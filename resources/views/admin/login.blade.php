<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>直排輪 | 自由式後台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="台灣直排輪競賽">
    <meta name="description" content="Latest updates and statistic charts">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ URL::asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/custom/adminLogo.png') }}" />
    <style>

        body, h3 {
            font-family: Microsoft JhengHei;
        }
    </style>
</head>

<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<div class="m-grid m-grid--hor m-grid--root m-page">


    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{ URL::asset('assets/app/media/img/bg/bg-1.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="https://cdn0.iconfinder.com/data/icons/halloween-49/48/bat-halloween-128.png">
                    </a>
                </div>
                <div class="m-login__signin">
                    <form action="{{ URL('admin/login') }}" class="m-login__form m-form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="帳號" name="accountId" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="密碼" name="password">
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary"> 登入 </button>
                        </div>
                    </form>
                </div>

                <div class="m-login__account">
                    <p class="m-login__account-msg">
                        讓選手在場上展現自我技巧，在舞台上盡情地發光發熱。
                    </p>
                    <p class="m-login__account-msg">
                        臺北市體育總會滑輪溜冰協會自由式組
                    </p>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- end:: Page -->


<!--begin::Base Scripts -->
<script src="{{ URL::asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->


<!--begin::Page Snippets -->
{{--<script src="{{ URL::asset('assets/snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>--}}
<!--end::Page Snippets -->


</body>
</html>