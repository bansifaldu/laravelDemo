<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::post('/changeLanguage', [App\Http\Controllers\LanguageTranslationController::class, 'index'])->name('changeLanguage');
// Auth::routes(['verify' => true]);
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/visitordashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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

// Route::get('mail', function(){
//     \Mail::raw("Testing", function($message){
//         $message->to("bansi.faldu@iflair.com");
//     });
// });

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\UserwelcomeController::class, 'index'])->name('userwelcome');
//fronted routes//

Route::get('/visitor_login', [App\Http\Controllers\UserwelcomeController::class, 'visitor_login'])->name('visitor_login');
Route::get('/visitor_register', [App\Http\Controllers\UserwelcomeController::class, 'visitor_register'])->name('visitor_register');
Route::post('/visitorLogin', 'App\Http\Controllers\Auth\LoginController@visitorLogin')->name('visitorLogin');

Route::post('/createVisitor', 'App\Http\Controllers\Auth\RegisterController@createVisitor')->name('createVisitor');


Route::post('/visitor/email/verification/resend',[App\Http\Controllers\EmailVerifyController::class, 'resend'])->name('verification.resend');
Route::get('/visitor/email/verify',[App\Http\Controllers\AdminController::class,'show'])->name('verification.notice');
Route::get('/visitor/email/{id}/{hash}',[App\Http\Controllers\EmailVerifyController::class,'verify'])->name('verification.verify');
Route::get('/verify/{token}', 'App\Http\Controllers\VerifyController@VerifyEmail')->name('verify');



// Route::middleware('verified:visitor.verification.notice')->get('/visitordashboard', 'App\Http\Controllers\VisitordashboardController@index')->name('visitordashboard');

  Route::get('/visitordashboard', 'App\Http\Controllers\VisitordashboardController@index')->name('visitordashboard');
// echo "hhhhhii"; exit;
Route::post('/logoutvisitor', 'App\Http\Controllers\Auth\LoginController@logoutvisitor')->name('logoutvisitor')->middleware('auth:visitor');


//
Route::post('/admin_logout', 'App\Http\Controllers\Auth\LoginController@admin_logout')->name('admin_logout');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
Route::get('/roles', 'App\Http\Controllers\PermissionController@Permission');
Auth::routes();
Route::get('register_con', 'App\Http\Controllers\Auth\RegisterController@register_con')->name('register_con');

// Route::group(['middleware' => 'role:developer'], function() {
    //    echo "hii";exit;
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth','verified');

        //declare controller function
        // echo "hii";exit;

    //    return 'Welcome Admin';exit;
       
   
 
//  });

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
// Route::get('/home', function() {
    
