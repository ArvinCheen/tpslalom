@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">團隊名冊</h2>
                <p>點擊團隊可展開</p>
                <p>由於本次參賽人數關係，載入時請耐心等後</p>
            </div>
            <div class="col-md-12">

                @foreach($teams as $key => $team)
                    <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                           aria-controls="{{ $key }}collapse">
                        <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                        <tr>
                            <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                {{ $team->players[0]->player->agency }} <small>教練：{{ $team->account->coach }} / 領隊：{{ $team->account->leader }} / 經理：{{ $team->account->management }}</small>
                            </th>
                            <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                共 {{ count($team->players) }} 位選手
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="collapse" id="{{ $key }}collapse">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead class="thead-inverse">

                            </thead>
                            <tbody>
                            @foreach ($team->players as $player)
                                <tr>
                                    <td class="" style="">
                                        {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency_all }})
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--                    <table class="col-md-3 table mb-4" align="center">--}}
                    {{--                        <tbody>--}}
{{--                    <tr>--}}
{{--                        <td colspan="3"> {{ $team->account->team_name }} </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td colspan="3"> 教練：{{ $team->account->coach }} </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td colspan="3"> 領隊：{{ $team->account->leader }} </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td colspan="3"> 經理：{{ $team->account->management }} </td>--}}
{{--                    </tr>--}}


                    {{--                        @foreach ($team->players as $player)--}}
                    {{--                            <tr>--}}
                    {{--                                <td class="" style="border:1px solid">--}}
                    {{--                                    {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency }})--}}
                    {{--                                </td>--}}
                    {{--                            </tr>--}}
                    {{--                        @endforeach--}}
                    {{--                        </tbody>--}}
                    {{--                    </table>--}}
                    {{--                    <br>--}}
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
