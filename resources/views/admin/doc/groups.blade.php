@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 分組名冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    @foreach($groups as $group)
                        <table class="table mb-0">
                            <tr>
                                <td>{{ $group->order }} </td>
                                <td class="text-center">{{ $group->group }} {{ $group->gender }}子組 {{ $group->item }}</td>
                                <td class="text-right">共 {{ $group->number_of_player }} 人</td>
                            </tr>
                        </table>
                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($group->players))
                                <tr>
                                    <td class="w-20">
                                        @if (isset($group->players[$i]))
                                            {{ $group->players[$i]->player_number }} {{ $group->players[$i]->name }} ({{ $group->players[$i]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($group->players[$i + 1]))
                                            {{ $group->players[$i + 1]->player_number }} {{ $group->players[$i + 1]->name }} ({{ $group->players[$i + 1]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($group->players[$i + 2]))
                                            {{ $group->players[$i + 2]->player_number }} {{ $group->players[$i + 2]->name }} ({{ $group->players[$i + 2]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($group->players[$i + 3]))
                                            {{ $group->players[$i + 3]->player_number }} {{ $group->players[$i + 3]->name }} ({{ $group->players[$i + 3]->agency }})
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @if (isset($group->players[$i + 4]))
                                            {{ $group->players[$i + 4]->player_number }} {{ $group->players[$i + 4]->name }} ({{ $group->players[$i + 4]->agency }})
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 5
                                @endphp
                            @endwhile
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
