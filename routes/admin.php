<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/admin', 'AdminController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    //Update Routes

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    Route::resource('profile', 'ProfileController');

    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/google-adsense', 'BusinessSettingsController@google_adsense')->name('google_adsense.index');
    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
    Route::get('/google-map', 'BusinessSettingsController@google_map')->name('google-map.index');
    Route::get('/google-firebase', 'BusinessSettingsController@google_firebase')->name('google-firebase.index');

    //Facebook Settings
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
    Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
    Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/google_analytics_4', 'BusinessSettingsController@google_analytics_4_update')->name('google_analytics_4.update');
    Route::post('/google_adsense', 'BusinessSettingsController@google_adsense_update')->name('google_adsense.update');
    Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
    Route::post('/google-map', 'BusinessSettingsController@google_map_update')->name('google-map.update');
    Route::post('/google-firebase', 'BusinessSettingsController@google_firebase_update')->name('google-firebase.update');

    Route::resource('/languages', 'LanguageController');
    Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

    // website setting
    Route::group(['prefix' => 'website'], function() {
        Route::get('/footer', 'WebsiteController@footer')->name('website.footer');
        Route::get('/header', 'WebsiteController@header')->name('website.header');
        Route::get('/appearance', 'WebsiteController@appearance')->name('website.appearance');
        Route::get('/pages', 'WebsiteController@pages')->name('website.pages');
        Route::resource('custom-pages', 'PageController');
        Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
    });

    Route::resource('roles', 'RoleController');
    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs', 'StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    //Blog Section
    Route::resource('category', 'CategoryController');
    Route::get('/category/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
    Route::resource('blog', 'BlogController');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');
    Route::get('/comments', 'CommentController@index')->name('comment.index');
    Route::post('/comments/change-status', 'CommentController@change_status')->name('comment.change-status');
    Route::get('/comments/{id}', 'CommentController@edit')->name('comment.edit');
    Route::patch('/comments/{id}', 'CommentController@update')->name('comment.update');
    Route::get('/comments/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::resource('taxonomy', 'TaxonomyController');
    Route::get('/taxonomy/destroy/{id}', 'TaxonomyController@destroy')->name('taxonomy.destroy');
    Route::resource('term', 'TermController');
    Route::get('/term/destroy/{id}', 'TermController@destroy')->name('term.destroy');
    Route::post('/term/change-show-on-home-page', 'TermController@change_show_on_home_page')->name('term.change-show-on-home-page');
    Route::post('/term/change-show-on-header', 'TermController@change_show_on_header')->name('term.change-show-on-header');
    Route::resource('work-report', 'WorkReportController');
    Route::get('/work-report/destroy/{id}', 'WorkReportController@destroy')->name('work-report.destroy');


    Route::resource('pages', 'PageController');
    Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');

    Route::get('/all-notification', 'NotificationController@index')->name('admin.all-notification');
});
