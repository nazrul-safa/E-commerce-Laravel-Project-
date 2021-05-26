<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SslCommerzPaymentController;

//route of frontend controller
Route::get('/',[FrontendController::class, 'home'])->name('tohoney_home');
Route::get('about',[FrontendController::class, 'about'])->name('tohoney_about');
Route::get('users',[FrontendController::class, 'users']);
Route::get('product/details/{product_id}',[FrontendController::class, 'product_details'])->name('product_details');
Route::get('shop',[FrontendController::class, 'shop'])->name('shop');
Route::get('categorywise/shop/{category_id}',[FrontendController::class, 'categorywise'])->name('categorywise');
Route::get('cart',[FrontendController::class, 'cart'])->name('cart');
Route::post('update/cart',[FrontendController::class, 'updatecart'])->name('updatecart');
Route::get('cart/{coupon_name}',[FrontendController::class, 'cart'])->name('cartwithcoupon');
Route::get('checkout',[FrontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post',[FrontendController::class, 'checkoutpost'])->name('checkoutpost');
Route::get('customer/register',[FrontendController::class, 'customer_register'])->name('customer_register');
Route::post('customer/register/post',[FrontendController::class, 'customer_post'])->name('customer_post');
Route::get('customer/login',[FrontendController::class, 'customer_login'])->name('customer_login');
Route::post('customer/login/post',[FrontendController::class, 'customer_login_post'])->name('customer_login_post');
Route::post('get/city/list',[FrontendController::class, 'getcitylist']);

//route of contact controller
Route::get('contact',[ContactController::class, 'contact'])->name('tohoney_contact');
Route::post('contact/post',[ContactController::class, 'contact_post'])->name('contact_post');



//route of category controller
Route::get('category',[CategoryController::class, 'category']);
Route::post('category/post',[CategoryController::class, 'categorypost']);
Route::get('category/delete/{category_id}',[CategoryController::class, 'categorydelete']);
Route::get('category/all/delete',[CategoryController::class, 'categoryalldelete']);
Route::get('category/edit/{category_id}',[CategoryController::class, 'categoryedit']);
Route::post('category/post/edit',[CategoryController::class, 'categoryeditpost']);
Route::get('category/restore/{category_id}',[CategoryController::class, 'categoryrestore']);
Route::get('category/forcedelete/{category_id}',[CategoryController::class, 'categoryforcedelte']);
Route::get('category/restore_all',[CategoryController::class, 'categoryrestoreall']);
Route::get('category/force_delete_all',[CategoryController::class, 'categoryforcedelteall']);
Route::post('category/check/delete',[CategoryController::class, 'category_check_delete'])->name('safa');

//route of Subcategory controller
Route::get('subcategory',[SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('subcategory/post',[SubcategoryController::class, 'subcategory_post'])->name('subcategory_post');
Route::post('get/subcategory/post',[SubcategoryController::class,'subcategory_get_data']);

//route of product controller
Route::get('product',[ProductController::class, 'product'])->name('product');
Route::post('product/post',[ProductController::class, 'product_post'])->name('product_post');
Route::get('product/edit/{product_id}',[ProductController::class, 'product_edit']);
Route::post('product/post/edit/{product_id}',[ProductController::class, 'product_post_edit'])->name('product_post_edit');
Route::get('product/delete/{product_id}',[ProductController::class, 'product_delete']);

//route of Faqs controller
Route::get('faq',[FaqController::class, 'faq'])->name('faq');
Route::post('faq/post',[FaqController::class, 'faq_post'])->name('faq_post');
Route::get('faq/delete/{faq_id}',[FaqController::class, 'faq_delete']);

//route of Testimonial controller
Route::get('tes',[TesController::class, 'tes'])->name('tes');
Route::post('tes/post',[TesController::class, 'tes_post'])->name('tes_post');
Route::get('tes/delete/{tes_id}',[TesController::class, 'tes_delete']);

Auth::routes(); 
//route of home controller
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('download/invoice/{order_id}', [App\Http\Controllers\HomeController::class, 'download_invoice'])->name('download_invoice');
Route::post('send/sms', [App\Http\Controllers\HomeController::class, 'sendsms'])->name('sendsms');
 
//route of Setting controller
Route::get('setting',[SettingController::class, 'setting'])->name('setting');
Route::post('setting/post',[SettingController::class, 'setting_post'])->name('setting_post');

//route of Cart controller
Route::post('add/to/cart/{product_id}',[CartController::class, 'addtocart'])->name('addtocart');
Route::get('cart/delete/{cart_id}',[CartController::class, 'cartdelete'])->name('cartdelete');


//route of Coupon controller
Route::resource('coupon',CouponController::class);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('onlin/epayment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


