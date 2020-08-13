@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 分組名冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    @foreach($groups as $group)
                        <table class="table mb-0">
                            <tr>
                                <td>{{ $group->order }} </td>
                                <td class="text-center">({{ $group->game_type }}) {{ $group->group }} {{ $group->gender }}子組 {{ $group->item }}</td>
                                <td class="text-right">共 {{ count($group->players) }} 人</td>
                            </tr>
                        </table>
                        @if($group->group.$group->gender.$group->item.$group->game_type == '青年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '青年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '成年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||

                                    $group->group.$group->gender.$group->item.$group->game_type == '國中男速度過樁選手菁英-前溜單足S形決賽' ||
                                    $group->group.$group->gender.$group->item.$group->game_type == '國中女速度過樁選手菁英-前溜單足S形決賽')
                            <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tr>
                                <td class="w-20">
                                    無（預賽動態取{{ $group->number_of_player }}強）
                                </td>
                            </tr>
                            </table>
                        @else
                            <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                                @php
                                    $i = 0;
                                @endphp
                                @while($i < count($group->players))
                                    <tr>
                                        <td class="w-20">
                                            @if (isset($group->players[$i]))
                                                {{ $group->players[$i]->player_number }} {{ $group->players[$i]->name }} ({{ $group->players[$i]->agency_all }})
                                            @endif
                                        </td>
                                        <td class="w-20">
                                            @if (isset($group->players[$i + 1]))
                                                {{ $group->players[$i + 1]->player_number }} {{ $group->players[$i + 1]->name }} ({{ $group->players[$i + 1]->agency_all }})
                                            @endif
                                        </td>
                                        <td class="w-20">
                                            @if (isset($group->players[$i + 2]))
                                                {{ $group->players[$i + 2]->player_number }} {{ $group->players[$i + 2]->name }} ({{ $group->players[$i + 2]->agency_all }})
                                            @endif
                                        </td>
                                        <td class="w-20">
                                            @if (isset($group->players[$i + 3]))
                                                {{ $group->players[$i + 3]->player_number }} {{ $group->players[$i + 3]->name }} ({{ $group->players[$i + 3]->agency_all }})
                                            @endif
                                        </td>
                                        <td class="w-20">
                                            @if (isset($group->players[$i + 4]))
                                                {{ $group->players[$i + 4]->player_number }} {{ $group->players[$i + 4]->name }} ({{ $group->players[$i + 4]->agency_all }})
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $i += 5
                                    @endphp
                                @endwhile
                            </table>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
