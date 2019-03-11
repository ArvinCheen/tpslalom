<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
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
                color: #636b6f;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .input-div {
                margin: 8px;
            }

            .submit-div {
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    註冊帳號
                </div>

                @if(session('error'))
                    <div>
                        <span class="text-danger"> {{ session('error') }} </span>
                    </div>
                @endif
                <form action="{{ URL('register') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-div">
                        <input type="text" name="accountId" placeholder="帳號" value="{{ old('accountId') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="password" name="passwordOne" placeholder="密碼" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="password" name="passwordTwo" placeholder="請請再輸入一次密碼" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="email" placeholder="電子信箱（必填）" value="{{ old('email') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="teamName" placeholder="團隊名稱（必填）" value="{{ old('teamName') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="phone" placeholder="聯絡電話（必填）" value="{{ old('phone') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="coach" placeholder="教練姓名（必填）" value="{{ old('coach') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="leader" placeholder="領隊姓名" value="{{ old('leader') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="management" placeholder="經理姓名" value="{{ old('management') }}" autocomplete="off">
                    </div>
                    <div class="input-div">
                        <input type="text" name="address" placeholder="地址" value="{{ old('address') }}" autocomplete="off">
                    </div>
                    <div class="submit-div">
                        <input type="submit" class="btn btn-primary" value="註冊" style="width:180px;">
                    </div>
                    <div class="submit-div">
                        <a href="{{ URL('login') }}" class="btn btn-primary" style="width:180px;">回登入頁</a>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>
