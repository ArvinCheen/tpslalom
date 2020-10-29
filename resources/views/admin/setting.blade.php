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
                    <div class="form-group">
                        <label for="usr">賽事名稱</label>
                        <input type="text" class="form-control" name="completeName" value="{{ $gameInfo->complete_name }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">號函一</label>
                        <input type="text" class="form-control" name="letterOne" value="{{ explode(' ', $gameInfo->letter)[0] }}">
                    </div>
                    <div class="form-group">
                        <label for="usr">號函二（若無則審略）</label>
                        <input type="text" class="form-control" name="letterTwo" value="{{ isset(explode(' ', $gameInfo->letter)[1]) ? explode(' ', $gameInfo->letter)[1] : null }}">
                    </div>

                    <div class="form-group">
                        <label class="usr">報名開關</label>
                        <div class="">
                            <input data-switch="true" type="checkbox" name="is_open_enroll" {{ $gameInfo->is_open_enroll ? 'checked' : null }} />
                        </div>
                    </div>
`                    <hr>
                    <button type="submit" class="btn btn-primary">送出</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')


    <script>
    </script>
@endsection
