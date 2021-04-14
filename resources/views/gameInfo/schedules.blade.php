@extends('layout')

@section('css')

@endsection

@section('content')
    @if (config('app.game_id') == 11)
        <div class="mh mb-5">
            <div class="container">
                <div class="mt-5 mb-5 text-center">
                    <h2> 賽程表 </h2>
                    {{-- <h3> 第一天 </h3> --}}
                    {{-- <h3> 預計比賽時間 09:00 ~ 18:00 </h3> --}}
                </div>
                <div class="col-md-12">
                    <table class="col-md-12 table table-striped table-dark">
                        <tr>
                            <td> 場次</td>
                            <td> 級別</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td> {{ $schedule->order }} </td>
                                <td> {{ $schedule->level }} </td>
                                <td> {{ $schedule->group }} </td>
                                <td> {{ $schedule->gender }} </td>
                                <td> {{ $schedule->item }} </td>
                                <td> {{ $schedule->number_of_player }} </td>
                            </tr>

                            {{-- @if ($schedule1->order == '場次14')
                                <tr>
                                    <td class="text-center" colspan="10">午休</td>
                                </tr>
                            @endif --}}
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    @endif

    @if (config('app.game_id') == 12)
        <div class="mh mb-5">
            <div class="container">
                <div class="mt-5 mb-5 text-center">
                    <h2> 賽程表 </h2>
                    <h3> 第一天 </h3>
                    {{-- <h3> 預計比賽時間 09:00 ~ 18:00 </h3> --}}
                </div>
                <div class="col-md-12">
                    <table class="col-md-12 table table-striped table-dark">
                        <tr>
                            <td> 場次</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
                            {{--                            <td> 賽別</td>--}}
                            {{--                            <td> 備註</td>--}}
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td> {{ $schedule->order }} </td>
                                <td> {{ $schedule->group }} </td>
                                <td> {{ $schedule->gender }} </td>
                                <td> {{ $schedule->item }} </td>
                                {{--                                <td> {{ $schedule->game_type }} </td>--}}
                                {{--                                <td> {{ $schedule->remark }} </td>--}}
                                <td> {{ $schedule->number_of_player }} </td>
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
