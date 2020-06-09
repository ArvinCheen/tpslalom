@extends('layout')

@section('css')

@endsection

@section('content')
    {{--<section class="bg-image bg-image-sm" style="background-image: url({{ URL::asset('front/comingSoon.jpg') }});">--}}
        {{--<div class="overlay"></div>--}}
        {{--<div class="coming-soon p-y-80">--}}
            {{--<div>--}}
                {{--<h2> 即將開放！ </h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}



    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 出場序名冊 </h2>
            </div>
            <div class="col-md-12">
                <select class="form-control" id="m_select2_1" name="scheduleId">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} {{ $schedule->game_type }} {{ $schedule->remark }} </option>
                    @endforeach
                </select>
            </div>
            @if ($schedule->item == '雙人花式繞樁')
                <div class="col-md-12 mt-3">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center"> 順序 </th>
                            <th class="text-center"> 編號 </th>
                            <th class="text-center"> 選手 </th>
                            <th class="text-center"> 編號 </th>
                            <th class="text-center"> 選手 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($isView)
                            <tr>
                                <th class="text-center"> 1 </th>
                                @foreach ($enrolls as $enroll)
                                    @if($enroll->appearance == 1)
                                        <th class="text-center"> {{ $enroll->player_number }} </th>
                                        <th class="text-center"> {{ $enroll->name }} </th>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th class="text-center"> 2 </th>
                                @foreach ($enrolls as $enroll)
                                    @if($enroll->appearance == 2)
                                        <th class="text-center"> {{ $enroll->player_number }} </th>
                                        <th class="text-center"> {{ $enroll->name }} </th>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th class="text-center"> 3 </th>
                                @foreach ($enrolls as $enroll)
                                    @if($enroll->appearance == 3)
                                        <th class="text-center"> {{ $enroll->player_number }} </th>
                                        <th class="text-center"> {{ $enroll->name }} </th>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th class="text-center"> 4 </th>
                                @foreach ($enrolls as $enroll)
                                    @if($enroll->appearance == 4)
                                        <th class="text-center"> {{ $enroll->player_number }} </th>
                                        <th class="text-center"> {{ $enroll->name }} </th>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th class="text-center"> 5 </th>
                                @foreach ($enrolls as $enroll)
                                    @if($enroll->appearance == 5)
                                        <th class="text-center"> {{ $enroll->player_number }} </th>
                                        <th class="text-center"> {{ $enroll->name }} </th>
                                    @endif
                                @endforeach
                            </tr>
                        @else
                            <th class="text-center" colspan="10"> -- 未抽籤 -- </th>
                        @endif
                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-md-12 mt-3">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center"> 出場順序 </th>
                            <th class="text-center"> 選手編號 </th>
                            <th class="text-center"> 選手姓名  </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($isView)
                            @if($gameInfo->game_type.$gameInfo->group.$gameInfo->item == '決賽國中速度過樁菁英組-前溜單足S形(男)' || $gameInfo->game_type.$gameInfo->group.$gameInfo->item == '決賽國中速度過樁菁英組-前溜單足S形(女)' || $gameInfo->game_type.$gameInfo->group.$gameInfo->item == '決賽高中速度過樁菁英組-前溜單足S形(男)')
                                <th class="text-center" colspan="10"> -- 前八強PK賽採動態出場 -- </th>
                            @else
                                @foreach ($enrolls as $enroll)
                                    <tr>
                                        <td class="text-center"> {{ $enroll->appearance }}</td>
                                        <td class="text-center"> {{ $enroll->player_number }}</td>
                                        <td class="text-center"> {{ $enroll->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @else
                            <th class="text-center" colspan="10"> -- 未抽籤 -- </th>
                        @endif
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function() {
            var scheduleId = $(this).val();
            window.location = "{{ URL('gameInfo/getAppearance/') }}/" + scheduleId
        });
    </script>
@endsection
