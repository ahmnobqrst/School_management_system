@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.Grade_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.Grade_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('grades.index')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.Grades')}}</li>
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
                            <a href="{{route('grades.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('grades_trans.add_grade')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('grades_trans.grade_name')}}</th>
                                            <th scope="col">{{trans('grades_trans.description')}}</th>
                                            <th scope="col">{{trans('grades_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grades as $grade)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$grade->name}}</td>
                                            <td>{{$grade->desc}}</td>
                                            <td>
                                                <a href="{{route('grades.edit',$grade->id)}}" class="btn btn-outline-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button id="deleteBtn" class="btn btn-outline-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#delete{{ $grade->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>



                                        </tr>


                                        <!-------------------------------------- the modal for delete Grade ------------------------------------------------>


                                        <div class="modal" tabindex="-1" role="dialog" id="delete{{ $grade->id }}">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('grades.destroy',$grade->id)}}" method="Post">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                {{method_field('delete')}}
                                                                {{csrf_field()}}
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('grades_trans.Delete_grade')}}</h5>
                                                                <div class="form-group">
                                                                    <p>{{trans('grades_trans.sure delete')}}</p>
                                                                    @csrf
                                                                    <input type="hidden" name="id" id="id" value="{{$grade->id}}">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-info" data-dismiss="modal">{{trans('teacher_trans.Close')}}</button>
                                                            <button type="submit" class="btn btn-danger">{{trans('teacher_trans.Delete')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-------------------------------------- the End modal for delete Grade ------------------------------------------------>


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