@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">分組名冊</h2>
                <p>點擊場次可展開</p>
                <p>由於本次參賽人數關係，載入時請耐心等後</p>
            </div>
            <div class="col-md-12">
                @foreach($groups as $key => $group)
                    @if ($group->item == '雙人花式繞樁')
                        <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                               aria-controls="{{ $key }}collapse">
                            <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                            <tr>
                                <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                    {{ $group->order }} （{{ $group->game_type }}）- {{ $group->group }} {{ $group->item }}
                                </th>
                                <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                    共 {{ $group->number_of_player }} 人
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <div class="collapse" id="{{ $key }}collapse">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead class="thead-inverse">
                                </thead>
                                <tbody>

                                @foreach ($group->players as $player)
                                    @if ($player->player->name == '邱映瑄')
                                        <tr>
                                            <td class="" style="">
                                                164 邱映瑄 / 362 邱宇廷
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($player->player->name == '范予僖')
                                        <tr>
                                            <td class="" style="">
                                                001 范予僖 / 193 黃淇宣
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                               aria-controls="{{ $key }}collapse">
                            <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                            <tr>
                                <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                    {{ $group->order }} （{{ $group->game_type }}）- {{ $group->group }}{{$group->gender }}子組 {{ $group->item }}
                                </th>
                                <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                    @if(
                                    $group->group.$group->gender.$group->item.$group->game_type == '青年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '青年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國小六年級男速度過樁選手菁英-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國中男速度過樁選手菁英-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國中女速度過樁選手菁英-前溜單足S形決賽'
                                    )
                                        共 ? 人
                                    @else
                                        共 {{ $group->number_of_player }} 人
                                    @endif
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <div class="collapse" id="{{ $key }}collapse">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead class="thead-inverse">
                                </thead>
                                <tbody>
                                @if(
                                    $group->group.$group->gender.$group->item.$group->game_type == '青年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '青年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國小六年級男速度過樁選手菁英-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國中男速度過樁選手菁英-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國中女速度過樁選手菁英-前溜單足S形決賽'
)
                                    <tr>
                                        <td class="" style="">
                                            PK賽採動態出場
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($group->players as $player)
                                        <tr>
                                            <td class="" style="">
                                                {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->agency_all }})
                                            </td>
                                        </tr>
                                    @endforeach
                                                                @endif

                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
