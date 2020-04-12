<?php

//dashboard
Route::get('/client', array('uses' => 'Client\DashboardController@index'));

//missions
Route::resource('/client/missions', 'Client\MissionController');
Route::post('/client/updateMission', 'Client\MissionController@updateMission');

//believers
Route::get('/client/believers/invite', 'Client\BelieverController@invite');
Route::post('/client/believers/invite', 'Client\BelieverController@uploadInvites');

//audiences
Route::get('/client/believers/audiences', 'Client\BelieverController@audiences');
Route::get('/client/believers/audience/{id}', 'Client\BelieverController@showAudience');
Route::post('/client/believers/audiences', 'Client\BelieverController@createAudience');

Route::resource('/client/believers', 'Client\BelieverController');
Route::post('/client/updateBeliever', 'Client\BelieverController@updateBeliever');

//Route::post('/client/toggleRewardPublish', 'Client\BelieverController@toggleStatus');

//messsages
Route::resource('/client/messages', 'Client\MessagesController');


//referrals
//Route::resource('/client/referrals', 'Client\ReferralController');
Route::get('/client/referrals', 'Client\ReferralsController@index');
Route::get('/client/referrals/{id}', 'Client\ReferralsController@detail');
Route::put('/client/referrals/{id}', 'Client\ReferralsController@put');

//reporting
Route::get('/client/reports', 'Client\ReportController@index');
Route::get('/client/reports/referralData', 'Client\ReportController@get');

//user nav
Route::resource('/client/settings', 'Client\SettingsController');
Route::resource('/client/profile', 'Client\ProfileController');

// referral data
