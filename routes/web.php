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




Route::get('/', 'HomeController@index');
Route::get('/trangchu', 'HomeController@index');
Route::post('/tim-kiem', 'HomeController@search');
Route::get('/contact', 'HomeController@contact');

//admin dashboard
Route::get('/loginAD', 'AdminController@index');
Route::get('/dashboard', 'AdminController@dashboard');

Route::get('/dashboardtk', 'AdminController@dashboardtk');

//admin login
Route::post('/dashboardAD', 'AdminController@dashboardAD');
Route::get('/logout', 'AdminController@logout');

//Category product
Route::get('/add-category-product', 'CategoryProductController@add_category_product');
Route::get('/all-category-product', 'CategoryProductController@all_category_product');
//Sửa 
Route::post('/update-category-product/{category_product_id}', 'CategoryProductController@update_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProductController@edit_category_product');
//xóa 
Route::get('/delete-category-product/{category_product_id}', 'CategoryProductController@delete_category_product');



Route::get('/unactive-category-product/{category_product_id}', 'CategoryProductController@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProductController@active_category_product');


Route::post('/save-category-product', 'CategoryProductController@save_category_product');

//brand thương hiệu

Route::get('/add-brand-product', 'brandController@add_brand_product');
Route::get('/all-brand-product', 'brandController@all_brand_product');
//Sửa 
Route::post('/update-brand-product/{brand_product_id}', 'brandController@update_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'brandController@edit_brand_product');
//xóa 
Route::get('/delete-brand-product/{brand_product_id}', 'brandController@delete_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'brandController@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'brandController@active_brand_product');

Route::post('/save-brand-product', 'brandController@save_brand_product');

// Sản phẩm
Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
//Sửa 
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
//xóa 
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
// index Danh mục sản phẩm 
Route::get('/Danh-muc-san-pham/{category_id}', 'CategoryProductController@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'brandController@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@deltails_product');

//cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');

//cart ajax
Route::post('/update-cart', 'CartController@update_cart');
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::get('/gio-hang', 'CartController@gio_hang');
Route::get('/del-product/{session_id}', 'CartController@delete_product');
Route::get('/del-all-product', 'CartController@delete_all_product');

//check coupon







///login-checkout save-checkout-customer payment /logout-checkout /order-place
Route::get('/login-checkout', 'checkoutController@login_checkout');
Route::get('/checkout', 'checkoutController@checkout');
Route::post('/save-checkout-customer', 'checkoutController@save_checkout_customer');
Route::get('/payment', 'checkoutController@payment');
Route::get('/logout-checkout', 'checkoutController@logout_checkout');
Route::post('/login-customer', 'checkoutController@login_customer');
Route::post('/order-place', 'checkoutController@order_place');



Route::post('/confirm-order', 'checkoutController@confirm_order');



//add_customer
Route::post('/add-customer', 'checkoutController@add_customer');

//Đơn hàng order manage-order

// Route::get('/manage-order', 'ordercontroller@manage_order');


// Route::get('/manage-order', 'checkoutController@manage_order');
// Route::get('/view-order/{orderid}', 'checkoutController@view_order');
 Route::get('/manage-order', 'orderCotroller@manage_order');
 Route::get('/view-order/{order_code}', 'orderCotroller@view_order');
 Route::get('/print-order/{checkout_code}', 'orderCotroller@print_order');
 Route::post('/update-order-qty', 'orderCotroller@update_order_qty');
 Route::post('/update-qty', 'orderCotroller@update_qty');




