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

/********** Index  **********/
Route::get('/', function () {
    return redirect(route('accounts.index'));
});

/********** Auth **********/
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/accounts');
    });
});

/********** UsersController **********/
Route::resource('users', 'UsersController');

/********** AccountsController **********/
Route::resource('accounts', 'AccountsController',
                ['except' => ['create']],
                ['middleware' => ['web', 'auth']]
);
Route::get('accounts/{year?}/{month?}/{date?}',
    'AccountsController@index',
    ['middleware' => ['web', 'auth']],
    function($year = null, $month = null, $date = null) {
        if($year  == null) $year  = date('Y');
        if($month == null) $month = date('m');
        if($date  == null) $date  = date('d');
    }
);
Route::post('accounts/changeType', [
    'as'   => 'accounts.changeType',
    'uses' => 'AccountsController@changeType'
]);

/********** AssetController **********/
Route::resource('assets', 'AssetsController',
                ['middleware' => ['web', 'auth']]
);

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