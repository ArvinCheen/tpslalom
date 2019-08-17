@extends('layout')

@section('css')

@endsection

@section('content')

<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <p>本次賽事積分有些許異動，詳細內容請參閱簡章</p>
            <p>相關組別報名注意事項，請參閱簡章</p>
        </div>
        <form action='{{ URL('enroll/enroll') }}' method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8 mb-5">
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
                        <select class="form-control" name="group" required disabled>
                            <option value=''> -- 請選擇 -- </option>
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

                <div class="col-md-4 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">報名項目</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item mb-3">
                            <div>
                                <h6>選擇級別</h6>
                            </div>
                            <div class="">
                                <select class="form-control" name="level" id="levelSelectBar" required>
                                    <option value=''> -- 選擇級別 -- </option>
                                    <option value="初級組">初級組</option>
                                    <option value="新人組">新人組</option>
                                    <option value="選手組">選手組</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item mb-3" id="enrollItemSelectBar" style="display:none">
                            <div>
                                <h6>選擇參賽項目</h6>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進雙足S型" id="doubleS" >
                                <label class="form-check-label" for="defaultCheck1">
                                    前進雙足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進單足S型" id="singleS" >
                                <label class="form-check-label" for="defaultCheck1">
                                    前進單足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進交叉型" id="cross" >
                                <label class="form-check-label" for="defaultCheck1">
                                    前進交叉型
                                </label>
                            </div>
                        </li>
                    </ul>

                    @if ($status)
                        <button class="btn btn-primary btn-lg btn-block" type="submit">報名</button>
                    @else
                        <button class="btn btn-lg btn-block" type="button" disabled>報名截止，無法報名</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#levelSelectBar").change(function() {
        $("#enrollItemSelectBar").show();

        switch ($(this).val()) {
            case '初級組':
                $('#doubleS').prop('disabled', false).prop('checked', false);
                $('#singleS').prop('disabled', true).prop('checked', false);
                $('#cross').prop('disabled', true).prop('checked', false);
                break;
            case '新人組':
                $('#doubleS').attr('disabled', false).prop('checked', false);
                $('#singleS').attr('disabled', true).prop('checked', false);
                $('#cross').attr('disabled', false).prop('checked', false);
                break;
            case '選手組':
                $('#doubleS').attr('disabled', false).prop('checked', false);
                $('#singleS').attr('disabled', false).prop('checked', false);
                $('#cross').attr('disabled', false).prop('checked', false);
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
