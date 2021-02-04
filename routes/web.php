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

Auth::routes();


//Home Controller
Route::get('/', 'HomeController@index')->name('index');
Route::get('/category/{name}/{id}/announcements', 'HomeController@announcementsByCategory')->name('home.announcements.category');
Route::post('/locale/{locale}', 'HomeController@locale')->name('locale');

//User Controller
Route::get('/user/{id}/profile', 'UserController@profile')->name('users.profile');

//Admin Controller
Route::get('/admin', 'AdminController@index')->name('admin.home');
Route::get('/admin/rejected', 'AdminController@rejected')->name('admin.rejected');
Route::post('/admin/{id}/accepted', 'AdminController@setAccepted')->name('admin.announcement.accepted');
Route::post('/admin/{id}/rejected', 'AdminController@setRejected')->name('admin.announcement.rejected');
Route::delete('/admin/{id}/delete', 'AdminController@delete')->name('admin.announcement.delete');


// AnnouncemnentController
Route::get('/announcements/create', 'AnnouncementController@create')->name('announcements.create');

Route::post('/announcement/images/upload', 'AnnouncementController@uploadImage')->name('announcements.images.upload');
Route::delete('/announcement/images/remove', 'AnnouncementController@removeImage')->name('announcements.images.remove');
Route::get('/announcement/images', 'AnnouncementController@getImages')->name('announcement.images');

Route::post('/announcements/store', 'AnnouncementController@store')->name('announcements.store');
Route::get('/announcements/{announcement}/show', 'AnnouncementController@show')->name('announcements.show');
Route::get('/announcements/{announcement}/edit', 'AnnouncementController@edit')->name('announcements.edit');
Route::put('/announcements/{announcement}/update', 'AnnouncementController@update')->name('announcements.update');
Route::delete('/announcements/{announcement}/delete', 'AnnouncementController@destroy')->name('announcements.delete');

