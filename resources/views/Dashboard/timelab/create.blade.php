@extends('Dashboard.layouts.master')
@section('css')
<style>
    /* الحاوية الرئيسية */
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        color: white;
        padding: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* تحسين الحقول */
    .form-label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-control,
    .custom-select {
        border-radius: 10px;
        border: 1px solid #dfe6e9;
        padding: 12px;
        height: auto;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .custom-select:focus {
        border-color: #6c5ce7;
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.1);
    }

    /* قسم الوقت */
    .time-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
        border: 1px dashed #ced4da;
    }

    /* الأخطاء الأنيقة */
    .is-invalid {
        border-color: #ff7675 !important;
    }

    .text-danger-custom {
        color: #d63031;
        font-size: 0.75rem;
        font-weight: 500;
        margin-top: 5px;
        display: block;
        animation: fadeIn 0.4s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* زر الحفظ */
    .btn-save {
        background: linear-gradient(45deg, #00b894, #55efc4);
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        font-weight: bold;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 184, 148, 0.4);
        color: white;
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
                <li class="breadcrumb-item active"><a  href ="{{route('timetable.index')}}">{{ trans('sidebar_trans.timetable') }}</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <i class="fa-solid fa-calendar-plus fa-lg"></i>
                    <span>{{ trans('Students_trans.add_timetable') }}</span>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('timetable.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><i class="fa-solid fa-calendar-day text-primary"></i> {{ trans('Students_trans.Day') }}</label>
                                <select class="custom-select @error('day') is-invalid @enderror" name="day" required>
                                    <option value="" selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    <option value="sun">{{ trans('Students_trans.Sun') }}</option>
                                    <option value="mon">{{ trans('Students_trans.Mon') }}</option>
                                    <option value="tue">{{ trans('Students_trans.Tue') }}</option>
                                    <option value="wed">{{ trans('Students_trans.Wed') }}</option>
                                    <option value="thu">{{ trans('Students_trans.Thu') }}</option>
                                </select>
                                @error('day') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label"><i class="fa-solid fa-list-ol text-primary"></i> {{ trans('Students_trans.Period') }}</label>
                                <input type="number" name="period" class="form-control @error('period') is-invalid @enderror" min="1" max="6" required>
                                @error('period') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label"><i class="fa-solid fa-book text-primary"></i> {{ trans('Students_trans.subject_name') }}</label>
                                <select class="custom-select @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                    <option value="" selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">{{trans('grades_trans.grade_name')}}</label>
                                <select class="custom-select @error('grade_id') is-invalid @enderror" name="grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                @error('grade_id') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">{{trans('class_trans.class_name')}}</label>
                                <select name="classroom_id" class="custom-select @error('classroom_id') is-invalid @enderror"></select>
                                @error('classroom_id') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">{{trans('section_trans.section_name')}}</label>
                                <select name="section_id" class="custom-select @error('section_id') is-invalid @enderror"></select>
                                @error('section_id') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">{{trans('section_trans.Teacher_name')}}</label>
                                <select class="custom-select @error('teacher_id') is-invalid @enderror" name="teacher_id" id="teacher_id">
                                </select>
                                @error('teacher_id') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="time-section">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fa-regular fa-clock text-info"></i> {{trans('Students_trans.start_time')}}</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
                                    @error('start_time') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fa-solid fa-clock-rotate-left text-success"></i> {{trans('Students_trans.end_time')}}</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" required>
                                    @error('end_time') <span class="text-danger-custom"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-save shadow">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> {{trans('Students_trans.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection