<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

//root route
Route::get('/', [DonationController::class, 'index']);




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider, and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Donations routes
Route::get('/donations/create', 'App\Http\Controllers\DonationController@create')->name('donations.create');
Route::post('/donations', 'App\Http\Controllers\DonationController@store')->name('donations.store');
Route::get('/donations', 'App\Http\Controllers\DonationController@index')->name('donations.index');
//Route::get('/donations', 'DonationController@index')->name('donations.index');
Route::get('/donations', 'App\Http\Controllers\DonationController@index')->name('donations.index'); // New route for displaying all donations
Route::get('/donations/{id}', 'App\Http\Controllers\DonationController@show')->name('donations.show');
Route::get('/donations/{id}/edit', 'App\Http\Controllers\DonationController@edit')->name('donations.edit');
Route::put('/donations/{id}', 'App\Http\Controllers\DonationController@update')->name('donations.update');
Route::patch('/donations/{id}', 'App\Http\Controllers\DonationController@update');
Route::patch('/donations/{id}/complete', 'App\Http\Controllers\DonationController@complete');
Route::get('/donations/{id}/participate', 'App\Http\Controllers\DonationController@participate')->name('donations.participate');
Route::post('/donations/{id}/participate', 'App\Http\Controllers\DonationController@participateStore')->name('donations.participateStore');
Route::get('/donation-history', 'App\Http\Controllers\DonationController@donationHistory')->name('donation.history');
Route::get('/donation/opened', 'App\Http\Controllers\DonationController@openedDonations')->name('donation.opened');
Route::delete('/donations/{id}', 'App\Http\Controllers\DonationController@destroy')->name('donations.destroy');






// User routes
Route::get('/register', 'UserController@create');
Route::post('/register', 'UserController@store');
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/donations', 'App\Http\Controllers\DonationController@store')->middleware('auth')->name('donations.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
