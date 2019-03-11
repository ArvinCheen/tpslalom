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
                    @foreach($groupsInfo as $val)
                        <table class="table mb-0">
                            <tr>
                                <td>{{ $val->order }} </td>
                                <td class="text-center">【{{ $val->level }}】{{ $val->group }} {{ $val->gender }}子組 {{ $val->item }}</td>
                                <td class="text-right">共 {{ $val->numberOfPlayer }} 人</td>
                            </tr>
                        </table>
                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($val->playerList))
                                <tr>
                                    <td class="w-25">
                                        @if (isset($val->playerList[$i]))
                                            {{ $val->playerList[$i]->playerNumber }} {{ $val->playerList[$i]->name }} ({{ $val->playerList[$i]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->playerList[$i + 1]))
                                            {{ $val->playerList[$i + 1]->playerNumber }} {{ $val->playerList[$i + 1]->name }} ({{ $val->playerList[$i + 1]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->playerList[$i + 2]))
                                            {{ $val->playerList[$i + 2]->playerNumber }} {{ $val->playerList[$i + 2]->name }} ({{ $val->playerList[$i + 2]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-25">
                                        @if (isset($val->playerList[$i + 3]))
                                            {{ $val->playerList[$i + 3]->playerNumber }} {{ $val->playerList[$i + 3]->name }} ({{ $val->playerList[$i + 3]->agency }})
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 4
                                @endphp
                            @endwhile
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection