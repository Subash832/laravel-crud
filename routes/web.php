<?php

Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->router->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->router->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->router->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->router->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->router->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->router->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->router->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->router->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->router->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->router->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->router->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');

   
    Route::resource('payments', 'Admin\PaymentsController');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    
   
    
   
   
    Route::get('/{uuid}/download', 'Admin\DownloadsController@download');
    
 
   
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



 
});
