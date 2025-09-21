@extends('Dashboard.layouts.master')
@section('css')
    {{-- Bootstrap Datepicker --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        /* تحسين عام */
        body {
            background: #f8f9fa;
        }
        .search-card {
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            border: none;
        }
        .search-header {
            font-family: 'Cairo', sans-serif;
            font-size: 22px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .datepicker-input {
            border-radius: 12px;
            padding-left: 40px;
            height: 45px;
        }
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #0d6efd;
            font-size: 16px;
        }
        .btn-submit {
            border-radius: 12px;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25,135,84,0.3);
        }
        .breadcrumb {
            background: transparent;
            font-size: 14px;
        }
    </style>
@endsection

@section('title')
    {{trans('sidebar_trans.Apperance_report')}}
@stop

@section('page-header')
@section('PageTitle')
    {{trans('sidebar_trans.Apperance_report')}}
@stop
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-2 text-primary"><i class="fas fa-file-alt"></i> {{trans('sidebar_trans.Apperance_report')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}" class="text-success"><i class="fas fa-home"></i> {{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active text-secondary">{{trans('sidebar_trans.Apperance_report')}}</li>
            </ol>
        </div>
    </div>
</div>

<!-- Search Card -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card search-card">
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger rounded">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h5 class="search-header"><i class="fas fa-search"></i>{{__('Students_trans.information_search')}}</h5>

                <form method="post" action="{{ route('get_attendance.report') }}" autocomplete="off">
                    @csrf

                    <div class="row">
                        <!-- اختيار الطالب -->
                        <div class="col-md-4 mb-3">
                            <label for="student" class="form-label"><th>{{trans('sidebar_trans.Graduate_students')}}</th></label>
                            <select class="form-control" name="student_id[]" multiple>
                                <option value="0"><th>{{trans('Students_trans.all')}}</th></option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- تاريخ البداية -->
                        <div class="col-md-4 mb-3">
                            <label for="from" class="form-label">{{trans('sidebar_trans.start_data')}}</label>
                            <div class="position-relative">
                                <i class="fas fa-calendar-alt input-icon"></i>
                                <input type="text" id="from" name="from" 
                                       class="form-control datepicker datepicker-input" 
                                       placeholder="{{trans('sidebar_trans.choose_start_data')}}" required 
                                       value="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <!-- تاريخ النهاية -->
                        <div class="col-md-4 mb-3">
                            <label for="to" class="form-label">{{trans('sidebar_trans.end_data')}}</label>
                            <div class="position-relative">
                                <i class="fas fa-calendar-alt input-icon"></i>
                                <input type="text" id="to" name="to" 
                                       class="form-control datepicker datepicker-input" 
                                       placeholder="{{trans('sidebar_trans.choose_end_data')}}" required 
                                       value="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button class="btn btn-success btn-submit" type="submit">
                            <i class="fas fa-paper-plane"></i> {{trans('Students_trans.submit')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom auto"
            });
        });
    </script>
@endsection
