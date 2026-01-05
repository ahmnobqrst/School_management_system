@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.lecture')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.lecture')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.lecture')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.lecture')}}</li>
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
                            @foreach($availableMonths as $m)
                            <a href="{{ route('student.leactures', ['month' => $m['month'], 'year' => $m['year']]) }}"
                                class="btn btn-outline-primary month-btn {{ ($month == $m['month'] && $year == $m['year']) ? 'active' : '' }}">
                                {{ $m['label'] }}
                            </a>
                            @endforeach
                            <div>
                                <div>
                                    <br><br>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50" style="text-align: center">
                                            <thead>
                                                <tr class="alert-success">
                                                    <th>#</th>
                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                    <th>{{trans('Students_trans.section')}}</th>
                                                    <th>{{trans('section_trans.Teacher_name')}}</th>
                                                    <th>{{trans('Students_trans.Topic')}}</th>
                                                    <th>{{trans('Students_trans.start_at')}}</th>
                                                    <th>{{trans('Students_trans.Duration')}}</th>
                                                    <th>{{trans('Students_trans.Url_Join')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($leactures as $leacture)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $leacture->grade?->name }}</td>
                                                    <td>{{ $leacture->classroom?->name }}</td>
                                                    <td>{{ $leacture->section?->section_name }}</td>
                                                    <td>{{ $leacture->created_by }}</td>
                                                    <td>{{ $leacture->topic }}</td>
                                                    <td>{{ $leacture->start_at }}</td>
                                                    <td>{{ $leacture->duration }}</td>
                                                    <td>
                                                        <a href="{{ $leacture->join_url }}" target="_blank" class="text-danger">
                                                            {{ trans('Students_trans.Join') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center text-muted py-4">
                                                        <i class="ri-information-line"></i>
                                                       {{ trans('Students_trans.no_leacture') }}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                        <div class="mt-3 d-flex justify-content-center">
                                            {{ $leactures->links() }}
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