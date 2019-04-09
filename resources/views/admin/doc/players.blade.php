@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 選手列表 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <h6>前進雙足S型 - {{ count($players->doubleS) }} 人</h6>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                <tr>
                                    <th> 姓名</th>
                                    <th> 性別</th>
                                    <th> 級別</th>
                                    <th> 組別</th>
                                    <th> 項目</th>
                                    <th> 教練</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($players->doubleS as $player)
                                    <tr>
                                        <td> {{ $player->name }}（{{ $player->player_number }}）</td>
                                        <td> {{ $player->gender }} </td>
                                        <td> {{ $player->level }} </td>
                                        <td> {{ $player->group }} </td>
                                        <td> {{ $player->item }} </td>
                                        <td> {{ $player->coach }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <h6>前進單足S型 - {{ count($players->singleS) }} 人</h6>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                <tr>
                                    <th> 姓名</th>
                                    <th> 性別</th>
                                    <th> 級別</th>
                                    <th> 組別</th>
                                    <th> 項目</th>
                                    <th> 教練</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($players->singleS as $player)
                                    <tr>
                                        <td> {{ $player->name }}（{{ $player->player_number }}）</td>
                                        <td> {{ $player->gender }} </td>
                                        <td> {{ $player->level }} </td>
                                        <td> {{ $player->group }} </td>
                                        <td> {{ $player->item }} </td>
                                        <td> {{ $player->coach }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <h6>前進交叉型 - {{ count($players->cross) }} 人</h6>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                <tr>
                                    <th> 姓名</th>
                                    <th> 性別</th>
                                    <th> 級別</th>
                                    <th> 組別</th>
                                    <th> 項目</th>
                                    <th> 教練</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($players->cross as $player)
                                    <tr>
                                        <td> {{ $player->name }}（{{ $player->player_number }}）</td>
                                        <td> {{ $player->gender }} </td>
                                        <td> {{ $player->level }} </td>
                                        <td> {{ $player->group }} </td>
                                        <td> {{ $player->item }} </td>
                                        <td> {{ $player->coach }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
