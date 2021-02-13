<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::middleware(['AdminMiddleware'])->group(function(){

        // users list
        Route::get('/users/list','UserController@allUserList');
        Route::post('/make/user/banned','UserController@bannedUsers');
        Route::get('unban/user/{id}','UserController@unbanUser');

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
        Route::get('/edit/trend/{id}','TrendController@editTrend');
        Route::post('/update/trend','TrendController@updateTrend');

        // contest
        Route::get('/contest/page','ContestController@contestPage');
        Route::post('/add/new/contest','ContestController@addNewContest');
        Route::get('view/all/contests','ContestController@viewAllContests');
        Route::get('/get/contest/data/for/modal/{id}/edit','ContestController@getDataForModal');
        Route::post('/update/contest/data/by/modal','ContestController@updateContestData');
        Route::get('/delete/contest/{id}','ContestController@deleteContest');
        Route::get('/manage/contest','ContestController@viewContestSubscribers');
        Route::get('/delete/contest/subscriber/{id}','ContestController@deleteContestSubscriber');
        Route::get('/approve/contest/subscriber/{id}','ContestController@approveContestSubscriber');
        Route::get('/deny/contest/subscriber/{id}','ContestController@denyContestSubscriber');
        Route::get('/close/contest/{id}','ContestController@closeContest');
        Route::get('/open/contest/{id}','ContestController@openContest');
        Route::get('/end/contest/{id}','ContestController@endContest');
        Route::post('/filter/by/contest','ContestController@filterByContest');

        // contest winner
        Route::get('/contest/winner/page','ContestWinnerController@contestWinnerPage');
        Route::get('/search/customer/for/new/sale','ContestWinnerController@searchCustomerForNewSale');
        Route::get('/customer/id/from/customer/name','ContestWinnerController@customerIDfromName');
        Route::post('/add/new/contest/winner','ContestWinnerController@addNewContestWinner');
        Route::get('/delete/contest/winner/{id}/{contest_id}','ContestWinnerController@deleteContestWinner');
        Route::get('/find/contest/{id}','ContestWinnerController@findContest');
        Route::get('/find/contest/subscribers/{id}','ContestWinnerController@findContestSubscriberByContest');

        // withdraw amount
        Route::get('/withdraw/amount/page','WithDrawController@withDrawAmountPage');
        Route::get('/delete/withdraw/{id}','WithDrawController@deleteWithdraw');
        Route::get('/get/withdraw/data/for/modal/{id}/edit','WithDrawController@getDataForModalApproveWithDraw');
        Route::post('/save/approve/data/wihdraw','WithDrawController@saveTransactionId');
        Route::get('/deny/withdraw/{id}/{user_id}','WithDrawController@denyWithDraw');
        Route::post('/update/wihdraw/data/by/modal','WithDrawController@updateWithdrawDataByModal');
        Route::post('/filter/by/date/withdraw','WithDrawController@filterByDate');

        // add money
        Route::get('/add/money/page','AddMoneyController@addMoneyPage');
        Route::get('/delete/add/money/{id}','AddMoneyController@deleteAddMoney');
        Route::get('/approve/add/money/{id}/{user_id}','AddMoneyController@approveAddMoney');
        Route::get('/deny/add/money/{id}','AddMoneyController@denyAddMoney');
        Route::get('/get/add/money/data/for/modal/{id}/edit','AddMoneyController@getDataForModal');
        Route::post('/update/add/money/data/by/modal','AddMoneyController@updateAddMoneyByModal');
        Route::post('/filter/by/date/add/money','AddMoneyController@filterByDate');

        // gen store
        Route::get('/package/page','PackageController@packagePage');
        Route::post('/add/new/package','PackageController@addNewPackage');
        Route::get('/delete/package/{id}','PackageController@deletePackage');
        Route::get('/edit/package/{id}','PackageController@editPackage');
        Route::post('/update/package','PackageController@updatePackage');
        Route::get('/manage/package','PackageController@managePakcage');
        Route::get('/delete/package/request/{id}','PackageController@deletePackageRequest');
        Route::get('/deny/package/request/{id}','PackageController@denyPackageRequest');
        Route::get('/approve/package/request/{id}','PackageController@approvePackageRequest');

        // contest rating
        Route::get('/contest/rating/page','ContestRatingController@contestRatingPage');
        Route::get('/delete/contest/rating/{id}','ContestRatingController@deleteContestRating');

        //payment
        Route::get('/payment/page','PaymentController@paymentPage');
        Route::post('/add/new/payment','PaymentController@addNewPayment');
        Route::get('/delete/payment/{id}','PaymentController@deletePayment');

        //password change
        Route::get('change/account/password','UserController@changePasswordPage');
        Route::post('chnage/my/password','UserController@changeMyPassword');
    });

});
