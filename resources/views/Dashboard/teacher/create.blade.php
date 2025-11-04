@extends('dashboard.layouts.master')

@section('css')
@toastr_css
@section('title')
{{ trans('teacher_trans.add_Teacher') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('teacher_trans.add_Teacher') }}
@stop
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="mb-0">{{ trans('teacher_trans.add_Teacher') }}</h4>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb pt-0 pr-0 mb-0">
                <li class="breadcrumb-item"><a href="{{route('teachers.index')}}"
                        class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('teacher_trans.teacher_list') }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <form action="{{ route('teachers.store') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_Email') }}</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="{{ __('teacher_trans.teacher_Email') }}">
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.password') }}</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="{{ __('teacher_trans.password') }}">
                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_name_ar') }}</label>
                            <input type="text" name="name_ar" class="form-control"
                                placeholder="{{ __('teacher_trans.teacher_name_ar') }}">
                            @error('name_ar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_name_en') }}</label>
                            <input type="text" name="name_en" class="form-control"
                                placeholder="{{ __('teacher_trans.teacher_name_en') }}">
                            @error('name_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.address_ar') }}</label>
                            <input type="text" name="address_ar" class="form-control"
                                placeholder="{{ __('teacher_trans.address_ar') }}">
                            @error('address_ar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.address_en') }}</label>
                            <input type="text" name="address_en" class="form-control"
                                placeholder="{{ __('teacher_trans.address_en') }}">
                            @error('address_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.Date_Of_Job') }}</label>
                            <input type="date" name="date_of_job" class="form-control">
                            @error('date_of_job') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.age') }}</label>
                            <input type="text" name="age" class="form-control"
                                placeholder="{{ __('teacher_trans.age') }}">
                            @error('age') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.phone') }}</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="{{ __('teacher_trans.phone') }}">
                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>{{ trans('teacher_trans.specialization') }}</label>
                            <select name="specialist_id" class="form-control" style="height:55px;">
                                <option value="" disabled selected>{{ trans('teacher_trans.specialization') }}</option>
                                @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ trans('teacher_trans.Genders') }}</label>
                            <select name="gender_id" class="form-control" style="height:55px;">
                                <option value="" disabled selected>{{ trans('teacher_trans.Genders') }}</option>
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ trans('Students_trans.Nationality') }}</label>
                            <select name="national_teacher_id" class="form-control" style="height:55px;">
                                <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach($nationals as $nal)
                                <option value="{{ $nal->id }}">{{ $nal->name }}</option>
                                @endforeach
                            </select>
                            @error('national_teacher_id') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>{{ trans('Students_trans.blood_type') }}</label>
                            <select name="blood_type_teacher_id" class="form-control" style="height:55px;">
                                <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach($bloods as $bg)
                                <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                @endforeach
                            </select>
                            @error('blood_type_teacher_id') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ trans('Students_trans.Grade') }}</label>
                            <select name="grade_id" class="form-control" style="height:55px;">
                                <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            @error('grade_id') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">{{ trans('teacher_trans.add_Teacher') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
