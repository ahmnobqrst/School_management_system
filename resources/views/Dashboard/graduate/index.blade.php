@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Students_graduation')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Students_graduation')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Students_graduation')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('graduates.index')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Students_graduation')}}</li>
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
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.student_name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->Gender->name}}</td>
                                            <td>{{$student->Grade->name}}</td>
                                            <td>{{$student->Classroom->name}}</td>
                                            <td>{{$student->Section->section_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Rollback_Student{{ $student->id }}" title="{{__('Students_trans.Rollback')}}">{{__('Students_trans.Rollback')}}</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title="{{trans('Students_trans.Delete')}}">{{trans('Students_trans.Delete')}}</button>
                                            </td>
                                        </tr>


                                        <!-------------------------------------------------- Modal for Delete Stuent --------------------------------------------->

                                        <div class="modal fade" id="Delete_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Deleted_Student')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('graduates.destroy',$student->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id" value="{{$student->id}}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Deleted_Student_tilte')}}</h5>
                                                            <input type="text" readonly value="{{$student->name}}" class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------------------------------ End modal For Delete Sudent -------------------------->


                                        <!-------------------------------------------------- Modal for Rollback Stuent --------------------------------------------->

                                        <div class="modal fade" id="Rollback_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Rollback')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('graduates.update','test')}}" method="post" autocomplete="off">
                                                            @method('PUT')
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$student->id}}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Are you Sure!?')}}</h5>
                                                            <input type="text" readonly value="{{$student->name}}" class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------------------------------ End modal For Rollback Sudent -------------------------->


                                        @endforeach
                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $students->links() }}
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