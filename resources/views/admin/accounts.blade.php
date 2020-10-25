@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 帳號修改 </h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                @foreach ($accounts as $account)
                    <a href="{{route('account.edit',['accountId'=>$account->id])}}">
                        {{ $account->account }}　
                        {{ $account->email }}　
                        {{ $account->team_name }}　
                        {{ $account->phone }}　
                        {{ $account->address }}　
                        {{ $account->coach }}　
                        {{ $account->leader }}　
                        {{ $account->manager }}　
                    </a>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
    </script>
@endsection
