@extends('layout')

@section('css')

@endsection

@section('content')

    <section class="bg-image bg-image-sm" style="background-image: url('https://i.ytimg.com/vi/HNmc9meCa4w/maxresdefault.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card m-b-0">
                        <div class="card-block">
                            <form action="{{ URL('login') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group input-icon-left m-b-10">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="account" class="form-control" placeholder="帳號" autofocus>
                                </div>
                                <div class="form-group input-icon-left m-b-15">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" class="form-control" placeholder="密碼">
                                </div>

                        @if (env('GAME') == 11)
                            <div class="col-md-12">
                                <a href="https://nksds.com/wp-content/uploads/2021/03/%E8%87%BA%E5%8C%97%E5%B8%82110%E5%B9%B4%E7%AC%AC%E4%B8%89%E5%8D%81%E5%85%AB%E5%B1%86%E9%9D%92%E5%B9%B4%E7%9B%83%E6%9A%A8%E5%85%AC%E7%9B%8A%E6%8D%90%E6%AC%BE%E6%B4%BB%E5%8B%95%E6%BA%9C%E5%86%B0%E9%8C%A6%E6%A8%99%E8%B3%BD%E8%87%AA%E7%94%B1%E5%BC%8F%E8%BC%AA%E6%BB%91%E7%AB%B6%E8%B3%BD%E8%A6%8F%E7%AB%A0.pdf" target="_brank">賽事簡章</a><br>
                            </div>
                        @endif

                        @if (env('GAME') == 12)
                            <div class="col-md-12">
                                <a href="{{ URL::asset('tmpdoc/3.pdf') }}" target="_brank">賽事簡章</a><br>
                            </div>
                        @endif

                        @if (env('GAME') == 13)
                            <div class="col-md-12">
                                <!-- <p>付款資訊：822 中國信託 8205-4024-5259 戶名：張潘垚</p> -->
                            </div>
                        @endif
                                <button type="submit" class="btn btn-primary btn-block m-t-10"> 登入 </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
