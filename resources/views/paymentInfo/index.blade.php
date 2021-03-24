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
                                    <a style="color:darkblue" href="https://docs.google.com/forms/d/e/1FAIpQLSdt75uY3cwyRBBdfaBSfGnXkcHFetCaMlYdjOpBxyMwTDywvQ/viewform">若完成匯款，請點此連結回報</a><br>
                                </div>
                            @endif

                            @if (env('GAME') == 12)
                                <div class="col-md-9">
                                    <p>付款資訊：700 中華郵政分局 0061-0041-9045-57 戶名：朱啟維</p>
                                </div>
                            @endif


                            @if (env('GAME') == 13)
                                <div class="col-md-9">
                                    <p>付款資訊：822 中國信託 8205-4024-5259 戶名：張潘垚</p>
                                </div>
                            @endif

                            <div class="col-md-3 text-right" style="padding-right:30px">Total：${{ $total }} 元</div>
                        @else
                            <div class="col-md-9">
                                目前無報名資料
                            </div>
                        @endif

                        @if (env('GAME') == 11)
                            <div class="col-md-12">
                                <a href="https://nksds.com/wp-content/uploads/2021/03/%E8%87%BA%E5%8C%97%E5%B8%82110%E5%B9%B4%E7%AC%AC%E4%B8%89%E5%8D%81%E5%85%AB%E5%B1%86%E9%9D%92%E5%B9%B4%E7%9B%83%E6%9A%A8%E5%85%AC%E7%9B%8A%E6%8D%90%E6%AC%BE%E6%B4%BB%E5%8B%95%E6%BA%9C%E5%86%B0%E9%8C%A6%E6%A8%99%E8%B3%BD%E8%87%AA%E7%94%B1%E5%BC%8F%E8%BC%AA%E6%BB%91%E7%AB%B6%E8%B3%BD%E8%A6%8F%E7%AB%A0.pdf" target="_brank">臺北市110年第三十八屆青年盃暨公益捐款活動溜冰錦標賽自由式輪滑競賽規章</a><br>
                            </div>
                        @endif

                        @if (env('GAME') == 12)
                            <div class="col-md-12">
                                <a href="{{ URL::asset('tmpdoc/2.pdf') }}" target="_brank">新竹市110年市長盃溜冰錦標賽 - 競賽章程(網路版本).pdf</a><br>
                                <a href="{{ URL::asset('tmpdoc/1.doc') }}" target="_brank">新竹市110年市長盃溜冰錦標賽 - 競賽章程(網路版本).doc</a>
                            </div>
                        @endif

                        @if (env('GAME') == 13)
                            <div class="col-md-12">
                                <!-- <p>付款資訊：822 中國信託 8205-4024-5259 戶名：張潘垚</p> -->
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
