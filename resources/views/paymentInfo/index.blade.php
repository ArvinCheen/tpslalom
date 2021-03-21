@extends('layout')

@section('css')

@endsection

@section('content')
    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-4 text-center">
                <h2 class="mb-3">{{ $gameInfo->complete_name }}</h2>
            </div>

            <div class="row justify-content-center col-md-12">
                <div class="col-md-8">
                    @if ($isOpenEnroll)
                        <a class="btn btn-primary col-md-12" href="{{ URL('enroll') }}">申請比賽項目</a>
                    @else
                        <a class="btn btn-default col-md-12">報名時間已結束</a>
                    @endif

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

                                    @if ($isOpenEnroll)
                                        <a class="small" href="{{ URL('enroll/' . $payment->player_id) }}">
                                            修改報名
                                        </a>
                                        <a class="small" href="#" onclick="cancelEnroll({{$payment->player_id}})">
                                            取消報名
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="">
                    @endforeach
                    <div class="row mt-3">
                        @if ($total)
                            @if (env('GAME') == 11)
                                <div class="col-md-9">
                                    <p>付款資訊：048 王道銀行營業部 0100-0051-3275-88 戶名：曾大宇</p>
                                    <a style="color:darkblue" href="https://docs.google.com/forms/d/e/1FAIpQLSdt75uY3cwyRBBdfaBSfGnXkcHFetCaMlYdjOpBxyMwTDywvQ/viewform">若完成匯款，請點此連結回報</a>
                                </div>
                            @endif

                            @if (env('GAME') == 12)
                                <div class="col-md-9">
                                    <p>付款資訊：700 中華郵政分局 0061-0041-9045-57 戶名：朱啟維</p>
                                </div>
                            @endif


                            @if (env('GAME') == 13)
                                <div class="col-md-9">
                                    <p>付款資訊：700 中華郵政分局 0061-0041-9045-57 戶名：朱啟維</p>
                                </div>
                            @endif

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
