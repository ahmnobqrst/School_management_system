@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .name_quiz {
        color: #2563eb;
        font-size: 18px;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .action-buttons a,
    .action-buttons button {
        width: 36px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .action-buttons i {
        font-size: 15px;
    }
</style>

@toastr_css
@section('title')
{{trans('sidebar_trans.Exam_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.Exam_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.Exam_list')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.Exam_list')}}</li>
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
                            <a href="{{route('quizz.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                aria-pressed="true">{{trans('sidebar_trans.create_quiz')}}</a>
                            <div class="table-responsive">
                                @if($quizzes)
                                <table id="datatable" class="table table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Students_trans.quiz_name')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($quizzes as $quizze)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$quizze->name}}</td>
                                            <td>{{$quizze->grade->name}}</td>
                                            <td>{{$quizze->classroom->name}}</td>
                                            <td>{{$quizze->section->section_name}}</td>
                                            <td>
                                                <div class="action-buttons">

                                                    <a href="{{route('quizz.edit',$quizze->id)}}"
                                                        class="btn btn-info btn-sm"
                                                        data-toggle="tooltip"
                                                        title="{{ __('Students_trans.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_exam{{ $quizze->id }}"
                                                        data-toggle="tooltip"
                                                        title="{{ __('Students_trans.delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <a href="{{route('questions',$quizze->section->id)}}"
                                                        class="btn btn-warning btn-sm"
                                                        data-toggle="tooltip"
                                                        title="{{ trans('sidebar_trans.question_sections_show') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{route('quiz.with.student',$quizze->id)}}"
                                                        class="btn btn-primary btn-sm"
                                                        data-toggle="tooltip"
                                                        title="{{ trans('Students_trans.show_student_share') }}">
                                                        <i class="fa fa-users"></i>
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>

                                        <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('quizz.destroy','test')}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel"> {{trans('Students_trans.Delete_quiz')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{trans('Students_trans.Deleted_quiz_tilte')}} <span class="name_quiz">{{$quizze->name}}<span></p>
                                                            <input type="hidden" name="id" value="{{$quizze->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        @endforeach
                                </table>
                                @else
                                <div class="alert alert-warning text-center mt-3">
                                    {{ __('Students_trans.no_data') }}
                                </div>
                                @endif
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