@extends('layout')

@section('css')

@endsection

@section('content')
    {{--<section class="bg-image bg-image-sm" style="background-image: url({{ URL::asset('front/comingSoon.jpg') }});">--}}
        {{--<div class="overlay"></div>--}}
        {{--<div class="coming-soon p-y-80">--}}
            {{--<div>--}}
                {{--<h2> 即將開放！ </h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">積分查詢</h2>
                <p>點擊積分可展開</p>
            </div>
            <div class="col-md-12 mt-3">
                @foreach ($integrals as $key => $integral)
                    <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false" aria-controls="{{ $key }}collapse">
                        <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                        <tr>
                            <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                @if ($key < 3)
                                    第 {{ $key + 1 }} 名：
                                @endif
                                {{ $integral->team_name }}
                            </th>
                            <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                總分：{{ $integral->integralTotal }}分
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="collapse" id="{{ $key }}collapse">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead class="thead-inverse">
                            </thead>
                            <tbody>
                            <tr>
                                <th class="text-center"> 編號 </th>
                                <th class="text-center"> 選手 </th>
                                <th> 項目 </th>
                                <th class="text-center"> 積分 </th>
                            </tr>
                            @foreach ($integral->players as $player)
                                <tr>
                                    <th class="text-center"> {{ $player->player_number }} </th>
                                    <th class="text-center"> {{ $player->name }} </th>
                                    <td> {{ "{$player->level} {$player->group} {$player->gender}子組 {$player->item} 第 {$player->rank} 名" }} </td>
                                    <td class="text-center"> {{ $player->integral }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
