<?php

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
    // Disable register.
    'register' => false,

    // Disable password reset.
    'reset' => false
]);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/label/show-all', 'LabelingController@index')->name('label.index');
Route::get('/label/show-positive-images', 'LabelingController@showPositives')->name('label.show.positives');
Route::get('/label/show-negative-images', 'LabelingController@showNegatives')->name('label.show.negatives');
Route::get('/label/show-not-labelled', 'LabelingController@showNotLabelled')->name('label.show.not.labelled');
Route::post('/search', 'LabelingController@search')->name('label.search');
Route::get('/label/edit/{requestid}', 'LabelingController@edit')->name('label.edit');
Route::get('/upload', 'ImageUploadController@fileUpload')->name('file.upload');
Route::post('/upload/store', 'ImageUploadController@fileStore')->name('file.store');
Route::post('/label/update', 'LabelingController@update')->name('label.update');
Route::get('/label/mark/{requestid}', 'LabelingController@mark')->name('label.mark');
Route::get('/label/mark/image/mark-area/{requestid}', 'ImageAreaMarkController@index')->name('image.mark');
Route::post('/label/mark/image/mark-area/store', 'ImageAreaMarkController@store')->name('image.mark.store');
Route::get('/label/mark/image/mark-area/delete/{requestid}', 'ImageAreaMarkController@delete')->name('image.mark.delete');
Route::get('/label/delete/{requestid}', 'LabelingController@delete')->name('label.delete');
Route::get('/archive/download/positive-iva', 'ArchiveController@downloadZipPositiveIVA')->name('download.positive.iva');
Route::get('/archive/download/negative-iva', 'ArchiveController@downloadZipNegativeIVA')->name('download.negative.iva');
Route::get('/user/control', 'UserController@index')->name('user.settings');
Route::post('/user/control/update', 'UserController@update')->name('user.update');
Route::post('/user/control/change-password', 'UserController@changePassword')->name('user.change.password');
Route::post('/user/generate-api-token', 'UserController@generateApiToken')->name('user.generate.api.token');
Route::post('/user/revoke-api-token', 'UserController@revokeApiToken')->name('user.revoke.api.token');
