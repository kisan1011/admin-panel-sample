<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Crypt;
use Illuminate\Support\Facades\Validator;
use Exception;

class PasswordController extends Controller
{
    public function ResetPassword($id, $date) {
		try{
    		$decrypted_id  = decrypt($id);	
    		$user = User::where('id', $decrypted_id)->where('role','!=', 'admin')->first();
    		if($user && $date==md5(date('d-m-Y'))){
    			$user->status = 1;
    		} else {
    			$user->status = 0;
    		}
    		$user->user_id = $id;
    		$user->date = $date;
    		return view('reset_password',$user);
    	} catch(Exception $e) {
    		abort(404, 'Not Found');
    	}
    }

    public function UpdatePassword(Request $request){
    	$validate = Validator::make($request->all(), [
    		'password'	=>	'required|min:8|confirmed',
    	]);

    	if($validate->fails()){
    		return redirect()->back()->withErrors($validate->errors());
    	} else {
		    $status = 0;
    		$post_data = $request->all();
    		try{
	    		$decrypted_id  = decrypt($post_data['id']);
	    		$user = User::where('id', $decrypted_id)->where('role','!=','admin')->first();
	    		if($user){
		    		$input = array(
		    			'password'	=>	$post_data['password'],
		    		);
		    		$user->update($input);
					return redirect('thankyou');
		    	} else {
		    		return redirect()->back()->withError('password','No user found with such data!', $status);
		    	}
	    	} catch(DecryptException $e) {
	    		return redirect()->back()->withError('password','Error while processing!', $status);
	    	}    		
    	}
    }

    public function Thankyou(){
    	return view('thank_you_message');
    }
}
