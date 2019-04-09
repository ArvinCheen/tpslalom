@extends('layout')

@section('css')

@endsection

@section('content')

    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 分組名冊 </h2>
            </div>
            <div class="col-md-12">
                @foreach($groups as $group)
                    <table class="table mb-4" >
                        <tr>
                            <td>{{ $group->order }}</td>
                        </tr>
                        <tr>
                            <td>【{{ $group->level }}】{{ $group->group }} {{ $group->gender }} {{ $group->item }}</td>
                        </tr>
                        <tr>
                            <td>共 {{ $group->number_of_player }} 人</td>
                        </tr>

                        @foreach ($group->players as $player)
                            <tr>
                                <td class="" style="border:1px solid">
                                    {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency }})
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
