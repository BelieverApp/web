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
Route::resource('/client/referrals', 'Client\ReferralController');

//reporting
Route::resource('/client/reports', 'Client\ReportController');

//user nav
Route::resource('/client/settings', 'Client\SettingsController');
Route::resource('/client/profile', 'Client\ProfileController');
