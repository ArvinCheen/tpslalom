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
                                    <input type="text" name="account" class="form-control" placeholder="帳號">
                                </div>
                                <div class="form-group input-icon-left m-b-15">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" class="form-control" placeholder="密碼">
                                </div>
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
