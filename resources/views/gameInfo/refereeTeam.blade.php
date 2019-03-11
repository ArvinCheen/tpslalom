@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">裁判團隊</h2>
                <p>來自臺北市體育總會滑輪溜冰協會－自由式組最優秀的裁判團隊</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/高林達.jpg') }}" style="width:200px;">
                    <h2 class="mt-4"> 高林達 </h2>
                    <h5>裁判長</h5>
                    <small>中華民國滑輪溜冰協會自由式輪滑委員會副總幹事</small><br>
                    <small>中華民國滑輪溜冰協會 A 級裁判</small>


                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/林建妤.jpg') }}" style="width:200px;">
                    <h2 class="mt-4"> 林建妤 </h2>
                    <h5>裁判</h5>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/孫麗晴.jpg') }}" style="width:200px;">
                    <h2 class="mt-4"> 孫麗晴 </h2>
                    <h5>裁判</h5>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/楊翔宇.jpg') }}" style="width:200px;">
                    <h2 class="mt-4"> 楊翔宇 </h2>
                    <h5>裁判</h5>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/謝牧倫.jpg') }}" style="width:200px;">
                    <h2 class="mt-4"> 謝牧倫 </h2>
                    <h5>裁判</h5>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="{{ URL::asset('front/team/鍾逸凱.jpg') }}" style="width:200px;">
                    <h2 class="mt-4">鍾逸凱</h2>
                    <h5>裁判</h5>
                </div>
                <div class="col-md-4 mb-5 text-center">
                    <img class="rounded-circle border" src="https://cdn3.iconfinder.com/data/icons/internet-and-web-4/78/internt_web_technology-13-256.png" style="width:200px;">
                    <h2 class="mt-4">想成為裁判？</h2>
                    <h5>快聯絡我們</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection