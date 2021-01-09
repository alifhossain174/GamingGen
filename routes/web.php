<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register',function(){
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    // sliders
    Route::get('/slider/page','SliderController@sliderPage');
    Route::post('/add/new/slider','SliderController@addNewSlider');
    Route::get('/delete/slider/{id}','SliderController@deleteSlider');

    // games
    Route::get('/game/page','GameController@gamePage');
    Route::post('/add/new/game','GameController@addNewGame');
    Route::get('/delete/game/{id}','GameController@deleteGame');

    // trends
    Route::get('/trend/page','TrendController@trendPage');
    Route::post('/add/new/trend','TrendController@addNewTrend');
    Route::get('/delete/trend/{id}','TrendController@deleteTrend');

    // contest
    Route::get('/contest/page','ContestController@contestPage');
    Route::post('/add/new/contest','ContestController@addNewContest');
    Route::get('/delete/trend/{id}','ContestController@deleteContest');
    Route::get('/manage/contest','ContestController@viewContestSubscribers');
    Route::get('/delete/contest/subscriber/{id}','ContestController@deleteContestSubscriber');
    Route::get('/approve/contest/subscriber/{id}','ContestController@approveContestSubscriber');
    Route::get('/deny/contest/subscriber/{id}','ContestController@denyContestSubscriber');

    // contest winner
    Route::get('/contest/winner/page','ContestWinnerController@contestWinnerPage');
    Route::get('/search/customer/for/new/sale','ContestWinnerController@searchCustomerForNewSale');
    Route::get('/customer/id/from/customer/name','ContestWinnerController@customerIDfromName');
    Route::post('/add/new/contest/winner','ContestWinnerController@addNewContestWinner');
    Route::get('/delete/contest/winner/{id}/{contest_id}','ContestWinnerController@deleteContestWinner');

    // withdraw amount
    Route::get('/withdraw/amount/page','WithDrawController@withDrawAmountPage');
    Route::get('/delete/withdraw/{id}','WithDrawController@deleteWithdraw');
    Route::get('/get/withdraw/data/for/modal/{id}/edit','WithDrawController@getDataForModalApproveWithDraw');
    Route::post('/save/approve/data/wihdraw','WithDrawController@saveTransactionId');
    Route::get('/deny/withdraw/{id}/{user_id}','WithDrawController@denyWithDraw');

    // add money
    Route::get('/add/money/page','AddMoneyController@addMoneyPage');
    Route::get('/delete/add/money/{id}','AddMoneyController@deleteAddMoney');
    Route::get('/approve/add/money/{id}/{user_id}','AddMoneyController@approveAddMoney');
    Route::get('/deny/add/money/{id}','AddMoneyController@denyAddMoney');

    // gen store
    Route::get('/package/page','PackageController@packagePage');
    Route::post('/add/new/package','PackageController@addNewPackage');
    Route::get('/delete/package/{id}','PackageController@deletePackage');
    Route::get('/manage/package','PackageController@managePakcage');
    Route::get('/delete/package/request/{id}','PackageController@deletePackageRequest');
    Route::get('/deny/package/request/{id}','PackageController@denyPackageRequest');

});
