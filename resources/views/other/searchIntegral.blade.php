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
<br>
@foreach ($integralData as $key => $val)
    <table class="table" style="margin-top:-19px; cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false" aria-controls="{{ $key }}collapse">
        <thead class="{{ $key % 2 ? '' : 'thead-inverse' }}">
        <tr >
            <th>
                @if ($key < 3)
                    第{{ $key + 1 }}名
                @endif
                {{ $val->team_name }}
            </th>
            <th style="text-align:right">
                總分：{{ $val->integralTotal }}分
            </th>
        </tr>
        </thead>
    </table>
    <div class="collapse" id="{{ $key }}collapse">
        <table class="table" style="margin-top:-16px;">
            <thead class="thead-inverse">
            </thead>
            <tbody>
            <tr>
                <th scope="col"> 編號 </th>
                <th scope="col"> 選手 </th>
                <th scope="col"> 項目 </th>
                <th scope="col"> 積分 </th>
            </tr>
            @foreach ($val->playerData as $player)
                <tr>
                    <th> {{ $player->player_number }} </th>
                    <th> {{ $player->name }} </th>
                    <td> {{ $player->level . $player->group . $player->gender . '子組' }} </td>
                    <td> {{ $player->integral }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--<hr>--}}
@endforeach
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
