@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 賽程表 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="mh mb-5">
            <div class="container">
                <div class="col-md-12">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td> 場次</td>
                            <td> 級別</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
                            <td> 人數</td>
                            <td> 秒數/人</td>
                            <td> 預估時間</td>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td> {{ $schedule->order }} </td>
                                <td> {{ $schedule->level }} </td>
                                <td> {{ $schedule->group }} </td>
                                <td> {{ $schedule->gender }} </td>
                                <td> {{ $schedule->item }} </td>
                                <td> {{ $schedule->number_of_player }} </td>
                                <td> {{ $schedule->estimate }} </td>
                                <td> {{ date('H:i:s',strtotime($schedule->estimate_time)) }} </td>
                            </tr>
                            @if (config('app.game_id') == 9)
                                @if ($schedule->order == '場次14')
                                    <tr>
                                        <td class="text-center" colspan="10">午休</td>
                                    </tr>
                                @endif
                                @if ($schedule->order == '場次90')
                                    <tr>
                                        <td class="text-center" colspan="10">午休</td>
                                    </tr>
                                @endif
                                @if ($schedule->order == '場次29')
                                    <tr>
                                        <td class="text-center" colspan="10">第一天賽程結束</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        <tr>
                            <td class="text-center" colspan="10">第二天賽程結束</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
