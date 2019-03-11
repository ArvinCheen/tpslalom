@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">繳費資訊</h2>
            <p> 報名費請於報名截止日前匯款至 </p>
            <p> 瑞興商業銀行 長安分行 </p>
            <p> 帳號007-521-160-7330 台北市體育總會滑輪溜冰協會張進坤 </p>
            {{--<p> 匯款完成後請到「<a href="https://docs.google.com/forms/d/e/1FAIpQLSdt75uY3cwyRBBdfaBSfGnXkcHFetCaMlYdjOpBxyMwTDywvQ/viewform" target="_blank">這裡</a>」填寫匯款資料 </p>--}}
        </div>
        <div class="row justify-content-center col-md-12">
            <div class="col-md-8  px-4">
                @foreach ($cart as $val)
                    <div class="row mt-3">
                        <div class="col-md-9">
                            <h5> {{ $val->name }} </h5>
                            <small> {{ $val->item }} </small>
                        </div>
                        <div class="col-md-3 text-right" style="padding-right:30px">
                            <div class="mb-2">
                                <span>${{ $val->fee }} 元</span>
                            </div>
                            <div>
                                <a class="small" href="{{ URL('enroll/edit/' . $val->playerSn) }}">
                                    修改報名
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="">
                @endforeach
                <div class="row mt-3">
                    <div class="col-md-9">

                    </div>
                    <div class="col-md-3 text-right" style="padding-right:30px">Total：${{ $total }} 元</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
