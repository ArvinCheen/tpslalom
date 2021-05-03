@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 隊伍名冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    @foreach($agencies as $agency)
                        <table class="table mb-0">
                            <tr>
                                <td colspan="5" class="w-25"> {{ $agency->agency }} - {{ count($agency->players) }} 人參賽
                                     {{-- / 教練：{{ $agency->account->coach }}　/　領隊：{{ $agency->account->leader }}　/　經理：{{ $agency->account->management }} --}}
                                    </td>
                                <td class="w-25 text-right"> <a href="{{ URL('admin/export/completion') }}/{{ $agency->account_id }}"></td>
                            </tr>
                        </table>

                        <table class="table table-bordered m-table m-table--border-tpslalom mb-4">
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @while($i < count($agency->players))
                                <tr>
                                    <td class="w-50">
                                        @if (isset($agency->players[$i]))
                                            {{ $agency->players[$i]->name }}
                                        @endif
                                    </td>
                                    <td class="w-50">
                                        @if (isset($agency->players[$i + 1]))
                                            {{ $agency->players[$i + 1]->name }}
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i += 2
                                @endphp
                            @endwhile
                            </tbody>
                        </table>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
