@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <img style="width:100%;" src="{{ URL::asset('img/enrollBanner7.png') }}">
            <h1 class="mt-5">比賽報名</h1>
        </div>
        <form action='{{ URL('enroll/enroll') }}' method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12 mb-5">
                    <h4 class="mb-3">選手資訊</h4>
                    <div class="mb-3">
                        <label>出賽選手</label>
                        <select class="form-control" name="playerId" required>
                            <option value=''> -- 請選擇一位選手 -- </option>
                            <option value="newPlayer"> 新增一個全新的選手 </option>
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}">
                                    No.{{ $player->id }} {{ $player->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address">姓名</label>
                        <input type="text" class="form-control" name="name" placeholder='' value="" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="address">單位</label>
                        <input type="text" class="form-control" name="agency" placeholder="" value="" required disabled>
                    </div>
                    <div class="mb-3">
                        <label>性別</label>
                        <select class="form-control" name="gender" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="男" >男</option>
                            <option value="女" >女</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>縣市</label>
                        <select class="form-control" name="city" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="臺北市">臺北市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="新北市">新北市</option>
                            <option value="連江縣">連江縣</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="新竹市">新竹市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="桃園市">桃園市</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="台中市">台中市</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="台南市">台南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="屏東縣">屏東縣</option>
                            <option value="台東縣">台東縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>組別</label>
                        <select class="form-control" name="group" id="組別" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="小班幼童組">小班幼童組</option>
                            <option value="中班幼童組">中班幼童組</option>
                            <option value="大班幼童組">大班幼童組</option>
                            <option value="國小一年級組">國小一年級組</option>
                            <option value="國小二年級組">國小二年級組</option>
                            <option value="國小三年級組">國小三年級組</option>
                            <option value="國小四年級組">國小四年級組</option>
                            <option value="國小五年級組">國小五年級組</option>
                            <option value="國小六年級組">國小六年級組</option>
                            <option value="國中組">國中組</option>
                            <option value="高中組">高中組</option>
                            <option value="社會組">社會組</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 mb-5">
                    <h4 class="mb-3">參賽項目</h4>
                    <ul class="list-group mb-3" style="float:left;width:49%">
                        <li class="list-group-item mb-3">
                            <div>
                                <h6>自由式速椿</h6>
                            </div>
                            <div class="">
                                <select class="form-control" name="level" id="自由級別" disabled>
                                    <option value='' id="自由預設"> -- 選擇級別 -- </option>
                                    <option value="初級組" id="初級組">初級組</option>
                                    <option value="選手組" id="選手組">選手組</option>
                                </select>
                            </div>
                            <div class="form-check mt-3" style="">
                                <input class="form-check-input" name="enrollFreeItem[]" type="checkbox" value="前進雙足S型" id="前進雙足S型" disabled>
                                <label class="form-check-label" for="前進雙足S型">
                                    前進雙足S型
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" name="enrollFreeItem[]" type="checkbox" value="前進單足S型" id="前進單足S型" disabled>
                                <label class="form-check-label" for="前進單足S型">
                                    前進單足S型
                                </label>
                            </div>
                        </li>
                        {{--                    <li class="list-group-item mb-3" id="enrollItemSelectBar" style="display:none">--}}
                        {{--                        <div>--}}
                        {{--                            <h6>選擇參賽項目</h6>--}}
                        {{--                        </div>--}}
                        {{--                    </li>--}}
                    </ul>
                    <ul class="list-group mb-3 " style="float:right;width:49%">
                        <li class="list-group-item mb-3">
                            <div>
                                <h6>競速</h6>
                            </div>
                            <div class="">
                                <select class="form-control" name="level" id="競速級別" disabled>
                                    <option value='' id="競速預設"> -- 選擇級別 -- </option>
                                    <option value="休閒組" id="休閒組">休閒組</option>
                                    <option value="競速組" id="競速組">競速組</option>
                                </select>
                            </div>

                            <div class="form-check mt-3 " style="">
                                <input class="form-check-input" name="enrollSpeedItem[]" type="checkbox" value="150公尺計時賽" id="150公尺計時賽" disabled>
                                <label class="form-check-label" for="150公尺計時賽">
                                    150公尺計時賽
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" name="enrollSpeedItem[]" type="checkbox" value="300公尺計時賽" id="300公尺計時賽" disabled>
                                <label class="form-check-label" for="300公尺計時賽">
                                    300公尺計時賽
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" name="enrollSpeedItem[]" type="checkbox" value="450公尺計時賽" id="450公尺計時賽" disabled>
                                <label class="form-check-label" for="450公尺計時賽">
                                    450公尺計時賽
                                </label>
                            </div>
                        </li>
                        {{--                    <li class="list-group-item mb-3" id="enrollItemSelectBar" style="display:none">--}}
                        {{--                        <div>--}}
                        {{--                            <h6>選擇參賽項目</h6>--}}
                        {{--                        </div>--}}
                        {{--                    </li>--}}
                    </ul>
                </div>


                @if ($status)
                    <button class="btn btn-primary btn-lg btn-block" type="submit">報名</button>
                @else
                    <button class="btn btn-lg btn-block" type="button" disabled>報名截止，無法報名</button>
                @endif

            </div>

            <div class="row"></div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>

    function init() {
        $('#自由級別').prop('disabled', false);
        $('#自由預設').prop('disabled', false).prop('selected', true);
        $('#初級組').prop('disabled', false);
        $('#選手組').prop('disabled', false);
        $('#前進雙足S型').prop('disabled', true).prop('checked', false);
        $('#前進單足S型').prop('disabled', true).prop('checked', false);

        $('#競速級別').prop('disabled', false);
        $('#競速預設').prop('disabled', false).prop('selected', true);
        $('#休閒組').prop('disabled', false);
        $('#競速組').prop('disabled', false);
        $('#150公尺計時賽').prop('disabled', true).prop('checked', false);
        $('#300公尺計時賽').prop('disabled', true).prop('checked', false);
        $('#450公尺計時賽').prop('disabled', true).prop('checked', false);
    }

    function 初級組() {
        $('#前進雙足S型').prop('disabled', false).prop('checked', false);
        $('#前進單足S型').prop('disabled', true).prop('checked', false);
    }

    function 選手組() {
        $('#前進雙足S型').prop('disabled', false).prop('checked', false);
        $('#前進單足S型').prop('disabled', false).prop('checked', false);
    }

    function 休閒組() {
        $('#150公尺計時賽').prop('disabled', false).prop('checked', false);
        $('#300公尺計時賽').prop('disabled', false).prop('checked', false);
        $('#450公尺計時賽').prop('disabled', true).prop('checked', false);
    }

    function 競速組() {
        $('#150公尺計時賽').prop('disabled', true).prop('checked', false);
        $('#300公尺計時賽').prop('disabled', false).prop('checked', false);
        $('#450公尺計時賽').prop('disabled', false).prop('checked', false);
    }

    function 初級關閉() {
        $('#初級組').prop('disabled', true);
    }

    function 競速關閉() {
        $('#競速組').prop('disabled', true);
    }



    $("#自由級別").change(function() {
        $('#前進雙足S型').prop('disabled', false).prop('checked', false);
        $('#前進單足S型').prop('disabled', false).prop('checked', false);
        switch ($(this).val()) {
            case '初級組':
                $('#前進單足S型').prop('disabled', true);
                break;
            case '選手組':
                $('#前進單足S型').prop('disabled', false);
                break;
        }

    });

    $("#競速級別").change(function() {
        $('#150公尺計時賽').prop('disabled', false).prop('checked', false);
        $('#300公尺計時賽').prop('disabled', false).prop('checked', false);
        $('#450公尺計時賽').prop('disabled', false).prop('checked', false);

        switch ($(this).val()) {
            case '休閒組':
                $('#450公尺計時賽').prop('disabled', true);
                break;
            case '競速組':
                $('#150公尺計時賽').prop('disabled', true);
                break;
        }
    });

    $("#組別").change(function() {
        init();
        switch ($(this).val()) {
            case '小班幼童組':
                競速關閉()
                break;
            case '中班幼童組':
                競速關閉()
                break;
            case '大班幼童組':
                競速關閉()
                break;
            case '國小一年級組':
                break;
            case '國小二年級組':
                break;
            case '國小三年級組':
                break;
            case '國小四年級組':
                break;
            case '國小五年級組':
                break;
            case '國小六年級組':
                break;
            case '國中組':
                初級關閉()
                break;
            case '高中組':
                初級關閉()
                break;
            case '社會組':
                競速關閉()
                初級關閉()
                break;
        }
    });

    $("select[name='playerId']").change(function() {
        var playerId = $(this).val();

        clearForm();

        if (playerId === '') {
            disabledForm(true);
        } else {
            disabledForm(false);
            getPlayer(playerId);
        }
    });

    function disabledForm(action) {
        $("input[name='name']").prop('disabled', action);
        $("input[name='agency']").prop('disabled', action);
        $("select[name='gender']").prop('disabled', action);
        $("select[name='city']").prop('disabled', action);
        $("select[name='group']").prop('disabled', action);
        $("select[name='doubleS']").prop('disabled', action);
        $("select[name='singleS']").prop('disabled', action);
        $("select[name='cross']").prop('disabled', action);
    }

    function clearForm() {
        $("input[name='name']").val('');
        $("input[name='agency']").val('');
        $("select[name='name']").prop("selectedIndex", 0);
        $("select[name='agency']").prop("selectedIndex", 0);
        $("select[name='gender']").prop("selectedIndex", 0);
        $("select[name='city']").prop("selectedIndex", 0);
        $("select[name='group']").prop("selectedIndex", 0);
        $("select[name='doubleS']").prop("selectedIndex", 0);
        $("select[name='singleS']").prop("selectedIndex", 0);
        $("select[name='cross']").prop("selectedIndex", 0);
    }

    function getPlayer(playerId) {
        console.log(playerId);
        $.ajax({
            url: "player/ajaxGetPlayer/" + playerId,
            dateType: "JSON",
            success: function (msg) {
                console.log(msg);
                $("input[name='name']").val(msg.name);
                $("input[name='agency']").val(msg.agency);
                $("select[name='gender'] option[value=" + msg.gender + "]").prop('selected', true);
                $("select[name='city'] option[value=" + msg.city + "]").prop('selected', true);

                if (!msg.group) {
                    $("select[name='group']").prop("selectedIndex", 0);
                } else {
                    $("select[name='group'] option[value=" + msg.group + "]").prop('selected', true);
                }

                if (!msg.doubleS) {
                    $("select[name='doubleS']").prop("selectedIndex", 0);
                } else {
                    $("select[name='doubleS'] option[value=" + msg.doubleS + "]").prop('selected', true);
                }

                if (!msg.singleS) {
                    $("select[name='singleS']").prop("selectedIndex", 0);
                } else {
                    $("select[name='singleS'] option[value=" + msg.singleS + "]").prop('selected', true);
                }

                if (!msg.cross) {
                    $("select[name='cross']").prop("selectedIndex", 0);
                } else {
                    $("select[name='cross'] option[value=" + msg.cross + "]").prop('selected', true);
                }
            },
            error: function (err) {
                console.log(err);
            }
        })
    }
</script>
@endsection
