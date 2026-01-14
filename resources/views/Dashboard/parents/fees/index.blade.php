@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.Accounters')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.Accounters')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.fees')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('parent.dashboard')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.fees')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('parent.pay.form',$student->id)}}"class="btn btn-warning btn-sm">
                              {{ trans('parent_trans.pay_now') }}
                            </a>
                            <br><br>
                            <div class="table-responsive">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="alert alert-info text-center">
                                            {{ trans('parent_trans.total_fees') }} <br>
                                            <strong>{{ $totalFees }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="alert alert-success text-center">
                                            {{ trans('parent_trans.paid') }} <br>
                                            <strong>{{ $paid }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="alert alert-danger text-center">
                                            {{ trans('parent_trans.remaining') }} <br>
                                            <strong>{{ $remaining }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('fee_trans.fee_name')}}</th>
                                            <th>{{trans('fee_trans.fee_amount')}}</th>
                                            <th>{{trans('fee_trans.fee_year')}}</th>
                                            <th>{{trans('fee_trans.fee_desc')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $fee)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$fee->name}}</td>
                                            <td>{{$fee->amount}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->desc}}</td>
                                            <td>{{$student->grade->name}}</td>
                                            <td>{{$student->classroom->name}}</td>

                                        </tr>

                                        @endforeach
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->


@endsection
@section('js')
@toastr_js
@toastr_render
@endsection