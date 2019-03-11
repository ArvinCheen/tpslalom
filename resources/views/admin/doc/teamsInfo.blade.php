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
                    @foreach($teamsInfo as $val)
                        <table class="table mb-0">
                            <tr>
                                <td class="w-25"> {{ $val->teamName }} - {{ count($val->players) }}人參賽 </td>
                                <td class="w-50"> 教練：{{ $val->coach }}　/　領隊：{{ $val->leader }}　/　經理：{{ $val->management }} </td>
                                <td class="w-25 text-right"> <a href="{{ URL('admin/export/completion') }}/{{ $val->accountId }}"><button type="button" class="btn btn-primary btn-sm"> 完賽證明 </button></a> </td>
                            </tr>
                        </table>

                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tbody>
                            @php
                                $i = 0;
                                $x = 0
                            @endphp
                            @while($i < count($val->players))
                                <tr>
                                    <td class="w-25">
                                        @if (isset($val->players[$x + $i]))
                                            {{ $val->players[$x + $i]->playerNumber }} {{ $val->players[$x + $i]->name }} ({{ $val->players[$x + $i]->city . $val->players[$x + $i]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->players[$x + $i + 1]))
                                            {{ $val->players[$x + $i + 1]->playerNumber }} {{ $val->players[$x + $i + 1]->name }} ({{ $val->players[$x + $i + 1]->city . $val->players[$x + $i + 1]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->players[$x + $i + 2]))
                                            {{ $val->players[$x + $i + 2]->playerNumber }} {{ $val->players[$x + $i + 2]->name }} ({{ $val->players[$x + $i + 2]->city . $val->players[$x + $i + 2]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->players[$x + $i + 3]))
                                            {{ $val->players[$x + $i + 3]->playerNumber }} {{ $val->players[$x + $i + 3]->name }} ({{ $val->players[$x + $i + 3]->city . $val->players[$x + $i + 3]->agency }})
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 3
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