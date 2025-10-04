@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('sidebar_trans.Apperance_report') }}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0"> {{ trans('sidebar_trans.Apperance_report') }}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active"> {{ trans('sidebar_trans.Apperance_report') }}</li>
            </ol>
        </div>
    </div>
</div>


@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">


            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="acd-des">
                        <div class="row">
                            <div class="col-xl-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <div class="d-block d-md-flex justify-content-between">
                                            <div class="d-block">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table 
                                            class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th class="alert-success">#</th>
                                                        <th class="alert-success">{{trans('Students_trans.name')}}</th>
                                                        <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                                                        <th class="alert-success">{{trans('Students_trans.section')}}</th>
                                                        <th class="alert-success">{{trans('Students_trans.Date')}}</th>
                                                        <th class="alert-warning">{{trans('Students_trans.status')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Students as $student)
                                                    <tr>
                                                        <td>{{ $loop->index+1 }}</td>
                                                        <td>{{$student->students->name}}</td>
                                                        <td>{{$student->Grade->name}}</td>
                                                        <td>{{$student->Section->section_name}}</td>
                                                        <td>{{$student->attendence_date}}</td>
                                                        <td>

                                                            @if($student->attendence_status == 0)
                                                            <span class="btn-danger">{{trans('Students_trans.absence')}}</span>
                                                            @else
                                                            <span class="btn-success">{{trans('Students_trans.presence')}}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                            </table>

                                            {{ $Students->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection

                @endsection
                @section('js')

                @endsection