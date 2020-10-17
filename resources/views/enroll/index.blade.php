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
                                <option value=''> -- 請選擇 --</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>縣市</label>
                            <select class="form-control" name="city" required disabled>
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
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>組別</label>
                            <select id="groupSelect" class="form-control" name="group" required disabled>
                                <option value=''> -- 請選擇 --</option>
                                <option value="幼童">幼童</option>
                                <option value="國小一年級">國小一年級</option>
                                <option value="國小二年級">國小二年級</option>
                                <option value="國小三年級">國小三年級</option>
                                <option value="國小四年級">國小四年級</option>
                                <option value="國小五年級">國小五年級</option>
                                <option value="國小六年級">國小六年級</option>
                                <option value="國中">國中</option>
                                <option value="高中">高中</option>
                                <option value="大專">大專</option>
                                <option value="社會">社會</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div id="selectGameItem" class="row" style="display:none">
                    <div class="col-md-12 mb-12">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-3">選擇競賽項目</h4>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item mb-3">
                                <h6>速樁</h6>
                                <div>
                                    <select class="form-control" name="level" id="levelSelect">
                                        <option value=''> -- 選擇速樁級別 --</option>
                                        <option id="option初級組" value="初級組" {{ $level == '初級組' ? 'selected' : null }}>初級組</option>
                                        <option value="新人組" {{ $level == '新人組' ? 'selected' : null }}>新人組</option>
                                        <option value="選手組" {{ $level == '選手組' ? 'selected' : null }}>選手組</option>
                                    </select>
                                </div>
                                <div class="enrollItemBox" style="display:none">
                                    <div class="form-check" style="margin-top:10px">
                                        <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進雙足S型" id="doubleS"
                                               @foreach ($enrolls as $enroll)
                                               @if ($enroll->item == '前進雙足S型')
                                               checked
                                            @endif
                                            @endforeach
                                        >
                                        <label class="form-check-label" for="doubleS">
                                            前進雙足S型
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin-top:10px">
                                        <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進單足S型" id="singleS"
                                               @foreach ($enrolls as $enroll)
                                               @if ($enroll->item == '前進單足S型')
                                               checked
                                            @endif
                                            @endforeach
                                        >
                                        <label class="form-check-label" for="singleS">
                                            前進單足S型
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin-top:10px">
                                        <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進交叉型" id="cross"
                                               @foreach ($enrolls as $enroll)
                                               @if ($enroll->item == '前進交叉型')
                                               checked
                                            @endif
                                            @endforeach
                                        >
                                        <label class="form-check-label" for="cross">
                                            前進交叉型
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item mb-3">
                                <div>
                                    <h6>個人指定套路</h6>
                                </div>
                                <div class="form-check" style="margin-top:10px">
                                    <input class="form-check-input" name="flowerItem" type="radio" value="初級指定套路" id="flower1"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->item == '初級指定套路')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="flower1">
                                        初級指定套路（指定曲目）
                                    </label>
                                </div>
                                <div class="form-check" style="margin-top:10px">
                                    <input class="form-check-input" name="flowerItem" type="radio" value="中級指定套路" id="flower2"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->item == '中級指定套路')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="flower2">
                                        中級指定套路（自選曲目）
                                    </label>
                                </div>

                                <hr id="flowerHrLine" style="display:none;">

                                <div class="form-check flower1sound" style="margin-top:10px; display:none">
                                    <input class="form-check-input" name="sound" type="radio" value="曲目1" id="sound1"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->sound == '曲目1')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="sound1">
                                        曲目1
                                    </label>
                                </div>
                                <div class="form-check flower1sound" style="margin-top:10px; display:none">
                                    <input class="form-check-input" name="sound" type="radio" value="曲目2" id="sound2"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->sound == '曲目2')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="sound2">
                                        曲目2
                                    </label>
                                </div>
                                <div class="form-check flower1sound" style="margin-top:10px; display:none">
                                    <input class="form-check-input" name="sound" type="radio" value="曲目3" id="sound3"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->sound == '曲目3')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="sound3">
                                        曲目3
                                    </label>
                                </div>
                                <div class="form-check flower1sound" style="margin-top:10px; display:none">
                                    <input class="form-check-input" name="sound" type="radio" value="曲目4" id="sound4"
                                           @foreach ($enrolls as $enroll)
                                           @if ($enroll->sound == '曲目4')
                                           checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="sound4">
                                        曲目4
                                    </label>
                                </div>


                                <div class="form-check custom-file flower2sound" style="margin-top:10px; display:none">
                                    <input type="file" class="custom-file-input" id="customFile" name="soundFile">
                                    <label class="custom-file-label" for="customFile">選擇音樂檔</label>
                                </div>
                            </li>
                        </ul>

                        @if ($status)
                            @if (is_null($playerId))
                                <button class="btn btn-primary col-md-12" type="submit">報名</button>
                            @else
                                <button class="btn btn-primary col-md-5" type="submit">修改報名資訊</button>
                                <a class="btn btn-default col-md-5" href="{{ URL('paymentInfo') }}">回繳費資訊</a>
                            @endif
                        @else
                            <button class="btn" type="button" disabled>報名截止，無法報名</button>
                        @endif
                    </div>
                </div>
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
            var url = "http://nksds.com/tpslalom/public/player/ajaxGetPlayer/" + playerId;
            @endif

            $.ajax({
                url: url,
                dateType: "JSON",
                success: function (msg) {
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
