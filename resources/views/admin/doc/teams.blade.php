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
                                                                <td colspan="5" class="w-25"> 隊伍：{{ $team->agency_all }} - {{ count($team->players) }} 人參賽 / 教練團：{{ $team->coach }}　{{ $team->leader }}　{{ $team->management }}</td>
{{--                                <td colspan="5" class="w-25"> 隊伍：{{ $team->account->team_name }} - {{ count($team->players) }} 人參賽 / 教練：{{ $team->account->coach }}　/　領隊：{{ $team->account->leader }}　/　經理：{{ $team->account->management }}</td>--}}
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
                                    <td class="w-20">
                                        @if (isset($team->players[$i]))
                                            {{ $team->players[$i]->id }} {{ $team->players[$i]->name }}
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 1]))
                                            {{ $team->players[$i + 1]->id }} {{ $team->players[$i + 1]->name }}
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 2]))
                                            {{ $team->players[$i + 2]->id }} {{ $team->players[$i + 2]->name }}
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 3]))
                                            {{ $team->players[$i + 3]->id }} {{ $team->players[$i + 3]->name }}
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($team->players[$i + 4]))
                                            {{ $team->players[$i + 4]->id }} {{ $team->players[$i + 4]->name }}
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
