<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user/register', 'API\RegisterController@register');
Route::post('user/login', 'API\LoginController@login');

// Route::middleware('jwt.auth')->get('users', function(Request $request) {
//     return auth()->user();
// });

Route::post('/v1/clients', 'API\ClientController@index');
Route::post('/v1/clientsFollowedByUser', 'API\ClientController@clientsFollowedByUser');
Route::post('/v1/clients/show', 'API\ClientController@show');
Route::post('/v1/clients/follow', 'API\ClientController@follow');
Route::post('/v1/clients/unfollow', 'API\ClientController@unfollow');
Route::post('/v1/clients/refer', 'API\ClientController@refer');
Route::post('/v1/clients/share', 'API\ClientController@share');
Route::post('/v1/clients/misisions', 'API\ClientController@missions');

Route::post('/v1/missions', 'API\MissionController@index');
Route::post('/v1/missions/show', 'API\MissionController@show');
Route::post('/v1/missions/client', 'API\MissionController@showByClient');
Route::post('/v1/missions/accept', 'API\MissionController@accept');
Route::post('/v1/missions/complete', 'API\MissionController@complete');
Route::post('/v1/missions/getMissionHistory', 'API\MissionController@getMissionHistory');

Route::post('/v1/profile', 'API\ProfileController@show');
Route::post('/v1/profile/history', 'API\ProfileController@challengeHistory');
Route::post('/v1/profile/pointbalance/', 'API\ProfileController@balance');
Route::post('/v1/profile/editUsername', 'API\ProfileController@editUsername');
Route::post('/v1/profile/editContact', 'API\ProfileController@editContact');
Route::post('/v1/profile/leaderboard', 'API\ProfileController@leaderboard');
Route::post('/v1/profile/editProfilePic', 'API\ProfileController@uploadProfilePic');
Route::post('/v1/profile/delete', 'API\ProfileController@deleteYourAccount');
Route::post('/v1/profile/updateNotifications', 'API\ProfileController@updateNotifications');

Route::post('/v1/messages', 'API\MessagesController@index');
Route::post('/v1/messages/show', 'API\MessagesController@show');
Route::post('/v1/messages/delete', 'API\MessagesController@delete');

Route::post('/v1/rewards', 'API\RewardController@index');
Route::post('/v1/rewards/show', 'API\RewardController@show');
Route::post('/v1/rewards/redeem', 'API\RewardController@redeem');

Route::post('/v1/referral/create', 'API\ReferralController@create');

Route::post('/v1/favs', 'API\FavController@index');
Route::post('/v1/favs/create', 'API\FavController@create');
Route::post('/v1/favs/delete', 'API\FavController@delete');
