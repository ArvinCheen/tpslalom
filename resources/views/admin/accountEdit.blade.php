@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 修改帳號資料 </h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('account.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="accountId" value="{{ $account->id }}">
                    <div class="form-group">
                        <label for="usr">帳號</label>
                        <input type="text" class="form-control" name="account" value="{{ $account->account }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">mail</label>
                        <input type="text" class="form-control" name="email" value="{{ $account->email }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">團隊名稱</label>
                        <input type="text" class="form-control" name="team_name" value="{{ $account->team_name }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">聯絡電話</label>
                        <input type="text" class="form-control" name="phone" value="{{ $account->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">聯絡地址</label>
                        <input type="text" class="form-control" name="address" value="{{ $account->address }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">教練</label>
                        <input type="text" class="form-control" name="coach" value="{{ $account->coach }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">領隊</label>
                        <input type="text" class="form-control" name="leader" value="{{ $account->leader }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">經理</label>
                        <input type="text" class="form-control" name="manager" value="{{ $account->manager }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
    </script>
@endsection
