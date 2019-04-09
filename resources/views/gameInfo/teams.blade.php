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

                @foreach($teams as $team)
                    <table class="col-md-3 table mb-4" align="center">
                        <tbody>
                        <tr>
                            <td colspan="3"> 隊伍：{{ $team->account->team_name }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 教練：{{ $team->account->coach }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 領隊：{{ $team->account->leader }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 經理：{{ $team->account->management }} </td>
                        </tr>
                        <tr>
                            <td colspan="3"> 選手人數及名冊：{{ count($team->players) }} 人 </td>
                        </tr>

                        @foreach ($team->players as $player)
                            <tr>
                                <td class="" style="border:1px solid">
                                    {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency }})
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
