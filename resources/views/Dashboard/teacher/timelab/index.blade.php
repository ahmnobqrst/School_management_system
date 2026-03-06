@extends('Dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .card-statistics {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background: #f8f9fb;
            color: #2d3436;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            border: none;
            padding: 15px;
        }

        .day-column {
            background: #fff !important;
            font-weight: 800;
            color: #6c5ce7;
            border-left: 5px solid #6c5ce7 !important;
            box-shadow: inset 2px 0 5px rgba(0, 0, 0, 0.02);
        }

        .schedule-card {
            border: none;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 10px;
            overflow: hidden;
            border: 1px solid rgba(108, 92, 231, 0.05);
        }

        .subject-header {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            color: #fff;
            padding: 8px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .info-line {
            padding: 5px 12px;
            font-size: 0.75rem;
            color: #555;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-line i {
            color: #6c5ce7;
            width: 18px;
            font-size: 0.8rem;
        }

        .time-slot {
            background: #f1f0ff;
            color: #5a49d8;
            font-size: 0.7rem;
            border-radius: 50px;
            padding: 3px 12px;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }

        .empty-state i {
            font-size: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('sidebar_trans.timetable') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-left float-sm-right">
                    <li class="breadcrumb-item"><a
                            href="{{ route('teacher.dashboard') }}">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('sidebar_trans.timetable') }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center border-0">
                    <thead>
                        <tr>
                            <th>{{ trans('Students_trans.day') }}</th>
                            @for ($i = 1; $i <= $maxPeriods; $i++)
                                <th>{{ trans('Students_trans.timetable') }} {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $day)
                            <tr>
                                <td class="day-column text-uppercase text-primary">
                                    {{ trans('Students_trans.' . ucfirst($day)) }}
                                </td>
                                @for ($p = 1; $p <= $maxPeriods; $p++)
                                    <td class="align-middle p-2" style="background: #fafafa; min-width: 160px;">
                                        @if (isset($schedules[$day][$p]))
                                            @foreach ($schedules[$day][$p] as $item)
                                                <div class="schedule-card text-right">
                                                    <div class="subject-header text-center">
                                                        <i class="fa-solid fa-book-open mr-1"></i>
                                                        {{ $item->subject->name }}
                                                    </div>
                                                    <div class="py-2">
                                                        <div class="info-line">
                                                            <i class="fa-solid fa-school"></i>
                                                            <span>{{ $item->classroom->name }}</span>
                                                        </div>
                                                        <div class="info-line">
                                                            <i class="fa-solid fa-layer-group"></i>
                                                            <span
                                                                class="badge badge-light border text-dark">{{ $item->section->section_name }}</span>
                                                        </div>
                                                        <div class="info-line">
                                                            <i class="fa-solid fa-graduation-cap"></i>
                                                            <span>{{ $item->grade->name }}</span>
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="time-slot">
                                                                <i class="fa-regular fa-clock"></i>
                                                                {{ $item->start_time }} -
                                                                {{ $item->end_time }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <i class="fa-solid fa-minus opacity-25"></i>
                                            </div>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
