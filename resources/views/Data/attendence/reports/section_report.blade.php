@extends('Dashboard.layouts.master')

@section('css')
    @toastr_css

    <style>
        .month-tabs {
            gap: .5rem;
        }

        .month-tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .55rem .9rem;
            border-radius: 999px;
            border: 1px solid #e6e6e6;
            background: #fff;
            color: #333;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            transition: all .15s ease-in-out;
            text-decoration: none !important;
            min-width: 90px;
        }

        .month-tab:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .07);
            border-color: #d8d8d8;
        }

        .month-tab.active {
            border-color: #0d6efd;
            background: rgba(13, 110, 253, .08);
            color: #0d6efd;
            box-shadow: 0 6px 16px rgba(13, 110, 253, .15);
        }

        .cell-present {
            background: rgba(25, 135, 84, .10);
            color: #198754;
            font-weight: 800;
        }

        .cell-absent {
            background: rgba(220, 53, 69, .10);
            color: #dc3545;
            font-weight: 800;
        }

        .cell-none {
            background: rgba(255, 193, 7, .12);
            color: #b78103;
            font-weight: 700;
        }

        .att-icon {
            font-size: 16px;
            line-height: 1;
        }

        .days-head th {
            position: sticky;
            top: 0;
            background: #f7f7f7;
            z-index: 2;
        }
    </style>

@section('title')
    {{ trans('sidebar_trans.Apperance_report') }}
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('sidebar_trans.Apperance_report') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.dashboard') }}"
                        class="default-color">{{ trans('Students_trans.Home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('attendence_section') }}"
                        class="default-color">{{ trans('sidebar_trans.Apperance_report') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('attendance.attendance_report_title') }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-wrap month-tabs">
            @foreach ($months as $m)
                @php
                    $isActive = (int) $month === (int) $m['number'];
                    $qs = request()->all();
                    $qs['month'] = $m['number'];
                    $qs['year'] = $year;
                    unset($qs['export']);
                @endphp
                <a class="month-tab {{ $isActive ? 'active' : '' }}"
                    href="{{ route('teacher.section_report', $id) . '?' . http_build_query($qs) }}">
                    {{ $m['name'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="GET" action="{{ route('teacher.section_report', $id) }}">
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">

            <div class="row align-items-start">
                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold">{{ trans('Students_trans.student_name') }}:</label>
                    <input type="text" name="name" value="{{ $name }}" class="form-control"
                        placeholder="{{ trans('Students_trans.search') }}">
                    @error('name')
                        <small class="text-danger mt-1 d-block" style="font-size: 85%; font-weight: 500;">
                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold">{{ trans('attendance.from_date') }}:</label>
                    <input type="date" name="from" value="{{ $from }}" class="form-control">
                    @error('from')
                        <small class="text-danger mt-1 d-block" style="font-size: 85%; font-weight: 500;">
                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold">{{ trans('attendance.to_date') }}:</label>
                    <input type="date" name="to" value="{{ $to }}" class="form-control">
                    @error('to')
                        <small class="text-danger mt-1 d-block" style="font-size: 85%; font-weight: 500;">
                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="col-md-3 mt-md-4 pt-md-2">
                    <div class="btn-group w-100">
                        <button type="submit" class="btn btn-primary btn-sm"
                            title="{{ trans('Students_trans.search') }}">
                            <i class="fa fa-search"></i>
                        </button>

                        <button type="submit" name="export" value="pdf" class="btn btn-danger btn-sm"
                            title="PDF">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </button>

                        <button type="submit" name="export" value="excel" class="btn btn-info btn-sm" title="Excel">
                            <i class="fa fa-file-excel-o"></i> Excel
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-2 text-muted">
            {{ trans('attendance.from_date') }}: <b>{{ $from }}</b> — {{ trans('attendance.to_date') }}:
            <b>{{ $to }}</b>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive" style="max-height: 70vh;">
                    <table class="table table-sm table-bordered" style="text-align:center; white-space: nowrap;">
                        <thead class="days-head">
                            <tr class="alert-success">
                                <th>#</th>
                                <th>{{ trans('Students_trans.name') }}</th>
                                <th>{{ trans('Students_trans.Grade') }}</th>
                                <th>{{ trans('Students_trans.section') }}</th>
                                <th>{{ trans('attendance.present_days') }}</th>
                                <th>{{ trans('attendance.absent_days') }}</th>

                                @foreach ($days as $d)
                                    <th>{{ \Carbon\Carbon::parse($d)->format('d') }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($students as $student)
                                @php
                                    $presentCount = $student->attendance
                                        ->filter(fn($a) => (int) $a->attendence_status === 1)
                                        ->count();
                                    $absentCount = $student->attendance
                                        ->filter(fn($a) => (int) $a->attendence_status === 0)
                                        ->count();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ optional($student->Grade)->name }}</td>
                                    <td>{{ optional($student->Section)->section_name }}</td>
                                    <td class="text-success font-weight-bold">{{ $presentCount }}</td>
                                    <td class="text-danger font-weight-bold">{{ $absentCount }}</td>

                                    @foreach ($days as $d)
                                        @php $status = $attendanceMap[$student->id][$d] ?? null; @endphp

                                        @if ($status === 1)
                                            <td class="cell-present">
                                                <span class="att-icon">✔</span>
                                            </td>
                                        @elseif($status === 0)
                                            <td class="cell-absent">
                                                <span class="att-icon">✖</span>
                                            </td>
                                        @else
                                            <td class="cell-none">
                                                <span class="att-icon">—</span>
                                            </td>
                                        @endif
                                    @endforeach
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
