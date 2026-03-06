@extends('Dashboard.layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .card-statistics {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs-custom {
        border: none;
        gap: 15px;
        padding: 10px;
        background: #fdfdfd;
        border-radius: 12px;
        margin-bottom: 35px;
    }

    .nav-tabs-custom .nav-item .nav-link {
        border: none;
        color: #666;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 10px;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.02), -3px -3px 10px rgba(255, 255, 255, 0.7);
        position: relative;
    }

    .nav-tabs-custom .nav-item .nav-link.active {
        background: #6c5ce7;
        color: #fff !important;
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(108, 92, 231, 0.3);
    }

    .nav-tabs-custom .nav-item .nav-link:hover:not(.active) {
        transform: translateY(-4px);
        color: #6c5ce7;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
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

    .btn-primary.btn-sm {
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
        border: none;
        background: #6c5ce7;
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
        <a href="{{ route('timetable.create') }}" class="btn btn-primary btn-sm mb-4">
            <i class="fa fa-plus-circle"></i> {{ trans('Students_trans.add_timetable') }}
        </a>

        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            @foreach ($grades as $index => $grade)
            <li class="nav-item">
                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab"
                    href="#grade-{{ $grade->id }}">
                    <i class="fa-solid fa-graduation-cap"></i> {{ $grade->name }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach ($grades as $index => $grade)
            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="grade-{{ $grade->id }}">
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
                                    @if (isset($schedules[$grade->id][$day][$p]))
                                    @foreach ($schedules[$grade->id][$day][$p] as $item)
                                    <div class="schedule-card text-right">
                                        <div class="subject-header text-center">
                                            <i class="fa-solid fa-book-open mr-1"></i>
                                            {{ $item->subject->name }}
                                        </div>
                                        <div class="py-2">
                                            <div class="info-line">
                                                <i class="fa-solid fa-chalkboard-user"></i>
                                                <span>{{ $item->teacher->name }}</span>
                                            </div>
                                            <div class="info-line">
                                                <i class="fa-solid fa-school"></i>
                                                <span>{{ $item->classroom->name }}</span>
                                            </div>
                                            <div class="info-line">
                                                <i class="fa-solid fa-layer-group"></i>
                                                <span
                                                    class="badge badge-light border text-dark">{{ $item->section->section_name }}</span>
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
            @endforeach
        </div>
    </div>
</div>
@endsection