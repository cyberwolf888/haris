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

Auth::routes();

//Frontend
Route::get('/', 'HomeController@index')->name('home');
Route::get('/detail/{id}', 'HomeController@product_detail')->name('frontend.product_detail');
Route::get('/cart', 'HomeController@cart_manage')->name('frontend.cart.manage');
Route::post('/cart/insert', 'HomeController@cart_insert')->name('frontend.cart.insert');
Route::post('/cart/update', 'HomeController@cart_update')->name('frontend.cart.update');
Route::post('/cart/delete', 'HomeController@cart_delete')->name('frontend.cart.delete');
Route::get('/checkout', 'HomeController@checkout')->name('frontend.checkout');
Route::post('/checkout', 'HomeController@checkout_proses')->name('frontend.checkout.proses');
Route::get('/invoice/{id}', 'HomeController@invoice')->name('frontend.invoice');
Route::get('/invoice/{id}/print', 'HomeController@invoice_print')->name('frontend.invoice.print');
Route::get('/payment/{id}', 'HomeController@payment')->name('frontend.payment');
Route::post('/payment/{id}', 'HomeController@payment_proses')->name('frontend.payment.proses');
Route::post('/subscribe', 'HomeController@subscribe')->name('frontend.subscribe');
Route::get('/category/{id}', 'HomeController@category')->name('frontend.category');
Route::get('/hotsales', 'HomeController@hot_sales')->name('frontend.hotsales');
Route::get('/newitem', 'HomeController@new_item')->name('frontend.newitem');
Route::get('/contact', 'HomeController@contact')->name('frontend.contact');
Route::post('/contact', 'HomeController@contact_proses')->name('frontend.contact.proses');
Route::get('/search', 'HomeController@search')->name('frontend.search');



