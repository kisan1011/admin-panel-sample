<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'v1'], function(){
	// User Authonticate
	Route::post('signup',[App\Http\Controllers\api\v1\AuthController::class,'Register']);
	Route::post('social_signup',[App\Http\Controllers\api\v1\AuthController::class,'SocialLogin']);
	Route::post('signin',[App\Http\Controllers\api\v1\AuthController::class,'Login']);
	Route::post('forgotpassword',[App\Http\Controllers\api\v1\AuthController::class,'ForgotPasword']);
	// Authenticate
	Route::group(['middleware' => ['auth:api']], function() {
		// User
		Route::post('profile',[App\Http\Controllers\api\v1\AuthController::class,'GetUserProfile']);
		Route::post('change_password',[App\Http\Controllers\api\v1\AuthController::class,'ChangePassword']);
		Route::post('logout',[App\Http\Controllers\api\v1\AuthController::class,'Logout']);
		// Category
		Route::post('category',[App\Http\Controllers\api\v1\CategoryController::class,'GetCategory']);
	});
});