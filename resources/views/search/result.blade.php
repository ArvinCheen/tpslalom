@extends('layout')

@section('css')

@endsection

@section('content')
{{--    <section class="bg-image bg-image-sm" style="background-image: url({{ URL::asset('front/comingSoon.jpg') }});">--}}
{{--        <div class="overlay"></div>--}}
{{--        <div class="coming-soon p-y-80">--}}
{{--            <div>--}}
{{--                <h2> 即將開放！！ </h2>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}





    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 成績查詢 </h2>
            </div>
            <div class="col-md-12">
                <select class="form-control" id="m_select2_1" name="scheduleSn">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} {{ $schedule->game_type }} {{ $schedule->remark }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="20">
                            @if (is_null($openResultTime))
                                成績公告時間：尚未公告
                            @else
                                成績公告時間：{{ $openResultTime }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center"> 名次 </th>
                        <th class="text-center"> 編號 </th>
                        <th class="text-center"> 選手 </th>
                        @if ($scheduleId >= 24 || ($scheduleId >= 11 && $scheduleId <= 20 ))
                            @if ($scheduleId >= 24 || $scheduleId <= 34)
                                @if ($scheduleId == 27 || $scheduleId >= 35)
                                    <th class="text-center"> 一回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 二回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                @else
                                    <th class="text-center"> 一回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                    <th class="text-center"> 二回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                    <th class="text-center"> 三回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                    <th class="text-center"> 四回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                    <th class="text-center"> 五回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                    <th class="text-center"> 最佳成績 </th>
                                @endif
                            @else
                                <th class="text-center"> 一回 </th>
                                <th class="text-center"> 誤椿 </th>
                                <th class="text-center"> 二回 </th>
                                <th class="text-center"> 誤椿 </th>
                                <th class="text-center"> 成績 </th>
                            @endif
                        @else
                            @if ($scheduleId == 22 || $scheduleId == 23)
                            @else
                                <th class="text-center"> 技術一 </th>
                                <th class="text-center"> 藝術一 </th>
                                <th class="text-center"> 總分一 </th>
                                <th class="text-center"> 技術二 </th>
                                <th class="text-center"> 藝術二 </th>
                                <th class="text-center"> 總分二 </th>
                                <th class="text-center"> 技術三 </th>
                                <th class="text-center"> 藝術三 </th>
                                <th class="text-center"> 總分三 </th>
                                <th class="text-center"> 技術四 </th>
                                <th class="text-center"> 藝術四 </th>
                                <th class="text-center"> 總分四 </th>
                                <th class="text-center"> 技術五 </th>
                                <th class="text-center"> 藝術五 </th>
                                <th class="text-center"> 總分五 </th>
                                <th class="text-center"> 罰分 </th>
                            @endif
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($result) == 0)
                        <th class="text-center" colspan="20"> -- 無資料 -- </th>
                    @endif
                    @foreach ($result as $key => $val)
                        <tr>
                            <td class="text-center">
                                @if ($rankLimit >= ($key+1))
                                    {{ $val->rank }}
                                @endif
                            </td>
                            <td class="text-center"> {{ $val->player_number }}</td>
                            <td class="text-center"> {{ $val->name }}</td>
                            @if ($scheduleId >= 24 || ($scheduleId >= 11 && $scheduleId <= 20 ))
                                <td class="text-center"> {{ $val->round_one_second }}</td>
                                <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>
                                <td class="text-center"> {{ $val->round_two_second }}</td>
                                <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>
                                <td class="text-center"> {{ $val->final_result }}</td>
                            @else

                                @if ($scheduleId == 22 || $scheduleId == 23)
                                @else
                                    <td class="text-center"> {{ $val->skill_1 }}</td>
                                    <td class="text-center"> {{ $val->art_1 }}</td>
                                    <td class="text-center"> {{ $val->score_1 }}</td>
                                    <td class="text-center"> {{ $val->skill_2 }}</td>
                                    <td class="text-center"> {{ $val->art_2 }}</td>
                                    <td class="text-center"> {{ $val->score_2 }}</td>
                                    <td class="text-center"> {{ $val->skill_3 }}</td>
                                    <td class="text-center"> {{ $val->art_3 }}</td>
                                    <td class="text-center"> {{ $val->score_3 }}</td>
                                    <td class="text-center"> {{ $val->skill_4 }}</td>
                                    <td class="text-center"> {{ $val->art_4 }}</td>
                                    <td class="text-center"> {{ $val->score_4 }}</td>
                                    <td class="text-center"> {{ $val->skill_5 }}</td>
                                    <td class="text-center"> {{ $val->art_5 }}</td>
                                    <td class="text-center"> {{ $val->score_5 }}</td>
                                    <td class="text-center"> {{ $val->punish }}</td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function() {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('search/result/') }}/" + scheduleSn
        });
    </script>
@endsection
