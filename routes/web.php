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
Route::get('/label', 'LabelingController@index')->name('label.index');
Route::post('/search', 'LabelingController@search')->name('label.search');
Route::get('/label/edit/{requestid}', 'LabelingController@edit')->name('label.edit');
Route::get('/upload', 'ImageUploadController@fileUpload')->name('file.upload');
Route::post('/upload/store', 'ImageUploadController@fileStore')->name('file.store');
Route::post('/label/update', 'LabelingController@update')->name('label.update');
Route::get('/label/mark/{requestid}', 'LabelingController@mark')->name('label.mark');
Route::get('/label/delete/{requestid}', 'LabelingController@delete')->name('label.delete');
Route::get('/archive/download/positive-iva', 'ArchiveController@downloadZipPositiveIVA')->name('download.positive.iva');
Route::get('/archive/download/negative-iva', 'ArchiveController@downloadZipNegativeIVA')->name('download.negative.iva');
