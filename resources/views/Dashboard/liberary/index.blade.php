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
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
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
                                <a href="{{route('liberary.create')}}" class="btn btn-success" role="button"
                                    aria-pressed="true">{{trans('Students_trans.Add_new_liberary')}}
                                </a>
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
                                                    <th>{{trans('section_trans.Teacher_name')}}</th>
                                                    <th>{{trans('Students_trans.Actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($liberaries as $liberary)

                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>{{$liberary->title }}</td>
                                                    <td>
                                                        <embed src="{{ URL::asset('storage/'.$liberary->file_name) }}" height="100px" width="200px"><br><br>
                                                        <a href="{{ route('download.book', ['path' => $liberary->file_name]) }}" title="{{__('Students_trans.download book')}}"
                                                            class="btn btn-success" role="button" aria-pressed="true"><i class="fa-solid fa-download"></i></a>
                                                        <!-- <a href="{{ URL::asset('storage/'.$liberary->file_name) }}" title="{{__('Students_trans.download book')}}" 
                                               class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa-solid fa-download"></i></a> -->
                                                    </td>
                                                    <td>{{$liberary->grade->name}}</td>
                                                    <td>{{$liberary->classroom->name }}</td>
                                                    <td>{{$liberary->section->section_name}}</td>
                                                    <td>{{$liberary->teacher->name ?? 'ahmed'}}</td>

                                                    <td>
                                                        <a href="{{route('liberary.edit',$liberary->id)}}"
                                                            class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_liberary{{ $liberary->id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- Deleted inFormation Student -->
                                                <div class="modal fade" id="delete_liberary{{ $liberary->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Delete')}}
                                                                    <span style="font-family:Cairo;color:blue;">{{$liberary->title}}</span>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('liberary.destroy','Delete')}}"
                                                                    method="post">
                                                                    {{method_field('delete')}}
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="id" value="{{$liberary->id}}">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Delete_liberary')}}
                                                                    </h5>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                        <button
                                                                            class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                        </table>
                                        <div class="mt-3 d-flex justify-content-center">
                                            {{ $liberaries->links() }}
                                        </div>
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