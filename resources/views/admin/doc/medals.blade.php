@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title">獎牌數量</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-3">
                <div class="portlet-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td> 金牌</td>
                            <td> 銀牌</td>
                            <td> 銅牌</td>
                        </tr>
                        <tr>
                            <td> {{ $goldTotal }} </td>
                            <td> {{ $silverTotal }} </td>
                            <td> {{ $copperTotal }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td> 場次</td>
                            <td> 組別</td>
                            <td> 性別</td>
                            <td> 項目</td>
                            <td> 人數</td>
                            <td class="text-center"> 金牌</td>
                            <td class="text-center"> 銀牌</td>
                            <td class="text-center"> 銅牌</td>
                        </tr>
                        @foreach($medalData as $val)
                            <tr>
                                <td> {{ $val->order }} </td>
                                <td> {{ $val->group }} </td>
                                <td> {{ $val->gender }} </td>
                                <td> {{ $val->item }} </td>
                                <td> {{ $val->number_of_player }} </td>
                                <td class="text-center">
                                    @if ($val->number_of_player >= 1)
                                        v
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($val->number_of_player >= 2)
                                        v
                                    @endif

                                </td>
                                <td class="text-center">
                                    @if ($val->number_of_player >= 3)
                                        v
                                    @endif
                                </td>
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
