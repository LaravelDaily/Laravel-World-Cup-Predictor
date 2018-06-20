<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::post('teams_restore/{id}', ['uses' => 'Admin\TeamsController@restore', 'as' => 'teams.restore']);
    Route::delete('teams_perma_del/{id}', ['uses' => 'Admin\TeamsController@perma_del', 'as' => 'teams.perma_del']);
    Route::resource('matches', 'Admin\MatchesController');
    Route::get('matches/predict/{match_id}', 'Admin\MatchesController@predict')->name('matches.predict');
    Route::post('matches/predict/{match_id}', 'Admin\MatchesController@postPredict')->name('matches.post_predict');
    Route::post('matches_mass_destroy', ['uses' => 'Admin\MatchesController@massDestroy', 'as' => 'matches.mass_destroy']);
    Route::post('matches_restore/{id}', ['uses' => 'Admin\MatchesController@restore', 'as' => 'matches.restore']);
    Route::delete('matches_perma_del/{id}', ['uses' => 'Admin\MatchesController@perma_del', 'as' => 'matches.perma_del']);
    Route::resource('predictions', 'Admin\PredictionsController');
    Route::post('predictions_mass_destroy', ['uses' => 'Admin\PredictionsController@massDestroy', 'as' => 'predictions.mass_destroy']);
    Route::post('predictions_restore/{id}', ['uses' => 'Admin\PredictionsController@restore', 'as' => 'predictions.restore']);
    Route::delete('predictions_perma_del/{id}', ['uses' => 'Admin\PredictionsController@perma_del', 'as' => 'predictions.perma_del']);



 
});