//      return view('home');
// })->name('home')->middleware('auth');
// Route::get('admin/list', [App\Http\Controllers\UserController::class, 'getuser'])->name('admin.list');
// Route::group(['prefix' => 'orders', 'middleware' => ['auth', 'check_merchant']], function () {

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
    Route::get('settings', 'App\Http\Controllers\UserController@user_setting');
    Route::post('user_setting_save', 'App\Http\Controllers\UserController@user_setting_save'); 
    Route::get('change_password', 'App\Http\Controllers\UserController@change_password');
    Route::post('change_password_save', 'App\Http\Controllers\UserController@change_password_save'); 
    Route::get('user_management', 'App\Http\Controllers\UserController@user_management')->name('admin.user_management');
    Route::get('getuser', 'App\Http\Controllers\UserController@getuser');
    Route::get('usermagagement_edit/{id}', 'App\Http\Controllers\UserController@usermagagement_edit'); 
    Route::get('list', [App\Http\Controllers\UserController::class, 'getuser'])->name('admin.list');
    Route::post('usermagagement_edit_save', [App\Http\Controllers\UserController::class, 'usermagagement_edit_save'])->name('admin.usermagagement_edit_save');
    Route::get('deleteData/{id}', 'App\Http\Controllers\UserController@deleteData'); 
    Route::get('create_user', [App\Http\Controllers\UserController::class, 'create_user'])->name('admin.create_user');
    Route::post('create_user_save', [App\Http\Controllers\UserController::class, 'create_user_save'])->name('admin.create_user_save');
    Route::post('varifyemail', [App\Http\Controllers\UserController::class, 'varifyemail'])->name('admin.varifyemail');
    Route::post('user_create_emailveify', [App\Http\Controllers\UserController::class, 'user_create_emailveify'])->name('admin.user_create_emailveify');

});
Route::group(['prefix' => 'role'], function () {
    Route::get('role_management', 'App\Http\Controllers\RoleController@index')->name('role.role_management');
    Route::get('list', [App\Http\Controllers\RoleController::class, 'getrole'])->name('role.list');
    Route::get('create_role', [App\Http\Controllers\RoleController::class, 'create_role'])->name('role.create_role');
    Route::post('create_role_save', [App\Http\Controllers\RoleController::class, 'create_role_save'])->name('role.create_role_save');
    Route::get('role_edit/{id}', 'App\Http\Controllers\RoleController@role_edit'); 
    Route::post('role_edit_save', [App\Http\Controllers\RoleController::class, 'role_edit_save'])->name('role.role_edit_save');
    Route::get('deleteData/{id}', 'App\Http\Controllers\RoleController@deleteData'); 
    Route::post('changestatusid', [App\Http\Controllers\RoleController::class, 'changestatusid'])->name('role.changestatusid'); 
});   
Route::group(['prefix' => 'permission'], function () {
    Route::get('permission_management', 'App\Http\Controllers\PermissionController@index')->name('permission.permission_management');
    Route::get('list', [App\Http\Controllers\PermissionController::class, 'getpermission'])->name('permission.list');
    Route::get('create_permission', [App\Http\Controllers\PermissionController::class, 'create_permission'])->name('permission.create_permission');
    Route::post('create_permission_save', [App\Http\Controllers\PermissionController::class, 'create_permission_save'])->name('permission.create_permission_save');
    Route::get('permission_edit/{id}', 'App\Http\Controllers\PermissionController@permission_edit'); 
    Route::post('permission_edit_save', [App\Http\Controllers\PermissionController::class, 'permission_edit_save'])->name('permission.permission_edit_save');
    Route::get('deleteData/{id}', 'App\Http\Controllers\PermissionController@deleteData'); 

});
Route::group(['prefix' => 'category'], function () {
    Route::get('category_management', 'App\Http\Controllers\CategoryController@index')->name('category.category_management');
    Route::get('list', [App\Http\Controllers\CategoryController::class, 'getcategory'])->name('category.list');
    Route::get('create_category', [App\Http\Controllers\CategoryController::class, 'create_category'])->name('category.create_category');
    Route::post('create_category_save', [App\Http\Controllers\CategoryController::class, 'create_category_save'])->name('category.create_category_save');
    Route::get('category_edit/{id}', 'App\Http\Controllers\CategoryController@category_edit'); 
    Route::post('category_edit_save', [App\Http\Controllers\CategoryController::class, 'category_edit_save'])->name('category.category_edit_save');
    Route::post('deleteData', 'App\Http\Controllers\CategoryController@deleteData'); 

});

Route::group(['prefix' => 'blogs'], function () {
    Route::get('blogs_management', 'App\Http\Controllers\BlogController@index')->name('blogs.blogs_management');
    Route::get('list', [App\Http\Controllers\BlogController::class, 'getblogs'])->name('blogs.list');
    Route::get('create_blogs', [App\Http\Controllers\BlogController::class, 'create_blogs'])->name('blogs.create_blogs');
    Route::post('create_blogs_save', [App\Http\Controllers\BlogController::class, 'create_blogs_save'])->name('blogs.create_blogs_save');
    Route::get('blogs_edit/{id}', 'App\Http\Controllers\BlogController@blogs_edit'); 
    Route::post('blogs_edit_save', [App\Http\Controllers\BlogController::class, 'blogs_edit_save'])->name('blogs.blogs_edit_save');
    Route::post('deleteData', 'App\Http\Controllers\BlogController@deleteData'); 

});

Route::get('/view_composer', 'App\Http\Controllers\ViewcomposerController@index')->name('view_composer');
Route::get('/view_composer/foo', 'App\Http\Controllers\ViewcomposerController@foo')->name('foo');
Route::get('/view_composer/bar', 'App\Http\Controllers\ViewcomposerController@bar')->name('bar');
Route::get('/view_composer/baz', 'App\Http\Controllers\ViewcomposerController@baz')->name('baz');

Route::get('validation_demo/validation_demo_management', [App\Http\Controllers\Validation_demoController::class, 'index'])->name('index');
