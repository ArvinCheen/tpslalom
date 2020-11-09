@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 隊伍名冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    @foreach($teams as $team)
                        <table class="table mb-0">
                            <tr>
{{--                                                                <td colspan="5" class="w-25"> 隊伍：{{ $team->agency }} - {{ count($team->players) }} 人參賽</td>--}}
{{--                                / 教練團：{{ $team->coach }}　{{ $team->leader }}　{{ $team->management }}--}}
                                <td colspan="5" class="w-25"> {{ $team->account->team_name }} - {{ count($team->players) }} 人參賽 / 教練：{{ $team->account->coach }}　/　領隊：{{ $team->account->leader }}　/　經理：{{ $team->account->management }}</td>
{{--                                <td colspan="5" class="w-25"> 教練：{{ $team->account->coach }}　/　領隊：{{ $team->account->leader }}　/　經理：{{ $team->account->management }}</td>--}}
                            </tr>
                        </table>

                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($team->players))
                                <tr>
                                    <td class="w-50">
                                        @if (isset($team->players[$i]))
                                            {{ is_null($team->players[$i]->player_number) ? '未抽籤' : $team->players[$i]->player_number }}
                                            {{ $team->players[$i]->player->name }}
                                        @endif
                                    </td>
                                    <td class="w-50">
                                        @if (isset($team->players[$i + 1]))
                                            {{ is_null($team->players[$i + 1]->player_number) ? '未抽籤' : $team->players[$i + 1]->player_number }}
                                            {{ $team->players[$i + 1]->player->name }}
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 2
                                @endphp
                            @endwhile
                            </tbody>
                        </table>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
