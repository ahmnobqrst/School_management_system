@extends('Dashboard.layouts.master')

@section('title')
{{ __('attendance.attendance_report_title') }}
@endsection

@section('css')
<style>
    .attendance-card {
        border-radius: 12px !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
        border: none !important;
    }

    .month-btn {
        margin: 3px;
        min-width: 90px;
        border-radius: 20px !important;
        font-weight: 600;
    }

    .month-btn.active {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .attendance-table th {
        background-color: #eef2f7 !important;
        font-weight: 700;
        text-align: center;
    }

    .attendance-table td {
        text-align: center;
        vertical-align: middle;
    }

    .attendance-table tbody tr:hover {
        background-color: #e9f2ff !important;
    }

    .badge-present {
        background-color: #28a745 !important;
        color: #fff !important;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: bold;
    }

    .badge-absent {
        background-color: #dc3545 !important;
        color: #fff !important;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: bold;
    }
</style>
@endsection


@section('content')
<div class="page-content">
    <div class="row">
        <div class="card attendance-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <i class="ri-file-list-3-line"></i>
                    {{ __('attendance.attendance_report_title') }}
                </div>
            </div>

            <div class="card-body">

                <div class="mb-4 text-center">
                    @foreach($availableMonths as $m)
                    <a href="{{ route('student.attendence', ['month' => $m['month'], 'year' => $m['year'],'studentId'=>$student->id]) }}"
                        class="btn btn-outline-primary month-btn {{ ($month == $m['month'] && $year == $m['year']) ? 'active' : '' }}">
                        {{ $m['label'] }}
                    </a>
                    @endforeach
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card text-center attendance-card">
                            <div class="card-body">
                                <h6 class="mb-2 text-muted">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                    {{ __('attendance.present_days') }}
                                </h6>
                                <h2 class="text-success fw-bold">
                                    {{ $totalAppearneceInMonth }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center attendance-card">
                            <div class="card-body">
                                <h6 class="mb-2 text-muted">
                                    <i class="ri-close-circle-fill text-danger"></i>
                                    {{ __('attendance.absent_days') }}
                                </h6>
                                <h2 class="text-danger fw-bold">
                                    {{ $totalAbsentInMonth }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table table-bordered attendance-table text-nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ __('attendance.date') }}</th>
                            <th>{{ __('attendance.student_status') }}</th>
                            <th>{{ __('attendance.day_name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceRecords as $record)
                        @php
                        $dayName = \Carbon\Carbon::parse($record->attendence_date)
                        ->locale(app()->getLocale())
                        ->isoFormat('dddd');
                        @endphp
                        <tr>
                            <td class="date-text">
                                <i class="ri-calendar-line"></i>
                                {{ $record->attendence_date }}
                            </td>

                            <td>
                                @if($record->attendence_status == 1)
                                <span class="badge-present">
                                    <i class="ri-checkbox-circle-fill"></i>
                                    {{ __('attendance.present') }}
                                </span>
                                @else
                                <span class="badge-absent">
                                    <i class="ri-close-circle-fill"></i>
                                    {{ __('attendance.absent') }}
                                </span>
                                @endif
                            </td>

                            <td class="day-name">
                                <i class="ri-time-line"></i>
                                {{ $dayName }}
                            </td>
                        </tr>
                        @endforeach

                        @if($attendanceRecords->isEmpty())
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">
                                <i class="ri-information-line"></i>
                                {{ __('attendance.no_records_found') }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $attendanceRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection