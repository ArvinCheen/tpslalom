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
//    Route::get('/', ['as' => '/', 'uses' => 'GameInfoController@groups']);
//    Route::get('/', ['as' => '/', 'uses' => 'GameInfoController@schedules']);
    Route::get('/', ['as' => 'paymentInfo', 'uses' => 'PaymentController@index'])->middleware(['auth']);

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
        Route::get('/{playerId?}', ['as' => '/', 'uses' => 'EnrollController@index']);
        Route::get('edit/{playerNumber}', ['as' => 'edit', 'uses' => 'EnrollController@edit']);
        Route::put('update', ['as' => 'update', 'uses' => 'EnrollController@update']);
        Route::post('enroll', ['as' => 'enroll', 'uses' => 'EnrollController@enroll']);
        Route::delete('cancel', ['as' => 'cancel', 'uses' => 'EnrollController@cancel']);
    });

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account', 'uses' => 'AccountController@index'])->middleware(['auth']);
        Route::put('update', 'AccountController@update');
    });

    Route::group(['prefix' => 'player'], function () {
        Route::get('ajaxGetPlayer/{playerId}', 'PlayerController@ajaxGetPlayer');
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
        Route::get('/result/{scheduleId?}', 'SearchController@result');
        Route::get('/integral', 'SearchController@integral');
    });

    Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'AboutController@index');
    });

    Route::group(['prefix' => 'gameInfo'], function () {
        Route::get('/getAppearance/{scheduleSn?}', 'GameInfoController@getAppearance');
        Route::get('/schedules', 'GameInfoController@schedules');
        Route::get('/groups', 'GameInfoController@groups');
        Route::get('/teams', 'GameInfoController@teams');
        Route::get('/refereeTeam', 'GameInfoController@refereeTeam');
        Route::get('/errata', 'GameInfoController@errata');//勘誤
        Route::get('/nationalRecord', 'GameInfoController@nationalRecord');
        Route::get('/program', 'GameInfoController@program');

    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', ["as" => "admin.login", 'uses' => 'Admin\Auth\LoginController@index']);
    Route::post('/login', 'Admin\Auth\LoginController@login');
    Route::get('/logout', 'Admin\Auth\LoginController@logout');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin']], function () {

    Route::get('/', 'Admin\ResultController@index');

    Route::group(['prefix' => 'drawLots'], function () {
        Route::get('/', 'Admin\DrawLotsController@drawLots');
        Route::get('/clear', 'Admin\DrawLotsController@clear');

        Route::get('/import', 'Admin\DrawLotsController@import');
    });


    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'Admin\AccountController@index');
        Route::get('/edit/{accountId}', ['as' => 'account.edit', 'uses' => 'Admin\AccountController@edit']);
        Route::put('/update', ['as' => 'account.update', 'uses' => 'Admin\AccountController@update']);
    });


    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'Admin\DashboardController@index');
        Route::get('/game', 'Admin\DashboardController@game');
    });


    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'SettingController@index']);
        Route::put('update', ['as' => 'setting.update', 'uses' => 'SettingController@update']);
    });


    Route::get('/grouping', 'Admin\GroupingController@grouping');  // 場次編組
    Route::get('/import', 'Admin\GroupingController@import');  // 匯入資料

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
        Route::get('/schedules', 'Admin\DocController@schedules');
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
        Route::get('/certificate/{scheduleId}', 'Admin\ExportController@certificate');
        Route::get('/completion/{accountId}', 'Admin\ExportController@completion');
        Route::get('/records', 'Admin\ExportController@records');
        Route::get('/teamCheckIn', 'Admin\ExportController@teamCheckIn');
        Route::get('/result', 'Admin\ExportController@result');
        Route::get('/groups', 'Admin\ExportController@groups');
        Route::get('/teams', 'Admin\ExportController@teams');
        Route::get('/playerNumber', 'Admin\ExportController@playerNumber');
        Route::get('/花樁評分表', 'Admin\ExportController@花樁評分表');
        Route::get('/花樁總匯表', 'Admin\ExportController@花樁總匯表');
        Route::get('/花樁罰分紀錄', 'Admin\ExportController@花樁罰分紀錄');
        Route::get('/花樁紀錄', 'Admin\ExportController@花樁紀錄');
        Route::get('/music/{filename}', 'Admin\ExportController@music');



    });


    Route::get('/musics', 'Admin\MusicsController@index');
    Route::get('/musics/download/{filename}', ['as' => 'musics.download', 'uses' => 'Admin\MusicsController@download']);
});

/**
 * Route::group(['prefix' => '/'], function () {
 * });
 */
