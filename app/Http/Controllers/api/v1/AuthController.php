<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{UserRegisterRequest,UserLoginRequest,ForgotPasswordRequest,UserSocialLoginRequest,ChangePasswordRequest};
use App\Models\User;
use GuzzleHttp\Client;
use Laravel\Passport\Client as OClient; 
use Illuminate\Support\Facades\Auth;
use URL;
use Crypt;
use Exception;
use Mail;
use Hash;

class AuthController extends Controller
{
    public function Register(UserRegisterRequest $request){
    	try{
            $post_data = $request->all();
            $post_data['role'] = 'user';
            $post_data['provider'] = 'email';
            $post_data['image'] = (@$post_data['image']!='') ? FileUploadHelper($post_data['image'],'profile') : '';
            $user = User::create($post_data);
            $link = URL::to("verifyemail/" . \Crypt::encrypt($user->id));
            $email_data = array(
                'name'      =>  $user->getFullname(),
                'title'         =>  \Config::get('app.name'),
                'link'          =>  $link,
                'verify_status' =>  $user->verify_status,
            );
            try {
                Mail::send('templates.signup_email', $email_data, function ($message) use ($user) {
                    $message->to($user->email, $user->getFullname())->subject(\Config::get('app.name').' - Verify Email');
                    $message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
                });
            } catch(Exception $e) {
                return response()->json(['status' => false, 'message'=>"Error while sending mail.",'errorMessage'=>$e->getMessage()]);
            }
            return response()->json(['status' => true, 'message' => 'Please verify your email address!']);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function Login(UserLoginRequest $request){
    	try{
            $post_data = $request->all();
            if(Auth::attempt(['email' => $post_data['email'], 'password' => $post_data['password']])) {
                $user = Auth::user();
                if($user->verify_status==1){
                    $user->device_token = $post_data['device_token'];
                    $user->save();
                    $token_details = $user->createToken(\Config::get('app.name'))->accessToken;
                    return response()->json(['status' => true, 'message' => 'Login successfully!','data'=>$user,'access_token'=>$token_details]);
                }
                else {
                    return response()->json(['status' => false, 'message' => 'Please verify your email address!']);  
                }
            } else {
                return response()->json(['status' => false, 'message' =>'Login credentials are invalid!']);
            }
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function ForgotPasword(ForgotPasswordRequest $request){
        try{
            $post = $request->all();
            $user = User::where('email', $post['email'])->where('role','!=','admin')->first();
            if($user){
                $encrypted_id = Crypt::encrypt($user->id);
                $date = md5(date('d-m-Y'));
                $link = URL::to("passwordreset/" . $encrypted_id . '/' . $date);
                $email_data = array(
                    'name'      =>  $user->getFullname(),
                    'title'         =>  \Config::get('app.name'),
                    'link'          =>  $link,
                );
                try{
                    Mail::send('templates.forgot_password_email', $email_data, function ($message) use ($user) {
                        $message->to($user->email,$user->name)->subject('Forgot Password Request');
                        $message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
                    });
                    return response()->json(['status' => true, 'message' => "Forgot password link sent on your email."]);
                } catch(\Exception $e) {
                    return response()->json(['status' => false, 'message' => 'Error while sending email!','data'=>$e->getMessage()]);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'No user found with this email!']);
            }
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function SocialLogin(UserSocialLoginRequest $request){
        try{
            $post_data = $request->all();
            $post_data['role'] = 'user';
            $user = User::where('email','=',$post_data['email'])->where('role','!=','admin')->first();
            if(empty($user)){
                $post_data['image'] = (@$post_data['image']!='') ? FileUploadHelper($post_data['image'],'profile') : '';
                $post_data['password'] = 'social_login_password';
                $post_data['verify_status'] = 1;
                $user = User::create($post_data);
            } else {
                $post_data['password'] = 'social_login_password';
                $user->update($post_data);
            }
            $user = User::find($user->id);
            $token_details = $user->createToken(\Config::get('app.name'))->accessToken;
            return response()->json(['status' => true, 'message' => 'Login successfully!','data'=>$user,'access_token'=>$token_details]);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function GetUserProfile(Request $request){
        try{
            $user = Auth::user();
            return response()->json(['status' => true, 'message' => 'data fetched successfully!', 'data' => $user]);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function ChangePassword(ChangePasswordRequest $request){
        try {
            $post_data = $request->all();
            $user_id = Auth::user()->id;
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                return response()->json(["status" => false, "message" => "Invalid old password."]);
            } else if ((Hash::check(request('password'), Auth::user()->password)) == true) {
                return response()->json(["status" => false, "message" => "Please enter a password which is not similar then current password."]);
            } else {
                User::where('id', $user_id)->update(['password' => bcrypt($post_data['password'])]);
                return response()->json(["status" => true, "message" => "Password updated successfully."]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function Logout(Request $request){
        try{
            $user = Auth::user();
            \DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
            return response()->json(['status' => true, 'message' => 'Successfully logout!']);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }
}
