@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
                <h3> 第一天 </h3>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedulesFirstDay as $scheduleFD)
                        <tr>
                            <td> {{ $scheduleFD->order }} </td>
                            <td> {{ $scheduleFD->group }} </td>
                            <td> {{ $scheduleFD->gender }} </td>
                            <td> {{ $scheduleFD->item }} </td>
                            <td> {{ $scheduleFD->number_of_player }} </td>
                        </tr>
                        <tr >
                            <td colspan="5 text-center"> 檢錄．完賽排名．獎狀列印 </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="mt-5 mb-5 text-center">
                <h2> 賽程表 </h2>
                <h3> 第二天 </h3>
            </div>
            <div class="col-md-12">
                <table class="col-md-12 table table-striped table-dark">
                    <tr>
                        <td> 場次</td>
                        <td> 組別</td>
                        <td> 性別</td>
                        <td> 項目</td>
                        <td> 人數</td>
                    </tr>
                    @foreach($schedulesSecondDay as $scheduleSD)
                        <tr>
                            <td> {{ $scheduleSD->order }} </td>
                            <td> {{ $scheduleSD->group }} </td>
                            <td> {{ $scheduleSD->gender }} </td>
                            <td> {{ $scheduleSD->item }} </td>
                            <td> {{ $scheduleSD->number_of_player }} </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
