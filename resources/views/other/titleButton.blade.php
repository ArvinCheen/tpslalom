<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">107青年盃賽事系統</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="{{ URL('enroll') }}"> 報名 </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ URL('enroll/edit') }}"> 修改報名 </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ URL('account') }}"> 帳號資訊 </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ URL('paymentInfo') }}"> 繳費資訊 </a>
            </li>
            {{--<li class="nav-item {{ $active == '成績查詢' ? 'active' : '' }}">--}}
                {{--<a class="nav-link" href="{{ URL('searchResult/場次1') }}"> 成績查詢 </a>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ $active == '積分查詢' ? 'active' : '' }}">--}}
                {{--<a class="nav-link" href="{{ URL('searchIntegral') }}"> 積分查詢 </a>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ $active == '賽程表' ? 'active' : '' }}">--}}
                {{--<a class="nav-link" href="{{  URL('schedule/2') }}"> 賽程表 </a>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ $active == '分組名冊' ? 'active' : '' }}">--}}
                {{--<a class="nav-link" href="{{ URL('playerRegister') }}"> 分組名冊 </a>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ $active == '團隊名冊' ? 'active' : '' }}">--}}
                {{--<a class="nav-link" href="{{ URL('teamRegister') }}"> 團隊名冊 </a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{ URL('logout') }}"> 登出 </a>
            </li>
        </ul>
    </div>
</nav>