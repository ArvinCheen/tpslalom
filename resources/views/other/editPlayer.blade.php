<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>直排輪競賽</title>
        <!-- Icon -->
        <link rel="icon" href="https://nksds.com/wp-content/uploads/2017/03/cropped-LOGO-512-32x32.png" sizes="32x32" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            body {
                font-family: Microsoft JhengHei;
            }

            .center-outside-div {
                margin: 0 auto;
                width: 100%;
                text-align: center;
            }

            .input-outside {
                margin:10px 0;
            }

            /*.input {*/
                /*width: 150px;*/
            /*}*/

            .input {
                padding:0 5px;
                width: 150px;
            }

            .account-id-div {
                margin: 20px;
            }

            .top-button {
                display: inline-block;
            }

            .submit-div {
                margin-bottom: 15px;
            }

        </style>
    </head>
    <body>
        <div class="center-outside-div">
            @include ('titleButton')
        </div>
        <div class="center-outside-div" style="margin-top:50px;">

            <form action="{{ URL('updatePlayer') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="playerSn" value="{{ $playerData->playerSn }}">
                <div class="account-id-div">
                    姓名：<input type="text" class="input" name="name" value="{{ old('name', $playerData->name) }}">
                </div>
                {{ csrf_field() }}
                <div class="account-id-div">
                    性別：
                    <select name="gender" class="input">
                        <option value=""> -- 請選擇 -- </option>
                        <option value="男" {{ old('gender', $playerData->gender) == '男' ? 'selected' : '' }}>男</option>
                        <option value="女" {{ old('gender', $playerData->gender) == '女' ? 'selected' : '' }}>女</option>
                    </select>
                </div>
                {{ csrf_field() }}
                <div class="account-id-div">
                    縣市：
                    <select name="city" class="input">
                        <option value=""> -- 請選擇 -- </option>
                        <option value="臺北市" {{ old('city', $playerData->city) == '臺北市' ? 'selected' : '' }}>臺北市</option>
                        <option value="基隆市" {{ old('city', $playerData->city) == '基隆市' ? 'selected' : '' }}>基隆市</option>
                        <option value="新北市" {{ old('city', $playerData->city) == '新北市' ? 'selected' : '' }}>新北市</option>
                        <option value="連江縣" {{ old('city', $playerData->city) == '連江縣' ? 'selected' : '' }}>連江縣</option>
                        <option value="宜蘭縣" {{ old('city', $playerData->city) == '宜蘭縣' ? 'selected' : '' }}>宜蘭縣</option>
                        <option value="新竹市" {{ old('city', $playerData->city) == '新竹市' ? 'selected' : '' }}>新竹市</option>
                        <option value="新竹縣" {{ old('city', $playerData->city) == '新竹縣' ? 'selected' : '' }}>新竹縣</option>
                        <option value="桃園縣" {{ old('city', $playerData->city) == '桃園縣' ? 'selected' : '' }}>桃園縣</option>
                        <option value="苗栗縣" {{ old('city', $playerData->city) == '苗栗縣' ? 'selected' : '' }}>苗栗縣</option>
                        <option value="台中市" {{ old('city', $playerData->city) == '台中市' ? 'selected' : '' }}>台中市</option>
                        <option value="彰化縣" {{ old('city', $playerData->city) == '彰化縣' ? 'selected' : '' }}>彰化縣</option>
                        <option value="南投縣" {{ old('city', $playerData->city) == '南投縣' ? 'selected' : '' }}>南投縣</option>
                        <option value="嘉義市" {{ old('city', $playerData->city) == '嘉義市' ? 'selected' : '' }}>嘉義市</option>
                        <option value="嘉義縣" {{ old('city', $playerData->city) == '嘉義縣' ? 'selected' : '' }}>嘉義縣</option>
                        <option value="雲林縣" {{ old('city', $playerData->city) == '雲林縣' ? 'selected' : '' }}>雲林縣</option>
                        <option value="台南市" {{ old('city', $playerData->city) == '台南市' ? 'selected' : '' }}>台南市</option>
                        <option value="高雄市" {{ old('city', $playerData->city) == '高雄市' ? 'selected' : '' }}>高雄市</option>
                        <option value="澎湖縣" {{ old('city', $playerData->city) == '澎湖縣' ? 'selected' : '' }}>澎湖縣</option>
                        <option value="金門縣" {{ old('city', $playerData->city) == '金門縣' ? 'selected' : '' }}>金門縣</option>
                        <option value="屏東縣" {{ old('city', $playerData->city) == '屏東縣' ? 'selected' : '' }}>屏東縣</option>
                        <option value="台東縣" {{ old('city', $playerData->city) == '台東縣' ? 'selected' : '' }}>台東縣</option>
                        <option value="花蓮縣" {{ old('city', $playerData->city) == '花蓮縣' ? 'selected' : '' }}>花蓮縣</option>
                    </select>
                </div>
                {{ csrf_field() }}
                <div class="account-id-div">
                    單位：<input type="text" class="input" name="agency" value="{{ old('agency', $playerData->agency) }}">
                </div>
                <div class="submit-div">
                    <input type="submit" class="btn btn-primary" value="修改" style="width:180px;">
                </div>
                {{--因為會連動到過去的歷史報名紀錄，暫時無解，先註解掉--}}
                {{--<div class="submit-div">--}}
                    {{--<input type="button" class="btn btn-danger" value="刪除選手資料"  onclick="deleteWindow({{ $playerData->sn }})" style="width:180px;">--}}
                {{--</div>--}}

            </form>

        </div>
    </body>

    <form id="deletePlayerForm" action="{{ URL('deletePlayer') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" id="playerSn" name="playerSn">
    </form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>
    $("select[name='level']").change(function() {
        $("select[name='item']").empty();
        $("select[name='group']").empty();
       var level = $(this).val();
        if (level === "初級組") {
            $("select[name='item']").append('<option value=""> -- 請選擇 -- </option>');
            $("select[name='item']").append('<option value="前進雙足S型">前進雙足S型</option>');

            $("select[name='group']").append('<option value=""> -- 請選擇 -- </option>');
            $("select[name='group']").append('<option value="幼童組">幼童組</option>');
            $("select[name='group']").append('<option value="國小一年級">國小一年級</option>');
            $("select[name='group']").append('<option value="國小二年級">國小二年級</option>');
            $("select[name='group']").append('<option value="國小三年級">國小三年級</option>');
            $("select[name='group']").append('<option value="國小四年級">國小四年級</option>');
            $("select[name='group']").append('<option value="國小五年級">國小五年級</option>');
            $("select[name='group']").append('<option value="國小六年級">國小六年級</option>');
        } else if (level === "選手組" || level === "新人組") {
            $("select[name='item']").append('<option value=""> -- 請選擇 -- </option>');
            $("select[name='item']").append('<option value="前進雙足S型">前進雙足S型</option>');
            $("select[name='item']").append('<option value="前進單足S型">前進單足S型</option>');
            $("select[name='item']").append('<option value="前進交叉型">前進交叉型</option>');

            $("select[name='group']").append('<option value=""> -- 請選擇 -- </option>');
            $("select[name='group']").append('<option value="幼童組">幼童組</option>');
            $("select[name='group']").append('<option value="國小一年級">國小一年級</option>');
            $("select[name='group']").append('<option value="國小二年級">國小二年級</option>');
            $("select[name='group']").append('<option value="國小三年級">國小三年級</option>');
            $("select[name='group']").append('<option value="國小四年級">國小四年級</option>');
            $("select[name='group']").append('<option value="國小五年級">國小五年級</option>');
            $("select[name='group']").append('<option value="國小六年級">國小六年級</option>');
            $("select[name='group']").append('<option value="國中組">國中組</option>');
            $("select[name='group']").append('<option value="高中組">高中組</option>');
            $("select[name='group']").append('<option value="大專校院組">大專校院組</option>');
            $("select[name='group']").append('<option value="社會組">社會組</option>');
        }

    });

    function deleteWindow(playerSn) {
        $("#playerSn").val(playerSn);
        $("#deletePlayerForm").submit();
    }
//    $.ajax({
//        url: "deleteAjaxContractClause",
//        type: "GET",
//        dataType: "JSON",
//        data: { clauseSn: clauseSn, _method: 'delete'},
//    })
//        .done(function( msg ) {
//            if (typeof msg.error !== 'undefined') {
//                toastr['error'](msg.error);
//            } else if (msg.deleteStatus === 1) {
//                $("#clause-sn-"+ clauseSn).hide();
//                toastr['success']('刪除契約條款成功');
//            } else {
//                toastr['error']('刪除契約條款失敗');
//            }
//        })
//        .error(function() {
//            toastr['error']('刪除契約條款失敗');
//        });

</script>
</html>
