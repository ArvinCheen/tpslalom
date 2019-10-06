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
                                <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} {{ $schedule->number_of_player }}人</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-2">
                        <a href="{{ URL('admin/result\/') . ($scheduleId + 1) }}" class="btn btn-primary" > 下一場 </a>
                    </div>
                    <div class="ml-2">
                        <a href="{{ URL('admin/export/certificate') }}/{{$scheduleId}}"><button type="button" class="btn btn-primary"> 匯出獎狀 </button></a>
                    </div>
                    <div class="ml-2">
                        <form action="{{ route('admin.rank') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="scheduleId" value="{{ $scheduleId }}">
                            <button type="submit" class="btn btn-primary"> 排名 </button>
                        </form>
                    </div>
                </div>
                <form id="result-form" action="{{ URL('admin/result/update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="scheduleSn" value="{{ $scheduleId }}">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class=""></i> 順序
                            </th>
                            <th class="text-center">
                                <i class=""></i> 號碼
                            </th>
                            <th class="text-center">
                                <i class=""></i> 姓名
                            </th>
                            <th class="text-center">
                                <i class=""></i> 地區
                            </th>
                            <th class="text-center">
                                <i class=""></i> 單位
                            </th>
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
                                <i class=""></i> 積分
                            </th>
                            <th class="text-center">
                                <i class=""></i> 名次
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($enrolls as $key => $enroll)

                            <tr>
                                <td class="text-center"> {{ $enroll->appearance }} </td>
                                <td class="text-center"> {{ $enroll->player_number }} </td>
                                <td class="text-center"> {{ $enroll->player->name }} </td>
                                <td class="text-center"> {{ $enroll->player->city }} </td>
                                <td class="text-center"> {{ $enroll->player->agency }} </td>
                                {{--<td class="text-center"> <input name="roundOneSecond[]" type="text" class="text-center resultInput" size="8" value="{{ rand(5, 25) }}.{{ rand(1, 900) }}" autocomplete="off" > </td>--}}
                                {{--<td class="text-center"> <input name="roundOneMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ rand(0,7) }}" autocomplete="off"> </td>--}}
                                {{--<td class="text-center"> <input name="roundTwoSecond[]" type="text" class="text-center resultInput" size="8" value="{{ rand(5, 25) }}.{{ rand(1, 900) }}" autocomplete="off" > </td>--}}
                                {{--<td class="text-center"> <input name="roundTwoMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ rand(0,7) }}" autocomplete="off"> </td>--}}

                                <td class="text-center"> <input name="roundOneSecond[]" type="text" class="text-center resultInput roundOneSecond" size="8" value="{{ $enroll->round_one_second }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundOneMissConr[]" type="text" class="text-center resultInput roundOneMissConr" size="3" value="{{ $enroll->round_one_miss_conr }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundTwoSecond[]" type="text" class="text-center resultInput roundTwoSecond" size="8" value="{{ $enroll->round_two_second }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundTwoMissConr[]" type="text" class="text-center resultInput roundTwoMissConr" size="3" value="{{ $enroll->round_two_miss_conr }}" autocomplete="off" > </td>
                                <td class="text-center"> {{ $enroll->final_result }} </td>
                                <td class="text-center"> {{ $enroll->integral }} </td>
                                <td class="text-center"> {{ $enroll->rank }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @foreach ($enrolls as $key => $enroll)
                        <input type="hidden" name="enrollIds[]" value="{{ $enroll->id }}"}>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#m_select2_1").change(function() {
            var scheduleId = $(this).val();
            window.location = "{{ URL('admin/result/') }}/" + scheduleId
        });

        $(".resultInput").keyup(function(e) {
            if (e.which == 13) {
                $("#result-form").submit();
                return;
            }

            if ($(this).hasClass('roundOneSecond') || $(this).hasClass('roundTwoSecond')) {
                if ($(this).val().length == 5) {
                    $(this).parent().next().children().focus();
                }
            }

            if ($(this).hasClass('roundOneMissConr')) {
                if ($(this).val().length == 1) {
                    $(this).parent().next().children().focus();
                }
            }

            if ($(this).hasClass('roundTwoMissConr')) {
                if ($(this).val().length == 1) {
                    $(this).parent().parent().next().children().children().eq(0).focus();
                }
            }
        });
    </script>
@endsection
