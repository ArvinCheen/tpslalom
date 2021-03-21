<!DOCTYPE html>
<html lang="en">

<head>
    <html lang="{{ app()->getLocale() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>直排輪體育賽事</title>
    <link rel="icon" href="{{ URL::asset('front/logo.png') }}" sizes="32x32"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- 由後台提供的plugins調整bootstrap元素 Start -->
    <link href="{{ URL::asset('global/css/plugins.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- 由後台提供的plugins調整bootstrap元素 End -->

    <!-- 訊息通知 Start -->
    <link href="{{ URL::asset('global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- 訊息通知 End -->

    <link rel="stylesheet" href="{{ URL::asset('front/theme.css') }}"/>
    <style>
        .mh {
            min-height: 700px;
        }
    </style>
@yield('css')
<body>
<header id="header">
    <div class="container">
        <div class="navbar-backdrop">
            <div class="navbar">
                <div class="navbar-left">
                    <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                    <a href="{{ URL('') }}" class="logo mb-1">
                        {{--                        <img class="" src="{{ URL::asset('front/logo.png') }}" alt="直排輪競賽" style="">--}}
                    </a>
                    <nav class="nav">
                        <ul>
                            {{--                            <li>--}}
                            {{--                                <a href="{{ URL('') }}"> 首頁 </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li>--}}
                            {{--                                <a href="{{ URL('enroll') }}"> 報名 </a>--}}
                            {{--                            </li>--}}


                            {{--                            <li class="has-dropdown">--}}
                            {{--                                <a href="#">成績公告</a>--}}
                            {{--                                <ul>--}}
                                                                <li>
                                                                    <a href="{{ URL('search/result') }}">
                                                                        成績查詢 </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ URL('search/integral') }}"> 積分查詢 </a>
                                                                </li>
                            {{--                                </ul>--}}
                            {{--                            </li>--}}

                            {{--                            <li class="has-dropdown">--}}
                            {{--                                <a href="#">比賽資訊</a>--}}
                            {{--                                <ul>--}}
                            @if ($isOpenDocument)
                                <li>
                                    <a href="{{ URL('gameInfo/schedules') }}">賽程表</a>
                                </li>
                                <li>
                                    <a href="{{ URL('gameInfo/groups') }}"> 分組名冊 </a>
                                </li>
                                <li>
                                    <a href="{{ URL('gameInfo/teams') }}"> 隊伍名冊 </a>
                                </li>
                            @endif
                            {{--                            <li>--}}
                            {{--                                <a href="{{ URL('gameInfo/program') }}"> 線上秩序冊 </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li>--}}
                            {{--                                <a href="{{ URL('gameInfo/nationalRecord') }}"> 單足S形全國紀錄 </a>--}}
                            {{--                            </li>--}}
                            {{--                                    <li>--}}
                            {{--                                        <a href="{{ URL('gameInfo/getAppearance') }}"> 出場序名冊 </a>--}}
                            {{--                                    </li>--}}
                            {{--                                    <li>--}}
                            {{--                                        <a href="{{ URL('gameInfo/refereeTeam') }}"> 裁判團隊 </a>--}}
                            {{--                                    </li>--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}


                            {{--                            <li>--}}
                            {{--                                <a href="{{ URL('gameInfo/errata') }}"> 勘誤專區 </a>--}}
                            {{--                            </li>--}}
                            <li>
                                <a href="{{ URL('paymentInfo') }}"> 報名選手清單 </a>
                            </li>
                            <li class="float-right">
                                <a href="{{ route('account')}}"> 帳號資訊 </a>
                            </li>
                            {{--                            <li class="d-lg-none">--}}
                            {{--                                <a href="{{ URL('logout') }}"> 登出 </a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </nav>
                </div>
                {{--                全國暫時不走登入制，因為不在我們這註冊--}}
                {{--                <div class="nav navbar-right">--}}
                {{--                    <ul>--}}
                {{--                        <li class="d-none d-lg-block">--}}
                {{--                            <a href="{{ URL('account') }}"> 帳號 </a>--}}
                {{--                            @if (auth()->user())--}}
                {{--                                <a href="{{ URL('logout') }}"> 登出 </a>--}}
                {{--                            @else--}}
                {{--                                <a href="{{ URL('login') }}"> 登入 </a>--}}
                {{--                            @endif--}}
                {{--                            <a data-toggle="search"><i class="fa fa-search"></i></a>--}}
                {{--                        </li>--}}

                {{--                        <li class="d-lg-none">--}}
                {{--                            <a data-toggle="search" class="fa fa-search"></a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="navbar-search">
            <div class="container">
                <form action="" method="get" disabled="true">
                    <input type="text" name="playerName" class="form-control" placeholder="搜尋選手">
                    <i class="fa fa-times close"></i>
                </form>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h4 class="footer-title">賽事的初衷</h4>
                <p>能讓選手在場上展現自我技巧，在舞台上盡情地發光發熱。我們能給的不多，為了給選手一個專屬的舞台，對我來說，這比我的生死更重要。</p>
            </div>
        </div>
        <a href="https://yoyocharity.ebc.net.tw/" target="_blank"><img src="https://imgur.com/3uHTVfK.png" style="width:220px;border-radius:7px;"></a>
        <div class="footer-bottom">
            <div class="footer-social">
                {{--                <a href="https://www.facebook.com/tpersf/" target="_blank" data-toggle="tooltip" title="" data-original-title="facebook"><i class="fa fa-facebook"></i></a>--}}
                {{--                <a href="#https://www.youtube.com/user/AuthenticRollerblade" data-toggle="fbbuytooltip" title="" data-original-title="youtube"><i class="fa fa-youtube"></i></a>--}}
            </div>
            <p>Copyright © {{date ('Y')}} Sundog Copyright. All rights reserved.</p>

        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- 訊息通知 Start -->
<script src="{{ URL::asset('global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<!-- 訊息通知 End -->

@yield('js')

<script src="{{ URL::asset('front/theme.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
<script>

    /* 訊息通知 Start */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-bottom-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if (session('success'))
        toastr['success']('{{ session('success') }}');
    @endif
        @if (session('info'))
        toastr['info']('{{ session('info') }}');
    @endif
        @if (session('warning'))
        toastr['warning']('{{ session('warning') }}');
    @endif
        @if (session('error'))
        toastr['error']('{{ session('error') }}');
    @endif
    /* 訊息通知 End */
</script>
</body>
</html>
