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
                                    - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組 {{ $schedule->item }} {{ $schedule->number_of_player }}人
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
                    @if($model <> 'freeStyle')
                    table
                     @endif
                        table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class=""></i> 號碼
                            </th>
                            <th class="text-center">
                                <i class=""></i> 姓名
                            </th>
                            <th class="text-center">
                                <i class=""></i> 單位
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
                                @break
                                @case('pk')
                                @break
                                @case('freeStyle')
                                <th class="text-center">
                                    <i class=""></i> 技術1
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 藝術1
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 總分1
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 技術2
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 藝術2
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 總分2
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 技術3
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 藝術3
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 總分3
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 技術4
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 藝術4
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 總分4
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 技術5
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 藝術5
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 總分5
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 罰分
                                </th>
                                <th class="text-center">
                                    <i class=""></i> 名次
                                </th>
                                @break
                            @endswitch
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($enrolls as $key => $enroll)
                            <tr>
                                <td class="text-center"> {{ $enroll->player_number }}</td>
                                <td class="text-center"> {{ $enroll->player->name }} </td>
                                <td class="text-center"> {{ $enroll->player->agency }} </td>
                                @switch ($model)
                                    @case('speed')
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
                                    @break
                                    @case('pk')
                                    @break
                                    @case('freeStyle')

                                    <td class="text-center"><input name="skill_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_1 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_1 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="score_1[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_1 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="skill_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_2 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_2 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="score_2[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_2 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="skill_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_3 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_3 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="score_3[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_3 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="skill_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_4 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_4 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="score_4[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_4 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="skill_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->skill_5 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="art_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->art_5 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="score_5[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->score_5 }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="punish[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->punish }}" autocomplete="off"></td>
                                    <td class="text-center"><input name="rank[]" type="text" class="text-center resultInput " size="3" value="{{ $enroll->rank }}" autocomplete="off"></td>
                                    @break
                                @endswitch
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    @foreach ($enrolls as $key => $enroll)
                        <input type="hidden" name="enrollIds[]" value="{{ $enroll->id }}" }>
                    @endforeach
                </form>
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
