@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
@toastr_css
@section('title')
{{trans('Students_trans.liberary')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.liberary')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.liberary')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.liberary')}}</li>
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
                         <div>
                         <div>
                            <br><br>

                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.book_title')}}</th>
                                            <th>{{trans('Students_trans.fileName')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($liberaries as $liberary)
                                        
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$liberary->title }}</td>
                                            <td>
                                                <embed src="{{ URL::asset('storage/'.$liberary->file_name) }}" height="100px" width="200px"><br><br>
                                               <a href="{{ route('student.download.book', ['path' => $liberary->file_name]) }}" title="{{__('Students_trans.download book')}}" 
                                               class="btn btn-success" role="button" aria-pressed="true"><i class="fa-solid fa-download"></i></a>
                                            </td>
                                            <td>{{$liberary->grade->name}}</td>
                                            <td>{{$liberary->classroom->name }}</td>
                                            <td>{{$liberary->section->section_name}}</td>
                                            
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