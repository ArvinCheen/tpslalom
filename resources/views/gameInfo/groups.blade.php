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
                                    共 {{ count($group->players) }} 人
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <div class="collapse" id="{{ $key }}collapse">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead class="thead-inverse">
                                </thead>
                                <tbody>
{{--                                @foreach ($group->players as $player)--}}
{{--                                    @if ($player->player->name == '邱映瑄')--}}
{{--                                        <tr>--}}
{{--                                            <td class="" style="">--}}
{{--                                                邱映瑄 / 邱宇廷--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}

{{--                                    @if ($player->player->name == '劉祐呈')--}}
{{--                                        <tr>--}}
{{--                                            <td class="" style="">--}}
{{--                                                劉祐呈 / 劉哲呈--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}

{{--                                    @if ($player->player->name == '侯鈞諺')--}}
{{--                                        <tr>--}}
{{--                                            <td class="" style="">--}}
{{--                                                侯鈞諺 / 陳建廷--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    @else
                        <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                               aria-controls="{{ $key }}collapse">
                            <thead class="{{ $key % 2 ? 'thead-dark' : null }}">
                            <tr>
                                <th class="pl-3" style=" border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                    {{ $group->order }} {{ $group->game_type }} - {{ $group->group }}{{$group->gender }}子組 {{ $group->item }}
                                </th>
                                <th class="text-right pr-3" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                    @if($group->number_of_player == 0)
                                        共 ? 人
                                    @else
                                        共 {{ count($group->players) }} 人
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
                                @if($group->number_of_player == 0)
                                    <tr>
                                        <td class="" style="">
                                            PK賽採動態出場
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($group->players as $player)
                                        <tr>
                                            <td class="" style="">
                                                {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->agency }})
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
