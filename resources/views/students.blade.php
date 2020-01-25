<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <form action="{{ route('students.add') }}" method="POST">
                {{ csrf_field() }}
                新增學生姓名：<input type="text" name="name">
                <button type="submit" class="btn btn-primary"> 新增 </button>
            </form>
        </div>
        <div>
            <table>

                <tr>
                    <td> 掃描號碼 </td>
                    <td> 學生 </td>
                </tr>
                @foreach ($students as $student)
                    <tr>
                        <td> {{ $student->id }} </td>
                        <td> {{ $student->name }} </td>
                    </tr>
                @endforeach
            </table>
        </div>
    <a href="{{ route('index') }}">回首頁</a>
    </body>
</html>
