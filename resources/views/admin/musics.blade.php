@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 套路音樂下載 </h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                @foreach ($musics as $music)

                    <a href="{{route('musics.download',['filename'=>$music->sound])}}">
                        {{ $music->sound }}　
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
