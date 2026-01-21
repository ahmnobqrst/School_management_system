@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.lecture_zoom')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.lecture_zoom')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.lecture_zoom')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.lecture_zoom')}}</li>
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
                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                    <th>{{trans('Students_trans.section')}}</th>
                                                    <th>{{trans('section_trans.Teacher_name')}}</th>
                                                    <th>{{trans('Students_trans.Topic')}}</th>
                                                    <th>{{trans('Students_trans.start_at')}}</th>
                                                    <th>{{trans('Students_trans.Duration')}}</th>
                                                    <th>{{trans('Students_trans.Url_Join')}}</th>
                                                    <th>{{trans('Students_trans.Actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($online_classes as $online_classe)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$online_classe->grade->name}}</td>
                                                    <td>{{ $online_classe->classroom->name }}</td>
                                                    <td>{{$online_classe->section->section_name}}</td>
                                                    <td>{{$online_classe->created_by}} - {{where($online_classe->user?->email,$online_classe->created_by)}}</td>
                                                    <td>{{$online_classe->topic}}</td>
                                                    <td>{{$online_classe->start_at}}</td>
                                                    <td>{{$online_classe->duration}}</td>
                                                    <td><a href="{{$online_classe->join_url}}" target="_blank" class="text-danger">{{trans('Students_trans.Join')}}</a></td>
                                                    <!-- <td class="text-danger"><a href="{{$online_classe->join_url}}"
                                                    target="_blank"> <th>{{trans('Students_trans.Join')}}</th></a>
                                            </td>-->
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_receipt{{$online_classe->meeting_id}}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- Deleted inFormation Student -->
                                                <div class="modal fade" id="Delete_receipt{{$online_classe->meeting_id}}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Delete')}}
                                                                    <span style="font-family:Cairo;color:blue;">{{$online_classe->topic}}</span>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('online_classes.destroy','Delete')}}"
                                                                    method="post">
                                                                    {{method_field('delete')}}
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="meeting_id" value="{{$online_classe->meeting_id}}">
                                                                    <input type="hidden" name="id" value="{{$online_classe->id}}">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Delete_class')}}
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
                                            {{ $online_classes->links() }}
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