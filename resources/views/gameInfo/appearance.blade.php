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
                <h2> 出場序查詢 </h2>
            </div>
            <div class="col-md-12">
                <select class="form-control" id="m_select2_1" name="scheduleId">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} </option>
                    @endforeach
                </select>
            </div>
            @if ($scheduleId == 20)
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
                                <th class="text-center"> 180 </th>
                                <th class="text-center"> 鐘晨恩 </th>
                                <th class="text-center"> 0020 </th>
                                <th class="text-center"> 鐘晨芸 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 2 </th>
                                <th class="text-center"> 50 </th>
                                <th class="text-center"> 侯安伃 </th>
                                <th class="text-center"> 0161 </th>
                                <th class="text-center"> 劉以琳 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 3 </th>
                                <th class="text-center"> 2 </th>
                                <th class="text-center"> 范予僖 </th>
                                <th class="text-center"> 0026 </th>
                                <th class="text-center"> 黃淇宣 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 4 </th>
                                <th class="text-center"> 42 </th>
                                <th class="text-center"> 周柏崴 </th>
                                <th class="text-center"> 0083 </th>
                                <th class="text-center"> 周柏諦 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 5 </th>
                                <th class="text-center"> 85 </th>
                                <th class="text-center"> 侯鈞諺 </th>
                                <th class="text-center"> 0126 </th>
                                <th class="text-center"> 陳建廷 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 6 </th>
                                <th class="text-center"> 84 </th>
                                <th class="text-center"> 倪詣超 </th>
                                <th class="text-center"> 0092 </th>
                                <th class="text-center"> 倪采彤 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 7 </th>
                                <th class="text-center"> 268 </th>
                                <th class="text-center"> 邱映瑄 </th>
                                <th class="text-center"> 0132 </th>
                                <th class="text-center"> 邱宇廷 </th>
                            </tr>
                            <tr>
                                <th class="text-center"> 8 </th>
                                <th class="text-center"> 342 </th>
                                <th class="text-center"> 周祈佑 </th>
                                <th class="text-center"> 0311 </th>
                                <th class="text-center"> 賴徐捷 </th>
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
                            <th class="text-center"> 順序 </th>
                            <th class="text-center"> 編號 </th>
                            <th class="text-center"> 選手 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($isView)
                            @foreach ($enrolls as $enroll)
                                <tr>
                                    <td class="text-center"> {{ $enroll->appearance }}</td>
                                    <td class="text-center"> {{ $enroll->player_number }}</td>
                                    <td class="text-center"> {{ $enroll->name }}</td>
                                </tr>
                            @endforeach
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
