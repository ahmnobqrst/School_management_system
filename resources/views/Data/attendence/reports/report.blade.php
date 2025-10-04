@extends('Dashboard.layouts.master')

@section('css')
{{-- Bootstrap Datepicker --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
{{-- FontAwesome Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
{{-- Bootstrap Multiselect --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css" />

<style>
    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(135deg, #e8f5e9, #f1f8e9, #e3f2fd);
        min-height: 100vh;
    }

    /* ✅ كارد البحث */
    .search-card {
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        border: none;
        background: #fff;
        transition: all 0.3s ease-in-out;
    }

    .search-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 35px rgba(25, 135, 84, 0.15);
    }

    .search-header {
        font-size: 22px;
        font-weight: bold;
        color: #198754;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label {
        font-weight: 600;
        color: #212529;
    }

    .datepicker-input {
        border-radius: 12px;
        padding-left: 42px;
        height: 48px;
        background: #fcfcfc;
        border: 1px solid #ced4da;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #198754;
        font-size: 16px;
    }

    .btn-submit {
        border-radius: 12px;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        background: linear-gradient(45deg, #198754, #28a745);
        border: none;
        color: #fff;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        background: linear-gradient(45deg, #157347, #198754);
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.4);
    }

    /* ✅ البريدكرام */
    .breadcrumb {
        background: transparent;
        font-size: 14px;
    }

    .breadcrumb-item a {
        color: #198754;
        font-weight: 600;
    }

    .breadcrumb-item.active {
        color: #6c757d;
        font-weight: 500;
    }

    /* ✅ multiselect dropdown */
    .multiselect-container {
        min-width: 100% !important;
        max-height: 400px;
        overflow-y: auto;
        border-radius: 10px;
    }

    .multiselect-container>li>a>label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        cursor: pointer;
        padding: 5px 10px;
        white-space: normal;
    }

    .multiselect-container input[type="checkbox"] {
        width: 16px;
        height: 16px;
    }

    /* RTL (عربي): checkbox شمال */
    [dir="rtl"] .multiselect-container>li>a>label {
        flex-direction: row-reverse;
        text-align: right;
    }

    /* LTR (إنجليزي): checkbox يمين */
    [dir="ltr"] .multiselect-container>li>a>label {
        flex-direction: row;
        text-align: left;
    }

    /* ✅ رسائل الخطأ */
    .error-message {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        border-radius: 8px;
        padding: 10px 12px;
        margin-top: 8px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .error-message::before {
        content: "\f06a";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
    }
</style>
@endsection

@section('title')
{{ trans('sidebar_trans.Apperance_report') }}
@stop

@section('page-header')
@section('PageTitle')
{{ trans('sidebar_trans.Apperance_report') }}
@stop
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-2 text-success"><i class="fas fa-file-alt"></i> {{trans('sidebar_trans.Apperance_report')}}</h4>
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

                <h5 class="search-header"><i class="fas fa-search"></i> {{__('Students_trans.information_search')}}</h5>

                <form method="post" action="{{ route('get_attendance.report') }}" autocomplete="off">
                    @csrf

                    <div class="row">
                        <!-- اختيار الطالب -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">{{trans('Students_trans.student_name')}}</label>
                            <select id="studentSelect" class="form-control" name="student_id[]" multiple="multiple">
                                @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
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
                            @error('from')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
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
                            @error('to')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button class="btn btn-submit" type="submit">
                            <i class="fas fa-paper-plane"></i> {{trans('Students_trans.submit_report')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- Datepicker --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- Bootstrap Multiselect --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>

<script>
    $(function() {
        // datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });

        // multiselect with checkbox
        $('#studentSelect').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            filterPlaceholder: "{{trans('Students_trans.search')}}",
            nonSelectedText: "{{trans('Students_trans.choose_student')}}",
            selectAllText: "{{trans('Students_trans.all')}}",
            allSelectedText: "{{trans('Students_trans.all')}}",
            buttonWidth: '100%',
            maxHeight: 400,
        });
    });
</script>
@endsection
