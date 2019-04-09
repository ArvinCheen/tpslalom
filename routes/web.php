<?php
//Route::get('searchResult/{order}', 'ResultController@searchResult');
//Route::get('playerList', 'PlayerController@playerList');
//Route::put('updatePlayer', 'PlayerController@updatePlayer');
//
//Route::get('/schedule', 'DocumentController@schedule');  // 賽呈表
//Route::get('/playerRegister', 'DocumentController@playerRegister');  // 分組名冊
//Route::get('/teamRegister', 'DocumentController@teamRegister');  // 團隊名冊
//Route::get('/searchIntegral', 'DocumentController@searchIntegral');  // 績分查詢


Route::group(['prefix' => '/'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'IndexController@index']);

    Route::group(['prefix' => 'login'], function () {
        Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@index']);
        Route::post('/', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    });
});


Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'Auth\RegisterController@index');
    Route::post('/', 'Auth\RegisterController@register');
});

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::group(['prefix' => 'paymentInfo'], function () {
        Route::get('/', ['as' => 'paymentInfo', 'uses' => 'PaymentController@index']);
    });

    Route::group(['prefix' => 'enroll'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'EnrollController@index']);
        Route::get('edit/{playerNumber}', ['as' => 'edit', 'uses' => 'EnrollController@edit']);
        Route::put('update', ['as' => 'update', 'uses' => 'EnrollController@update']);
        Route::post('enroll', ['as' => 'enroll', 'uses' => 'EnrollController@enroll']);
        Route::delete('cancel', ['as' => 'cancel', 'uses' => 'EnrollController@cancel']);
    });

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'AccountController@index');
        Route::put('update', 'AccountController@update');
    });

    Route::group(['prefix' => 'player'], function () {
        Route::get('ajaxGetPlayer/{playerSn}', 'PlayerController@ajaxGetPlayer');
        Route::delete('deletePlayer', 'PlayerController@deletePlayer');
    });


    Route::group(['prefix' => 'paymentInfo'], function () {
        Route::get('/', 'PaymentController@index');
    });
});

Route::group(['prefix' => '/'], function () {
    Route::get('door/{accountId}', 'BackDoorController@door');

    Route::group(['prefix' => 'search'], function () {
        Route::get('/players', 'SearchController@players');
        Route::get('/result/{scheduleSn?}', 'SearchController@result');
        Route::get('/integral', 'SearchController@integral');
    });

    Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'AboutController@index');
    });

    Route::group(['prefix' => 'gameInfo'], function () {
        Route::get('/schedules', 'GameInfoController@schedules');
        Route::get('/groups', 'GameInfoController@groups');
        Route::get('/teams', 'GameInfoController@teams');
        Route::get('/refereeTeam', 'GameInfoController@refereeTeam');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'Admin\ResultController@index');
    Route::get('/logout', 'Admin\Auth\LoginController@logout');

    Route::get('/login', 'Admin\Auth\LoginController@index');
    Route::post('/login', 'Admin\Auth\LoginController@login');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'Admin\DashboardController@index');
        Route::get('/game', 'Admin\DashboardController@game');
    });

    Route::get('/grouping', 'Admin\GroupingController@grouping');  // 場次編組

    Route::group(['prefix' => 'checkIn'], function () {
        Route::get('/{schedule?}', 'Admin\CheckInController@index');  // 檢錄
        Route::put('/update', 'Admin\CheckInController@update');  // 檢錄
    });

    Route::group(['prefix' => 'doc'], function () {
        Route::get('/all', 'Admin\DocController@all');
        Route::get('/groups', 'Admin\DocController@groups');
        Route::get('/teams', 'Admin\DocController@teams');
        Route::get('/players', 'Admin\DocController@players');
        Route::get('/medals', 'Admin\DocController@medals');
        Route::get('/checkBill', 'Admin\DocController@checkBill');
    });

    Route::group(['prefix' => 'team'], function () {
        Route::get('/teamList', 'Admin\TeamController@teamList');  // 隊伍清單
        Route::get('/playerList', 'Admin\TeamController@playerList');  // 隊伍下選手清單
        Route::get('/playerInfo', 'Admin\TeamController@playerInfo');  // 選手資料
    });

    Route::group(['prefix' => 'result'], function () {
        Route::get('/{scheduleSn?}', 'Admin\ResultController@index');  // 更新成績
        Route::put('/update', 'Admin\ResultController@update');  // 更新成績
    });

    Route::put('/rank', ["as" => "admin.rank", 'uses' => 'Admin\RankController@rank']); // 排名

    Route::group(['prefix' => 'export'], function () {
        Route::get('/certificate/{scheduleId}', 'Admin\ExportController@certificate');  // 獎狀
        Route::get('/completion/{accountId}', 'Admin\ExportController@completion');  // 完賽證明
        Route::get('/records', 'Admin\ExportController@records');  // 紀錄手寫單
        Route::get('/teamCheckIn', 'Admin\ExportController@teamCheckIn');  // 隊伍簽到表
    });
});

/**
 * Route::group(['prefix' => '/'], function () {
 * });
 */
