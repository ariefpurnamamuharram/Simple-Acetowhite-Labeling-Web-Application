<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::get('/', 'WelcomeController@index')->name('welcome');


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/all', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/positives', 'DashboardController@showPositives')->name('dashboard.show.positives');
Route::get('/dashboard/negatives', 'DashboardController@showNegatives')->name('dashboard.show.negatives');


/*
|--------------------------------------------------------------------------
| File Routes
|--------------------------------------------------------------------------
*/

Route::get('/file/page={page}/edit/filename={requestid}', 'DashboardController@edit')->name('file.edit');
Route::get('/file/mark-area/filename={requestid}', 'ImageAreaMarkController@index')->name('image.mark');
Route::get('/file/mark-area/delete/markid={requestid}', 'ImageAreaMarkController@delete')->name('image.mark.delete');
Route::post('/file/update', 'DashboardController@update')->name('file.update');
Route::post('/file/mark-area/store', 'ImageAreaMarkController@store')->name('image.mark.store');
Route::post('/file/delete-label', 'DashboardController@delete')->name('file.delete.label');


/*
|--------------------------------------------------------------------------
| Upload Routes
|--------------------------------------------------------------------------
*/

Route::get('/upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('/upload/store', 'FileUploadController@fileStore')->name('file.store');


/*
|--------------------------------------------------------------------------
| Archive Routes
|--------------------------------------------------------------------------
*/

Route::get('/archive/download/positives', 'ArchiveController@downloadPositives')->name('download.positives');
Route::get('/archive/download/negatives', 'ArchiveController@downloadNegatives')->name('download.negatives');


/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/

Route::post('/search', 'SearchController@search')->name('file.search');


/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/

Route::get('/user/my', 'UserController@index')->name('user.settings');
Route::post('/user/my/update', 'UserController@update')->name('user.update');
Route::post('/user/my/change-password', 'PasswordController@changePassword')->name('password.change');
Route::post('/user/my/generate-api-token', 'UserController@generateApiToken')->name('user.generate.api.token');
Route::post('/user/my/revoke-api-token', 'UserController@revokeApiToken')->name('user.revoke.api.token');


/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
*/

Route::get('/administrator/dashboard', 'AdministratorController@dashboard')->name('administrator.dashboard');
Route::get('/administrator/dashboard/inconclusive-images', 'AdministratorController@dashboardInconclusiveImages')->name('administrator.dashboard.inconclusive.images');
Route::get('/administrator/users', 'AdministratorController@users')->name('administrator.users');
Route::get('/administrator/user/new', 'AdministratorController@newUser')->name('administrator.new.user');
Route::get('/administrator/image-area-marks/{email}/{filename}', 'AdministratorController@imageAreaMarks')->name('administrator.area.marks');
Route::post('/administrator/user/store', 'AdministratorController@storeUser')->name('administrator.store.user');
Route::post('/administrator/user/delete', 'AdministratorController@deleteUser')->name('administrator.delete.user');
