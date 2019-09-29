@extends('layout')

@section('css')

@endsection

@section('content')
    <section class="bg-image bg-image-sm" style="background-image: url({{ URL::asset('front/comingSoon.jpg') }});">
        <div class="overlay"></div>
        <div class="coming-soon p-y-80">
            <div>
                <h2> 即將開放！ </h2>
            </div>
        </div>
    </section>



{{--    <div class="mh mb-5">--}}
{{--        <div class="container">--}}
{{--            <div class="mt-5 mb-5 text-center">--}}
{{--                <h2> 成績查詢 </h2>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <select class="form-control" id="m_select2_1" name="scheduleSn">--}}
{{--                    @foreach ($schedules as $schedule)--}}
{{--                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            @if ($isGameOver)--}}
{{--                <div class="col-md-12 mt-3">--}}
{{--                    <table class="table table-striped table-bordered table-advance table-hover">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="text-center" colspan="10"> 台北市 </th>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th class="text-center"> 名次 </th>--}}
{{--                            <th class="text-center"> 編號 </th>--}}
{{--                            <th class="text-center"> 選手 </th>--}}
{{--                            <th class="text-center"> 一回 </th>--}}
{{--                            <th class="text-center"> 誤椿 </th>--}}
{{--                            <th class="text-center"> 二回 </th>--}}
{{--                            <th class="text-center"> 誤椿 </th>--}}
{{--                            <th class="text-center"> 成績 </th>--}}
{{--                            <th class="text-center"> 積分 </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @if ($taipeiResult->count() == 0)--}}
{{--                            <th class="text-center" colspan="10"> -- 無資料 -- </th>--}}
{{--                        @endif--}}
{{--                        @foreach ($taipeiResult as $val)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center"> {{ $val->rank }}</td>--}}
{{--                                <td class="text-center"> {{ $val->player_number }}</td>--}}
{{--                                <td class="text-center"> {{ $val->name }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_one_second }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_two_second }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>--}}
{{--                                <td class="text-center"> {{ $val->final_result }}</td>--}}
{{--                                <td class="text-center"> {{ $val->integral }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col-md-12 mt-3">--}}
{{--                    <table class="table table-striped table-bordered table-advance table-hover">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="text-center" colspan="10"> 外縣市 </th>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th class="text-center"> 名次 </th>--}}
{{--                            <th class="text-center"> 編號 </th>--}}
{{--                            <th class="text-center"> 選手 </th>--}}
{{--                            <th class="text-center"> 一回 </th>--}}
{{--                            <th class="text-center"> 誤椿 </th>--}}
{{--                            <th class="text-center"> 二回 </th>--}}
{{--                            <th class="text-center"> 誤椿 </th>--}}
{{--                            <th class="text-center"> 成績 </th>--}}
{{--                            <th class="text-center"> 積分 </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @if ($otherCityResult->count() == 0)--}}
{{--                            <th class="text-center" colspan="10"> -- 無資料 -- </th>--}}
{{--                        @endif--}}
{{--                        @foreach ($otherCityResult as $val)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center"> {{ $val->rank }}</td>--}}
{{--                                <td class="text-center"> {{ $val->player_number }}</td>--}}
{{--                                <td class="text-center"> {{ $val->name }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_one_second }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_two_second }}</td>--}}
{{--                                <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>--}}
{{--                                <td class="text-center"> {{ $val->final_result }}</td>--}}
{{--                                <td class="text-center"> {{ $val->integral }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div class="mt-5 mb-5 text-center">--}}
{{--                    <h4> -- 未完賽 -- </h4>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function() {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('search/result/') }}/" + scheduleSn
        });
    </script>
@endsection
