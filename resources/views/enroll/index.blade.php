@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container mt-5">
            {{--        <div class="mt-5 mb-5 text-center">--}}
            {{--            <p>本次賽事積分有些許異動，詳細內容請參閱簡章</p>--}}
            {{--            <p>相關組別報名注意事項，請參閱簡章</p>--}}
            {{--        </div>--}}
            <form action='{{ URL('enroll/enroll') }}' method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if (isset($playerId))
                    <input type="hidden" name="playerId" value="{{$playerId}}"/>
                @endif
                <div class="row">
                    <div class="col-md-12 mb-12">
                        @if (is_null($playerId))
                            <h3 class="mb-3">報名參賽選手</h3>
                        @else
                            <h3 class="mb-3">修改參賽選手資料</h3>
                        @endif

                        @if (is_null($playerId))
                            <div class="mb-3">
                                <select class="form-control" id="selectPlayer" name="playerId" required>
                                    <option value=''> -- 請選擇一位選手 --</option>
                                    <option value="newPlayer"> 新增一個全新的選手</option>
                                    @foreach ($players as $player)
                                        <option value="{{ $player->id }}">
                                            No.{{ $player->id }} {{ $player->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label>姓名</label>
                            <input type="text" class="form-control" name="name" placeholder='' value="" required disabled>
                        </div>
                        @if(env('GAME') == 13)
                            <div class="mb-3">
                                <label>身份證字號</label>
                                <input type="text" class="form-control" name="identityId" placeholder='範例：A123456789' value="" required disabled>
                            </div>
                            <div class="mb-3">
                                <label>出生年月日</label>
                                <input type="text" class="form-control" name="birthday" placeholder='範例：西元月日（19900523）' value="" required disabled>
                            </div>
                            <div class="mb-3">
                                <label>教練</label>
                                <input type="text" class="form-control" name="coach" placeholder="" value="" required disabled>
                            </div>
                            <div class="mb-3">
                                <label>領隊</label>
                                <input type="text" class="form-control" name="leader" placeholder="" value="" required disabled>
                            </div>
                            <div class="mb-3">
                                <label>管理</label>
                                <input type="text" class="form-control" name="manager" placeholder="" value="" required disabled>
                            </div>
                            <div class="mb-3">
                                <label>家長</label>
                                <input type="text" class="form-control" name="parent" placeholder="" value="" required disabled>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label>單位</label>
                            <input type="text" class="form-control" name="agency" placeholder="" value="" required disabled>
                        </div>
                        <div class="mb-3">
                            <label>性別</label>
                            <select class="form-control" name="gender" required disabled>
                                <option value=''> -- 請選擇 --</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>縣市</label>
                            <select class="form-control" name="city" required disabled>
                                @if (env('GAME') == 13)
                                    <option value="花蓮縣">花蓮縣</option>
                                @else
                                    <option value=''> -- 請選擇 --</option>
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
                                @endif
                            </select>
                        </div>
                            <div class="mb-3">
                                <label>組別</label>
                                <select id="groupSelect" class="form-control" name="group" required >
                                    <option value=''> -- 請選擇 --</option>
                                    @if(env('GAME') == 11 || env('GAME') == 14)
                                        <option value="幼童">幼童</option>
                                    @endif

                                    @if(env('GAME') == 12)
                                        <option value="幼童">幼童</option>
                                        <option value="小班">小班</option>
                                        <option value="中班">中班</option>
                                        <option value="大班">大班</option>
                                    @endif

                                    @if(env('GAME') == 13)
                                        <option value="小班">小班</option>
                                        <option value="中班">中班</option>
                                        <option value="大班">大班</option>
                                    @endif

                                    <option value="國小一年級">國小一年級</option>
                                    <option value="國小二年級">國小二年級</option>
                                    <option value="國小三年級">國小三年級</option>
                                    <option value="國小四年級">國小四年級</option>
                                    <option value="國小五年級">國小五年級</option>
                                    <option value="國小六年級">國小六年級</option>
                                    <option value="國中">國中</option>
                                    <option value="高中">高中</option>

                                    @if(env('GAME') == 11 || env('GAME') == 14)
                                        <option value="大專">大專</option>
                                        <option value="社會">社會</option>
                                    @endif

                                    @if(env('GAME') == 12)
                                        chr<option value="社會">社會</option>
                                    @endif

                                    @if(env('GAME') == 13)
                                        <option value="大專">青年</option>
                                        <option value="大專">公開</option>
                                    @endif


                                </select>
                            </div>

                            @if(env('GAME') == 11 || env('GAME') == 14)
                                <div class="mb-3">
                                    <label>級別</label>
                                    <select id="groupSelect" class="form-control" name="level" required >
                                        <option value=''> -- 請選擇 --</option>
                                        <option value="初級組" {{ $level == '初級組' ? 'selected' : '' }}>初級組</option>
                                        <option value="新人組" {{ $level == '新人組' ? 'selected' : '' }}>新人組</option>
                                        <option value="選手組" {{ $level == '選手組' ? 'selected' : '' }}>選手組</option>
                                    </select>
                                </div>
                            @endif
                    </div>
                </div>
                <hr>
                <h3 class="mb-3">參賽項目 <small>對應組別請參照簡章說明</small></h3>
                @switch (env('GAME'))
                    @case(11)
                        <div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>初級組 快速過角標： <small style="color:red">（限從未在民國109(含)年之前於全國盃賽報名者及未於臺北市中正盃、青年盃尚未獲得初級組前六名者，如發現違反規定者取消名次並不退還報名費。）</small></label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進雙足S形"> 前進雙足S形
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>新人組 速度過樁 - (每人限報一項，不得跨組) <small style="color:red">（限從未在民國109(含)年之前於全國盃賽（含新人組）中得過前三名之選手報名參賽，如發現違反規定者取消名次並不退還報名費）</small></label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進雙足S形"> 前進雙足S形
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進交叉形"> 前進交叉形
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>選手組 速度過樁</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進雙足S形"> 前進雙足S形
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進單足S形"> 前進單足S形
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="前進交叉形"> 前進交叉形
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break;
                    @case(12)
                        <div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>競速溜冰 - 競速組</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="競速組 300 公尺計時賽"> 競速組 300 公尺計時賽
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="競速組 450 公尺計時賽"> 競速組 450 公尺計時賽
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>競速溜冰 - 休閒組</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="休閒組 150 公尺計時賽"> 休閒組 150 公尺計時賽
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="休閒組 300 公尺計時賽"> 休閒組 300 公尺計時賽
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>自由式輪滑</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="單足S形"> 單足S形
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="雙足S形"> 雙足S形
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @break;
                    @case(13)
                        <div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>前溜單足S形</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小低年級菁英組 前溜單足S形"> 國小低年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小中年級菁英組 前溜單足S形"> 國小中年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小高年級菁英組 前溜單足S形"> 國小高年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國中組 前溜單足S形"> 國中組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="青年組 前溜單足S形"> 青年組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="公開組 前溜單足S形"> 公開組
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>前溜雙足S形</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="幼幼組 前溜雙足S形"> 幼幼組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="幼童組 前溜雙足S形"> 幼童組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小選手甲組 前溜雙足S形"> 國小選手甲組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國中選手甲組 前溜雙足S形"> 國中選手甲組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小低年級菁英組 前溜雙足S形"> 國小低年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小中年級菁英組 前溜雙足S形"> 國小中年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小高年級菁英組 前溜雙足S形"> 國小高年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國中組 前溜雙足S形"> 國中組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="青年組 前溜雙足S形"> 青年組
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 mb-12">
                                    <label>前溜交叉形</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="幼幼組 前溜交叉形"> 幼幼組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="幼童組 前溜交叉形"> 幼童組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小選手甲組 前溜交叉形"> 國小選手甲組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國中選手甲組 前溜交叉形"> 國中選手甲組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小低年級菁英組 前溜交叉形"> 國小低年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小中年級菁英組 前溜交叉形"> 國小中年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國小高年級菁英組 前溜交叉形"> 國小高年級菁英組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="國中組 前溜交叉形"> 國中組
                                        </label>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="enrollItem[]" value="青年組 前溜交叉形"> 青年組
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break;

                    @case(14)
                    <div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-12">
                                <div class="form-check">
                                    @php
                                        $checkedStatus = false;
                                    @endphp

                                    @foreach ($enrolls as $enroll)
                                        @if ($enroll->item == '前進雙足S形')
                                            @php
                                                $checkedStatus = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <label class="form-check-label">
                                        <input type="checkbox" name="enrollItem[]" value="前進雙足S形" {{ $checkedStatus ? 'checked' : null }}> 前進雙足S形
                                    </label>
                                    @php
                                        $checkedStatus = false;
                                    @endphp
                                </div>
                                <div class="form-check">
                                    @foreach ($enrolls as $enroll)
                                        @if ($enroll->item == '前進單足S形')
                                            @php
                                                $checkedStatus = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <label class="form-check-label">
                                        <input type="checkbox" name="enrollItem[]" value="前進單足S形" {{ $checkedStatus ? 'checked' : null }}> 前進單足S形
                                    </label>
                                    @php
                                        $checkedStatus = false;
                                    @endphp
                                </div>
                                <div class="form-check">
                                    @foreach ($enrolls as $enroll)
                                        @if ($enroll->item == '前進交叉形')
                                            @php
                                                $checkedStatus = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <label class="form-check-label">
                                        <input type="checkbox" name="enrollItem[]" value="前進交叉形" {{ $checkedStatus ? 'checked' : null }}> 前進交叉形
                                    </label>
                                    @php
                                        $checkedStatus = false;
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>

                    @break;
                    @default
                @endswitch
                <hr>
                @if ($status)
                    @if (is_null($playerId))
                        <button class="btn btn-primary col-md-12" type="submit">報名</button>
                    @else
                        <button class="btn btn-primary col-md-3" type="submit">修改報名資訊</button>
                        <a class="btn btn-default col-md-3" href="{{ URL('paymentInfo') }}">回繳費資訊</a>
                    @endif
                @else
                    <button class="btn" type="button" disabled>報名截止，無法報名</button>
                @endif
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if (! is_null($playerId))
        getPlayer({{$playerId}});
        disabledForm(false);

        @foreach ($enrolls as $enroll)

        @if ($enroll->item == '初級指定套路')
        $("#flowerHrLine").show();
        $('.flower1sound').show();
        @endif

        @if ($enroll->item == '中級指定套路')
        $("#flowerHrLine").show();
        $('.flower2sound').show();
        @endif

        @endforeach
        @endif

        @if (! is_null($level))
        showSpeedItem('{{$level}}');
        @endif



        $("#selectPlayer").change(function () {
            var playerId = $(this).val();

            clearForm();

            if (playerId === '') {
                disabledForm(true);
            } else {
                disabledForm(false);
                getPlayer(playerId);
            }
        });

        $("#levelSelect").change(function () {
            showSpeedItem($(this).val());
            clearSpeedItem();
        });

        function clearSpeedItem() {
            $('#doubleS').prop('checked', false);
            $('#singleS').prop('checked', false);
            $('#cross').prop('checked', false);
        }

        function showSpeedItem(level) {
            $(".enrollItemBox").show();
            switch (level) {
                case '初級組':
                    $('#doubleS').prop('disabled', false);
                    $('#singleS').prop('disabled', true);
                    $('#cross').prop('disabled', true);
                    break;
                case '新人組':
                    $('#doubleS').attr('disabled', false);
                    $('#singleS').attr('disabled', true);
                    $('#cross').attr('disabled', false);

                    // 這裡有bug，如果選到新人組，其它組別都會吃到下面的設定，暫時想不到更好的寫法
                    $('#doubleS').change(function () {
                        if (document.getElementById("doubleS").checked === true) {
                            $('#cross').attr('disabled', true);
                        } else {
                            $('#cross').attr('disabled', false);
                        }
                    });

                    $('#cross').change(function () {
                        if (document.getElementById("cross").checked === true) {
                            $('#doubleS').attr('disabled', true);
                        } else {
                            $('#doubleS').attr('disabled', false);
                        }
                    });

                    break;
                case '選手組':
                    $('#doubleS').attr('disabled', false);
                    $('#singleS').attr('disabled', false);
                    $('#cross').attr('disabled', false);
                    break;
            }
        }

        $("input[name='flowerItem']").change(function () {
            showFlowerItem($(this).val());
        });

        function showFlowerItem(item) {
            $("#flowerHrLine").show();

            switch (item) {
                case '初級指定套路':
                    $('.flower1sound').show();
                    $('.flower2sound').hide();
                    break;
                case '中級指定套路':
                    $('.flower1sound').hide();
                    $('.flower2sound').show();
                    break;
            }
        }

        $("#groupSelect").change(function () {
            showItemSelect();
        });

        function showItemSelect() {
            $("#selectGameItem").show();
            switch ($("#groupSelect").val()) {
                case '幼童':
                case '國小一年級':
                case '國小二年級':
                case '國小三年級':
                case '國小四年級':
                case '國小五年級':
                case '國小六年級':
                    $('#option初級組').prop('disabled', false);
                    break;
                default:
                    $('#option初級組').prop('disabled', true);
                    break;
            }
        }

        function disabledForm(action) {
            $("input[name='name']").prop('disabled', action);
            $("input[name='identityId']").prop('disabled', action);
            $("input[name='birthday']").prop('disabled', action);
            $("input[name='coach']").prop('disabled', action);
            $("input[name='leader']").prop('disabled', action);
            $("input[name='parent']").prop('disabled', action);
            $("input[name='manager']").prop('disabled', action);
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
            // dev 和 production 的domain不同，暫時使用兩種寫法
                @if (env('APP_ENV') == 'local')
            var url = "/player/ajaxGetPlayer/" + playerId;
                @else
            var url = "./public/player/ajaxGetPlayer/" + playerId;
            @endif

            $.ajax({
                url: url,
                dateType: "JSON",
                success: function (msg) {
                    $("input[name='name']").val(msg.name);
                    $("input[name='agency']").val(msg.agency);
                    $("select[name='gender'] option[value=" + msg.gender + "]").prop('selected', true);
                    $("select[name='city'] option[value=" + msg.city + "]").prop('selected', true);

                    @if (env('GAME') == 13)
                        $("input[name='identityId']").val(msg.identity_id);
                        $("input[name='birthday']").val(msg.birthday);
                        $("input[name='coach']").val(msg.coach);
                        $("input[name='leader']").val(msg.leader);
                        $("input[name='manager']").val(msg.manager);
                        $("input[name='parent']").val(msg.parent);
                    @endif

                    if (!msg.group) {
                        $("select[name='group']").prop("selectedIndex", 0);
                    } else {
                        $("select[name='group'] option[value=" + msg.group + "]").prop('selected', true);
                    }

                    // if (!msg.doubleS) {
                    //     $("select[name='doubleS']").prop("selectedIndex", 0);
                    // } else {
                    //     $("select[name='doubleS'] option[value=" + msg.doubleS + "]").prop('selected', true);
                    // }
                    //
                    // if (!msg.singleS) {
                    //     $("select[name='singleS']").prop("selectedIndex", 0);
                    // } else {
                    //     $("select[name='singleS'] option[value=" + msg.singleS + "]").prop('selected', true);
                    // }
                    //
                    // if (!msg.cross) {
                    //     $("select[name='cross']").prop("selectedIndex", 0);
                    // } else {
                    //     $("select[name='cross'] option[value=" + msg.cross + "]").prop('selected', true);
                    // }
                    if (msg.group) {
                        showItemSelect();
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }

        // 上傳檔案 start
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        // 上傳檔案 end
    </script>
@endsection
