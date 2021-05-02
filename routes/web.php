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
Route::post('buy/admin/process', 'BookingController@addadmin')->name('booking.store.admin');

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('bed', 'BedController');

    Route::get('request/bed', 'BedRequestController@index')->name('bed.request');
    Route::put('request/bed/create/{id}', 'BedRequestController@create')->name('bed.requestcreate');
    Route::put('request/bed/edit/{id}', 'BedRequestController@edit')->name('bed.requestedit');
    Route::put('request/bed/delete/{id}', 'BedRequestController@delete')->name('bed.requestdelete');
    Route::put('request/bed/cancel/{id}', 'BedRequestController@cancel')->name('bed.requestcancel');

    Route::resource('class', 'ClassController');

    Route::get('request/class', 'ClassRequestController@index')->name('class.request');
    Route::put('request/class/create/{id}', 'ClassRequestController@create')->name('class.requestcreate');
    Route::put('request/class/edit/{id}', 'ClassRequestController@edit')->name('class.requestedit');
    Route::put('request/class/delete/{id}', 'ClassRequestController@delete')->name('class.requestdelete');
    Route::put('request/class/cancel/{id}', 'ClassRequestController@cancel')->name('class.requestcancel');

    Route::get('request-image/class', 'ClassImageRequestController@index')->name('class.image-request');
    Route::put('request-image/class/approve/{id}', 'ClassImageRequestController@approve')->name('class.request-image.approve');
    Route::put('request-image/class/reject/{id}', 'ClassImageRequestController@reject')->name('class.request-image.reject');

    Route::resource('room', 'RoomController');

    Route::get('request/room', 'RoomRequestController@index')->name('room.request');
    Route::put('request/room/create/{id}', 'RoomRequestController@create')->name('room.requestcreate');
    Route::put('request/room/edit/{id}', 'RoomRequestController@edit')->name('room.requestedit');
    Route::put('request/room/delete/{id}', 'RoomRequestController@delete')->name('room.requestdelete');
    Route::put('request/room/cancel/{id}', 'RoomRequestController@cancel')->name('room.requestcancel');

    Route::resource('room-number', 'RoomNumberController');
    
    Route::put('request/room-number/non-active/{id}', 'RoomNumberRequestController@toNonActive')->name('room-number.nonactive');
    Route::put('request/room-number/active/{id}', 'RoomNumberRequestController@toActive')->name('room-number.active');

    Route::get('request/room-number', 'RoomNumberRequestController@index')->name('room-number.request');
    Route::put('request/room-number/create/{id}', 'RoomNumberRequestController@create')->name('room-number.requestcreate');
    Route::put('request/room-number/edit/{id}', 'RoomNumberRequestController@edit')->name('room-number.requestedit');
    Route::put('request/room-number/delete/{id}', 'RoomNumberRequestController@delete')->name('room-number.requestdelete');
    Route::put('request/room-number/cancel/{id}', 'RoomNumberRequestController@cancel')->name('room-number.requestcancel');

    Route::resource('user', 'UserController');
    Route::put('update/user-image/{id}', 'UserController@updateImage')->name('user.image-update');

    Route::put('request/user/non-active/{id}', 'UserRequestController@toNonActive')->name('user.nonactive');
    Route::put('request/user/active/{id}', 'UserRequestController@toActive')->name('user.active');

    Route::get('request/user', 'UserRequestController@index')->name('user.request');
    // Route::put('request/user/create/{id}', 'UserRequestController@create')->name('user.requestcreate');
    // Route::put('request/user/edit/{id}', 'UserRequestController@edit')->name('user.requestedit');
    Route::put('request/user/delete/{id}', 'UserRequestController@delete')->name('user.requestdelete');
    Route::put('request/user/cancel/{id}', 'UserRequestController@cancel')->name('user.requestcancel');

    Route::resource('booking', 'BookingController');

    Route::get('customer/booking', 'BookProcessController@index')->name('booking.customer');
    Route::put('booking/buying/{id}/{rmid?}', 'BookProcessController@buying')->name('booking.buying');
    Route::put('booking/roomupdate/{id}', 'BookProcessController@roomupdate')->name('booking.roomupdate');
    Route::put('booking/approval/{id}', 'BookProcessController@approval')->name('booking.approve');
    Route::put('booking/decline/{id}/{rmid?}', 'BookProcessController@decline')->name('booking.decline');
    Route::put('booking/check-in/{id}', 'BookProcessController@checkin')->name('booking.checkin');
    Route::put('booking/check-out/{id}/{rmid?}', 'BookProcessController@checkout')->name('booking.checkout');

    Route::resource('dynamic-data', 'DynamicDataController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    Route::put('image-update', 'SettingsController@updateImage')->name('image.update');
});

Route::group(['as' => 'receptionist.', 'prefix' => 'receptionist', 'namespace' => 'Receptionist', 'middleware' => ['auth', 'receptionist']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('bed', 'BedController');

    Route::get('request/bed', 'BedRequestController@request')->name('bed.request');
    Route::post('request-delete/bed/{id}', 'BedRequestController@reqdelete')->name('bed.requestdelete');

    Route::resource('class', 'ClassController');

    Route::get('request/class', 'ClassRequestController@request')->name('class.request');
    Route::post('request-delete/class/{id}', 'ClassRequestController@reqdelete')->name('class.requestdelete');

    Route::get('request-image/class', 'ClassImageRequestController@index')->name('class.image-request');
    Route::get('request-image/edit/{id}/class', 'ClassImageRequestController@edit')->name('class.image-request.edit');
    Route::put('request-image/update/{id}/class', 'ClassImageRequestController@update')->name('class.request-image.update');
    
    Route::resource('room', 'RoomController');

    Route::get('request/room', 'RoomRequestController@request')->name('room.request');
    Route::post('request-delete/room/{id}', 'RoomRequestController@reqdelete')->name('room.requestdelete');

    Route::resource('room-number', 'RoomNumberController');
    Route::put('room-number/non-active/{id}', 'RoomNumberRequestController@toNonActive')->name('room-number.nonactive');
    Route::put('room-number/active/{id}', 'RoomNumberRequestController@toActive')->name('room-number.active');
    Route::get('request/room-number', 'RoomNumberRequestController@request')->name('room-number.request');

    Route::resource('user', 'UserController');
    Route::put('update/user-image/{id}', 'UserController@updateImage')->name('user.image-update');
    Route::put('request/user/non-active/{id}', 'UserRequestController@toNonActive')->name('user.nonactive');
    Route::put('request/user/active/{id}', 'UserRequestController@toActive')->name('user.active');
    Route::get('request/user', 'UserRequestController@request')->name('user.request');

    Route::resource('booking', 'BookingController');

    Route::get('customer/booking', 'BookProcessController@index')->name('booking.customer');
    Route::put('booking/buying/{id}/{rmid?}', 'BookProcessController@buying')->name('booking.buying');
    Route::put('booking/roomupdate/{id}', 'BookProcessController@roomupdate')->name('booking.roomupdate');
    Route::put('booking/approval/{id}', 'BookProcessController@approval')->name('booking.approve');
    Route::put('booking/decline/{id}/{rmid?}', 'BookProcessController@decline')->name('booking.decline');
    Route::put('booking/check-in/{id}', 'BookProcessController@checkin')->name('booking.checkin');
    Route::put('booking/check-out/{id}/{rmid?}', 'BookProcessController@checkout')->name('booking.checkout');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    Route::put('image-update', 'SettingsController@updateImage')->name('image.update');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('booking', 'BookingController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    Route::put('image-update', 'SettingsController@updateImage')->name('image.update');
});