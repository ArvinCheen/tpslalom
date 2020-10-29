@extends('admin.layout')

@section('css')

@endsection

@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"> 對帳單 </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-money"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">{{ number_format($total) }} 元</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td> 隊名 </td>
                            <td> 電話 </td>
                            <td> 地址 </td>
                            <td> 教練/領隊/經理 </td>
                            <td> 費用 </td>
                        </tr>
                        @foreach($bills as $bill)
                            <tr>
                                <td> {{ $bill->account->team_name }} </td>
                                <td> {{ $bill->account->phone }} </td>
                                <td> {{ $bill->account->address }} </td>
                                <td> {{ $bill->account->coach }} / {{ $bill->account->leader }} / {{ $bill->account->manager }} </td>
                                <td> {{ number_format($bill->totalFee) }} </td>
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
