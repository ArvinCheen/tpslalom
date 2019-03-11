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
                @foreach($groupLists as $val)
                    <table class="table mb-4" >
                        <tr>
                            <td>{{ $val->order }}</td>
                        </tr>
                        <tr>
                            <td>【{{ $val->level }}】{{ $val->group }}{{ $val->gender }}{{ $val->item }}</td>
                        </tr>
                        <tr>
                            <td>共 {{ $val->numberOfPlayer }} 人</td>
                        </tr>

                        @foreach ($val->playerList as $playerList)
                            <tr>
                                <td class="" style="border:1px solid">
                                    {{ $playerList->playerNumber }} {{ $playerList->name }} ({{ $playerList->city . $playerList->agency }})
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
