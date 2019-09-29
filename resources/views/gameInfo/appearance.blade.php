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
