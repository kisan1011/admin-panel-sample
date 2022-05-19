<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::Routes();
Route::get('/', function(){
   return redirect('login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// Authenticate
Route::group(['middleware' => ['auth']], function () {
    // Users
    Route::resource('users',App\Http\Controllers\UserController::class);
    Route::get('check_email_dublicate', [App\Http\Controllers\UserController::class, 'CheckEmailDublicate']);
    Route::get('check_username_dublicate', [App\Http\Controllers\UserController::class, 'CheckUsernameDublicate']);
    Route::post('multiple_user_delete',[App\Http\Controllers\UserController::class,'MultipleUserDelete']);
    Route::get('profiles', [App\Http\Controllers\HomeController::class, 'Profile']);
    Route::post('update_admin_profile', [App\Http\Controllers\HomeController::class, 'UpdateAdminProfile']);

    // Category
    // Route::resource('category',App\Http\Controllers\CategoryController::class);
    // Route::get('check_category_name_dublicate', [App\Http\Controllers\CategoryController::class, 'CategoryNameDublicate']);
    // Route::post('multiple_category_delete',[App\Http\Controllers\CategoryController::class,'MultipleCategoryDelete']);
    // Route::post('import', [App\Http\Controllers\CategoryController::class, 'import']);

    Route::get('category',function(){
        return view('category.categorylist',['page_title'=>'Category']);
    });
});

// Email verification
Route::get('verifyemail/{id}', [App\Http\Controllers\VerificationController::class, 'EmailVerification']);

// Forgot password
Route::get('passwordreset/{id}/{date}', [App\Http\Controllers\PasswordController::class, 'ResetPassword']);
Route::post('savepassword/{id}/{date}', [App\Http\Controllers\PasswordController::class, 'UpdatePassword']);
Route::get('thankyou', [App\Http\Controllers\PasswordController::class, 'Thankyou']);

// Command
Route::get('cache-clear', [App\Http\Controllers\CacheController::class, 'CacheClear'])->name('CacheClear');
Route::get('migrate-tables', [App\Http\Controllers\CacheController::class, 'MigrateTable'])->name('MigrateTable');

// Logout
Route::get('/logout', [App\Http\Controllers\CacheController::class, 'Logout'])->name('Logout');
