@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">修改報名資訊</h2>
            <p>

            </p>
        </div>
        <form action='{{ URL('enroll/update') }}' method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="playerSn" value="{{ $player->playerSn }}"/>
            <div class="row">
            <div class="col-md-8 mb-5">
                <h4 class="mb-3">選手資訊</h4>
                <div class="mb-3">
                    <label for="address">姓名</label>
                    <input type="text" class="form-control" name="name" placeholder='' value="{{ $player->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="address">單位</label>
                    <input type="text" class="form-control" name="agency" placeholder="example：某某國小" value="{{ $player->agency }}" required>
                </div>
                <div class="mb-3">
                    <label>性別</label>
                    <select class="form-control" name="gender" required>
                        <option value=''> -- 請選擇 -- </option>
                        <option value="男" {{ $player->gender == '男' ? 'selected' : '' }}>男</option>
                        <option value="女" {{ $player->gender == '女' ? 'selected' : '' }}>女</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>縣市</label>
                    <select class="form-control" name="city" required>
                        <option value=''> -- 請選擇 -- </option>
                        <option value="臺北市" {{ $player->city == '臺北市' ? 'selected' : '' }}>臺北市</option>
                        <option value="基隆市" {{ $player->city == '基隆市' ? 'selected' : '' }}>基隆市</option>
                        <option value="新北市" {{ $player->city == '新北市' ? 'selected' : '' }}>新北市</option>
                        <option value="連江縣" {{ $player->city == '連江縣' ? 'selected' : '' }}>連江縣</option>
                        <option value="宜蘭縣" {{ $player->city == '宜蘭縣' ? 'selected' : '' }}>宜蘭縣</option>
                        <option value="新竹市" {{ $player->city == '新竹市' ? 'selected' : '' }}>新竹市</option>
                        <option value="新竹縣" {{ $player->city == '新竹縣' ? 'selected' : '' }}>新竹縣</option>
                        <option value="桃園市" {{ $player->city == '桃園市' ? 'selected' : '' }}>桃園市</option>
                        <option value="苗栗縣" {{ $player->city == '苗栗縣' ? 'selected' : '' }}>苗栗縣</option>
                        <option value="台中市" {{ $player->city == '台中市' ? 'selected' : '' }}>台中市</option>
                        <option value="彰化縣" {{ $player->city == '彰化縣' ? 'selected' : '' }}>彰化縣</option>
                        <option value="南投縣" {{ $player->city == '南投縣' ? 'selected' : '' }}>南投縣</option>
                        <option value="嘉義市" {{ $player->city == '嘉義市' ? 'selected' : '' }}>嘉義市</option>
                        <option value="嘉義縣" {{ $player->city == '嘉義縣' ? 'selected' : '' }}>嘉義縣</option>
                        <option value="雲林縣" {{ $player->city == '雲林縣' ? 'selected' : '' }}>雲林縣</option>
                        <option value="台南市" {{ $player->city == '台南市' ? 'selected' : '' }}>台南市</option>
                        <option value="高雄市" {{ $player->city == '高雄市' ? 'selected' : '' }}>高雄市</option>
                        <option value="澎湖縣" {{ $player->city == '澎湖縣' ? 'selected' : '' }}>澎湖縣</option>
                        <option value="金門縣" {{ $player->city == '金門縣' ? 'selected' : '' }}>金門縣</option>
                        <option value="屏東縣" {{ $player->city == '屏東縣' ? 'selected' : '' }}>屏東縣</option>
                        <option value="台東縣" {{ $player->city == '台東縣' ? 'selected' : '' }}>台東縣</option>
                        <option value="花蓮縣" {{ $player->city == '花蓮縣' ? 'selected' : '' }}>花蓮縣</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>組別</label>
                    <select class="form-control" name="group" required>
                        <option value=''> -- 請選擇 -- </option>
                        <option value="幼童" {{ $player->group == '幼童' ? 'selected' : '' }}>幼童</option>
                        <option value="國小一年級" {{ $player->group == '國小一年級' ? 'selected' : '' }}>國小一年級</option>
                        <option value="國小二年級" {{ $player->group == '國小二年級' ? 'selected' : '' }}>國小二年級</option>
                        <option value="國小三年級" {{ $player->group == '國小三年級' ? 'selected' : '' }}>國小三年級</option>
                        <option value="國小四年級" {{ $player->group == '國小四年級' ? 'selected' : '' }}>國小四年級</option>
                        <option value="國小五年級" {{ $player->group == '國小五年級' ? 'selected' : '' }}>國小五年級</option>
                        <option value="國小六年級" {{ $player->group == '國小六年級' ? 'selected' : '' }}>國小六年級</option>
                        <option value="國中" {{ $player->group == '國中' ? 'selected' : '' }}>國中</option>
                        <option value="男女子" {{ $player->group == '男女子' ? 'selected' : '' }}>男女子</option>
                        <option value="高中" {{ $player->group == '高中' ? 'selected' : '' }}>高中</option>
                        <option value="大專" {{ $player->group == '大專' ? 'selected' : '' }}>大專</option>
                        <option value="社會" {{ $player->group == '社會' ? 'selected' : '' }}>社會</option>
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
                                    <option value="初級組" {{ $player->level == '初級組' ? 'selected' : '' }}>初級組</option>
                                    <option value="新人組" {{ $player->level == '新人組' ? 'selected' : '' }}>新人組</option>
                                    <option value="選手組" {{ $player->level == '選手組' ? 'selected' : '' }}>選手組</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item mb-3" id="enrollItemSelectBar" >
                            <div>
                                <h6>選擇參賽項目</h6>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進雙足S型" id="doubleS" {{ !is_null($player->doubleS) ? 'checked' : null}}>
                                <label class="form-check-label" for="defaultCheck1">
                                    前進雙足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進單足S型" id="singleS" {{ !is_null($player->singleS) ? 'checked' : null}}>
                                <label class="form-check-label" for="defaultCheck1">
                                    前進單足S型
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:10px">
                                <input class="form-check-input" name="enrollItem[]" type="checkbox" value="前進交叉型" id="cross" {{ !is_null($player->cross) ? 'checked' : null}}>
                                <label class="form-check-label" for="defaultCheck1">
                                    前進交叉型
                                </label>
                            </div>
                        </li>
                    </ul>
                    @if (config('app.enroll'))
                        <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">修改</button>
                        <input type="button" class="btn btn-danger btn-lg btn-block" onclick="cancelEnroll()" value="取消報名">
                    @else
                        <button class="btn btn-lg btn-block" type="button" disabled>報名截止，無法修改</button>
                    @endif
                </div>


            </div>
        </div>
        </form>
    </div>
