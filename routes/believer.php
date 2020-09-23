<?php


Route::get('/believer', array('uses' => 'Believer\DashboardController@index'));
Route::get('/pusher', array('uses' => 'Believer\DashboardController@pusher'));
