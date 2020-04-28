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

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/label', 'LabelingController@index')->name('label.index');
Route::get('/label/edit/{requestid}', 'LabelingController@edit')->name('label.edit');
Route::get('/upload', 'ImageUploadController@fileUpload')->name('file.upload');
Route::post('/upload/store', 'ImageUploadController@fileStore')->name('file.store');
Route::post('/label/update', 'LabelingController@update')->name('label.update');
