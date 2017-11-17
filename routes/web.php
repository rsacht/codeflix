<?php

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
    return view('welcome');
});

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')->name('email-verification.check');


//Rotas de Recuperação de Senha
Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
],function(){
    //Rotas publicas
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    //Rotas privadas, permitidas apenas a administradores
    Route::group(['middleware' => ['isVerified','can:admin']], function (){
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('dashboard', function(){
            return view('admin.dashboard');
        });
        //USUÁRIOS
        Route::resource('users', 'UsersController');
        // Alteração de senha do usuário
        Route::get('users/settings', 'Auth\UserSettingsController@edit')->name('user_settings.edit');
        Route::put('users/settings', 'Auth\UserSettingsController@update')->name('user_settings.update');
        //CATEGORIAS
        Route::resource('categories', 'CategoryController');
    });
});

Route::get('/force-login', function(){
    \Auth::loginUsingId(1);
});
