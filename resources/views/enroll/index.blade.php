@extends('layout')

@section('css')

@endsection

@section('content')

<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">107年中正盃 報名</h2>
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
                        <select class="form-control" name="playerSn" required>
                            <option value=''> -- 請選擇一位選手 -- </option>
                            <option value="newPlayer"> 新增一個全新的選手 </option>
                            @foreach ($playerList as $val)
                                <option value="{{ $val->playerSn }}" {{ old('playerSn') == $val->playerSn ? 'selected' : '' }}>
                                    No.{{ $val->playerSn }} {{ $val->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address">姓名</label>
                        <input type="text" class="form-control" name="name" placeholder='' value="{{ old('name') }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="address">單位</label>
                        <input type="text" class="form-control" name="agency" placeholder="" value="{{ old('agency') }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label>性別</label>
                        <select class="form-control" name="gender" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="男" {{ old('gender') == '男' ? 'selected' : '' }}>男</option>
                            <option value="女" {{ old('gender') == '女' ? 'selected' : '' }}>女</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>縣市</label>
                        <select class="form-control" name="city" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="臺北市" {{ old('city') == '臺北市' ? 'selected' : '' }}>臺北市</option>
                            <option value="基隆市" {{ old('city') == '基隆市' ? 'selected' : '' }}>基隆市</option>
                            <option value="新北市" {{ old('city') == '新北市' ? 'selected' : '' }}>新北市</option>
                            <option value="連江縣" {{ old('city') == '連江縣' ? 'selected' : '' }}>連江縣</option>
                            <option value="宜蘭縣" {{ old('city') == '宜蘭縣' ? 'selected' : '' }}>宜蘭縣</option>
                            <option value="新竹市" {{ old('city') == '新竹市' ? 'selected' : '' }}>新竹市</option>
                            <option value="新竹縣" {{ old('city') == '新竹縣' ? 'selected' : '' }}>新竹縣</option>
                            <option value="桃園市" {{ old('city') == '桃園市' ? 'selected' : '' }}>桃園市</option>
                            <option value="苗栗縣" {{ old('city') == '苗栗縣' ? 'selected' : '' }}>苗栗縣</option>
                            <option value="台中市" {{ old('city') == '台中市' ? 'selected' : '' }}>台中市</option>
                            <option value="彰化縣" {{ old('city') == '彰化縣' ? 'selected' : '' }}>彰化縣</option>
                            <option value="南投縣" {{ old('city') == '南投縣' ? 'selected' : '' }}>南投縣</option>
                            <option value="嘉義市" {{ old('city') == '嘉義市' ? 'selected' : '' }}>嘉義市</option>
                            <option value="嘉義縣" {{ old('city') == '嘉義縣' ? 'selected' : '' }}>嘉義縣</option>
                            <option value="雲林縣" {{ old('city') == '雲林縣' ? 'selected' : '' }}>雲林縣</option>
                            <option value="台南市" {{ old('city') == '台南市' ? 'selected' : '' }}>台南市</option>
                            <option value="高雄市" {{ old('city') == '高雄市' ? 'selected' : '' }}>高雄市</option>
                            <option value="澎湖縣" {{ old('city') == '澎湖縣' ? 'selected' : '' }}>澎湖縣</option>
                            <option value="金門縣" {{ old('city') == '金門縣' ? 'selected' : '' }}>金門縣</option>
                            <option value="屏東縣" {{ old('city') == '屏東縣' ? 'selected' : '' }}>屏東縣</option>
                            <option value="台東縣" {{ old('city') == '台東縣' ? 'selected' : '' }}>台東縣</option>
                            <option value="花蓮縣" {{ old('city') == '花蓮縣' ? 'selected' : '' }}>花蓮縣</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>組別</label>
                        <select class="form-control" name="group" required disabled>
                            <option value=''> -- 請選擇 -- </option>
                            <option value="幼童" {{ old('group') == '幼童' ? 'selected' : '' }}>幼童</option>
                            <option value="國小一年級" {{ old('group') == '國小一年級' ? 'selected' : '' }}>國小一年級</option>
                            <option value="國小二年級" {{ old('group') == '國小二年級' ? 'selected' : '' }}>國小二年級</option>
                            <option value="國小三年級" {{ old('group') == '國小三年級' ? 'selected' : '' }}>國小三年級</option>
                            <option value="國小四年級" {{ old('group') == '國小四年級' ? 'selected' : '' }}>國小四年級</option>
                            <option value="國小五年級" {{ old('group') == '國小五年級' ? 'selected' : '' }}>國小五年級</option>
                            <option value="國小六年級" {{ old('group') == '國小六年級' ? 'selected' : '' }}>國小六年級</option>
                            <option value="國中" {{ old('group') == '國中' ? 'selected' : '' }}>國中</option>
                            <option value="男女子" {{ old('group') == '男女子' ? 'selected' : '' }}>男女子</option>
                            <option value="高中" {{ old('group') == '高中' ? 'selected' : '' }}>高中</option>
                            <option value="大專" {{ old('group') == '大專' ? 'selected' : '' }}>大專</option>
                            <option value="社會" {{ old('group') == '社會' ? 'selected' : '' }}>社會</option>
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
                                <select class="form-control" name="level" id="levelSelectBar">
                                    <option value=''> -- 選擇級別 -- </option>
                                    <option value="初級組" {{ old('level') == '初級組' ? 'selected' : '' }}>初級組</option>
                                    <option value="新人組" {{ old('level') == '新人組' ? 'selected' : '' }}>新人組</option>
                                    <option value="選手組" {{ old('level') == '選手組' ? 'selected' : '' }}>選手組</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item mb-3" id="enrollItemSelectBar" style="display:none">
                            <div>
                                <h6>選擇參賽項目</h6>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="doubleS" id="doubleS">
                                <label class="form-check-label" for="defaultCheck1">
                                    前進雙足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="singleS" id="singleS">
                                <label class="form-check-label" for="defaultCheck1">
                                    前進單足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="cross" id="cross">
                                <label class="form-check-label" for="defaultCheck1">
                                    前進交叉型
                                </label>
                            </div>
                        </li>
                    </ul>

                    @if (config('app.enroll'))
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="enrollButton">報名</button>
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
                $('#singleS').attr('disabled', false).prop('checked', false);
                $('#cross').attr('disabled', false).prop('checked', false);
                break;
            case '選手組':
                $('#doubleS').attr('disabled', false).prop('checked', false);
                $('#singleS').attr('disabled', false).prop('checked', false);
                $('#cross').attr('disabled', false).prop('checked', false);
                break;
        }
    });

    $('#doubleS').change(function() {
        lockLevelSelectBar();
    });

    $('#singleS').change(function() {
        lockLevelSelectBar();
    });

    $('#cross').change(function() {
        lockLevelSelectBar();
    });

    function lockLevelSelectBar() {
        if ($("#levelSelectBar").val() === '新人組') {
            if ($('#doubleS:checked').val() === 'doubleS' && $('#singleS:checked').val() === 'singleS') {
                console.log(1);
                $('#cross').attr('disabled', true);
            } else {
                $('#cross').attr('disabled', false);
            }

            if ($('#singleS:checked').val() === 'singleS' && $('#cross:checked').val() === 'cross') {
                console.log(2);
                $('#doubleS').attr('disabled', true);
            } else {
                $('#doubleS').attr('disabled', false);
            }

            if ($('#cross:checked').val() === 'cross' && $('#doubleS:checked').val() === 'doubleS') {
                console.log(3);
                $('#singleS').attr('disabled', true);
            } else {
                $('#singleS').attr('disabled', false);
            }
        }
    }


    $("select[name='playerSn']").change(function() {
        var playerSn = $(this).val();

        clearForm();

        if (playerSn === '') {
            disabledForm(true);
        } else {
            disabledForm(false);
            getPlayer(playerSn);
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

    function getPlayer(playerSn) {
        $.ajax({
            url: "player/ajaxGetPlayer/" + playerSn,
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
            },
            error: function (err) {
                console.log(err);
            }
        })
    }
</script>
@endsection
