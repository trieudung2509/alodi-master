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
// use App\Mail\SupportMailManager;
//demo

Route::post('/aiz-uploader', 'AizUploadController@show_uploader');
Route::post('/aiz-uploader/upload', 'AizUploadController@upload');
Route::get('/aiz-uploader/get_uploaded_files', 'AizUploadController@get_uploaded_files');
Route::post('/aiz-uploader/get_file_by_ids', 'AizUploadController@get_preview_files');
Route::get('/aiz-uploader/download/{id}', 'AizUploadController@attachment_download')->name('download_attachment');
Route::post('/aiz-uploader/get_uploaded_file_by_url', 'AizUploadController@get_uploaded_file_by_url');
Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');
//payhere below

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
//Blog Section
Route::get('/blog', 'BlogController@all_blog')->name('blog');
Route::get('/blog/{slug}', 'BlogController@blog_details')->name('blog.details');
Route::get('/category/{slug}', 'CategoryController@blog_listing')->name('category.blogs');
Route::get('/term/{slug}', 'TermController@blog_listing')->name('term.blogs');
Route::post('/{slug}/comment', 'CommentController@store')->name('blog.comment');

Auth::routes(['verify' => true]);
Route::get('/refresh-csrf', function() {
  return csrf_token();
});

//mobile app balnk page for webview
Route::get('/mobile-page/{slug}', 'PageController@mobile_custom_page')->name('mobile.custom-pages');

//Custom page
Route::get('/{slug}', 'PageController@show_custom_page')->name('custom-pages.show_custom_page');
