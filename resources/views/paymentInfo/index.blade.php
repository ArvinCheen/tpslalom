@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-4 text-center">
                <h2 class="mb-3">109北市中正盃</h2>
                <a style="color:orange" href="https://docs.google.com/forms/d/e/1FAIpQLSdt75uY3cwyRBBdfaBSfGnXkcHFetCaMlYdjOpBxyMwTDywvQ/viewform">若完成匯款，請點此連結回報</a>
            </div>

            <div class="row justify-content-center col-md-12">
                <div class="col-md-8">
                    <a class="btn btn-primary col-md-12" href="{{ URL('enroll') }}">申請比賽項目</a>
                </div>

                <div class="col-md-8 px-4">
                    <h3 class="mt-4 mb-4 ">報名選手清單</h3>
                    @foreach ($paymentInfo as $payment)
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <h5> {{ $payment->name }} {{ $payment->group }} {{ $payment->gender }}</h5>
                                <small> {{ $payment->item }} </small>
                            </div>
                            <div class="col-md-3 text-right" style="padding-right:30px">
                                <div class="mb-2">
                                    <span>${{ $payment->fee }} 元</span>
                                </div>
                                <div>
                                    <a class="small" href="{{ URL('enroll/' . $payment->player_id) }}">
                                        修改報名
                                    </a>

                                    <a class="small" href="#" onclick="cancelEnroll({{$payment->player_id}})">
                                        取消報名
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="">
                    @endforeach
                    <div class="row mt-3">
                        @if ($total)
                            <div class="col-md-9">
                                付款資訊：048 王道銀行營業部 0100-0051-3275-88 戶名：曾大宇
                            </div>
                            <div class="col-md-3 text-right" style="padding-right:30px">Total：${{ $total }} 元</div>
                            @else
                            <div class="col-md-9">
                                目前無報名資料
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="cancelForm" action="{{ URL('enroll/cancel') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" id="playerId" name="playerId"/>
    </form>
@endsection

@section('js')
    <script>
        function cancelEnroll(playerId) {
            $("#playerId").val(playerId);
            $('#cancelForm').submit();
        }
    </script>
@endsection
