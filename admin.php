<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit')->middleware('actch');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

    /*Friday Category*/
    Route::group(['namespace' => 'Accountant'], function () {
        Route::get('categories', 'CategoryController@index')->name('categories'); // ajax
        Route::post('categories', 'CategoryController@store')->name('categories.store'); // ajax
        Route::post('items', 'CategoryController@storeItem')->name('items.store'); // ajax
        Route::put('categories/{id}', 'CategoryController@update')->name('categories.update'); // ajax
        Route::put('items/{id}', 'CategoryController@updateItem')->name('items.update'); // ajax
        Route::delete('categories/{id}', 'CategoryController@destroy')->name('categories.destroy'); // ajax
        Route::delete('items/{id}', 'CategoryController@destroyItem')->name('items.destroy'); // ajax
    });
    /*Friday Category*/

    Route::group(['middleware' => ['admin']], function () {

        Route::get('settings', 'SystemController@settings')->name('settings');
        Route::post('settings', 'SystemController@settings_update');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
        //Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

        //dashboardRoute::group( ['prefix' => 'notification', 'as' => 'notification.', 'm
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');


        Route::get('command', 'DashboardController@AdhanCommandRunView')->name('command');
        Route::get('command/continue', 'DashboardController@AdhanCommandRunContinue')->name('command.continue');
        Route::get('command/active', 'DashboardController@AdhanCommandRunActive')->name('command.active');

        Route::resource('account-transaction', 'AccountTransactionController')->middleware('module:account');

        Route::resource('provide-deliveryman-earnings', 'ProvideDMEarningController')->middleware('module:provide_dm_earning');

        Route::get('maintenance-mode', 'SystemController@maintenance_mode')->name('maintenance-mode');

        Route::group(['prefix' => 'dashboard-stats', 'as' => 'dashboard-stats.'], function () {
            Route::post('order', 'DashboardController@order')->name('order');
            Route::post('zone', 'DashboardController@zone')->name('zone');
            Route::post('user-overview', 'DashboardController@user_overview')->name('user-overview');
            Route::post('business-overview', 'DashboardController@business_overview')->name('business-overview');
        });

        Route::group(['prefix' => 'custom-role', 'as' => 'custom-role.', 'middleware' => ['module:custom_role']], function () {
            Route::get('create', 'CustomRoleController@create')->name('create');
            Route::post('create', 'CustomRoleController@store');
            Route::get('edit/{id}', 'CustomRoleController@edit')->name('edit');
            Route::post('update/{id}', 'CustomRoleController@update')->name('update');
            Route::delete('delete/{id}', 'CustomRoleController@distroy')->name('delete');
            Route::post('search', 'CustomRoleController@search')->name('search');
        });

        Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['module:employee']], function () {
            Route::get('add-new', 'EmployeeController@add_new')->name('add-new');
            Route::post('add-new', 'EmployeeController@store');
            Route::get('list', 'EmployeeController@list')->name('list');
            Route::get('update/{id}', 'EmployeeController@edit')->name('edit');
            Route::post('update/{id}', 'EmployeeController@update')->name('update');
            Route::delete('delete/{id}', 'EmployeeController@distroy')->name('delete');
            Route::post('search', 'EmployeeController@search')->name('search');
        });

        Route::post('food/variant-price', 'FoodController@variant_price')->name('food.variant-price');

        Route::group(['prefix' => 'food', 'as' => 'food.', 'middleware' => ['module:food']], function () {
            Route::get('add-new', 'FoodController@index')->name('add-new');
            Route::post('variant-combination', 'FoodController@variant_combination')->name('variant-combination');
            Route::post('store', 'FoodController@store')->name('store');
            Route::get('edit/{id}', 'FoodController@edit')->name('edit');
            Route::post('update/{id}', 'FoodController@update')->name('update');
            Route::get('list', 'FoodController@list')->name('list');
            Route::delete('delete/{id}', 'FoodController@delete')->name('delete');
            Route::get('status/{id}/{status}', 'FoodController@status')->name('status');
            Route::get('review-status/{id}/{status}', 'FoodController@reviews_status')->name('reviews.status');
            Route::post('search', 'FoodController@search')->name('search');
            Route::get('reviews', 'FoodController@review_list')->name('reviews');
            Route::get('category/{id}', 'FoodController@get_food_by_category_id')->name('get-food-by-category-id');

            Route::get('view/{id}', 'FoodController@view')->name('view');
            //ajax request
            Route::get('get-categories', 'FoodController@get_categories')->name('get-categories');
            Route::get('get-foods', 'FoodController@get_foods')->name('getfoods');

            //Import and export
            Route::get('bulk-import', 'FoodController@bulk_import_index')->name('bulk-import');
            Route::post('bulk-import', 'FoodController@bulk_import_data');
            Route::get('bulk-export', 'FoodController@bulk_export_index')->name('bulk-export-index');
            Route::post('bulk-export', 'FoodController@bulk_export_data')->name('bulk-export');
        });

        Route::group(['prefix' => 'banner', 'as' => 'banner.', 'middleware' => ['module:banner']], function () {
            Route::get('add-new', 'BannerController@index')->name('add-new');
            Route::post('store', 'BannerController@store')->name('store');
            Route::get('edit/{banner}', 'BannerController@edit')->name('edit');
            Route::post('update/{banner}', 'BannerController@update')->name('update');
            Route::get('status/{id}/{status}', 'BannerController@status')->name('status');
            Route::delete('delete/{banner}', 'BannerController@delete')->name('delete');
            Route::post('search', 'BannerController@search')->name('search');
        });

        Route::group(['prefix' => 'campaign', 'as' => 'campaign.', 'middleware' => ['module:campaign']], function () {
            Route::get('{type}/add-new', 'CampaignController@index')->name('add-new');
            Route::post('store/basic', 'CampaignController@storeBasic')->name('store-basic');
            Route::post('store/item', 'CampaignController@storeItem')->name('store-item');
            Route::get('{type}/edit/{campaign}', 'CampaignController@edit')->name('edit');
            Route::get('{type}/view/{campaign}', 'CampaignController@view')->name('view');
            Route::post('basic/update/{campaign}', 'CampaignController@update')->name('update-basic');
            Route::post('item/update/{campaign}', 'CampaignController@updateItem')->name('update-item');
            Route::get('remove-restaurant/{campaign}/{restaurant}', 'CampaignController@remove_restaurant')->name('remove-restaurant');
            Route::post('add-restaurant/{campaign}', 'CampaignController@addrestaurant')->name('addrestaurant');
            Route::get('{type}/list', 'CampaignController@list')->name('list');
            Route::get('status/{type}/{id}/{status}', 'CampaignController@status')->name('status');
            Route::delete('delete/{campaign}', 'CampaignController@delete')->name('delete');
            Route::delete('item/delete/{campaign}', 'CampaignController@delete_item')->name('delete-item');
            Route::post('basic-search', 'CampaignController@searchBasic')->name('searchBasic');
            Route::post('item-search', 'CampaignController@searchItem')->name('searchItem');
        });

        Route::group(['prefix' => 'coupon', 'as' => 'coupon.', 'middleware' => ['module:coupon']], function () {
            Route::get('add-new', 'CouponController@add_new')->name('add-new');
            Route::post('store', 'CouponController@store')->name('store');
            Route::get('update/{id}', 'CouponController@edit')->name('update');
            Route::post('update/{id}', 'CouponController@update');
            Route::get('status/{id}/{status}', 'CouponController@status')->name('status');
            Route::delete('delete/{id}', 'CouponController@delete')->name('delete');
            Route::post('search', 'CouponController@search')->name('search');
        });

