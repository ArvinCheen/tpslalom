@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"> 總冊
                    <small>共 {{ count($all) }} 人</small>
                </h3>
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
                            <th> 選手號碼</th>
                            <th style="width:80px"> 姓名</th>
                            <th> 組別</th>
                            <th style="width:50px"> 性別</th>
                            <th style="width:240px"> 項目</th>
                            <th style="width:80px"> 縣市</th>
                            <th> 單位</th>
                            <th style="width:80px"> 教練</th>
                            <th style="width:80px"> 領隊</th>
                            <th style="width:80px"> 經理</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all as $val)
                            <tr>
                                <td> {{ $val->player_number }} </td>
                                <td> {{ $val->name }} </td>
                                <td> {{ $val->group }} </td>
                                <td> {{ $val->gender }} </td>
                                <td>
                                    @foreach($val->itemAll as $key => $item)
                                        {{$key + 1}}. {{$item}}<br>
                                    @endforeach
                                </td>
                                <td> {{ $val->city }} </td>
                                <td> {{ $val->agency }} </td>
                                <td> {{ $val->coach }} </td>
                                <td> {{ $val->leader }} </td>
                                <td> {{ $val->manager }} </td>
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
