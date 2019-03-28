@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">註冊</h2>
            <p>註冊頁面</p>
        </div>
        <form action='{{ URL('register') }}' method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="mb-3">
                        <label>帳號</label>
                        <input type="text" class="form-control" name="account" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>密碼</label>
                        <input type="password" class="form-control" name="password" required >
                    </div>
                    <div class="mb-3">
                        <label>團隊名稱</label>
                        <input type="text" class="form-control" name="teamName" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>電話</label>
                        <input type="text" class="form-control" name="phone" maxlength="10" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>地址</label>
                        <input type="text" class="form-control" name="address" autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>信箱</label>
                        <input type="text" class="form-control" name="email" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>教練</label>
                        <input type="text" class="form-control" name="coach" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>領隊</label>
                        <input type="text" class="form-control" name="leader" autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label>經理</label>
                        <input type="text" class="form-control" name="management" autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <hr class="mb-3">
                        <button class="btn btn-primary btn-block" type="submit"> 註冊 </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
@endsection
