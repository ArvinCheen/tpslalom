@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
        <h2>{{ $gameInfo->complete_name }}</h2>
    </div>

        <p class="lead">宗旨：為推展青少年體育，落實體育向下紮根之政策，提倡正當休閒活動提升溜冰技術水準，特舉辦主委盃溜冰錦標賽，並作為中等以上學校運動成績優良學生升學輔導之依據。</p>
        <p class="lead">承辦單位：{{ $gameInfo->agency }}</p>
        <p class="lead">比賽地點：{{ $gameInfo->game_address }}</p>
        <p class="lead">報名日期：{{ $gameInfo->enroll_start_time }} ~ {{ $gameInfo->enroll_close_time }}</p>
        <p class="lead">勘誤日期：{{ $gameInfo->enroll_close_time }} ~ {{ $gameInfo->errata_close_time }}</p>
        <p class="lead">比賽日期：{{ $gameInfo->game_date}}</p>
{{--        <hr class="mb-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-sm-6 col-md-4">--}}
{{--                <div class="card card-lg h-100">--}}
{{--                    <div class="card-img">--}}
{{--                        <img src="{{ URL::asset('front/doubleS.jpg') }}" class="card-img-top" alt="Assassin's Creed Syndicate">--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <h4 class="card-title mb-3">--}}
{{--                            <a >前進雙足S型</a>--}}
{{--                        </h4>--}}
{{--                        <p class="card-text">前進雙足S型起跑距離為8米，擺放17個角椎，各角錐間距為(初級組：160公分、新人組以上皆為120公分)</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4">--}}
{{--                <div class="card card-lg h-100">--}}
{{--                    <div class="card-img">--}}
{{--                        <img src="{{ URL::asset('front/singleS.jpg') }}" class="card-img-top" alt="Assassin's Creed Syndicate">--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <h4 class="card-title mb-3">--}}
{{--                            <a >前進單足S型</a>--}}
{{--                        </h4>--}}
{{--                        <p class="card-text">前進單足S型起跑距離為12米，擺放20個角椎，各角錐間距為80公分</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4">--}}
{{--                <div class="card card-lg h-100">--}}
{{--                    <div class="card-img">--}}
{{--                        <img src="{{ URL::asset('front/cross.jpg') }}" class="card-img-top" alt="Assassin's Creed Syndicate">--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <h4 class="card-title mb-3">--}}
{{--                            <a >前進交叉型</a>--}}
{{--                        </h4>--}}
{{--                        <p class="card-text">前進交叉型起跑距離為8米，擺放17個角椎，各角錐間距為120公分</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <hr class="mb-4">
        <h4>競賽內容：</h4>
       <p> (1) 單足S形為二回合計時賽，二輪成績擇優排名。</p>
       <p> (2) 每踢倒、漏過一個樁加比賽0.2秒，失誤超過四個，則該次比賽失格，單足S形在抵達終點前任何地方浮足落地則該次比賽失格。</p>
       <p> (3) 前溜項目幼童、國小組選手需配戴安全帽。</p>
       <p> (4) 號碼布應別在選手背面明顯處。</p>
       <p> (5) 起跑線與輔助線為200x40cm的起跑框，選手至少要有一隻腳完全在這個區域內，不可碰觸前後線。</p>
       <p> (6) 速度過樁起跑指令為「各就各位」、「預備」、「嗶」聲，在決賽時，預備之後將不允許身體有任何的動作，否則將視為一個起跑違規。</p>
       <p> (7) 新人組選手使用之輪鞋，輪徑不可超過80mm(含)，違者得以取消資格，不得要求退還報名費。</p>
        <hr>
        <h4>注意事項</h4>
        <p>本賽會報名截止日翌日，不再接受任何補報名，請勿自誤。</p>
        <a href="{{ URL('enroll') }}" class="btn btn-primary btn-block"> 立即報名 </a>
        <hr>
        <h4 class="mt-3">比賽地點</h4>
        <iframe class="mb-5" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.82178386301!2d121.54560216540534!3d25.074028842838754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442abfe34b8743f%3A0xf6d1c502397e60c8!2z6L-O6aKo5rKz5r-x5YWs5ZyS5rqc5Yaw5aC0!5e0!3m2!1szh-TW!2stw!4v1522677075559" width="600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
@endsection

@section('js')

@endsection
