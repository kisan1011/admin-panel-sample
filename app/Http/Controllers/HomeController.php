<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\AdminProfileRequest;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $dashboard_count['users'] = User::where('role','!=','admin')->count();
        $dashboard_count['category'] = Category::count();
        return view('admin.home',compact('title'))->with('dashboard',$dashboard_count);
    }

    public function profile()
    {
        $title = 'Profile';
        $user = Auth::user();
        return view('admin.profile',compact('title'))->with('user',$user);
    }

    public function UpdateAdminProfile(AdminProfileRequest $request)
    {
        try{
            $post_data = $request->all();
            $valid_user = User::find($post_data['id']);
            if($valid_user){
                if(@$post_data['image']!=''){
                    $post_data['image'] = FileUploadHelper($post_data['image'],'profile');
                } else {
                    unset($post_data['image']);
                }
                unset($post_data['confirm_password']);
                $post_data['image'] = (@$post_data['image']!='') ? $post_data['image'] : $valid_user->image;
                $post_data['password'] = (@$post_data['password']!='') ? bcrypt($post_data['password']) : $valid_user->password;
                User::where('id',$post_data['id'])->update($post_data);
                return response()->json(['status' => true, 'message' => 'Profile successfully updated!','data'=>url('/').'/'.$post_data['image']]);
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid user detail!']);
            }
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }
}

