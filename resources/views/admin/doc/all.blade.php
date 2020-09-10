@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"> 總冊 <small>共 {{ count($all) }} 人</small> </h3>
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
                            <th> 組別 </th>
                            <th> 性別 </th>
                            <th> 項目 </th>
                            <th> 隊名 </th>
                            <th> 教練 </th>
                            <th> 領隊 </th>
                            <th> 經理 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all as $item)
                            <tr>
                                <td> {{ $item->player_number }} </td>
                                <td> {{ $item->name }} </td>
                                <td> {{ $item->group }} </td>
                                <td> {{ $item->gender }} </td>
                                <td> {{ str_replace(','," / ",$item->itemAll) }} </td>
                                <td> {{ $item->agency }} </td>
                                <td> {{ $item->coach }} </td>
                                <td> {{ $item->leader }} </td>
                                <td> {{ $item->manager }} </td>
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
