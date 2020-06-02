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
                @foreach($groups as $key => $group)
                    <table class="table table-striped  table-advance table-hover" style="cursor: pointer;" data-toggle="collapse" href="#{{ $key }}collapse" aria-expanded="false"
                           aria-controls="{{ $key }}collapse">
                        <tr>
                            <td>{{ $group->order }} {{ $group->group }} {{ $group->gender }} {{ $group->item }}</td>
                        </tr>
                        <tr>
                            <td>共 {{ $group->number_of_player }} 人</td>
                        </tr>
                    </table>
                    <div class="collapse" id="{{ $key }}collapse">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead class="thead-inverse">
                            </thead>
                            <tbody>
                            @foreach ($group->players as $player)
                                <tr>
                                    <td class="" style="border:1px solid">
                                        {{ $player->player_number }} {{ $player->player->name }} ({{ $player->player->city . $player->player->agency }})
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--                    <br>--}}
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
