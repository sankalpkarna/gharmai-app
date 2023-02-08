<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderAPIController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    //Route::get("customer",[CustomerAPIController::class,'getData']);
    Route::get("provider/index/{id?}",[ProviderAPIController::class,'index']);
    Route::post("provider/add",[ProviderAPIController::class,'store']);
    Route::put("provider/update/{id}",[ProviderAPIController::class,'update']);
    Route::delete("provider/delete/{id}",[ProviderAPIController::class,'destroy']);
    Route::get("provider/search/{name}",[ProviderAPIController::class,'search']);
});

