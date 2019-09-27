<?php

/** -------- Landing page -------- */
Route::get('/', 'LandingController@index')->name('welcome');

/** -------- Authentication ------- */
// custom logout
Route::any('logout', 'Auth\LoginController@logout')->name('logout');
// Authentication routes
Auth::routes(['verify' => true]);

/** -------- Countries -------- */
// index [travel to || travel from]
Route::get('/countries', 'CountryController@index')->name('countries.index');
// view single country
Route::get('/countries/{country}', 'CountryController@show')->name('countries.show');

/** -------- Static: How to start -------- */
Route::view('/how-to-start', 'static.how_to_start')->name('how_to_start');
/** -------- Static: About Us-------- */
Route::view('/about-us', 'static.about')->name('about');


Route::view('/terms', 'static.terms')->name('terms');

/** ================= Requires Authentication Routes ================== */
Route::group(['middleware' => 'auth'], function () {
    // Profile page
    Route::get('/profile/{user?}', 'ProfileController@index')->name('profile.index');
    // Profile General Settings
    Route::post('/profile/general-settings', 'ProfileController@updateGeneralSettings');
    Route::post('/profile/{user}/general-settings', 'ProfileController@updateGeneralSettings');
    // Profile Required education settings
    Route::post('/profile/required-education-settings', 'ProfileController@updateRequiredEducationSettings');
    Route::post('/profile/{user}/required-education-settings', 'ProfileController@updateRequiredEducationSettings');
    // Profile optional settings
    Route::post('/profile/optional-settings', 'ProfileController@updateOptionalSettings');
    Route::post('/profile/{user}/optional-settings', 'ProfileController@updateOptionalSettings');
    /** ============== Routes Requires Verified Email =============== */
    Route::group(['middleware' => 'verified'], function () {
        /** -------- Orders -------- */
        // Index Order
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        // Create order
        Route::get('/orders/create', 'OrderController@create')->name('orders.create');
        // Show Order
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        // Store order
        Route::post('/orders', 'OrderController@store')->name('orders.store');

        /** -------- Order Tasks -------- */
        // Index order tasks
        Route::get('/orders/{order}/tasks', 'TaskController@index')->name('tasks.index');
        // Store an order task
        Route::post('/orders/{order}/tasks', 'TaskController@store')->name('tasks.store');
        // Update an order task
        Route::patch('/orders/{order}/tasks/{task}', 'TaskController@update')->name('tasks.update');
        /** --------- Universities & Countries -------- */
        // View a single university
        Route::get('/countries/{country}/universities/{university}', 'UniversityController@show')->name('universities.show');
        // Fetch Universities according to Countries
        Route::get('/universities', 'UniversityController@index')->name('universities.index');
        /** -------- Notifications -------- */
        // Read Notification
        Route::post('notifications/{notification}', 'NotificationController@markAsRead');
        /** -------- Order Chat --------  */
        // Fetch old messages for order
        Route::get('chat/{order}', 'ChatController@get');
        // Send a message for order
        Route::post('chat/{order}', 'ChatController@send');
    });
});

Route::get('test', function (){
    abort(404);
//    return $ordersInThisCountry->map(function ($order) {
//        return \App\Models\Order::with('owner')->where('id', $order)->where('user_id', '!=', auth()->id())->get()->pluck('owner');
//    });
});

