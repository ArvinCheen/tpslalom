@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title"> 獎狀總覽 </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="mh mb-5">
            <div class="container">
                <div class="col-md-12">
                    @foreach($teams as $team)
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td>隊伍</td>
                            <td>選手姓名 </td>
                            <td>場次 </td>
                            <td>性別 </td>
                            <td>級別 </td>
                            <td>組別 </td>
                            <td>項目 </td>
                            <td>名次 </td>
                        </tr>
                        @foreach($team->certificate as $certificate)

{{--                            {{ dd($team) }}--}}
                            <tr>
                                <td>{{ $certificate->team_name }}</td>
                                <td>{{ $certificate->name }}</td>
                                <td>{{ $certificate->order }}</td>
                                <td>{{ $certificate->gender }}</td>
                                <td>{{ $certificate->level }}</td>
                                <td>{{ $certificate->group }}</td>
                                <td>{{ $certificate->item }}</td>
                                <td>{{ $certificate->rank }}</td>
                            </tr>
                        @endforeach
                    </table>
                        <br>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
