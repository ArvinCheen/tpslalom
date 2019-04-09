@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 級別</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td> {{ $schedule->order }} </td>
                            <td> {{ $schedule->level }} </td>
                            <td> {{ $schedule->group }} </td>
                            <td> {{ $schedule->gender }} </td>
                            <td> {{ $schedule->item }} </td>
                            <td> {{ $schedule->number_of_player }} </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
