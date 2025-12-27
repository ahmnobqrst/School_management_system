@extends('Dashboard.layouts.master')

@section('css')
<style>
    .table thead th {
        background: #3b82f6;
        color: #fff;
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }
</style>
@toastr_css
@endsection

@section('title')
{{ trans('Students_trans.students_in_exam') }}
@stop

@section('content')

<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="mb-0">{{ trans('Students_trans.students_in_exam') }}</h4>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb pt-0 pr-0 mb-0">
                <li class="breadcrumb-item"><a href="{{route('teachers.index')}}"
                        class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.students_in_exam') }}</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <h4 class="mb-4">
                    <i class="fas fa-users"></i>
                    {{ trans('Students_trans.students_in_exam') }}
                </h4>

                @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Students_trans.student_name') }}</th>
                                <th>{{ trans('Students_trans.email') }}</th>
                                <th>{{ trans('Students_trans.section') }}</th>
                                <th>{{ trans('Students_trans.gender') }}</th>
                                <th>{{ trans('Students_trans.score') }}</th>
                                <th>{{ trans('Students_trans.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->student->name ?? '-' }}</td>
                                <td>{{ $result->student->email ?? '-' }}</td>
                                <td>{{ $result->student->Section->section_name ?? '-' }}</td>
                                <td>{{ $result->student->Gender->name ?? '-' }}</td>
                                <td>{{ $result->score ?? '-' }}</td>
                                <td>
                                    <a href="{{route('student.answers',['quizId'=>$result->quiz->id,'studentId'=>$result->student->id])}}"
                                        class="btn btn-outline-info btn-sm">
                                        <i class="fa fa-edit"></i>{{trans('Students_trans.show_answers')}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-warning text-center">
                    {{ __('Students_trans.no_student') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection