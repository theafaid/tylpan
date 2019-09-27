<?php

// Assign a delegate for an order
Route::post('/orders/{order}/delegate', 'OrderDelegateController@assign');
// Remove assigned delegate for an order
Route::delete('/orders/{order}/delegate', 'OrderDelegateController@dismiss');
// Fetch Delegates from a country
Route::get('/countries/{country}/delegates', 'CountryDelegateController@index');

/** =========== Routes requires super admin rule =============== */
Route::group(['middleware' => 'admin.super'], function () {
    // Dashboard Index
    Route::get('/', 'DashboardController')->name('dashboard.index');
    // Users resource
    Route::resource('/users', 'UserController')->except(['edit', 'update']);
    // Site Settings Page
    Route::get('settings', 'SettingController@index')->name('settings');
    // Update site general settings
    Route::patch('settings/general', 'SettingController@updateGeneralSettings')->name('general_settings');
    // Update site additional settings
    Route::patch('settings/additional', 'SettingController@updateAdditionalSettings')->name('additional_settings');
    // Site Features
    Route::resource('features', 'FeatureController')->except(['edit', 'update', 'show']);
    // Countries resource
    Route::resource('countries', 'CountryController')->except(['destroy']);
    // Universities Resource
    Route::resource('universities', 'UniversityController');
});

/** ======== Routes for delegates, admins, super_admins */
Route::resource('orders', 'OrderController');