//Backend
Route::group(['prefix' => 'backend', 'middleware' => ['auth','role:admin-access|owner-access'], 'as'=>'backend'], function() {

    //Dashboard
    Route::get('/', 'Backend\DashboardController@index')->name('.dashboard');

    //Category
    Route::group(['prefix' => 'category', 'as'=>'.category'], function() {
        Route::get('/', 'Backend\CategoryController@index')->name('.manage');
        Route::get('/create', 'Backend\CategoryController@create')->name('.create');
        Route::post('/create', 'Backend\CategoryController@store')->name('.store');
        Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('.edit');
        Route::post('/edit/{id}', 'Backend\CategoryController@update')->name('.update');
        Route::get('/detail/{id}', 'Backend\CategoryController@show')->name('.show');
    });

    //Product
    Route::group(['prefix' => 'product', 'as'=>'.product'], function() {
        Route::get('/', 'Backend\ProductController@index')->name('.manage');
        Route::get('/create', 'Backend\ProductController@create')->name('.create');
        Route::post('/create', 'Backend\ProductController@store')->name('.store');
        Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('.edit');
        Route::post('/edit/{id}', 'Backend\ProductController@update')->name('.update');
        Route::get('/gallery/manage/{id}', 'Backend\ProductController@manage_gallery')->name('.gallery.manage');
        Route::get('/gallery/create/{id}', 'Backend\ProductController@create_gallery')->name('.gallery.create');
        Route::post('/gallery/create/{id}', 'Backend\ProductController@store_gallery')->name('.gallery.store');
        Route::get('/gallery/delete/{id}', 'Backend\ProductController@destroy_gallery')->name('.gallery.destroy');
        Route::get('/detail/{id}', 'Backend\ProductController@show')->name('.show');
    });

    //Transaction
    Route::group(['prefix' => 'transaction', 'as'=>'.transaction'], function() {
        Route::get('/', 'Backend\TransactionController@index')->name('.manage');
        Route::get('/detail/{id}', 'Backend\TransactionController@show')->name('.show');
        Route::post('/approve', 'Backend\TransactionController@approve')->name('.approve');
        Route::post('/decline', 'Backend\TransactionController@decline')->name('.decline');
        Route::post('/shipped', 'Backend\TransactionController@shipped')->name('.shipped');
        Route::post('/finish', 'Backend\TransactionController@finish')->name('.finish');
        Route::post('/cancel', 'Backend\TransactionController@cancel')->name('.cancel');
    });

    //User
    Route::group(['prefix' => 'user', 'as'=>'.user'], function() {

        //Admin
        Route::group(['prefix' => 'admin', 'as'=>'.admin'], function() {
            Route::get('/', 'Backend\UserController@admin')->name('.manage');
            Route::get('/create', 'Backend\UserController@create_admin')->name('.create');
            Route::post('/create', 'Backend\UserController@store_admin')->name('.store');
            Route::get('/edit/{id}', 'Backend\UserController@edit_admin')->name('.edit');
            Route::post('/edit/{id}', 'Backend\UserController@update_admin')->name('.update');
        });

        //Owner
        Route::group(['prefix' => 'owner', 'as'=>'.owner'], function() {
            Route::get('/', 'Backend\UserController@owner')->name('.manage');
            Route::get('/create', 'Backend\UserController@create_owner')->name('.create');
            Route::post('/create', 'Backend\UserController@store_owner')->name('.store');
            Route::get('/edit/{id}', 'Backend\UserController@edit_owner')->name('.edit');
            Route::post('/edit/{id}', 'Backend\UserController@update_owner')->name('.update');
        });

        //Member
        Route::group(['prefix' => 'member', 'as'=>'.member'], function() {
            Route::get('/', 'Backend\UserController@member')->name('.manage');
            Route::get('/create', 'Backend\UserController@create_member')->name('.create');
            Route::post('/create', 'Backend\UserController@store_member')->name('.store');
            Route::get('/edit/{id}', 'Backend\UserController@edit_member')->name('.edit');
            Route::post('/edit/{id}', 'Backend\UserController@update_member')->name('.update');
        });

    });

    //Report
    Route::group(['prefix' => 'report', 'as'=>'.report'], function() {
        Route::get('/', 'Backend\ReportController@index')->name('.index');
        Route::post('/transaction', 'Backend\ReportController@transaction')->name('.transaction');
    });

    //Promotion
    Route::group(['prefix' => 'promotion', 'as'=>'.promotion'], function() {
        Route::get('/', 'Backend\PromotionController@index')->name('.index');
        Route::post('/process', 'Backend\PromotionController@process')->name('.process');
        Route::get('/delete/{id}', 'Backend\PromotionController@delete')->name('.delete');
    });

    //Setting
    Route::group(['prefix' => 'setting', 'as'=>'.setting'], function() {
        Route::get('/', 'Backend\SettingController@index')->name('.manage');
        Route::get('/create', 'Backend\SettingController@create')->name('.create');
        Route::post('/create', 'Backend\SettingController@store')->name('.store');
        Route::get('/edit/{id}', 'Backend\SettingController@edit')->name('.edit');
        Route::post('/edit/{id}', 'Backend\SettingController@update')->name('.update');
        Route::get('/delete/{id}', 'Backend\SettingController@destroy')->name('.delete');
    });

    //Profile
    Route::group(['prefix' => 'profile', 'as'=>'.profile'], function() {
        Route::get('/', 'Backend\ProfileController@index')->name('.index');
        Route::post('/edit/{id}', 'Backend\ProfileController@update')->name('.update');
    });

});

//Member
Route::group(['prefix' => 'member', 'middleware' => ['auth','role:member-access'], 'as'=>'member'], function() {
    Route::get('/', 'Member\DashboardController@index')->name('.dashboard');

    Route::group(['prefix' => 'transaction', 'as'=>'.transaction'], function() {
        Route::get('/', 'Member\TransactionController@index')->name('.manage');
        Route::get('/detail/{id}', 'Member\TransactionController@show')->name('.show');
        Route::post('/approve', 'Member\TransactionController@approve')->name('.approve');
    });

    Route::group(['prefix' => 'profile', 'as'=>'.profile'], function() {
        Route::get('/', 'Member\ProfileController@index')->name('.index');
        Route::post('/edit/{id}', 'Member\ProfileController@update')->name('.update');
    });
});