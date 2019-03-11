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
            }

            .top-button {
                display: inline-block;
            }

            td {
                text-align: center;
            }

        </style>
    </head>
    <body>
        <div class="center-outside-div">
            @include ('titleButton')
        </div>
        <div class="col-md-6" style="margin:25px auto;">

            <table class="col-md-3 table" align="center">
                <tr>
                    <td> 場次 </td>
                    <td> 級別 </td>
                    <td> 組別 </td>
                    <td> 性別 </td>
                    <td> 項目 </td>
                    <td> 人數 </td>
                </tr>

                @foreach($schedule as $val)
                    <tr>
                        <td> {{ $val->order }} </td>
                        <td> {{ $val->level }} </td>
                        <td> {{ $val->group }} </td>
                        <td> {{ $val->gender }} </td>
                        <td> {{ $val->item }} </td>
                        <td> {{ $val->number_of_player }} </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>

</script>
</html>
