@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@toastr_css
@section('title')
{{trans('sidebar_trans.timetable')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.timetable')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.timetable')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.timetable')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="card-body">
    <a href="{{route('timetable.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('teacher_trans.add_Teacher')}}</a><br><br>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th style="width: 100px;">{{ trans('Students_trans.Day') }}</th>
                    @for($i = 1; $i <= $maxPeriods; $i++)
                        <th>{{ trans('Students_trans.Period') }} {{ $i }}</th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($days as $day)
                <tr>
                    <td class="bg-light font-weight-bold">
                        {{ trans('Students_trans.' . ucfirst($day)) }}
                    </td>

                    @for($i = 1; $i <= $maxPeriods; $i++)
                        <td>
                        @if(isset($schedules[$day][$i]))
                        @foreach($schedules[$day][$i] as $item)
                        <div class="schedule-box p-2 mb-1" style="background-color: #e3f2fd; border-radius: 5px; border-right: 4px solid #1976d2;">
                            <div class="font-weight-bold text-primary" style="font-size: 0.9rem;">
                                {{ $item->subject->name }}
                            </div>
                            <div class="text-muted" style="font-size: 0.8rem;">
                                <i class="fa fa-user"></i> {{ $item->teacher->name }}
                            </div>
                            <div class="badge badge-secondary" style="font-size: 0.7rem;">
                                {{ $item->section->section_name }}
                            </div>
                            <div class="mt-1 text-info" style="font-size: 0.7rem;">
                                {{ $item->start_time }}
                            </div>
                        </div>
                        @endforeach
                        @else
                        <span class="text-light-gray" style="color: #ddd;">---</span>
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