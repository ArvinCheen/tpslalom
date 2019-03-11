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
                        <select class="form-control m-select2" id="m_select2_1" name="scheduleSn">
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->scheduleSn }}" {{ $scheduleSn == $schedule->scheduleSn ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} {{ $schedule->numberOfPlayer }}人</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <a href="{{ URL('admin/export/certificate') }}/{{$scheduleSn}}"><button type="button" class="btn btn-primary"> 匯出獎狀 </button></a>
                    </div>
                    <div class="ml-2">
                        <a onclick="gameOver()"><button type="button" class="btn btn-primary"> 排名 </button></a>
                    </div>
                </div>
                <form id="result-form" action="{{ URL('admin/result/updateResult') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="scheduleSn" value="{{ $scheduleSn }}">
                    <input type="hidden" name="isGameOver">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class=""></i> 名次
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($players as $key => $val)
                            <input type="hidden" name="enrollSn[]" value="{{ $val->enrollSn }}"}>
                            <tr>
                                <td class="text-center"> {{ $val->rank }} </td>
                                <td class="text-center"> {{ $val->playerNumber }} </td>
                                <td class="text-center"> {{ $val->name }} </td>
                                <td class="text-center"> {{ $val->city }} </td>
                                <td class="text-center"> {{ $val->agency }} </td>
                                {{--<td class="text-center"> <input name="roundOneSecond[]" type="text" class="text-center resultInput" size="8" value="{{ rand(5, 25) }}.{{ rand(1, 900) }}" autocomplete="off" > </td>--}}
                                {{--<td class="text-center"> <input name="roundOneMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ rand(0,7) }}" autocomplete="off"> </td>--}}
                                {{--<td class="text-center"> <input name="roundTwoSecond[]" type="text" class="text-center resultInput" size="8" value="{{ rand(5, 25) }}.{{ rand(1, 900) }}" autocomplete="off" > </td>--}}
                                {{--<td class="text-center"> <input name="roundTwoMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ rand(0,7) }}" autocomplete="off"> </td>--}}

                                <td class="text-center"> <input name="roundOneSecond[]" type="text" class="text-center resultInput" size="8" value="{{ $val->roundOneSecond }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundOneMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ $val->roundOneMissConr }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundTwoSecond[]" type="text" class="text-center resultInput" size="8" value="{{ $val->roundTwoSecond }}" autocomplete="off" > </td>
                                <td class="text-center"> <input name="roundTwoMissConr[]" type="text" class="text-center resultInput" size="3" value="{{ $val->roundTwoMissConr }}" autocomplete="off" > </td>
                                <td class="text-center"> {{ $val->finalResult }} </td>
                                <td class="text-center"> {{ $val->integral }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#m_select2_1").change(function() {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('admin/result/') }}/" + scheduleSn
        });

        $(".resultInput").keydown(function(e) {
            if (e.which == 13) {
                $("#result-form").submit();
            }
        })

        function gameOver() {
            $("input[name='isGameOver']").val(1);
            $("#result-form").submit();
        }
    </script>
@endsection