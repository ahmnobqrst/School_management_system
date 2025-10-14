@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{__('Students_trans.Edit_quiz')}} - {{$quizz->name}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('Students_trans.Edit_quiz')}} - {{$quizz->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{__('Students_trans.Edit_quiz')}} - {{$quizz->name}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{__('Students_trans.Edit_quiz')}}{{$quizz->name}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('quizz.update','test')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name_ar')}}</label>
                                    <input type="text" name="name_ar" value="{{$quizz->getTranslation('name','ar')}}" class="form-control">
                                    <input type="hidden" name="id" value="{{$quizz->id}}">
                                </div>
                                @error('name_ar')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror

                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name_en')}}</label>
                                    <input type="text" name="name_en" value="{{$quizz->getTranslation('name','en')}}" class="form-control">
                                </div>
                                @error('name_en')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{trans('Students_trans.subject_name')}} : <span class="text-danger" readonly>*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id">
                                            <option value="{{ $subject->id }}" {{$subject->id == $quizz->subject_id ? "selected":""}}>{{ $subject->name }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grad_id">
                                            @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{$grade->id == $quizz->grade_id ? "selected":""}}>{{ $grade->name }}</option>
                                            <option value="{{ $grade->id }}" {{$grade->id == $quizz->grade_id ? "selected":""}}>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('grade_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="class_id">
                                            <option value="{{$quizz->classroom_id}}">{{$quizz->classroom->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('classroom_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                        <select class="custom-select mr-sm-2" name="sect_id">
                                            <option value="{{$quizz->section_id}}">{{$quizz->section->section_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('section_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.Update')}}</button>
                        </form>
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