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
Route::get('/', 'DashboardController@index')->name('primary');
Route::get('class/{id}/{slug?}', 'ClassController@details')->name('class.details');
Route::get('buy/{id}/{class_id?}/{bed_id?}/{class_slug?}/{bed_slug?}', 'ClassController@buypage')->name('class.buypage');
Route::post('buy/process', 'BookingController@add')->name('booking.store');

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('bed', 'BedController');
    Route::resource('class', 'ClassController');
    Route::resource('room', 'RoomController');
    Route::resource('room-number', 'RoomNumberController');
    Route::resource('user', 'UserController');

    Route::resource('booking', 'BookingController');

    Route::get('customer/booking', 'BookProcessController@index')->name('booking.customer');
    Route::put('booking/approval/{id}', 'BookProcessController@approval')->name('booking.approve');
    Route::put('booking/decline/{id}', 'BookProcessController@decline')->name('booking.decline');
    Route::put('booking/check-in/{id}', 'BookProcessController@checkin')->name('booking.checkin');
    Route::put('booking/check-out/{id}', 'BookProcessController@checkout')->name('booking.checkout');

    Route::resource('dynamic-data', 'DynamicDataController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
});

Route::group(['as' => 'receptionist.', 'prefix' => 'receptionist', 'namespace' => 'Receptionist', 'middleware' => ['auth', 'receptionist']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('bed', 'BedController');
    Route::resource('class', 'ClassController');
    Route::resource('room', 'RoomController');
    Route::resource('booking', 'BookingController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('booking', 'BookingController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
});