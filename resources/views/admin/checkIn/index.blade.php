@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title">檢錄</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group m-form__group row">
                    <div class="col-md-9 ">
                        <select class="form-control m-select2" id="m_select2_1" name="scheduleSn">
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->scheduleSn }}" {{ $scheduleSn == $schedule->scheduleSn ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}  {{ $schedule->item }} {{ $schedule->numberOfPlayer }}人</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <form id="result-form" action="{{ URL('admin/checkIn/update') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th> 號碼 </th>
                            <th> 名稱 </th>
                            <th> 單位 </th>
                            <th> 檢錄 </th>
                            <th> 檢錄時間 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($players as $player)
                            <tr>
                                <td> {{ $player->playerNumber }} </td>
                                <td> {{ $player->name }} </td>
                                <td> {{ $player->agency }} </td>
                                <td>
                                    <span class="m-switch m-switch--sm m-switch--icon m-switch--warning">
                                        <label class="m-0">

                                            <input type="checkbox" {{ $player->check == '出賽' ? 'checked' : null }} onclick="checkIn({{ $player->playerSn }}, '{{ $player->check }}')">

                                            <span class="m-0"></span>
                                        </label>
                                    </span>
                                </td>
                                <td class="w-25"> {{ $player->checkInTime }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <form id="checkInForm" action="{{ URL('admin/checkIn/update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="playerSn">
        <input type="hidden" name="checkStatus">
        <input type="hidden" name="scheduleSn" value="{{ $scheduleSn }}">
    </form>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#m_select2_1").change(function() {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('admin/checkIn') }}/" + scheduleSn
        });


        function checkIn(playerSn, checkStatus) {
            if (checkStatus === '未到') {
                $("input[name='checkStatus']").val('出賽');
            }

            if (checkStatus === '出賽') {
                $("input[name='checkStatus']").val('未到');
            }

            $("input[name='playerSn']").val(playerSn);
            $("#checkInForm").submit();
        }
    </script>
@endsection