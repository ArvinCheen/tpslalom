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
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }}
                            - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組 {{ $schedule->item }} {{ $schedule->game_type }} {{ $schedule->remark }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>

                        @switch ($model)
                            @case('speed')
                            <th class="text-center"> 選手</th>
                            <th class="text-center"> 一回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 二回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 名次</th>
                            @break;
                            @case('freeStyle')
                            <th class="text-center"> 選手</th>

                            <th class="text-center"> 罰分</th>
                            <th class="text-center"> 技術一</th>
                            <th class="text-center"> 藝術一</th>
                            <th class="text-center"> 總分一</th>
                            <th class="text-center"> 技術二</th>
                            <th class="text-center"> 藝術二</th>
                            <th class="text-center"> 總分二</th>
                            <th class="text-center"> 技術三</th>
                            <th class="text-center"> 藝術三</th>
                            <th class="text-center"> 總分三</th>
                            @if ($scheduleInfo->item == '個人花式繞樁' )
                                <th class="text-center"> 技術四</th>
                                <th class="text-center"> 藝術四</th>
                                <th class="text-center"> 總分四</th>
                                <th class="text-center"> 技術五</th>
                                <th class="text-center"> 藝術五</th>
                                <th class="text-center"> 總分五</th>
                            @endif
                            <th class="text-center"> 名次</th>

                            @break;

                            @case('stop')
                            <th class="text-center"> 名次</th>
                            <th class="text-center"> 選手</th>
                            @break;
                            @case('pk')
                            @break;
                        @endswitch
                    </tr>
                    </thead>
                    <tbody>
                    @switch ($model)
                        @case('speed')
                        @foreach ($result as $key => $val)
                            <tr>
                                <td class="text-center"> {{ $val->player_number }} {{$val->player->name}}</td>
                                <td class="text-center"> {{ $val->round_one_second }}</td>
                                <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>
                                <td class="text-center"> {{ $val->round_two_second }}</td>
                                <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>
                                <td class="text-center"> {{ $val->final_result }}</td>
                                <td class="text-center"> {{ $val->rank }}</td>
                            </tr>
                        @endforeach
                        @break;
                        @case('freeStyle')
{{--                        @if ($scheduleInfo->item == '雙人花式繞樁')--}}
{{--                                                        <tr>--}}
{{--                                                            <th class="text-center"> 001 范予僖、193 黃淇宣</th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"> 1</th>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <th class="text-center"> 362 邱宇廷、164 邱映瑄</th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"></th>--}}
{{--                                                            <th class="text-center"> 2</th>--}}
{{--                                                        </tr>--}}

{{--                        @else--}}

                            @foreach ($result as $key => $val)
                                <tr>
                                    <td class="text-center"> {{ $val->player_number }} {{$val->player->name}}</td>
                                    <td class="text-center"> {{ $val->punish }}</td>
                                    <td class="text-center"> {{ $val->skill_1 }}</td>
                                    <td class="text-center"> {{ $val->art_1 }}</td>
                                    <td class="text-center"> {{ $val->score_1 }}</td>
                                    <td class="text-center"> {{ $val->skill_2 }}</td>
                                    <td class="text-center"> {{ $val->art_2 }}</td>
                                    <td class="text-center"> {{ $val->score_2 }}</td>
                                    <td class="text-center"> {{ $val->skill_3 }}</td>
                                    <td class="text-center"> {{ $val->art_3 }}</td>
                                    <td class="text-center"> {{ $val->score_3 }}</td>
                                    @if ($scheduleInfo->item == '個人花式繞樁')
                                    <td class="text-center"> {{ $val->skill_4 }}</td>
                                    <td class="text-center"> {{ $val->art_4 }}</td>
                                    <td class="text-center"> {{ $val->score_4 }}</td>
                                    <td class="text-center"> {{ $val->skill_5 }}</td>
                                    <td class="text-center"> {{ $val->art_5 }}</td>
                                    <td class="text-center"> {{ $val->score_5 }}</td>
                                    @endif
                                    <td class="text-center"> {{ $val->rank }}</td>
                                </tr>
                            @endforeach
{{--                        @endif--}}
                        @break;
                        @case('stop')
                        @foreach ($result as $key => $val)
                            <tr>
                                <td class="text-center"> {{ $val->rank }}</td>
                                <td class="text-center"> {{$val->name}}({{ $val->player_number }})</td>
                            </tr>
                        @endforeach
                        @break;
                        @case('pk')
                        @switch ($scheduleInfo->order)
                            @case('場次131')
                            <img src="https://imgur.com/EwNkPsd.jpg"/>
                            @break;
                            @case('場次132')
                            <img src="https://imgur.com/NGXBntM.jpg"/>
                            @break;
                            @case('場次133')
                            <img src="https://imgur.com/J1OANrj.jpg"/>
                            @break;
                            @case('場次134')
                            <img src="https://imgur.com/awtnLGB.jpg"/>
                            @break;
                            @case('場次135')
                            <img src="https://imgur.com/jI5tFZc.jpg"/>
                            @break;
                            @case('場次136')
                            <img src="https://imgur.com/mnxFene.jpg"/>
                            @break;
                        @endswitch
                        @break;
                    @endswitch

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function () {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('search/result/') }}/" + scheduleSn
        });
    </script>
@endsection
