<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('demo', function(){
	return view('page.demo_home');
});

Route::get('admin', [
	'as' => 'admin',
	'uses' => 'AdminController@index'
]);

Route::get('admin/info', [
	'as' => 'adminGetInfo',
	'uses' => 'AdminController@getInfo'
]);

Route::post('admin/info', [
	'as' => 'adminPostInfo',
	'uses' => 'AdminController@postInfo'
]);

Route::get('admin/nav', [
	'as' => 'adminGetNav',
	'uses' => 'AdminController@getNav'
]);

Route::get('admin/edit-nav', [
	'as' => 'adminGetEditNav',
	'uses' => 'AdminController@getEditNav'
]);

Route::post('admin/nav', [
	'as' => 'adminPostNav',
	'uses' => 'AdminController@postNav'
]);

Route::get('admin/slide', [
	'as' => 'adminGetSlide',
	'uses' => 'AdminController@getSlide'
]);

Route::post('admin/slide', [
	'as' => 'adminPostSlide',
	'uses' => 'AdminController@postSlide'
]);

Route::get('admin/remove-slide/{id}', [
	'as' => 'adminRemoveSlide',
	'uses' => 'AdminController@getRemoveSlide'
]);

Route::post('admin/edit-slide', [
	'as' => 'adminEditSlide',
	'uses' => 'AdminController@postEditSlide'
]);

Route::get('admin/category', [
	'as' => 'adminGetCategory',
	'uses' => 'AdminController@getCategory'
]);

Route::post('admin/category', [
	'as' => 'adminPostCategory',
	'uses' => 'AdminController@postCategory'
]);

Route::get('admin/remove-category/{id}', [
	'as' => 'adminRemoveCategory',
	'uses' => 'AdminController@getRemoveCategory'
]);

Route::post('admin/edit-category', [
	'as' => 'adminEditCategory',
	'uses' => 'AdminController@postEditCategory'
]);

Route::get('admin/product', [
	'as' => 'adminGetProduct',
	'uses' => 'AdminController@getProduct'
]);

Route::post('admin/product', [
	'as' => 'adminPostProduct',
	'uses' => 'AdminController@postProduct'
]);

Route::get('admin/picture', [
	'as' => 'adminGetPicture',
	'uses' => 'AdminController@getPicture'
]);

Route::post('admin/picture', [
	'as' => 'adminPostPicture',
	'uses' => 'AdminController@postPicture'
]);

Route::get('admin/remove-picture/{id}', [
	'as' => 'adminGetRemovePicture',
	'uses' => 'AdminController@getRemovePicture'
]);

Route::post('admin/edit-picture', [
	'as' => 'adminGetEditPicture',
	'uses' => 'AdminController@getEditPicture'
]);

Route::get('admin/profile', [
	'as' => 'adminProfile',
	'uses' => 'AdminController@profile'
]);

Route::get('admin/cart', [
	'as' => 'adminCart',
	'uses' => 'AdminController@cart'
]);

Route::get('admin/login', [
	'as' => 'adminGetLogin',
	'uses' => 'Admin\AuthController@getLogin'
]);

Route::post('admin/login', [
	'as' => 'adminPostLogin',
	'uses' => 'Admin\AuthController@postLogin'
]);

Route::get('admin/logout', [
	'as' => 'adminLogout',
	'uses' => 'AdminController@logout'
]);

Route::get('admin/remove-product/{id}', [
	'as' => 'adminRemoveProduct',
	'uses' => 'AdminController@getRemoveProduct'
]);

Route::post('admin/edit-product', [
	'as' => 'adminEditProduct',
	'uses' => 'AdminController@postEditProduct'
]);

Route::post('admin/import', 'AdminController@postImport');

Route::get('/home', 'HomeController@index');

Route::get('/', 'MyController@index');


Route::get('product', 'MyController@getProduct');
Route::get('checkout', 'MyController@getCheckout');
Route::get('contact', 'MyController@getContact');
Route::get('picture', 'MyController@getPicture');

Route::post('add-to-cart', 'MyController@getAddToCart');
Route::post('remove-cart', 'MyController@getRemoveCart');
Route::get('refresh-checkout', 'MyController@refreshCheckout');

Route::get('destroy-session', 'MyController@destroySession');




Route::auth();

Route::get('/home', 'HomeController@index');
