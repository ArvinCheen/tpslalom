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

            table {
                border-collapse: collapse;
                background: #B2EBF2;
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
        <div class="" style="margin-top:25px;">
            @if(session('success'))
                <div class="alert alert-success" style="text-align: center;">
                    <span> {{ session('success') }} </span>
                </div>
            @endif

            <table class="col-md-8 " align="center">
                <tr>
                    <td> 號碼 </td>
                    <td> 名稱 </td>
                    <td> 單位 </td>
                    <td> 性別 </td>
                    <td> 組別 </td>
                    <td> 賽參項目 </td>
                    <td> 金額 </td>
                </tr>

                @foreach ($enrollPlayer as $val)
                <tr>
                    <td> {{ $val->player_number }} </td>
                    <td> {{ $val->name }} </td>
                    <td> {{ $val->agency }} </td>
                    <td> {{ $val->gender }} </td>
                    <td> {{ $val->group }} </td>
                    <td>
                        @foreach($val->enrollItem as $itemInfo)
                            {{ $itemInfo->item }},
                        @endforeach
                    </td>
                    <td> {{ $val->fee }} </td>
                </tr>
                @endforeach
            </table>
            <hr>
        </div>

        <div class="center-outside-div">
            <b>總費用：{{ $registryFeeTotal }} 元</b>
            <br>
            <b>繳費資訊</b>
            <br>
        </div>
    </body>

    <form id="deleteEnrollForm" action="{{ URL('deleteEnroll') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" id="enrollSn" name="enrollSn">
        <input type="hidden" id="playerSn" name="playerSn">
    </form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>

    function deleteEnroll(enrollSn, playerSn) {
        $("#enrollSn").val(enrollSn);
        $("#playerSn").val(playerSn);
        $("#deleteEnrollForm").submit();
    }
</script>
</html>
