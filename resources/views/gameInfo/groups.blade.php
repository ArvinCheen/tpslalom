@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2 class="mb-3">分組名冊暨出場序</h2>
                <p>點擊場次可展開</p>
                <p>由於本次參賽人數關係，載入時請耐心等後</p>
            </div>
            <div class="col-md-12" mt-3">
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

                            <tr>
                                <td class="" style="">
                                    0737 謝牧倫 / 0745 周柏崴
                                </td>
                            </tr>
                            <tr>
                                <td class="" style="">
                                    0002 范予僖 / 0449 黃淇宣
                                </td>
                            </tr>
                            <tr>
                                <td class="" style="">
                                    0798 邱宇廷 / 0394 邱映瑄
                                </td>
                            </tr>
                            <tr>
                                <td class="" style="">
                                    0744 范子聿 / 0797 游瑋筑
                                </td>
                            </tr>
                            <tr>
                                <td class="" style="">
                                    0781 侯鈞諺 / 0796 陳建廷
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @else

                    <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                           aria-controls="{{ $key }}collapse">
                        <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                        <tr>
                            <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                {{ $group->order }} （{{ $group->game_type }}）- {{ $group->group }} {{ $group->item }}
                            </th>
                            <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                @if($group->game_type.$group->group.$group->item == '決賽國中速度過樁菁英組-前溜單足S形(男)' || $group->game_type.$group->group.$group->item == '決賽國中速度過樁菁英組-前溜單足S形(女)' || $group->game_type.$group->group.$group->item == '決賽高中速度過樁菁英組-前溜單足S形(男)')
                                    共 0 人
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
                            @if($group->game_type.$group->group.$group->item == '決賽國中速度過樁菁英組-前溜單足S形(男)' || $group->game_type.$group->group.$group->item == '決賽國中速度過樁菁英組-前溜單足S形(女)' || $group->game_type.$group->group.$group->item == '決賽高中速度過樁菁英組-前溜單足S形(男)')
                                <tr>
                                    <td class="" style="">
                                        無
                                    </td>
                                </tr>
                            @else
                                @foreach ($group->players as $player)
                                    <tr>
                                        <td class="" style="">
                                            {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency }})
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
