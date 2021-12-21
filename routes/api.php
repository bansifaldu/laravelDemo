<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\Auth\ApiAuthController;

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
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('register', [RegisterController::class, 'register']);
//Route::post('login', [RegisterController::class, 'login']);

 Route::middleware('auth:api')->group( function () {

    Route::resource('products', ProductController::class);
 });
Route::group(['middleware' => ['cors', 'json.response']], function () {

    // ...

    // public routes
    Route::post('login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('register', [ApiAuthController::class, 'register'])->name('register.api');


    // ...
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
        Route::post('logout', [ApiAuthController::class, 'logout'])->name('logout.api');

});