</div>

<form id="cancelForm" action="{{ URL('enroll/cancel') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="playerSn" value="{{ $player->playerSn }}"/>
</form>
@endsection

@section('js')

    <script>
        lockLevelSelectBar();

        if ($("#levelSelectBar").val() == '初級組') {
            $('#singleS').prop('disabled', true);
            $('#cross').prop('disabled', true);
        }

        $("#levelSelectBar").change(function() {
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
                if ($('#doubleS:checked').val() === '前進雙足S型' && $('#singleS:checked').val() === '前進單足S型') {
                    console.log(1);
                    $('#cross').attr('disabled', true);
                } else {
                    $('#cross').attr('disabled', false);
                }

                if ($('#singleS:checked').val() === '前進單足S型' && $('#cross:checked').val() === '前進交叉型') {
                    console.log(2);
                    $('#doubleS').attr('disabled', true);
                } else {
                    $('#doubleS').attr('disabled', false);
                }

                if ($('#cross:checked').val() === '前進交叉型' && $('#doubleS:checked').val() === '前進雙足S型') {
                    console.log(3);
                    $('#singleS').attr('disabled', true);
                } else {
                    $('#singleS').attr('disabled', false);
                }
            }
        }

        function cancelEnroll() {
            $('#cancelForm').submit();
        }
    </script>
@endsection
