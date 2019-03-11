@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">帳號資訊</h2>
            <p> 王道銀行營業部 代碼048 </p>
            <p> 帳號0100-0051-327-588 曾大宇 </p>
            <p> 匯款完成後請到「<a href="https://docs.google.com/forms/d/e/1FAIpQLSdt75uY3cwyRBBdfaBSfGnXkcHFetCaMlYdjOpBxyMwTDywvQ/viewform" target="_blank">這裡</a>」填寫匯款資料 </p>
        </div>

        <form action='{{ URL('account/update') }}' method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="accountSn" value="{{ $account->accountSn }}"/>
            <div class="row">
                <div class="col-md-8 mb-5">
                    <h4 class="mb-3">帳號資訊</h4>
                    <div class="mb-3">
                        <label>帳號</label>
                        <input type="text" class="form-control" name="teamName" placeholder='' value="{{ $account->accountId }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label>團隊名稱</label>
                        <input type="text" class="form-control" name="teamName" placeholder='' value="{{ $account->teamName }}" required>
                    </div>
                    <div class="mb-3">
                        <label>電話</label>
                        <input type="text" class="form-control" name="phone" placeholder='' value="{{ $account->phone }}" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label>地址</label>
                        <input type="text" class="form-control" name="address" placeholder='' value="{{ $account->address }}">
                    </div>
                    <div class="mb-3">
                        <label>信箱</label>
                        <input type="text" class="form-control" name="email" placeholder='' value="{{ $account->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label>教練</label>
                        <input type="text" class="form-control" name="coach" placeholder='' value="{{ $account->coach }}" required>
                    </div>
                    <div class="mb-3">
                        <label>領隊</label>
                        <input type="text" class="form-control" name="leader" placeholder='' value="{{ $account->leader }}" >
                    </div>
                    <div class="mb-3">
                        <label>經理</label>
                        <input type="text" class="form-control" name="management" placeholder='' value="{{ $account->management }}" >
                    </div>
                    <div class="mb-3">
                        <hr class="mb-3">
                        <button class="btn btn-primary btn-block" type="submit"> 修改 </button>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">選手名冊</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($players as $val)
                            <li class="list-group-item mb-3">
                                <div>
                                    <h6> {{ $val->name }} <small> - No.{{ $val->playerSn }}</small></h6>
                                    <small> {{ $val->gender }} / {{ $val->city }} / {{ $val->agency }} </small>
                                </div>
                            </li>
                        @endforeach
                        @if ($players->isEmpty())
                            <li class="list-group-item mb-3">
                                <div>
                                    <h6> 目前您底下無選手資料 </h6>
                                    <a href="{{ URL('enroll') }}" ><small> 請前往報名頁面新增選手 </small></a>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
@endsection