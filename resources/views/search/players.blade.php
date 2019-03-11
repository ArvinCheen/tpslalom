@extends('layout')

@section('css')

@endsection

@section('content')
<div class="mh mb-5">
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h2 class="mb-3">選手資料</h2>
            @if ($players->isEmpty())
                <p>無選手資料</p>
            @else
                <p>以下資料為選手過去比賽歷史資訊</p>
            @endif
        </div>
        <div class="row justify-content-center col-md-12">
            <div class="col-md-8 px-4">
                @foreach ($players as $player)
                    <div class="row mt-3">
                        <div class="col-md-9">
                            <h5> {{ $player->name }} <small> {{ $player->teamName }}</small></h5>
                            @foreach ($player->results as $result)
                            <div>
                                <small> {{ $result->abridgeName }} - {{ $result->item }} / {{ $result->level }} / {{ $result->group }} / 成績：{{ $result->finalResult }} / 名次：{{ $result->rank }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr class="">
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
