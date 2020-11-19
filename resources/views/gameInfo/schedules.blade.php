@extends('layout')

@section('css')

@endsection

@section('content')
    @if (config('app.game_id') == 9)
        <div class="mh mb-5">
            <div class="container">
                <div class="mt-5 mb-5 text-center">
                    <h2> 賽程表 </h2>
                    <h3> 第一天 </h3>
                    <h3> 預計比賽時間 09:00 ~ 18:00 </h3>
                </div>
                <div class="col-md-12">
                    <table class="col-md-12 table table-striped table-dark">
                        <tr>
                            <td> 場次</td>
                            <td> 級別</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
{{--                            <td> 賽別</td>--}}
{{--                            <td> 備註</td>--}}
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules1Day as $schedule1)
                            <tr>
                                <td> {{ $schedule1->order }} </td>
                                <td> {{ $schedule1->level }} </td>
                                <td> {{ $schedule1->group }} </td>
                                <td> {{ $schedule1->gender }} </td>
                                <td> {{ $schedule1->item }} </td>
{{--                                <td> {{ $schedule1->game_type }} </td>--}}
{{--                                <td> {{ $schedule1->remark }} </td>--}}
                                <td> {{ $schedule1->number_of_player }} </td>
                            </tr>

                            @if ($schedule1->order == '場次14')
                                <tr>
                                    <td class="text-center" colspan="10">午休</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td class="text-center" colspan="10">第一天賽程結束</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-5 mb-5 text-center">
                    <h2> 賽程表 </h2>
                    <h3> 第二天 </h3>
                    <h3> 預計比賽時間 09:00 ~ 18:00 </h3>
                </div>
                <div class="col-md-12">
                    <table class="col-md-12 table table-striped table-dark">
                        <tr>
                            <td> 場次</td>
                            <td> 級別</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
{{--                            <td> 賽別</td>--}}
{{--                            <td> 備註</td>--}}
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules2Day as $schedule2)
                            <tr>
                                <td> {{ $schedule2->order }} </td>
                                <td> {{ $schedule2->level }} </td>
                                <td> {{ $schedule2->group }} </td>
                                <td> {{ $schedule2->gender }} </td>
                                <td> {{ $schedule2->item }} </td>
{{--                                <td> {{ $schedule2->game_type }} </td>--}}
{{--                                <td> {{ $schedule2->remark }} </td>--}}
                                <td> {{ $schedule2->number_of_player }} </td>
                            </tr>


                            @if ($schedule2->order == '場次90')
                                <tr>
                                    <td class="text-center" colspan="10">午休</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td class="text-center" colspan="10">第二天賽程結束</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if (config('app.game_id') == 10)
        <div class="mh mb-5">
            <div class="container">
                <div class="mt-5 mb-5 text-center">
                    <h2> 賽程表 </h2>
                    <h3> 第一天 </h3>
                    <h3> 預計比賽時間 09:00 ~ 18:00 </h3>
                </div>
                <div class="col-md-12">
                    <table class="col-md-12 table table-striped table-dark">
                        <tr>
                            <td> 場次</td>
                            <td> 級別</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
                            {{--                            <td> 賽別</td>--}}
                            {{--                            <td> 備註</td>--}}
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules1Day as $schedule1)
                            <tr>
                                <td> {{ $schedule1->order }} </td>
                                <td> {{ $schedule1->level }} </td>
                                <td> {{ $schedule1->group }} </td>
                                <td> {{ $schedule1->gender }} </td>
                                <td> {{ $schedule1->item }} </td>
                                {{--                                <td> {{ $schedule1->game_type }} </td>--}}
                                {{--                                <td> {{ $schedule1->remark }} </td>--}}
                                <td> {{ $schedule1->number_of_player }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endif


@endsection

@section('js')

@endsection
