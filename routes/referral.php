<?php
Route::get('/referrer', 'Referral\ReferralController@genLinkFrame');
Route::post('/generate-link', 'Referral\ReferralController@generateLink');
Route::get('/referee', 'Referral\ReferralController@refereeFrame');
Route::post('/referee-data', 'Referral\ReferralController@refereeData');
Route::get('/referral/{id}', 'Referral\ReferralController@referralRedirect');


//temp routes
Route::get('/morrison-share', 'Referral\ReferralController@exampleGenLink');
Route::get('/morrison-referee', 'Referral\ReferralController@exampleReferee');

Route::get('/referrers', 'Referral\ReferralController@referrers');
Route::get('/referrals', 'Referral\ReferralController@referrals');
