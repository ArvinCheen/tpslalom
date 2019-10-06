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
                                <td class="w-25"> {{ $team->account->team_name }} - {{ count($team->players) }}人參賽 </td>
                                <td class="w-50"> 教練：{{ $team->account->coach }}　/　領隊：{{ $team->account->leader }}　/　經理：{{ $team->account->management }} </td>
                                <td class="w-25 text-right"> <a href="{{ URL('admin/export/completion') }}/{{ $team->account_id }}"><button type="button" class="btn btn-primary btn-sm"> 完賽證明 </button></a> </td>
                            </tr>
                        </table>

                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($team->players))
                                <tr>
                                    <td class="w-20">
                                        @if (isset($team->players[$i]))
                                            {{ $team->players[$i]->player_number }} {{ $team->players[$i]->player->name }} ({{ $team->players[$i]->player->city . $team->players[$i]->player->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 1]))
                                            {{ $team->players[$i + 1]->player_number }} {{ $team->players[$i + 1]->player->name }} ({{ $team->players[$i + 1]->player->city . $team->players[$i + 1]->player->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 2]))
                                            {{ $team->players[$i + 2]->player_number }} {{ $team->players[$i + 2]->player->name }} ({{ $team->players[$i + 2]->player->city . $team->players[$i + 2]->player->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 3]))
                                            {{ $team->players[$i + 3]->player_number }} {{ $team->players[$i + 3]->player->name }} ({{ $team->players[$i + 3]->player->city . $team->players[$i + 3]->player->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 4]))
                                            {{ $team->players[$i + 4]->player_number }} {{ $team->players[$i + 4]->player->name }} ({{ $team->players[$i + 4]->player->city . $team->players[$i + 3]->player->agency }})
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 5
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
