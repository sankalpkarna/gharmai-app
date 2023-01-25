<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


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

Route::get('/', function () {
    return redirect('auth/login');
});

//Calling view from the Webpage controller
Route::view('/about','about');
Route::view('/contact','contact');
Route::view('/noaccess','noaccess');

//Calling view from the Auth controller
Route::get('/auth/login',[AuthController::class, 'login'])->name('login');
Route::post('/auth/loginUser',[AuthController::class,'loginUser'])->name('login.user');
Route::get('/auth/register',[AuthController::class,'register'])->name('register');
Route::post('/auth/registerUser',[AuthController::class, 'registerUser'])->name('register.user');
Route::get('/auth/recover',[AuthController::class, 'recover'])->name('recover');
Route::get('/auth/logout',[AuthController::class,'logoutUser'])->name('logout');

//Calling view from the Home controller
Route::get('/home', [HomeController::class, 'index'])->name('home'); 

//Calling view from the Profile controller

Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
Route::post('/profile/update',[ProfileController::class,'profileUpdate'])->name('profile.update');
Route::get('/profile/security',[ProfileController::class, 'profileSecurity'])->name('profile.security');

//Calling view from the User controller
Route::get('/user',[UserController::class,'index'])->name('user');
Route::get('/user/add',[UserController::class,'add'])->name('user.add');
Route::post('/user/store',[UserController::class,'store'])->name('user.store');
Route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update',[UserController::class,'update'])->name('user.update');
Route::get('/user/delete/{id}',[UserController::class,'destroy'])->name('user.destroy');


//Rest Controller Url's
Route::get('/rest/index',[RestController::class,'index']);

Route::get('provider/index',[ProviderController::class,'index']);