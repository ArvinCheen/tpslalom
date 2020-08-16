<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>直排輪 | 自由式後台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="台灣直排輪競賽">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--begin::Web font -->

    <script src="{{ URL::asset('assets/app/js/webfont.js') }}" type="text/javascript"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ URL::asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/demo/demo2/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/custom/adminLogo.png') }}" />

    @yield('css')

    <style>
        body, h3 {
            font-family: Microsoft JhengHei;
        }

        .m-table.m-table--border-tpslalom, .m-table.m-table--border-tpslalom td, .m-table.m-table--border-tpslalom th {
            border-color: #dedede
        }
    </style>
</head>

<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<div class="m-grid m-grid--hor m-grid--root m-page">
    <header id="m_header" class="m-grid__item m-header " minimize="minimize" minimize-offset="200" minimize-mobile-offset="200">
        <div class="m-header__top">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="#" class="m-brand__logo-wrapper">
                                    <img alt="" src="https://cdn0.iconfinder.com/data/icons/halloween-49/48/bat-halloween-128.png" style="width:70px"/>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">


                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- END -->


                                <!-- begin::Responsive Header Menu Toggler-->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- end::Responsive Header Menu Toggler-->


                                <!-- begin::Topbar Toggler-->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>
                                <!--end::Topbar Toggler-->
                            </div>
                        </div>
                    </div>
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
{{--                                            <span class="m-topbar__welcome">Hello,&nbsp;</span>--}}
{{--                                            <span class="m-topbar__username">曾大宇</span>--}}
                                        </a>
                                    </li>
                                    <li class="m-nav__item m-topbar__user-profile ">
                                        <a href="{{ URL('admin/logout') }}" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-topbar__username"> Logout </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-header__bottom">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">

                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i>
                        </button>

                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                <li class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text"> 賽事 </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="#" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-diagram"></i>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text"> 107中正盃 </span>
													</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-" id="m_quicksearch"
                         m-quicksearch-mode="default">

                        <form class="m-header-search__form">
                            <div class="m-header-search__wrapper">
								<span class="m-header-search__icon-search" id="m_quicksearch_search">
									<i class="la la-search"></i>
								</span>
                                <span class="m-header-search__input-wrapper">
									<input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="搜尋選手..." id="m_quicksearch_input">
								</span>
                                <span class="m-header-search__icon-close" id="m_quicksearch_close">
									<i class="la la-remove"></i>
								</span>
                                <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
									<i class="la la-remove"></i>
								</span>
                            </div>
                        </form>

                        <div class="m-dropdown__wrapper">
                            <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    {{--搜尋動畫--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end::Header -->
    <!-- begin::Body -->

    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop 	m-container m-container--responsive m-container--xxl m-page__container m-body">
        <button class="m-aside-left-close m-aside-left-close--skin-light" id="m_aside_left_close_btn"><i class="la la-close"></i>
        </button>

        <div id="m_aside_left" class="m-grid__item m-aside-left ">
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="false" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text"> 操作類 </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/setting') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 比賽設定 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('admin/result') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 輸入成績 </span>
                        </a>
                    </li>
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/checkIn') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 檢錄 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/drawLots') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 出場序抽籤 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/grouping') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 場次編組 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text"> 資訊類 </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/doc/all') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 總冊 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/doc/schedules') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 賽呈表 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('admin/doc/groups') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 分組名冊 </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('admin/doc/teams') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 隊伍名冊 </span>
                        </a>
                    </li>
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/doc/players') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 選手名冊 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/doc/medals') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 獎牌數量 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/doc/checkBill') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 對帳單 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text"> 匯出類 </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('/admin/export/records') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 檢錄手寫單 </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('admin/export/result') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 賽後成績 </span>
                        </a>
                    </li>
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/export/groups') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 分組名冊 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-menu__item " aria-haspopup="true">--}}
{{--                        <a href="{{ URL('admin/export/teams') }}" class="m-menu__link ">--}}
{{--                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
{{--                                <span></span>--}}
{{--                            </i>--}}
{{--                            <span class="m-menu__link-text"> 隊伍名冊 </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('admin/export/playerNumber') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 選手號碼布列表 </span>
                        </a>
                    </li>

                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('/admin/export/花樁評分表') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 花樁評分表 </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('/admin/export/花樁總匯表') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 花樁總匯表 </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('/admin/export/花樁罰分紀錄') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 花樁罰分紀錄 </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ URL('/admin/export/花樁紀錄') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text"> 花樁紀錄 </span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/demo/demo2/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/app/js/layout-builder.js') }}" type="text/javascript"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if (session('success'))
    toastr.success('{{ session('success') }}');
    @endif
    @if (session('info'))
    toastr.info('{{ session('info') }}');
    @endif
    @if (session('warning'))
    toastr.warning('{{ session('warning') }}');
    @endif
    @if (session('error'))
    toastr.error('{{ session('error') }}');
    @endif
</script>
@yield('js')

</body>
</html>
