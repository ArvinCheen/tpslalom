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
                            <th style="width:50px"> 選手號碼</th>
                            <th style="width:80px"> 姓名</th>
                            <th style="width:80px"> 級別</th>
                            <th style="width:100px"> 組別</th>
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
                                <td> {{ is_null($val->player_number) ? '未抽籤' : $val->player_number }} </td>
                                <td> {{ $val->player->name }} </td>
                                <td> {{ $val->level }} </td>
                                <td> {{ $val->group }} </td>
                                <td> {{ $val->gender }} </td>
                                <td>
                                    @foreach($val->itemAll as $key => $item)
                                        {{$key + 1}}. {{$item}}<br>
                                    @endforeach
                                </td>
                                <td> {{ $val->player->city }} </td>
                                <td> {{ $val->player->agency }} </td>
                                <td> {{ $val->account->coach }} </td>
                                <td> {{ $val->account->leader }} </td>
                                <td> {{ $val->account->manager }} </td>
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
