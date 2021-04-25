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
                            <th style="width:50px"> 選手號碼 </th>
                            <th style="width:80px"> 姓名 </th>

                            @if (env('GAME') == 13)
                                <th style="width:80px"> 身份證字號 </th>
                                <th style="width:80px"> 生日 </th>
                                <th style="width:80px"> 家長 </th>
                            @endif

                            @if (env('GAME') <> 13)
                                <th style="width:80px"> 級別 </th>
                                <th style="width:100px"> 組別 </th>
                            @endif
                            <th style="width:50px"> 性別 </th>
                            <th style="width:150px"> 項目 </th>
                            <th style="width:80px"> 縣市 </th>
                            <th style="width:80px"> 單位 </th>
                            <th style="width:80px"> 團隊 </th>
                            <th style="width:50px"> 教練 </th>
                            <th style="width:50px"> 領隊 </th>
                            <th style="width:50px"> 經理 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all as $val)
                            <tr>
                                <td> {{ is_null($val->player_number) ? '未抽籤' : $val->player_number }} </td>
                                <td> {{ $val->player->name }} </td>
                                
                                @if (env('GAME')== 13)
                                    <td style="width:80px"> {{ $val->player->identity_id }} </td>
                                    <td style="width:120px"> {{ date_format(date_create($val->player->birthday),'Y-m-d') }} </td>
                                    <td style="width:80px"> {{ $val->player->parent }} </td>
                                @endif

                                @if (env('GAME') <> 13)
                                    <td> {{ $val->level }} </td>
                                    <td> {{ $val->group }} </td>
                                @endif

                                <td> {{ $val->gender }} </td>
                                <td>
                                    @foreach($val->itemAll as $key => $item)
                                        {{ $key + 1 }}. {{ $item }} {{ $val->sound }}<br>
                                    @endforeach
                                </td>
                                <td> {{ $val->player->city }} </td>
                                <td> {{ $val->player->agency }} </td>
                                <td> {{ $val->account->team_name }} </td>
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
