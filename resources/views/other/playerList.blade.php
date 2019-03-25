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

            .input {
                width: 150px;
            }

            .top-button {
                display: inline-block;
            }

        </style>
    </head>
    <body>
        <div class="center-outside-div">
            @include ('titleButton')
        </div>
        <div class="center-outside-div" style="margin-top:50px;">
            @if(session('success'))
                <div class="alert alert-success">
                    <span> {{ session('success') }} </span>
                </div>
            @endif

            @if ($players->isEmpty())
                目前你的帳號下還沒有選手資料
            @endif
            @foreach($players as $player)
                <a href="{{ URL('editPlayer/' . $player->sn) }}">唯一識別碼：{{ $player->sn }} - {{ $player->name }}</a><br>
            @endforeach
        </div>
    </body>
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
