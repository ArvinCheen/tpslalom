@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
                <h3> 第一天 </h3>
                <h3> 預計比賽時間 08:00 ~ 18:00 </h3>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 賽別</td>
                        <td> 備註</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedules1Day as $schedule1)
                            <tr>
                                <td> {{ $schedule1->order }} </td>
                                <td> {{ $schedule1->group }} </td>
                                <td> {{ $schedule1->gender }} </td>
                                <td> {{ $schedule1->item }} </td>
                                <td> {{ $schedule1->game_type }} </td>
                                <td> {{ $schedule1->remark }} </td>
                                @if ($schedule1->number_of_player == 0)
                                    <td> ? </td>
                                    @else
                                    <td> {{ $schedule1->number_of_player }} </td>
                                @endif
                            </tr>
{{--                        @if($schedule1->order == '場次10')--}}
{{--                            <tr>--}}
{{--                                <td class='text-center' colspan="7"> 中午休息 12:00 ~ 13:00</td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
                    @endforeach
                </table>
            </div>

            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
                <h3> 第二天 </h3>
                <h3> 預計比賽時間 08:00 ~ 18:00 </h3>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 賽別</td>
                        <td> 備註</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedules2Day as $schedule2)
                            <tr>
                                <td> {{ $schedule2->order }} </td>
                                <td> {{ $schedule2->group }} </td>
                                <td> {{ $schedule2->gender }} </td>
                                <td> {{ $schedule2->item }} </td>
                                <td> {{ $schedule2->game_type }} </td>
                                <td> {{ $schedule2->remark }} </td>
                                @if ($schedule2->number_of_player == 0)
                                    <td> ? </td>
                                @else
                                    <td> {{ $schedule2->number_of_player }} </td>
                                @endif
                            </tr>
{{--                        @if($schedule2->order == '場次34')--}}
{{--                            <tr>--}}
{{--                                <td class='text-center' colspan="7"> 中午休息 12:00 ~ 13:00</td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
                    @endforeach
                </table>
            </div>
            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
                <h3> 第三天 </h3>
                <h3> 預計比賽時間 08:00 ~ 18:00 </h3>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 賽別</td>
                        <td> 備註</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedules3Day as $schedule3)
                            <tr>
                                <td> {{ $schedule3->order }} </td>
                                <td> {{ $schedule3->group }} </td>
                                <td> {{ $schedule3->gender }} </td>
                                <td> {{ $schedule3->item }} </td>
                                <td> {{ $schedule3->game_type }} </td>
                                <td> {{ $schedule3->remark }} </td>
                                @if ($schedule3->number_of_player == 0)
                                    <td> ? </td>
                                @else
                                    <td> {{ $schedule3->number_of_player }} </td>
                                @endif
                            </tr>
{{--                        @if($schedule3->order == '場次80')--}}
{{--                            <tr>--}}
{{--                                <td class='text-center' colspan="7"> 中午休息 12:00 ~ 13:00</td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
                    @endforeach
                </table>
            </div>


        </div>
    </div>
@endsection

@section('js')

@endsection
