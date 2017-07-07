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

/* Index  */
Route::get('/', function () {
    return redirect(route('accounts.index'));
});

/* Auth */
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('account.index');
    });
});
Route::middleware('guest')->group(function () {
    Route::get('login', function() {
        return view('login');
    });
});

/* UsersController */
Route::resource('users', 'UsersController');

/* AccountsController */
Route::resource('accounts', 'AccountsController');

/**
 * Socialite
 */
Route::get('social/{provider}', [
    'as'   => 'social.login',
    'uses' => 'SocialController@execute',
]);
Route::get('social/{provider}/callback', [
    'as'   => 'social.callback',
    'uses' => 'SocialController@handleProviderCallback',
]);