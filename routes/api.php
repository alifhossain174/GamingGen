<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'],function(){

    Route::Post('user/login','ApiController@userLogin');
    Route::Post('user/register','ApiController@userRegistration');

    Route::get('get/sliders','ApiController@getSliders');
    Route::get('get/games','ApiController@getGames');
    Route::get('get/trends','ApiController@getTrends');
    Route::post('get/contests','ApiController@getContests');
    Route::post('get/previous/contests','ApiController@getPrevContests');
    Route::post('subscribe/contest','ApiController@subscribeContest');
    Route::post('winning/contest','ApiController@winningContestLists');
    Route::post('winning/contest/by/contest','ApiController@winningContestListsByContest');
    Route::post('view/leaderboard','ApiController@viewLeaderBoard');
    Route::post('withdraw/amount','ApiController@withDrawAmount');
    Route::post('view/withdraw/amount/history','ApiController@withDrawAmountHistory');
    Route::post('add/money','ApiController@addMoney');
    Route::post('add/money/history','ApiController@addMoneyHistory');

    Route::post('user/info/update','ApiController@userInfoUpdate');
    Route::post('change/password','ApiController@changePassword');
    Route::post('profile/image/upload','ApiController@profileImageUpload');
    Route::post('forget/password','ApiController@forgetPassword');

    Route::post('get/packages','ApiController@getPackages');
    Route::post('package/request','ApiController@packageRequest');
    Route::post('requested/package/list','ApiController@requestedPackageList');

    Route::post('user/account','ApiController@userAmount');
    Route::post('subscribed/contest/list','ApiController@subscribedContests');

    //contest rating api
    Route::post('submit/contest/rating','ApiController@submitContestRating');
    Route::post('get/contest/rating/list','ApiController@getContestRatingList');

    //payment
    Route::post('get/payment/info','ApiController@getPaymentInfo');
});
