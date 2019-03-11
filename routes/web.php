<?php
//Route::get('searchResult/{order}', 'ResultController@searchResult');
//Route::get('playerList', 'PlayerController@playerList');
//Route::put('updatePlayer', 'PlayerController@updatePlayer');
//
//Route::get('/schedule', 'DocumentController@schedule');  // 賽呈表
//Route::get('/playerRegister', 'DocumentController@playerRegister');  // 分組名冊
//Route::get('/teamRegister', 'DocumentController@teamRegister');  // 團隊名冊
//Route::get('/searchIntegral', 'DocumentController@searchIntegral');  // 績分查詢

Route::get('test', 'TestController@index');

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@index');
    Route::post('/', 'Auth\LoginController@login');
});

Route::group(['prefix' => '/'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'IndexController@index']);

    Route::group(['prefix' => 'login'], function () {
        Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@index']);
        Route::post('/', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    });
});


Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'paymentInfo'], function () {
        Route::get('/', ['as' => 'paymentInfo', 'uses' => 'PaymentController@index']);
    });

    Route::group(['prefix' => 'enroll'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'EnrollController@index']);
        Route::get('edit/{playerSn}', ['as' => 'edit', 'uses' => 'EnrollController@edit']);
        Route::put('update', ['as' => 'update', 'uses' => 'EnrollController@update']);
        Route::post('enroll', ['as' => 'enroll', 'uses' => 'EnrollController@enroll']);
        Route::delete('cancel', ['as' => 'cancel', 'uses' => 'EnrollController@cancel']);
    });

    Route::group(['prefix' => 'search'], function () {
        Route::get('/players', 'SearchController@players');
        Route::get('/result/{scheduleSn?}', 'SearchController@result');
        Route::get('/integral', 'SearchController@integral');
    });


    Route::get('door/{accountId}', 'BackDoorController@door');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/', 'IndexController@index');

    Route::group(['prefix' => 'register'], function () {
        Route::get('/', 'Auth\RegisterController@index');
        Route::post('/', 'Auth\RegisterController@register');
    });


    Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'AboutController@index');
    });

    Route::group(['prefix' => 'gameInfo'], function () {
        Route::get('/schedule', 'GameInfoController@schedule');
        Route::get('/groupList', 'GameInfoController@groupList');
        Route::get('/teamList', 'GameInfoController@teamList');
        Route::get('/refereeTeam', 'GameInfoController@refereeTeam');
    });

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'AccountController@index');
        Route::get('register', 'RegisterController@index');
        Route::post('register', 'AccountController@register');
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

Route::group(['prefix' => 'admin'], function () {

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
        Route::get('/allDoc', 'Admin\DocController@allDoc');
        Route::get('/groupsInfo', 'Admin\DocController@groupsInfo');
        Route::get('/teamsInfo', 'Admin\DocController@teamsInfo');
        Route::get('/playersInfo', 'Admin\DocController@playersInfo');
        Route::get('/checkBill', 'Admin\DocController@checkBill');
        Route::get('/medals', 'Admin\DocController@medals');
    });

//    Route::group(['prefix' => 'game'], function () {
//        Route::get('/', 'Admin\GameController@gameList');  // 比賽清單（首頁）
//        Route::get('/gameList', 'Admin\GameController@gameList');  // 比賽清單（首頁）
//        Route::get('/programDocument', 'Admin\GameController@programDocument');  // 秩序冊
//        Route::get('/enrollPlayerList', 'Admin\GameController@enrollPlayerList');  // 網頁列出比賽選手清冊（清冊模式）
//        Route::get('/enterResultMode/{order}', 'Admin\GameController@enterResultMode');  // 輸入成績模式
//        Route::get('/getGameItem', 'Admin\GameController@getGameItem');  // 尋找項目
//    });

    Route::group(['prefix' => 'document'], function () {
        Route::get('/schedule', 'Admin\DocumentController@schedule');  // 賽呈表
        Route::get('/playerRegister', 'Admin\DocumentController@playerRegister');  // 分組名冊
        Route::get('/teamRegister', 'Admin\DocumentController@teamRegister');  // 團隊名冊
        Route::get('/checkBill', 'Admin\DocumentController@checkBill');  // 對帳單
        Route::get('/detailDocument', 'Admin\DocumentController@detailDocument');  // 總冊
        Route::get('/exportCertificate/{order}/{level}/{group}/{gender}/{item}', 'Admin\DocumentController@exportCertificate');  // 輸出獎狀
        Route::get('/checkIn', 'Admin\DocumentController@checkIn');  // 檢錄單
        Route::get('/certificateOfCompletion', 'Admin\DocumentController@certificateOfCompletion');  // 完賽證明隊伍列表
        Route::get('/exportCertificateOfCompletion/{accountId}', 'Admin\DocumentController@exportCertificateOfCompletion');  // 匯出完賽證明
    });

    Route::group(['prefix' => 'team'], function () {
        Route::get('/teamList', 'Admin\TeamController@teamList');  // 隊伍清單
        Route::get('/playerList', 'Admin\TeamController@playerList');  // 隊伍下選手清單
        Route::get('/playerInfo', 'Admin\TeamController@playerInfo');  // 選手資料
    });

    Route::group(['prefix' => 'result'], function () {
        Route::get('/{scheduleSn?}', 'Admin\ResultController@index');  // 更新成績
        Route::put('/updateResult', 'Admin\ResultController@updateResult');  // 更新成績
    });

    Route::group(['prefix' => 'export'], function () {
        Route::get('/certificate/{scheduleSn}', 'Admin\ExportController@certificate');  // 獎狀
        Route::get('/completion/{accountId}', 'Admin\ExportController@completion');  // 完賽證明
        Route::get('/records', 'Admin\ExportController@records');  // 紀錄手寫單
        Route::get('/teamCheckIn', 'Admin\ExportController@teamCheckIn');  // 隊伍簽到表
    });
});

/**
Route::group(['prefix' => '/'], function () {
});

*/
