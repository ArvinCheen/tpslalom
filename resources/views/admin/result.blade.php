@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 輸入成績 </h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group m-form__group row">
                    <div class="col-md-6">
                        <select class="form-control m-select2" id="m_select2_1">
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }}
                                    - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組 {{ $schedule->item }} - {{ $schedule->number_of_player }}人
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-2">
                        <a href="{{ URL('admin/result\/') . ($scheduleId + 1) }}" class="btn btn-primary"> 下一場 </a>
                    </div>
                    <div class="ml-2">
                        <a href="{{ URL('admin/export/certificate') }}/{{$scheduleId}}">
                            <button type="button" class="btn btn-primary"> 匯出獎狀</button>
                        </a>
                    </div>
                    @if ($model == 'speed')
                        <div class="ml-2">
                            <form action="{{ route('admin.rank') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="scheduleId" value="{{ $scheduleId }}">
                                <button type="submit" class="btn btn-primary"> 排名</button>
                            </form>
                        </div>
                    @endif
                    <div class="ml-2">
                        <button type="submit" class="btn btn-primary" onclick="submit()"> 送出</button>
                    </div>
                </div>

                <form id="result-form" action="{{ URL('admin/result/update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="scheduleId" value="{{ $scheduleId }}">
                    <input type="hidden" name="model" value="{{ $model }}">
                    <table class="
{{--                    @if($model <> 'freeStyle')--}}
                        table
{{--@endif--}}
                        table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class=""></i> 選手
                            </th>

                            @switch ($model)
                                @case('speed')
                                <th class="text-center">
                                    <i class=""></i> 一回/秒數
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 一回/誤樁
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 二回/秒數
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 二回/誤樁
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 成績
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 名次
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 積分
                                </th>
                                @break
                                @case('pk')
                                @break
                                @case('freeStyle')
                                <th class="text-center">
                                    罰分
                                </th>
                                <th class="text-center">
                                    技術
                                </th>
                                <th class="text-center">
                                    藝術1
                                </th>
                                <th class="text-center">
                                    總分1
                                </th>
                                <th class="text-center">
                                    技術2
                                </th>
                                <th class="text-center">
                                    藝術2
                                </th>
                                <th class="text-center">
                                    總分2
                                </th>
                                <th class="text-center">
                                    技術3
                                </th>
                                <th class="text-center">
                                    藝術3
                                </th>
                                <th class="text-center">
                                    總分3
                                </th>
                                @if ($當前項目 == '個人花式繞樁')
                                <th class="text-center">
                                    技術4
                                </th>
                                <th class="text-center">
                                    藝術4
                                </th>
                                <th class="text-center">
                                    總分4
                                </th>
                                <th class="text-center">
                                    技術5
                                </th>
                                <th class="text-center">
                                    藝術5
                                </th>
                                <th class="text-center">
                                    總分5
                                </th>
                                @endif
                                <th class="text-center">
                                    名次
                                </th>
                                <th class="text-center">
                                    積分
                                </th>
                                @break
                            @endswitch
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($enrolls as $key => $enroll)
                            <tr>
                                <td class="text-center" style="width:70px"> {{ $enroll->player_number }} <br>{{ $enroll->player->name }}</td>
                                @switch ($model)
                                    @case('speed')
                                   {{-- <td class="text-center"><input name="roundOneSecond[]" type="text" class="text-center resultInput roundOneSecond" size="8" value="{{ rand(4, 10) . '.' . rand(0,9) }}"
                                                                  autocomplete="off"></td>
                                   <td class="text-center"><input name="roundOneMissConr[]" type="text" class="text-center resultInput roundOneMissConr" size="3"
                                                                  value="{{ rand(0,7) }}" autocomplete="off"></td>
                                   <td class="text-center"><input name="roundTwoSecond[]" type="text" class="text-center resultInput roundTwoSecond" size="8" value="{{ rand(4, 20) . '.' . rand(0,9) }}"
                                                                  autocomplete="off"></td>
                                   <td class="text-center"><input name="roundTwoMissConr[]" type="text" class="text-center resultInput roundTwoMissConr" size="3"
                                                                   value="{{ rand(0,7) }}" autocomplete="off"></td> --}}


                                    <td class="text-center"><input name="roundOneSecond[]" type="text" class="text-center resultInput roundOneSecond" size="8" value="{{ $enroll->round_one_second }}"
                                                                   autocomplete="off"></td>
                                    <td class="text-center"><input name="roundOneMissConr[]" type="text" class="text-center resultInput roundOneMissConr" size="3"
                                                                   value="{{ $enroll->round_one_miss_conr }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="roundTwoSecond[]" type="text" class="text-center resultInput roundTwoSecond" size="8" value="{{ $enroll->round_two_second }}"
                                                                   autocomplete="off"></td>
                                    <td class="text-center"><input name="roundTwoMissConr[]" type="text" class="text-center resultInput roundTwoMissConr" size="3"
                                                                   value="{{ $enroll->round_two_miss_conr }}" autocomplete="off"></td>

                                    <td class="text-center"> {{ $enroll->final_result }} </td>
                                    <td class="text-center"> {{ $enroll->rank }} </td>
                                    <td class="text-center"> {{ $enroll->integral }} </td>
                                    @break
                                    @case('pk')
                                    @break
                                    @case('freeStyle')
                                    <td class="text-center"><input name="punish[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->punish }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="skill_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_1 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_1 }}" autocomplete="off"></td>
{{--                                    <td class="text-center"><input name="score_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_1 }}" autocomplete="off"></td>--}}
                                    <td class="text-center">{{ $enroll->score_1 }}</td>
                                    <td class="text-center"><input name="skill_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_2 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_2 }}" autocomplete="off"></td>
{{--                                    <td class="text-center"><input name="score_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_2 }}" autocomplete="off"></td>--}}
                                    <td class="text-center">{{ $enroll->score_2 }}</td>
                                    <td class="text-center"><input name="skill_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_3 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_3 }}" autocomplete="off"></td>
{{--                                    <td class="text-center"><input name="score_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_3 }}" autocomplete="off"></td>--}}
                                    <td class="text-center">{{ $enroll->score_3 }}</td>
{{--                                    @if ($當前項目 == '個人花式繞樁')--}}
{{--                                    <td class="text-center"><input name="skill_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_4 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center"><input name="art_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_4 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center"><input name="score_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_4 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center">{{ $enroll->score_4 }}</td>--}}
{{--                                    <td class="text-center"><input name="skill_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_5 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center"><input name="art_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_5 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center"><input name="score_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_5 }}" autocomplete="off"></td>--}}
{{--                                    <td class="text-center">{{ $enroll->score_5 }}</td>--}}
{{--@endif--}}
                                    <td class="text-center"><input name="rank[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->rank }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="integral[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->integral }}" autocomplete="off"></td>
{{--                                    @break--}}
                                @endswitch
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    @foreach ($enrolls as $key => $enroll)
                        <input type="hidden" name="enrollIds[]" value="{{ $enroll->id }}" }>
                    @endforeach
                </form>
                @if ($model == 'freeStyle')
                    <p class="mt-5">裁判排名結果</p>
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <td class="text-center">選手</td>
                            <td class="text-center">裁判一</td>
                            <td class="text-center">裁判二</td>
                            <td class="text-center">裁判三</td>
{{--                            @if ($當前項目 == '個人花式繞樁')--}}
{{--                            <td class="text-center">裁判四</td>--}}
{{--                            <td class="text-center">裁判五</td>--}}
{{--                                @endif--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($評分表 as $選手)
                            <tr>
                                @foreach ($選手 as $val)
                                    <td class="text-center"> {{ $val }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <p class="mt-5">得勝分表及最終排名</p>
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <td class="text-center"></td>
                            @foreach ($得勝分表 as $各選手 => $val)
                                <td class="text-center">{{$各選手}}</td>
                            @endforeach
                            <td class="text-center">多數得勝分</td>
                            <td class="text-center">總計分別得勝分</td>
                            <td class="text-center">總計技術分</td>
                            <td class="text-center">總計得勝分</td>
                            <td class="text-center">總分</td>
                            <td class="text-center">排名</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($得勝分表 as $各選手 => $val)
                            <tr>
                                <td class="text-center">{{$各選手}}</td>
                                @foreach ($val as $var)
                                    <td class="text-center">{{$var}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        {{--                        @foreach ($評分表 as $選手)--}}
                        {{--                            <tr>--}}
                        {{--                                @foreach ($選手 as $val)--}}
                        {{--                                    <td class="text-center"> {{ $val }}</td>--}}
                        {{--                                @endforeach--}}
                        {{--                            </tr>--}}
                        {{--                        @endforeach--}}
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#m_select2_1").change(function () {
            var scheduleId = $(this).val();
            window.location = "{{ URL('admin/result/') }}/" + scheduleId
        });

        function submit() {
            $("#result-form").submit();
        }

        $(".resultInput").keyup(function (e) {
            if (e.which == 13) {
                $("#result-form").submit();
                return;
            }
        });
    </script>
@endsection
