<?php

//dashboard
Route::get('/admin', array('uses' => 'Admin\DashboardController@index'));

//clients
Route::resource('/admin/clients', 'Admin\ClientController');
Route::post('/admin/updateClient', 'Admin\ClientController@update');
Route::resource('/admin/manager', 'Admin\ClientUserController');

//rewards
Route::resource('/admin/rewards', 'Admin\RewardController');
Route::post('/admin/updateReward', 'Admin\RewardController@updateReward');
Route::post('/admin/toggleRewardPublish', 'Admin\RewardController@toggleStatus');

//redemptions
Route::resource('/admin/redemptions', 'Admin\RedemptionController');
Route::post('/admin/redemption/record', 'Admin\RedemptionController@redeem');

//user nav
Route::resource('/admin/missiontypes', 'Admin\MissionTypesController');
Route::post('/admin/missiontypes/update', 'Admin\MissionTypesController@update');

//reports
Route::resource('/admin/reports', 'Admin\ReportController');

//user nav
Route::resource('/admin/settings', 'Admin\SettingsController');
Route::resource('/admin/profile', 'Admin\ProfileController');

//referrals
Route::get('/admin/referrals', 'Admin\ReferralController@index');
Route::get('/admin/referrals/{id}', 'Admin\ReferralController@detail');
Route::put('/admin/referrals/{id}', 'Admin\ReferralController@put');

Route::get('/admin/referrers-active', 'Admin\ReferralController@referrersActive');
