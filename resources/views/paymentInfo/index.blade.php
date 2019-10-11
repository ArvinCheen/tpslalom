@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">繳費資訊</h2>
                <p>新竹第一信用合作社</p>
                <p>單位：東南分社　帳號：002-001-00006960</p>
                <p>戶名：新竹市體育會滑輪溜冰委員會</p>
                <p>未於期限內繳交則視作報名未完成，匯款後請填寫匯款回報資料表。</p>
            </div>
            <div class="row justify-content-center col-md-12">
                <div class="col-md-8  px-4">
                    @foreach ($paymentInfo as $payment)
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <h5> {{ $payment->name }} </h5>
                                <small> {{ $payment->item }} </small>
                            </div>
                            <div class="col-md-3 text-right" style="padding-right:30px">
                                <div class="mb-2">
                                    <span>${{ $payment->fee }} 元</span>
                                </div>
                                <div>
                                    <a class="small" href="{{ URL('enroll/edit/' . $payment->player_id) }}">
                                        修改報名
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="">
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 text-right" style="padding-right:30px">Total：${{ $total }} 元</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
