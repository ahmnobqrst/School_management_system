@extends('Dashboard.layouts.master')

@section('css')
<style>
    .table thead th {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        text-align: center;
        border: none;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }

    .summary-card {
        border-radius: 14px;
        padding: 20px;
        color: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .summary-score {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .summary-status-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
    }

    .summary-status-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .summary-title {
        font-size: 15px;
        opacity: .9;
    }

    .summary-value {
        font-size: 26px;
        font-weight: bold;
    }

    .badge-success {
        background-color: #22c55e;
    }

    .badge-danger {
        background-color: #ef4444;
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

@php
    $isPassed = $totalScore->status;
@endphp

<!-- ===== Summary ===== -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="summary-card summary-score text-center">
            <div class="summary-title">
                <i class="fas fa-chart-line"></i>
                {{ __('Students_trans.total_score') }}
            </div>
            <div class="summary-value">
                {{ $totalScore->score }}
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="summary-card {{ $isPassed ? 'summary-status-success' : 'summary-status-danger' }} text-center">
            <div class="summary-title">
                <i class="fas fa-check-circle"></i>
                {{ __('Students_trans.student_status') }}
            </div>
            <div class="summary-value">
                {{ $isPassed ? __('Students_trans.passed') : __('Students_trans.failed') }}
            </div>
        </div>
    </div>
</div>

<!-- ===== Table ===== -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <h4 class="mb-4">
                    <i class="fas fa-users"></i>
                    {{ trans('Students_trans.students_answers') }}
                </h4>

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
                                    $isCorrect = $response && strcmp(trim($response->answer), trim($question->right_answer)) === 0;
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

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