//        Route::group(['prefix' => 'add-option', 'as' => 'add-option.', 'middleware' => ['module:attribute']], function () {
////        Route::group(['prefix' => 'attribute', 'as' => 'attribute.', 'middleware' => ['module:attribute']], function () {
//            Route::get('add-new', 'AttributeController@index')->name('add-new');
//            Route::post('store', 'AttributeController@store')->name('store');
//            Route::get('edit/{id}', 'AttributeController@edit')->name('edit');
//            Route::post('update/{id}', 'AttributeController@update')->name('update');
//            Route::delete('delete/{id}', 'AttributeController@delete')->name('delete');
//            Route::post('search', 'AttributeController@search')->name('search');
//
//            //Import and export
//            Route::get('bulk-import', 'AttributeController@bulk_import_index')->name('bulk-import');
//            Route::post('bulk-import', 'AttributeController@bulk_import_data');
//            Route::get('bulk-export', 'AttributeController@bulk_export_index')->name('bulk-export-index');
//            Route::post('bulk-export', 'AttributeController@bulk_export_data')->name('bulk-export');
//        });
        Route::group(['prefix' => 'add-option', 'as' => 'add-option.', 'middleware' => ['module:add-option']], function () {
            Route::get('add-new', 'AddOptionController@index')->name('add-new');
            Route::post('store', 'AddOptionController@store')->name('store');
            Route::get('edit/{id}', 'AddOptionController@edit')->name('edit');
            Route::post('update/{id}', 'AddOptionController@update')->name('update');
            Route::delete('delete/{id}', 'AddOptionController@delete')->name('delete');
            Route::get('food/category/{id}', 'AddOptionController@get_food_by_category_id')->name('get-food-by-category-id');
            Route::get('restaurant/category/{id}', 'AddOptionController@get_category_by_restaurant_id')->name('get-category-by-restaurant-id');
        });

        Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
                Route::get('get-restaurants-data/{restaurant}', 'VendorController@get_restaurant_data')->name('get-restaurants-data');
                Route::get('restaurant-filter/{id}', 'VendorController@restaurant_filter')->name('restaurantfilter');
