@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 單位名冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    @foreach($agencies as $agency)
                        <table class="table mb-0">
                            <tr>
                                                                <td colspan="5" class="w-25"> {{ $agency->agency }} - {{ count($agency->players) }} 人參賽</td>
{{--                                / 教練團：{{ $agency->coach }}　{{ $agency->leader }}　{{ $agency->management }}--}}
{{--                                <td colspan="5" class="w-25"> 隊伍：{{ $agency->account->team_name }} - {{ count($agency->players) }} 人參賽 / 教練：{{ $agency->account->coach }}　/　領隊：{{ $agency->account->leader }}　/　經理：{{ $agency->account->management }}</td>--}}
{{--                                <td colspan="5" class="w-25"> 教練：{{ $agency->account->coach }}　/　領隊：{{ $agency->account->leader }}　/　經理：{{ $agency->account->management }}</td>--}}
                            </tr>
                        </table>

                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($agency->players))
                                <tr>
                                    <td class="w-50">
                                        @if (isset($agency->players[$i]))
                                            {{ $agency->players[$i]->name }} -
                                            教練：{{ $agency->players[$i]->account->coach }}
                                            領隊：{{ $agency->players[$i]->account->leader }}
                                            經理：{{ $agency->players[$i]->account->management }}
                                        @endif
                                    </td>
                                    <td class="w-50">
                                        @if (isset($agency->players[$i + 1]))
                                            {{ $agency->players[$i + 1]->name }} -
                                            教練：{{ $agency->players[$i + 1]->account->coach }}
                                            領隊：{{ $agency->players[$i + 1]->account->leader }}
                                            經理：{{ $agency->players[$i + 1]->account->management }}
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
