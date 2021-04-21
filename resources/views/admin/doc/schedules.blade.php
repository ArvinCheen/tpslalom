@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 賽程表 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="mh mb-5">
            <div class="container">
                <div class="col-md-12">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td> 場次</td>
                            @if (env('GAME') <> 13)
                                <td> 級別</td>
                                <td> 組別</td>
                            @endif
                            <td> 性別</td>
                            <td> 項目</td>
                            <td> 人數</td>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td> {{ $schedule->order }} </td>
                                @if (env('GAME') <> 13)
                                    <td> {{ $schedule->level }} </td>
                                    <td> {{ $schedule->group }} </td>
                                @endif
                                <td> {{ $schedule->gender }} </td>
                                <td> {{ $schedule->item }} </td>
                                <td> {{ $schedule->number_of_player }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