//                Route::get('get-account-data/{restaurant}', 'VendorController@get_account_data')->name('restaurantfilter');
            Route::group(['middleware' => ['module:restaurant']], function () {
                Route::get('update-application/{id}/{status}', 'VendorController@update_application')->name('application');
                Route::get('add', 'VendorController@index')->name('add');
                Route::post('store', 'VendorController@store')->name('store');
                Route::get('edit/{id}', 'VendorController@edit')->name('edit');
                Route::post('update/{restaurant}', 'VendorController@update')->name('update');
                Route::post('discount/{restaurant}', 'VendorController@discountSetup')->name('discount');
                Route::post('update-settings/{restaurant}', 'VendorController@updateRestaurantSettings')->name('update-settings');
                // Route::delete('delete/{restaurant}', 'VendorController@destroy')->name('delete');
                Route::delete('clear-discount/{restaurant}', 'VendorController@cleardiscount')->name('clear-discount');
                // Route::get('view/{restaurant}', 'VendorController@view')->name('view_tab');
                Route::get('view/{restaurant}/{tab?}/{sub_tab?}', 'VendorController@view')->name('view');
                 Route::post('edit-schedule', 'VendorController@schedule_edit')->name('edit-schedule');
                Route::delete('opening_time/{id}', 'VendorController@remove_schedule')->name('remove-schedule');
                Route::put('close-schedule/{id}','VendorController@close')->name('schedule.close');

                Route::put('open-schedule/{id}','VendorController@open')->name('schedule.open');
                Route::get('list', 'VendorController@list')->name('list');

                Route::get('new/pending/list', 'VendorController@NewPendinglist')->name('newpending');
                Route::get('pending/list', 'VendorController@Pendinglist')->name('pending.list');
                Route::post('search', 'VendorController@search')->name('search');
                Route::get('get-restaurants', 'VendorController@get_restaurants')->name('get-restaurants');
                Route::get('status/{restaurant}/{status}', 'VendorController@status')->name('status');
                Route::get('toggle-settings-status/{restaurant}/{status}/{menu}', 'VendorController@restaurant_status')->name('toggle-settings');
                Route::post('status-filter', 'VendorController@status_filter')->name('status-filter');
                Route::get('get-addons', 'VendorController@get_addons')->name('get_addons');
                //Import and export
                Route::get('bulk-import', 'VendorController@bulk_import_index')->name('bulk-import');
                Route::post('bulk-import', 'VendorController@bulk_import_data');
                Route::get('bulk-export', 'VendorController@bulk_export_index')->name('bulk-export-index');
                Route::post('bulk-export', 'VendorController@bulk_export_data')->name('bulk-export');
                //Restaurant shcedule
                Route::post('add-schedule', 'VendorController@add_schedule')->name('add-schedule');
                Route::post('holiyday/{id}edit','VendorController@admin_hollydayAdminUdpate')->name('admin.hollyday.edit');

                Route::get('holiday/{id?}get', 'VendorController@holiday')->name('holiday.get');
                Route::post('holiday/add', 'VendorController@add_holiday')->name('holiday.add');
                Route::delete('holiyday/{id}destroy','VendorController@admin_hollydayDestroy')->name('admin.hollyday.destroy');



            //     Route::get('remove-schedule/{restaurant_schedule}', 'VendorController@remove_schedule')->name('remove-schedule');
             });

            Route::group(['middleware' => ['module:withdraw_list']], function () {
                Route::post('withdraw-status/{id}', 'VendorController@withdrawStatus')->name('withdraw_status');
                Route::get('withdraw_list', 'VendorController@withdraw')->name('withdraw_list');
                Route::get('withdraw-view/{withdraw_id}/{seller_id}', 'VendorController@withdraw_view')->name('withdraw_view');
            });

        });

        Route::group(['prefix' => 'addon', 'as' => 'addon.', 'middleware' => ['module:addon']], function () {
            Route::get('add-new', 'AddOnController@index')->name('add-new');
            Route::post('store', 'AddOnController@store')->name('store');
            Route::get('edit/{id}', 'AddOnController@edit')->name('edit');
            Route::post('update/{id}', 'AddOnController@update')->name('update');
            Route::delete('delete/{id}', 'AddOnController@delete')->name('delete');
            Route::get('status/{addon}/{status}', 'AddOnController@status')->name('status');
            Route::post('search', 'AddOnController@search')->name('search');
            //Import and export
            Route::get('bulk-import', 'AddOnController@bulk_import_index')->name('bulk-import');
            Route::post('bulk-import', 'AddOnController@bulk_import_data');
            Route::get('bulk-export', 'AddOnController@bulk_export_index')->name('bulk-export-index');
            Route::post('bulk-export', 'AddOnController@bulk_export_data')->name('bulk-export');
        });

        Route::group(['prefix' => 'allergen', 'as' => 'allergen.'], function () {
            Route::group(['middleware' => ['module:allergen']], function () {
                Route::get('add', 'AllergenController@index')->name('add');
                Route::post('store', 'AllergenController@store')->name('store');
                Route::get('edit/{id}', 'AllergenController@edit')->name('edit');
                Route::post('update/{id}', 'AllergenController@update')->name('update');
                Route::delete('delete/{id}', 'AllergenController@delete')->name('delete');
                Route::get('status/{id}/{status}', 'AllergenController@status')->name('status');
                Route::get('update-priority/{allergen}', 'AllergenController@update_priority')->name('priority');

            });
        });

        Route::group(['prefix' => 'cuisine', 'as' => 'cuisine.'], function () {
//            Route::get('get-all', 'CategoryController@get_all')->name('get-all');
            Route::group(['middleware' => ['module:cuisine']], function () {
                Route::get('add', 'CuisineController@index')->name('add');
//                Route::get('add-sub-category', 'CategoryController@sub_index')->name('add-sub-category');
//                Route::get('add-sub-sub-category', 'CategoryController@sub_sub_index')->name('add-sub-sub-category');
                Route::post('store', 'CuisineController@store')->name('store');
                Route::get('edit/{id}', 'CuisineController@edit')->name('edit');
                Route::post('update/{id}', 'CuisineController@update')->name('update');
                Route::get('update-priority/{cuisine}', 'CuisineController@update_priority')->name('priority');
                Route::get('status/{id}/{status}', 'CuisineController@status')->name('status');
                Route::delete('delete/{id}', 'CuisineController@delete')->name('delete');
                Route::post('search', 'CuisineController@search')->name('search');
                Route::get('get_all_list', 'CuisineController@get_all_list')->name('get_all_list');

                //Import and export
                Route::get('bulk-import', 'CategoryController@bulk_import_index')->name('bulk-import');
                Route::post('bulk-import', 'CategoryController@bulk_import_data');
                Route::get('bulk-export', 'CategoryController@bulk_export_index')->name('bulk-export-index');
                Route::post('bulk-export', 'CategoryController@bulk_export_data')->name('bulk-export');
            });
        });

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('get-all', 'CategoryController@get_all')->name('get-all');
            Route::group(['middleware' => ['module:category']], function () {
                Route::get('add', 'CategoryController@index')->name('add');
                Route::post('store', 'CategoryController@store')->name('store');
                Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
                Route::post('update/{id}', 'CategoryController@update')->name('update');
                Route::get('update-priority/{category}', 'CategoryController@update_priority')->name('priority');
                Route::post('store', 'CategoryController@store')->name('store');
                Route::get('status/{id}/{status}', 'CategoryController@status')->name('status');
                Route::delete('delete/{id}', 'CategoryController@delete')->name('delete');
                Route::post('search', 'CategoryController@search')->name('search');
                Route::get('list', 'CategoryController@list')->name('list');
                // sub-category
                Route::get('add-sub-category', 'CategoryController@sub_index')->name('add-sub-category');
                Route::get('sub-category-list', 'CategoryController@sub_list')->name('sub-category-list');
                Route::get('add-sub-sub-category', 'CategoryController@sub_sub_index')->name('add-sub-sub-category');

                //Import and export
                Route::get('bulk-import', 'CategoryController@bulk_import_index')->name('bulk-import');
                Route::post('bulk-import', 'CategoryController@bulk_import_data');
                Route::get('bulk-export', 'CategoryController@bulk_export_index')->name('bulk-export-index');
                Route::post('bulk-export', 'CategoryController@bulk_export_data')->name('bulk-export');
            });
        });

        Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => ['module:order']], function () {
            Route::get('list/{status}', 'OrderController@list')->name('list');
            Route::get('details/{id}', 'OrderController@details')->name('details');
            Route::get('status', 'OrderController@status')->name('status');
            // Route::put('status-update/{id}', 'OrderController@status')->name('status-update');
            Route::get('view/{id}', 'OrderController@view')->name('view');
            Route::post('update-shipping/{order}', 'OrderController@update_shipping')->name('update-shipping');
            Route::delete('delete/{id}', 'OrderController@delete')->name('delete');

            Route::get('add-delivery-man/{order_id}/{delivery_man_id}', 'OrderController@add_delivery_man')->name('add-delivery-man');
            Route::get('payment-status', 'OrderController@payment_status')->name('payment-status');
            Route::get('generate-invoice/{id}', 'OrderController@generate_invoice')->name('generate-invoice');
            Route::post('add-payment-ref-code/{id}', 'OrderController@add_payment_ref_code')->name('add-payment-ref-code');
            Route::get('restaurant-filter/{restaurant_id}', 'OrderController@restaurnt_filter')->name('restaurant-filter');
            Route::get('filter/reset', 'OrderController@filter_reset');
            Route::post('filter', 'OrderController@filter')->name('filter');
            Route::post('search', 'OrderController@search')->name('search');
            //order update
            Route::post('add-to-cart', 'OrderController@add_to_cart')->name('add-to-cart');
            Route::post('remove-from-cart', 'OrderController@remove_from_cart')->name('remove-from-cart');
            Route::get('update/{order}', 'OrderController@update')->name('update');
            Route::get('edit-order/{order}', 'OrderController@edit')->name('edit');
            Route::get('quick-view', 'OrderController@quick_view')->name('quick-view');
            Route::get('quick-view-cart-item', 'OrderController@quick_view_cart_item')->name('quick-view-cart-item');
        });

        Route::group(['prefix' => 'dispatch', 'as' => 'dispatch.', 'middleware' => ['module:order']],function(){
            Route::get('list/{status}', 'OrderController@dispatch_list')->name('list');
        });

        Route::group(['prefix' => 'zone', 'as' => 'zone.', 'middleware' => ['module:zone']], function () {
            Route::get('/', 'ZoneController@index')->name('home');
            Route::post('store', 'ZoneController@store')->name('store');
            Route::get('edit/{id}', 'ZoneController@edit')->name('edit');
            Route::post('update/{id}', 'ZoneController@update')->name('update');
            Route::delete('delete/{zone}', 'ZoneController@destroy')->name('delete');
            Route::get('status/{id}/{status}', 'ZoneController@status')->name('status');
            Route::post('search', 'ZoneController@search')->name('search');
            Route::get('zone-filter/{id}', 'ZoneController@zone_filter')->name('zonefilter');
            Route::get('get-all-zone-cordinates/{id?}', 'ZoneController@get_all_zone_cordinates')->name('zoneCoordinates');
        });

      Route::group( ['prefix' => 'notification', 'as' => 'notification.', 'middleware' => ['module:notification']], function () {

        Route::get( 'topic', 'NotificationController@topic' )->name( 'topic' );
        Route::any( 'topic_add', 'NotificationController@topic_add' )->name( 'topic_add' );
        Route::get( 'search_topic', 'NotificationController@search_topic' )->name( 'search_topic' );

        Route::any( 'topicedit/{id}', 'NotificationController@topicedit' )->name( 'topicedit' );
        Route::delete( 'deletetopic/{id}', 'NotificationController@deletetopic' )->name( 'deletetopic' );

       Route::get( 'add-new', 'NotificationController@index' )->name( 'add-new' );
       Route::post( 'store', 'NotificationController@store' )->name( 'store' );
       Route::get( 'edit/{id}', 'NotificationController@edit' )->name( 'edit' );
       Route::post( 'update/{id}', 'NotificationController@update' )->name( 'update' );
       Route::get( 'status/{id}/{status}', 'NotificationController@status' )->name( 'status' );
       Route::delete( 'delete/{id}', 'NotificationController@delete')->name( 'delete' );
       Route::get('announcement','NotificationController@announcement' )->name( 'announcement' );
       Route::get('event', 'NotificationController@event')->name( 'event' );
       Route::get('list', 'NotificationController@List')->name( 'list' );
       Route::get('search', 'NotificationController@List')->name( 'search' );
       Route::get('readd/announcement{id?}', 'NotificationController@ReAddAnnouncement')->name( 'readd.announcement' );
  } );


        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['module:settings','actch']], function () {
            Route::get('business-setup', 'BusinessSettingsController@business_index')->name('business-setup');
            Route::get('config-setup', 'BusinessSettingsController@config_setup')->name('config-setup');
            Route::post('config-update', 'BusinessSettingsController@config_update')->name('config-update');
            Route::post('update-setup', 'BusinessSettingsController@business_setup')->name('update-setup');
            Route::get('app-settings', 'BusinessSettingsController@app_settings')->name('app-settings');
//            Route::POST('app-settings', 'BusinessSettingsController@update_app_settings')->name('app-settings');
            Route::POST('app-settings', 'BusinessSettingsController@update_app_settings')->name('appsettings');
            Route::get('landing-page-settings/{tab?}', 'BusinessSettingsController@landing_page_settings')->name('landing-page-settings');
//            Route::POST('landing-page-settings/{tab}', 'BusinessSettingsController@update_landing_page_settings')->name('landing-page-settings');
            Route::POST('landing-page-settings/{tab}', 'BusinessSettingsController@update_landing_page_settings')->name('landingpagesettings');
            Route::DELETE('landing-page-settings/{tab}/{key}', 'BusinessSettingsController@delete_landing_page_settings')->name('landing-page-settings-delete');

            Route::get('toggle-settings/{key}/{value}', 'BusinessSettingsController@toggle_settings')->name('toggle-settings');

            Route::get('fcm-index', 'BusinessSettingsController@fcm_index')->name('fcm-index');
            Route::post('update-fcm', 'BusinessSettingsController@update_fcm')->name('update-fcm');

            Route::post('update-fcm-messages', 'BusinessSettingsController@update_fcm_messages')->name('update-fcm-messages');

            Route::get('mail-config', 'BusinessSettingsController@mail_index')->name('mail-config');
            Route::post('mail-config', 'BusinessSettingsController@mail_config');

            Route::get('payment-method', 'BusinessSettingsController@payment_index')->name('payment-method');
            Route::post('payment-method-update/{payment_method}', 'BusinessSettingsController@payment_update')->name('payment-method-update');

            Route::get('currency-add', 'BusinessSettingsController@currency_index')->name('currency-add');
            Route::post('currency-add', 'BusinessSettingsController@currency_store');
            Route::get('currency-update/{id}', 'BusinessSettingsController@currency_edit')->name('currency-update');
            Route::put('currency-update/{id}', 'BusinessSettingsController@currency_update');
            Route::delete('currency-delete/{id}', 'BusinessSettingsController@currency_delete')->name('currency-delete');

            Route::get('pages/terms-and-conditions', 'BusinessSettingsController@terms_and_conditions')->name('terms-and-conditions');
            Route::post('pages/terms-and-conditions', 'BusinessSettingsController@terms_and_conditions_update');

            Route::get('pages/privacy-policy', 'BusinessSettingsController@privacy_policy')->name('privacy-policy');
            Route::post('pages/privacy-policy', 'BusinessSettingsController@privacy_policy_update');

            Route::get('pages/about-us', 'BusinessSettingsController@about_us')->name('about-us');
            Route::post('pages/about-us', 'BusinessSettingsController@about_us_update');

            Route::get('sms-module', 'SMSModuleController@sms_index')->name('sms-module');
            Route::post('sms-module-update/{sms_module}', 'SMSModuleController@sms_update')->name('sms-module-update');

            //recaptcha
            Route::get('recaptcha', 'BusinessSettingsController@recaptcha_index')->name('recaptcha_index');
            Route::post('recaptcha-update', 'BusinessSettingsController@recaptcha_update')->name('recaptcha_update');
        });

        Route::group(['prefix' => 'message', 'as' => 'message.'], function () {
            Route::get('list', 'ConversationController@list')->name('list');
            Route::post('store/{user_id}', 'ConversationController@store')->name('store');
            Route::get('view/{user_id}', 'ConversationController@view')->name('view');
        });

        Route::group(['prefix' => 'delivery-man', 'as' => 'delivery-man.'], function () {
            Route::get('get-account-data/{deliveryman}', 'DeliveryManController@get_account_data')->name('restaurantfilter');
            Route::group(['middleware' => ['module:deliveryman']], function () {
                Route::get('add', 'DeliveryManController@index')->name('add');
                Route::post('store', 'DeliveryManController@store')->name('store');
                Route::get('list', 'DeliveryManController@list')->name('list');
                Route::get('preview/{id}/{tab?}', 'DeliveryManController@preview')->name('preview');
                Route::get('status/{id}/{status}', 'DeliveryManController@status')->name('status');
                Route::get('earning/{id}/{status}', 'DeliveryManController@earning')->name('earning');
                Route::get('update-application/{id}/{status}', 'DeliveryManController@update_application')->name('application');
                Route::get('edit/{id}', 'DeliveryManController@edit')->name('edit');
                Route::post('update/{id}', 'DeliveryManController@update')->name('update');
                Route::delete('delete/{id}', 'DeliveryManController@delete')->name('delete');
                Route::post('search', 'DeliveryManController@search')->name('search');
                Route::get('get-deliverymen', 'DeliveryManController@get_deliverymen')->name('get-deliverymen');

                Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
                    Route::get('list', 'DeliveryManController@reviews_list')->name('list');
                    Route::get('status/{id}/{status}', 'DeliveryManController@reviews_status')->name('status');
                });
            });
        });


        Route::group(['prefix' => 'reviews', 'as' => 'reviews.', 'middleware' => ['module:customerList']], function () {
            Route::get('list', 'ReviewsController@list')->name('list');
            Route::post('search', 'ReviewsController@search')->name('search');
        });

        Route::group(['prefix' => 'report', 'as' => 'report.', 'middleware' => ['module:report']], function () {
            Route::get('order', 'ReportController@order_index')->name('order');
            Route::get('day-wise-report', 'ReportController@day_wise_report')->name('day-wise-report');
            Route::get('food-wise-report', 'ReportController@food_wise_report')->name('food-wise-report');
            Route::post('food-wise-report-search', 'ReportController@food_search')->name('food-wise-report-search');
            Route::get('order-transactions', 'ReportController@order_transaction')->name('order-transaction');
            Route::get('earning', 'ReportController@earning_index')->name('earning');
            Route::post('set-date', 'ReportController@set_date')->name('set-date');
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['module:customerList']], function () {
            Route::get('list', 'CustomerController@customer_list')->name('list');
            Route::get('view/{user_id}', 'CustomerController@view')->name('view');
            Route::post('search', 'CustomerController@search')->name('search');
            Route::get('status/{customer}/{status}', 'CustomerController@status')->name('status');
            Route::post('password/change','CustomerController@Updatepassword')->name('password.change');
            Route::post('profile/edit','CustomerController@CustomerEdit')->name('profile.edit');
        });


        Route::group(['prefix' => 'file-manager', 'as' => 'file-manager.'], function () {
            Route::get('/download/{file_name}', 'FileManagerController@download')->name('download');
            Route::get('/index/{folder_path?}', 'FileManagerController@index')->name('index');
            Route::post('/image-upload', 'FileManagerController@upload')->name('image-upload');
            Route::delete('/delete/{file_path}', 'FileManagerController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'email', 'as' => 'email.'], function () {
            Route::get('settings','EmailConfigController@EmailSettings')->name('settings');
            Route::post('settings/store','EmailConfigController@EmailSettingsStore')->name('settings.store');
            Route::put('settings/edit','EmailConfigController@EmailSettingsUpdate')->name('settings.update');

            Route::get('template','EmailConfigController@Template')->name('template.list');
            Route::post('template/store','EmailConfigController@TemplateCreate')->name('template.store');
            Route::put('template/edit{id?}','EmailConfigController@TemplateEidt')->name('template.update');
            Route::delete('template/destroy{id?}','EmailConfigController@TemplateDestroy')->name('template.destroy');
        });

        Route::group(['prefix' => 'prayer', 'as' => 'prayer.'], function () {
            Route::get( 'times', 'PrayerTimeController@show' )->name( 'times' );
            Route::get('time/month/get/','PrayerTimeController@Monthgget')->name('month.get.selected');
            Route::get('time/month/{id}','PrayerTimeController@MonthWiseTimeGet')->name('month.wise.get');
            Route::resource('time','PrayerTimeController');
        });




        Route::group(['prefix' => 'prayer', 'as' => 'prayer.'], function () {
            Route::get( 'times', 'PrayerTimeController@show' )->name( 'times' );
            Route::get('time/month/get/','PrayerTimeController@Monthgget')->name('month.get.selected');
            Route::get('time/month/{id}','PrayerTimeController@MonthWiseTimeGet')->name('month.wise.get');
            Route::resource('time','PrayerTimeController');
        });

                Route::group(['prefix' => 'communitybusiness', 'as' => 'communitybusiness.'], function () {
            Route::get( 'list', 'CommunityNameController@index' )->name( 'index' );
            Route::post( 'store', 'CommunityNameController@store' )->name( 'store' );
            Route::put( 'update{id?}', 'CommunityNameController@update' )->name( 'update' );
            Route::delete( 'destroy{id?}', 'CommunityNameController@destroy' )->name( 'destroy' );


            Route::get( 'details/list', 'CommunityNameController@Detailsindex' )->name( 'details.index' );

            Route::post( 'details/store', 'CommunityNameController@Detailsstore' )->name( 'details.store' );

            Route::put( 'details/update{id?}', 'CommunityNameController@Detailsupdate' )->name( 'details.update' );

            Route::delete( 'details/destroy{id?}', 'CommunityNameController@Detailsdestroy' )->name( 'details.destroy' );


            Route::get( 'mosque/wise/get', 'CommunityNameController@CommunityBussnessName' )->name( 'mosque.wise.get' );


            Route::get( 'mosque/wise/get/edit', 'CommunityNameController@CommunityBussnessNameEdit' )->name( 'mosque.wise.get.edit' );
        });

        Route::group( ['prefix' => 'notice', 'as' => 'notice.'], function () {


         Route::get('video', 'GalleryController@Vedioindex')->name('vedio');
         Route::post( 'video/create', 'GalleryController@Vediocreate')->name('vedio.store');
         Route::post( 'video/update{id?}', 'GalleryController@VedioUpdate')->name('vedio.update');
         Route::delete( 'video/destroy{id?}', 'GalleryController@VedioDestroy')->name('vedio.destroy');
         Route::resource( 'photo', 'GalleryController');
        });

        Route::group( ['prefix' => 'gallery', 'as' => 'gallery.'], function (){
         Route::resource( 'banner_photo', 'GalleryBannerController');
         Route::get( 'get/mosque/wise/banner', 'PhotoGalleryController@MosqueBanner')->name('mosque.wise.banner');
         Route::get( 'get/mosque/wise/banner/edit', 'PhotoGalleryController@MosqueBannerEdit')->name('mosque.wise.banner.edit');
         Route::resource( 'photo_gallery', 'PhotoGalleryController');
        });

        Route::group(['prefix' => 'cash-collect', 'as' => 'cash-collect.'], function () {
            Route::get('expense', 'DepositController@expense')->name('expense');
            Route::get('deposit/ledger', 'DepositController@ledger')->name('deposit.ledger');
            Route::resource('deposit','DepositController');
        });

        Route::delete( 'mosque-build/{id}/{type}', 'MosqueBuildController@destroy' )->name( 'mosque-build.destroy' );

      Route::group(['prefix' => 'mosques', 'as' => 'mosques.'], function () {
          Route::get('pending', 'VendorController@PendingListMosque')->name('pending');
          Route::get('list', 'VendorController@ListMosque')->name('list');
          Route::get('create', 'VendorController@create')->name('create');
          Route::post('mosques/save', 'VendorController@Mosquestore')->name('mosques.save');
          Route::post('approved{id?}', 'VendorController@mosqueApproved')->name('approved');
          Route::post('unapproved{id?}', 'VendorController@mosqueUnApproved')->name('unapproved');

          Route::post('mosqueupdate{id?}', 'VendorController@MosqueUpdate')->name('mosqueupdate');
          Route::get('mosque/edit{id?}', 'VendorController@MosqueEdit')->name('edit');
          Route::delete('mosque/destroy{id?}', 'VendorController@MosqueDestroy')->name('destroy');
          Route::post('password/update','VendorController@PasswordChenge')->name('password.updated');
      });


        Route::get('course/get', 'MosqueClassController@courseget')->name('course.get.mosque.wise');
       Route::get('course/get/edit', 'MosqueClassController@courseget_edit')->name('course.get.mosque.wise.edit');

        Route::group(['prefix' => 'education', 'as' => 'education.'], function () {

            Route::resource('course', 'CourseController');
            Route::resource('class', 'MosqueClassController');

        });


       Route::group(['prefix' => 'digital', 'as' => 'digital.'], function () {

            Route::get('section', 'DigitalSectionSettings@index')->name('section.index');

            Route::post('section/store', 'DigitalSectionSettings@store')->name('section.store');

        });


        Route::get('calendar', 'PrayerTimeController@PDFshow')->name('pdf.show');
        Route::get('calendar/create', 'PrayerTimeController@PDFCreate')->name('pdf.create');

        Route::get('prayer/time/export/view','PrayerTimeController@ExportView')->name('prayer.view');
        Route::get('/prayer/time/export/{month?}', 'PrayerTimeController@exportByMonth')->name('export.by.month');


        Route::get('payertime/date/wise/destroy','PrayerTimeController@PayerTimeDestroy')->name('prayer.time.delete');
        Route::get('payertime/excel/import/view','PrayerTimeController@ExcelView')->name('excel.view');

        Route::post('payertime/excel/import','PrayerTimeController@import')->name('excel.import');

        Route::group(['prefix' => 'youtube', 'as' => 'youtube.'], function () {
          Route::get('link/list', 'VendorController@YOutubeLInkList')->name('list');
          Route::post('link/save', 'VendorController@YoutubeLinkStore')->name('store');
          Route::post('link/update{id?}', 'VendorController@YoutubeLinkUPdate')->name('update');
          Route::delete('link/destroy{id?}', 'VendorController@YoutubeLinkDestroy')->name('destroy');
         Route::delete('link/offline/destroy{id?}', 'VendorController@YoutubeOfflineDestroy')->name('off.destroy');
         Route::get('mosque/wise/data/get','VendorController@Youtubelinkget')->name('data.get');
           Route::post('offline/save', 'VendorController@offlineVedioStore')->name('off.store');
          Route::post('offline/update{id?}', 'VendorController@offlineVedioUdate')->name('off.update');
      });

     Route::group(['prefix' => 'zakat', 'as' => 'zakat.'], function () {
          Route::get('nisab', 'VendorController@JakatLInkList')->name('list');
          Route::post('nisab/save', 'VendorController@JakatLinkStore')->name('store');
          Route::post('update{id?}', 'VendorController@JakatLinkUpdate')->name('update');
          Route::delete('destroy{id?}', 'VendorController@ZakatLinkDestroy')->name('destroy');
      });

      Route::group(['prefix' => 'romadan', 'as' => 'romadan.'], function () {
          Route::get('sehri-reminder', 'VendorController@SehriReminder')->name('view');
          Route::post('sehri-reminder/save', 'VendorController@SehriReminderStore')->name('store');
          Route::get('reminder/on/off', 'VendorController@OnOff')->name('OnOff');
          Route::post('reminder/on/off/save', 'VendorController@OnOffsave')->name('OnOff.save');
          Route::delete('destroy{id?}', 'VendorController@ZakatLinkDestroy')->name('destroy');


          Route::post('single/sehri/{id}/reminder/off','VendorController@SingleSehriReminderOff')->name('sehri.off.save');
          Route::post('single/sehri/{id}/reminder/on','VendorController@SingleSehriReminderON')->name('sehri.on.save');

          Route::post('single/iftar/{id}/reminder/off','VendorController@SingleIftarReminderOff')->name('iftar.off.save');
          Route::post('single/iftar/{id}/reminder/on','VendorController@SingleIftarReminderON')->name('iftar.on.save');
      });

        Route::resource( 'mosque-build', 'MosqueBuildController' )->except('destroy');

        Route::resource( 'expenditure', 'ExpenditureController' );

        Route::resource( 'regularcollection', 'RegularcollectionController' );


        //social media login
        Route::group(['prefix' => 'social-login', 'as' => 'social-login.','middleware'=>['module:business_settings']], function () {
            Route::get('view', 'BusinessSettingsController@viewSocialLogin')->name('view');
            Route::post('update/{service}', 'BusinessSettingsController@updateSocialLogin')->name('update');
        });
    });

    Route::get('zone/get-coordinates/{id}', 'ZoneController@get_coordinates')->name('zone.get-coordinates');
});
