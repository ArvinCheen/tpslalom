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
                                <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}  {{ $schedule->item }} {{ $schedule->number_of_player }}人</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="checkIn()"> 檢錄 </button>
                    </div>
                </div>
                <form id="checkInForm" action="{{ URL('admin/checkIn/update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
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
                        @foreach ($enrolls as $enroll)
                            <tr>
                                <td> {{ $enroll->player_number }} </td>
                                <td> {{ $enroll->player->name }} </td>
                                <td> {{ $enroll->player->agency }} </td>
                                <td>
                                    <span class="m-switch m-switch--sm m-switch--icon m-switch--warning">
                                        <label class="m-0">
                                            <input type="checkbox" name="checkInIds[]" {{ $enroll->check ? 'checked' : null }} value="{{ $enroll->id }}">
                                            <input type="hidden" name="enrollIds[]" checked value="{{ $enroll->id }}">
                                            <span class="m-0"></span>
                                        </label>
                                    </span>
                                </td>
                                <td class="w-25"> {{ $enroll->check_in_time }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>

                <div>
                    <button type="button" class="btn btn-primary" onclick="checkIn()"> 檢錄 </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#m_select2_1").change(function() {
            var scheduleId = $(this).val();
            window.location = "{{ URL('admin/checkIn') }}/" + scheduleId
        });

        function checkIn() {
            $("#checkInForm").submit();
        }
    </script>
@endsection
