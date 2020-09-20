@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 比賽設定 </h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('setting.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">承辦單位</label>--}}
{{--                        <input type="text" class="form-control" name="agency" value="{{ $gameInfo->agency }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">賽事簡稱</label>--}}
{{--                        <input type="text" class="form-control" name="abridge_name" value="{{ $gameInfo->abridge_name }}">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="usr">賽事名稱</label>
                        <input type="text" class="form-control" name="completeName" value="{{ $completeName }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">審略號函一</label>
                        <input type="text" class="form-control" name="letterOne" value="{{ $letterOne }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">號函二（若無則審略）</label>
                        <input type="text" class="form-control" name="letterTwo" value="{{ $letterTwo }}">
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">比賽地址</label>--}}
{{--                        <input type="text" class="form-control" name="game_address" value="{{ $gameInfo->game_address }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">比賽時間</label>--}}
{{--                        <input type="text" class="form-control" name="game_date" value="{{ $gameInfo->game_date }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">報名開始時間</label>--}}
{{--                        <input type="text" class="form-control" name="enroll_start_time" value="{{ $gameInfo->enroll_start_time }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">報名結束時間</label>--}}
{{--                        <input type="text" class="form-control" name="enroll_close_time" value="{{ $gameInfo->enroll_close_time }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="usr">勘誤結束時間</label>--}}
{{--                        <input type="text" class="form-control" name="errata_close_time" value="{{ $gameInfo->errata_close_time }}">--}}
{{--                    </div>--}}
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
