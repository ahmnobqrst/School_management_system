@extends('dashboard.layouts.master')

@section('css')
@toastr_css
@section('title')
{{ trans('teacher_trans.Edit_Teacher') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('teacher_trans.Edit_Teacher') }}
@stop
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="mb-0">{{ trans('teacher_trans.Edit_Teacher') }}</h4>
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

                @if (session('updated'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('updated') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <form action="{{ route('teachers.update', 'test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $teacher->id }}" name="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_Email') }}</label>
                            <input type="email" name="email" value="{{ $teacher->email }}" class="form-control">
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.password') }}</label>
                            <input type="password" name="password" value="{{ $teacher->password }}"
                                class="form-control">
                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_name_ar') }}</label>
                            <input type="text" name="name_ar" value="{{ $teacher->getTranslation('name','ar') }}"
                                class="form-control">
                            @error('name_ar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.teacher_name_en') }}</label>
                            <input type="text" name="name_en" value="{{ $teacher->getTranslation('name','en') }}"
                                class="form-control">
                            @error('name_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.address_ar') }}</label>
                            <input type="text" name="address_ar" value="{{ $teacher->getTranslation('address','ar') }}"
                                class="form-control">
                            @error('address_ar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('teacher_trans.address_en') }}</label>
                            <input type="text" name="address_en" value="{{ $teacher->getTranslation('address','en') }}"
                                class="form-control">
                            @error('address_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.Date_Of_Job') }}</label>
                            <input type="date" name="date_of_job" value="{{ $teacher->date_of_job }}"
                                class="form-control">
                            @error('date_of_job') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.age') }}</label>
                            <input type="text" name="age" value="{{ $teacher->age }}" class="form-control">
                            @error('age') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('teacher_trans.phone') }}</label>
                            <input type="text" name="phone" value="{{ $teacher->phone }}" class="form-control">
                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ trans('teacher_trans.specialization') }}</label>
                            <select name="specialist_id" class="form-control" style="height:55px;">
                                <option value="{{ $teacher->Specializations->id }}">
                                    {{ $teacher->Specializations->name }}
                                </option>
                                @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                @endforeach
                            </select>
                            @error('specialist_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ trans('Students_trans.Nationality') }}</label>
                            <select name="national_teacher_id" class="form-control" style="height:55px;">
                                @foreach($nationals as $nal)
                                <option value="{{ $nal->id }}"
                                    {{ $nal->id == $teacher->nationalitie_id ? 'selected' : '' }}>
                                    {{ $nal->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('national_teacher_id') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ trans('Students_trans.blood_type') }}</label>
                            <select name="blood_type_teacher_id" class="form-control" style="height:55px;">
                                @foreach($bloods as $bg)
                                <option value="{{ $bg->id }}"
                                    {{ $bg->id == $teacher->blood_type_teacher_id ? 'selected' : '' }}>
                                    {{ $bg->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('blood_type_teacher_id') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ trans('teacher_trans.Genders') }}</label>
                            <select name="gender_id" class="form-control" style="height:55px;">
                                <option value="{{ $teacher->Genders->id }}">{{ $teacher->Genders->name }}</option>
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                            @error('gender_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit"
                            class="btn btn-primary">{{ trans('teacher_trans.Update_Teacher') }}</button>
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
