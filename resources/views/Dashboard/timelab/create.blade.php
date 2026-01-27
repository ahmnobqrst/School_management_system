@extends('Dashboard.layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('timetable.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>{{ trans('Students_trans.Day') }}</label>
                    <select class="form-control" name="day" required>
                        <option value="sun">{{ trans('Students_trans.Sun') }}</option>
                        <option value="mon">{{ trans('Students_trans.Mon') }}</option>
                        <option value="tue">{{ trans('Students_trans.Tue') }}</option>
                        <option value="wed">{{ trans('Students_trans.Wed') }}</option>
                        <option value="thu">{{ trans('Students_trans.Thu') }}</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>{{ trans('Students_trans.Period') }}</label>
                    <input type="number" name="period" class="form-control" min="1" max="6" required>
                </div>

                <div class="col-md-3">
                    <label>{{ trans('Students_trans.subject') }}</label>
                    <select class="form-control" name="subject_id" required>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="row mt-3">
                <div class="form-group col">
                    <label for="inputState">{{trans('grades_trans.grade_name')}}</label>
                    <select class="custom-select my-1 mr-sm-2" name="grade_id">
                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($grades as $grade)
                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('grade_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                <div class="form-group col">
                    <label for="inputState">{{trans('class_trans.class_name')}}</label>
                    <select name="classroom_id" class="custom-select"></select>
                </div>
                @error('classroom_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror
                <div class="form-group col">
                    <label for="inputState">{{trans('class_trans.section_name')}}</label>
                    <select name="section_id" class="custom-select"></select>
                </div>
                @error('section_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror


                <div class="form-group col">
                    <label for="inputState">{{trans('section_trans.Teacher_name')}}</label>
                    <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                    </select>
                </div>
                @error('teacher_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                <div class="col-md-4">
                    <label>وقت البدء</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>وقت الانتهاء</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-4">حفظ الحصة</button>
        </form>
    </div>
</div>
@endsection