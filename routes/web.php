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
    return view('user.home');
})->name('user.home');
Route::get('/about', function () {
    return view('user.about');
})->name('user.about');
Route::get('/contact', function () {
    return view('user.contact');
})->name('user.contact');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('postLogout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product-detail', 'UserController@productDetail');
Route::get('/product-all', 'UserController@allProduct')->name('user.allProduct');
Route::post('/booking-product-by-id', 'UserController@bookingProductById');
Route::post('/detail-by-id', 'UserController@productDetailById');
Route::post('admin/list-products', 'AdminController@listProducts')->name("admin.listProducts");
Route::post('admin/list-cate', 'AdminController@listCate')->name("admin.listCate");

Route::group(['middleware' => ['CheckLogin']], function(){
    Route::get('/booking-product', 'UserController@bookingProduct');
});
Route::group(['prefix' => 'user', 'middleware' => ['CheckLogin']], function(){
    Route::get('/list-booking', 'UserController@viewListBooking')->name("user.listBooking");
    Route::post('/list-orders-by-user', 'UserController@getListBooking');
});
Route::group(['prefix' => 'admin', 'middleware' => ['CheckLogin','CheckAdmin']], function(){
    Route::get('/', 'AdminController@getHome')->name("admin.getHome");
    Route::get('/cate', 'AdminController@getCate')->name("admin.getCate");
    Route::post('/add-cate', 'AdminController@addCate')->name("admin.addCate");
    Route::post('/update-cate', 'AdminController@updateCate')->name("admin.updateCate");
    Route::post('/delete-cate', 'AdminController@deleteCate')->name("admin.deleteCate");
    Route::post('/list-order', 'AdminController@listOrder')->name("admin.listOrder");
    Route::post('/duyet-don', 'AdminController@duyetDon')->name("admin.duyetDon");
    Route::get('/product', 'AdminController@getProduct')->name("admin.getProduct");
    Route::post('/add-product', 'AdminController@addProduct')->name("admin.addProduct");
    Route::post('/update-product', 'AdminController@updateProduct')->name("admin.updateProduct");
    Route::post('/delete-product', 'AdminController@deleteProduct')->name("admin.deleteProduct");
    Route::get('/orders', 'AdminController@getOrder')->name("admin.getOrder");
    Route::get('/users', 'AdminController@getUser')->name("admin.getUser");
    Route::post('/list-user', 'AdminController@listUser')->name("admin.listUser");
});
