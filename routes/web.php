<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;


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
Route::get('/auth/verify/{token}', [AuthController::class, 'verify'])->name('verify'); 
Route::get('/auth/recover',[AuthController::class, 'recover'])->name('recover');
Route::post('/auth/recoverUser',[AuthController::class, 'recoverUser'])->name('recover.user');
Route::get('/auth/reset/{token}/{email}',[AuthController::class, 'reset'])->name('reset');
Route::post('/auth/resetUser',[AuthController::class, 'resetUser'])->name('reset.user');
Route::get('/auth/logout',[AuthController::class,'logoutUser'])->name('logout');

//Rest Controller Url's
Route::get('/rest/index',[RestController::class,'index']);

Route::group(['middleware' => ['auth']], function () {

    //Calling view from the Home controller
    Route::get('/home', [HomeController::class, 'index'])->name('home');  

    //Calling view from the Profile controller
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update',[ProfileController::class,'update'])->name('profile.update');
    Route::get('/profile/security',[ProfileController::class, 'security'])->name('profile.security');
    Route::post('/profile/change-password',[ProfileController::class,'changePassword'])->name('profile.change-password');

    //Calling view from the User Controller
    Route::get('/user',[UserController::class,'index'])->name('user');
    Route::get('/user/create',[UserController::class,'create'])->name('user.create');
    Route::post('/user/store',[UserController::class,'store'])->name('user.store');
    Route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update',[UserController::class,'update'])->name('user.update');
    Route::get('/user/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');   

    //Calling view from the Role Controller
    Route::get('/role',[RoleController::class,'index'])->name('role');
    Route::get('/role/create',[RoleController::class,'create'])->name('role.create');
    Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
    Route::get('/role/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update/{id}',[RoleController::class,'update'])->name('role.update');
    Route::get('/role/destroy/{id}',[RoleController::class,'destroy'])->name('role.destroy');
    
    //Calling view from the Permission Controller
    Route::get('/permission',[PermissionController::class,'index'])->name('permission');
    Route::get('/permission/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('/permission/store',[PermissionController::class,'store'])->name('permission.store');
    Route::get('/permission/edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permission.update');
    Route::get('/permission/destroy/{id}',[PermissionController::class,'destroy'])->name('permission.destroy');

    //Calling view from the Service Controller
    Route::get('/service',[ServiceController::class,'index'])->name('service');
    Route::get('/service/create',[ServiceController::class,'create'])->name('service.create');
    Route::post('/service/store',[ServiceController::class,'store'])->name('service.store');
    Route::get('/service/edit/{id}',[ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/service/update/{id}',[ServiceController::class,'update'])->name('service.update');
    Route::get('/service/destroy/{id}',[ServiceController::class,'destroy'])->name('service.destroy');

    //Calling view from the Provider Controller
    Route::get('/provider',[ProviderController::class,'index'])->name('provider');
    Route::get('/provider/create',[ProviderController::class,'create'])->name('provider.create');
    Route::post('/provider/store',[ProviderController::class,'store'])->name('provider.store');
    Route::get('/provider/edit/{id}',[ProviderController::class, 'edit'])->name('provider.edit');
    Route::post('/provider/update/{id}',[ProviderController::class,'update'])->name('provider.update');
    Route::get('/provider/destroy/{id}',[ProviderController::class,'destroy'])->name('provider.destroy');

    //Calling view from the Wallet Controller
    Route::get('/wallet',[WalletController::class,'index'])->name('wallet');
    Route::get('/wallet/create',[WalletController::class,'create'])->name('wallet.create');
    Route::post('/wallet/store',[WalletController::class,'store'])->name('wallet.store');
    Route::get('/wallet/edit/{id}',[WalletController::class, 'edit'])->name('wallet.edit');
    Route::post('/wallet/update/{id}',[WalletController::class,'update'])->name('wallet.update');
    Route::get('/wallet/destroy/{id}',[WalletController::class,'destroy'])->name('wallet.destroy');


    //Calling view from the Customer Controller
    Route::get('/customer',[CustomerController::class,'index'])->name('customer');
    Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create');
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
    Route::get('/customer/edit/{id}',[CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/update/{id}',[CustomerController::class,'update'])->name('customer.update');
    Route::get('/customer/destroy/{id}',[CustomerController::class,'destroy'])->name('customer.destroy');

    //Calling view from the Booking Controller
    Route::get('/booking',[BookingController::class,'index'])->name('booking');
    Route::get('/booking/create',[BookingController::class,'create'])->name('booking.create');
    Route::post('/booking/store',[BookingController::class,'store'])->name('booking.store');
    Route::get('/booking/edit/{id}',[BookingController::class, 'edit'])->name('booking.edit');
    Route::post('/booking/update/{id}',[BookingController::class,'update'])->name('booking.update');
    Route::get('/booking/destroy/{id}',[BookingController::class,'destroy'])->name('booking.destroy');

    //Calling view from the Payment Controller
    Route::get('/payment',[PaymentController::class,'index'])->name('payment');
    Route::get('/payment/create',[PaymentController::class,'create'])->name('payment.create');
    Route::post('/payment/store',[PaymentController::class,'store'])->name('payment.store');
    Route::get('/payment/edit/{id}',[PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/payment/update/{id}',[PaymentController::class,'update'])->name('payment.update');
    Route::get('/payment/destroy/{id}',[PaymentController::class,'destroy'])->name('payment.destroy');


    //Calling view from the Coupon Controller
    Route::get('/coupon',[CouponController::class,'index'])->name('coupon');
    Route::get('/coupon/create',[CouponController::class,'create'])->name('coupon.create');
    Route::post('/coupon/store',[CouponController::class,'store'])->name('coupon.store');
    Route::get('/coupon/edit/{id}',[CouponController::class, 'edit'])->name('coupon.edit');
    Route::post('/coupon/update/{id}',[CouponController::class,'update'])->name('service.update');
    Route::get('/coupon/destroy/{id}',[CouponController::class,'destroy'])->name('service.destroy');


   
    //Calling view from the Document Controller
    Route::get('/document',[DocumentController::class,'index'])->name('document');
    Route::get('/document/create',[DocumentController::class,'create'])->name('document.create');
    Route::post('/document/store',[DocumentController::class,'store'])->name('document.store');
    Route::get('/document/edit/{id}',[DocumentController::class, 'edit'])->name('document.edit');
    Route::post('/document/update/{id}',[DocumentController::class,'update'])->name('document.update');
    Route::get('/document/destroy/{id}',[DocumentController::class,'destroy'])->name('document.destroy');

    //Calling view from the Slider Controller
    Route::get('/slider',[SliderController::class,'index'])->name('slider');
    Route::get('/slider/create',[SliderController::class,'create'])->name('slider.create');
    Route::post('/slider/store',[SliderController::class,'store'])->name('slider.store');
    Route::get('/slider/edit/{id}',[SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update/{id}',[SliderController::class,'update'])->name('slider.update');
    Route::get('/slider/destroy/{id}',[SliderController::class,'destroy'])->name('slider.destroy');

    //Calling view from the Tax Controller
    Route::get('/tax',[TaxController::class,'index'])->name('tax');
    Route::get('/tax/create',[TaxController::class,'create'])->name('tax.create');
    Route::post('/tax/store',[TaxController::class,'store'])->name('tax.store');
    Route::get('/tax/edit/{id}',[TaxController::class, 'edit'])->name('tax.edit');
    Route::post('/tax/update/{id}',[TaxController::class,'update'])->name('tax.update');
    Route::get('/tax/destroy/{id}',[TaxController::class,'destroy'])->name('tax.destroy');

    //Calling view from the PaymentGateway Controller
    Route::get('/PaymentGatewayController',[PaymentGatewayController::class,'index'])->name('paymentgateway');
    Route::get('/paymentgateway/create',[PaymentGatewayController::class,'create'])->name('paymentgateway.create');
    Route::post('/paymentgateway/store',[PaymentGatewayController::class,'store'])->name('paymentgateway.store');
    Route::get('/paymentgateway/edit/{id}',[PaymentGatewayController::class, 'edit'])->name('paymentgateway.edit');
    Route::post('/paymentgateway/update/{id}',[PaymentGatewayController::class,'update'])->name('paymentgateway.update');
    Route::get('/paymentgateway/destroy/{id}',[PaymentGatewayController::class,'destroy'])->name('paymentgateway.destroy');


    //Calling view from the Notification Controller
    Route::get('/notification',[NotificationController::class,'index'])->name('notification');
    Route::get('/notification/create',[NotificationController::class,'create'])->name('notification.create');
    Route::post('/notification/store',[NotificationController::class,'store'])->name('notification.store');
    Route::get('/notification/edit/{id}',[NotificationController::class, 'edit'])->name('notification.edit');
    Route::post('/notification/update/{id}',[NotificationController::class,'update'])->name('notification.update');
    Route::get('/notification/destroy/{id}',[NotificationController::class,'destroy'])->name('notification.destroy');


    //Calling view from the Setting Controller
    Route::get('/setting',[SettingController::class,'index'])->name('setting');
    Route::get('/setting/create',[SettingController::class,'create'])->name('setting.create');
    Route::post('/setting/store',[SettingController::class,'store'])->name('setting.store');
    Route::get('/setting/edit/{id}',[SettingController::class, 'edit'])->name('setting.edit');
    Route::post('/setting/update/{id}',[SettingController::class,'update'])->name('setting.update');
    Route::get('/setting/destroy/{id}',[SettingController::class,'destroy'])->name('setting.destroy');


});    
