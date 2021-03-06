<?php
Route::get('/referrer', 'Referral\ReferralController@genLinkFrame');
Route::post('/generate-link', 'Referral\ReferralController@generateLink');
Route::get('/referee', 'Referral\ReferralController@refereeFrame');
Route::post('/referee-data', 'Referral\ReferralController@refereeData');
Route::get('/referral/{id}', 'Referral\ReferralController@referralRedirect');

Route::get('/dev-referrer', 'Referral\ReferralController@devGenLinkFrame');
Route::get('/dev-generate-link', 'Referral\ReferralController@devGenerateLink');
Route::get('/dev-referee', 'Referral\ReferralController@devRefereeFrame');
Route::get('/dev-referee-done', 'Referral\ReferralController@devRefereeDone');
