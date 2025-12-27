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
{{ trans('Students_trans.students_answers') }}
@stop

@section('content')

<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="mb-0">{{ trans('Students_trans.students_answers') }}</h4>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb pt-0 pr-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('teachers.index') }}" class="default-color">
                        {{ trans('Students_trans.Home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    {{ trans('Students_trans.students_answers') }}
                </li>
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
                    {{ trans('Students_trans.students_answers') }}
                </h4>

                @if($questions->count() > 0)

                <form method="POST" action="#">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Students_trans.question_name') }}</th>
                                    <th>{{ trans('Students_trans.right_answer') }}</th>
                                    <th>{{ trans('Students_trans.students_answers') }}</th>
                                    <th>{{ trans('Students_trans.score') }}</th>
                                    <th>{{ trans('Students_trans.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($questions as $question)
                                @php
                                $response = $question->responses->first();
                                $isCorrect = false;
                                if ($response && strcmp(trim($response->answer), trim($question->right_answer)) === 0) {
                                $isCorrect = true;
                                }
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $question->title ?? '-' }}</td>

                                    <td>{{ $question->right_answer ?? '-' }}</td>

                                    <td>{{ $response->answer ?? '-' }}</td>

                                    <td>{{ $response->score ?? '-' }}</td>

                                    <td>
                                        <span class="badge {{ $isCorrect ? 'badge-success' : 'badge-danger' }}">
                                            {{ $isCorrect ? __('Students_trans.correct') : __('Students_trans.wrong') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="alert alert-info text-center">
                                <strong>{{ __('Students_trans.total_score') }} :</strong>
                                {{$totalScore}}
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i>
                            {{ __('Students_trans.confirm_answers') }}
                        </button>
                    </div>
                </form>

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