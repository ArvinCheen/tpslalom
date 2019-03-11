@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 團隊名冊 </h2>
            </div>
            <div class="col-md-12">

                @foreach($teamLists as $val)
                    <table class="col-md-3 table mb-4" align="center">
                        <tbody>
                        <tr>
                            <td colspan="3"> 隊伍：{{ $val->teamName }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 教練：{{ $val->coach }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 領隊：{{ $val->leader }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 經理：{{ $val->management }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 選手人數及名冊：{{ count($val->playerList) }} 人 </td>
                        </tr>

                        @foreach ($val->playerList as $playerList)
                            <tr>
                                <td class="" style="border:1px solid">
                                    {{ $playerList->playerNumber }} {{ $playerList->name }} ({{ $playerList->city . $playerList->agency }})
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
