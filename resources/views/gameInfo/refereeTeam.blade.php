@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">裁判團隊</h2>
                <p>裁判為賽場中的最大主審，他們會全神貫注在每一位選手身上，以確保選手的權益及賽事的公平</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('img/裁判/曾大宇.jpeg') }}" style="width:200px;">
                    <h2 class="mt-4"> 曾大宇 </h2>
                    <h5>競速裁判長</h5>
                    <small>中華民國滑輪溜冰協會-競速A級裁判</small><br>
                    <small>2019年全民運動會-競速裁判</small><br>
                    <small>2019年全國中等學校運動會-競速裁判</small><br>
                    <small>2018年全民運動會-競速裁判</small><br>
                    <small>2018年全國大專運動會-競速裁判</small><br>
                    <small>2017世界大學運動會試辦賽-裁判</small><br>
                    <small>2017世界大學運動會-計時裁判組組長105年全民運動會競速裁判</small><br>
                    <small>2017世界大學運動會試辦賽-裁判</small><br>
                    <small>2017世界大學運動會-計時裁判組組長2016年全民運動會競速裁判</small>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('img/裁判/杜澄文.png') }}" style="width:200px;">
                    <h2 class="mt-4"> 杜澄文 </h2>
                    <h5>速樁裁判長</h5>
                    <small>中華民國溜冰協會-自由式A級裁判</small><br>
                    <small>新竹市2019年市長盃滑輪溜冰錦標賽 裁判長</small><br>
                    <small>2016年全國會長盃自由式滑輪錦標賽裁判</small>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('img/裁判/裁判.png') }}" style="width:200px;">
                    <h2 class="mt-4">想成為裁判？</h2>
                    <h5>快點聯絡我們！</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
