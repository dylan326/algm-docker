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

Route::get('/user-timelogs', 'TimelogsController@getUserTimelogs')->name('user-timelogs');

Route::get('/component-metadata', 'ComponentsController@outputComponentMetaData')->name('component-metadata');

//these are just development testiing routes for the time being
/*Route::get('/users-data', [App\Classes\PullApiData::class, 'pullUserApi']);
Route::get('/components-data', [App\Classes\PullApiData::class, 'pullComponentApi']);
Route::get('/timelogs-data', [App\Classes\PullApiData::class, 'pullTimelogApi']);
Route::get('/issues-data', [App\Classes\PullApiData::class, 'pullIssuesApi']);
Route::get('/save-user-data', [App\Classes\SaveApiData::class, 'saveUsersData']);*/
Route::get('/pull-and-save-api-data', [App\Classes\SaveApiData::class, 'saveAll'])->name('pull-and-save-api-data');