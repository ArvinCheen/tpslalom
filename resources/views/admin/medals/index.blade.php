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
                            <td> 金牌 </td>
                            <td> 銀牌 </td>
                            <td> 銅牌 </td>
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
                            <td> 性別 </td>
                            <td> 級別 </td>
                            <td> 組別 </td>
                            <td> 項目 </td>
                            <td> 縣市 </td>
                            <td> 人數 </td>
                            <td> 金牌 </td>
                            <td> 銀牌 </td>
                            <td> 銅牌 </td>
                        </tr>
                        @foreach($medalData as $val)
                            <tr>
                                <td> {{ $val->gender }} </td>
                                <td> {{ $val->level }} </td>
                                <td> {{ $val->group }} </td>
                                <td> {{ $val->item }} </td>
                                <td> {{ $val->city }} </td>
                                <td> {{ $val->quantity }} </td>
                                <td> {{ $val->gold }} </td>
                                <td> {{ $val->silver }} </td>
                                <td> {{ $val->copper }} </td>
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