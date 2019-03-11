@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"> 總冊 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> 選手號碼 </th>
                            <th> 姓名 </th>
                            <th> 級別 </th>
                            <th> 組別 </th>
                            <th> 性別 </th>
                            <th> 項目一 </th>
                            <th> 項目二 </th>
                            <th> 項目三 </th>
                            <th> 隊名 </th>
                            <th> 單位 </th>
                            <th> 地區 </th>
                            <th> 教練 </th>
                            <th> 領隊 </th>
                            <th> 經理 </th>
                            <th> 報名費 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allDoc as $val)
                            <tr>
                                <td> {{ $val->playerNumber }} </td>
                                <td> {{ $val->name }} </td>
                                <td> {{ $val->level }} </td>
                                <td> {{ $val->group }} </td>
                                <td> {{ $val->gender }} </td>
                                <td> {{ $val->doubleS }} </td>
                                <td> {{ $val->singleS }} </td>
                                <td> {{ $val->cross }} </td>
                                <td> {{ $val->teamName }} </td>
                                <td> {{ $val->agency }} </td>
                                <td> {{ $val->city }} </td>
                                <td> {{ $val->coach }} </td>
                                <td> {{ $val->leader }} </td>
                                <td> {{ $val->management }} </td>
                                <td> {{ $val->fee }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection