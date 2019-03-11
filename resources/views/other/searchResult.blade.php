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
        <div class="center-outside-div" style="margin-top:10px;">
            <select id="schedule-list">
                @foreach ($scheduleList as $val)
                    <option value="{{ $val->order }}" {{ $order == $val->order ? 'selected' : '' }}>{{ $val->order }} 【{{ $val->level }}】 {{ $val->group }}{{ $val->gender }} {{ $val->item }} </option>
                @endforeach
            </select>

        </div>

        @if ($enrollDataTaipei->isEmpty() && $enrollDataOtherCity->isEmpty())
            <br>
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title"> 尚未完賽 </h4>
                    <p class="card-text"> 比賽正在進行或是電腦正在計算成績中…請稍後 </p>
                </div>
            </div>
        @else
            <table class="table" style="margin-top:10px;">
                <thead class="thead-inverse">
                <tr>
                    <th colspan="9"> 台北市 </th>
                </tr>
                <tr>
                    <th> 名次 </th>
                    <th> 編號 </th>
                    <th> 選手 </th>
                    <th> 一回 </th>
                    <th> 誤椿 </th>
                    <th> 二回 </th>
                    <th> 誤椿 </th>
                    <th> 成績 </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($enrollDataTaipei as $val)
                    <tr>
                        <th> {{ $val->rank }}</th>
                        <td> {{ $val->playerNumber }}</td>
                        <td> {{ $val->name }} </td>
                        <td> {{ $val->roundOneSecond }} </td>
                        <td> {{ $val->roundOneMissConr }} </td>
                        <td> {{ $val->roundTwoSecond }} </td>
                        <td> {{ $val->roundTwoMissConr }} </td>
                        <td> {{ $val->finalResult }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table" style="margin-top:70px;">
                <thead class="thead-inverse">
                <tr>
                    <th colspan="9"> 外縣市 </th>
                </tr>
                <tr>
                    <th> 名次 </th>
                    <th> 編號 </th>
                    <th> 選手 </th>
                    <th> 一回 </th>
                    <th> 誤椿 </th>
                    <th> 二回 </th>
                    <th> 誤椿 </th>
                    <th> 成績 </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($enrollDataOtherCity as $val)
                    <tr>
                        <th> {{ $val->rank }}</th>
                        <td> {{ $val->playerNumber }}</td>
                        <td> {{ $val->name }} </td>
                        <td> {{ $val->roundOneSecond }} </td>
                        <td> {{ $val->roundOneMissConr }} </td>
                        <td> {{ $val->roundTwoSecond }} </td>
                        <td> {{ $val->roundTwoMissConr }} </td>
                        <td> {{ $val->finalResult }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>
    $("#schedule-list").change(function() {
        document.location.href="{{ URL('searchResult/') }}" + "/" + $(this).val();
    });
</script>
</html>
