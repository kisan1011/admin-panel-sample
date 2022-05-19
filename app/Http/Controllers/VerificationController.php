<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class VerificationController extends Controller
{
    public function EmailVerification($user_id){
    	try{
    		$decrypted_id  = decrypt($user_id);	
    		$user = User::where('id', $decrypted_id)->where('role','!=', 'admin')->first();
    		if($user){
    			$user->verify_status = 1;
	            $user->email_verified_at = date('Y-m-d G:i:s');
	      		$user->save();
	      		$user_details = ['status' => true, 'message'=>"Success.",'data'=>$user];
    		} else {
    			$user_details = ['status' => false, 'message'=>"User not found"];
    		}
    	} catch(Exception $e) {
    		$user_details = ['status' => false, 'message'=>"User not found"];
    	}
    	return view('templates.email_verification_response')->with('user',$user_details);
    }
}
