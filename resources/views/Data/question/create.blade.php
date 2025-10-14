@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.create_question')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.create_question')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.create_question')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.create_question')}}</li>
            </ol>
        </div>
    </div>
</div>

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('questionsss.store',$sectionId)}}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                                @error('name_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control">
                                </div>
                                @error('name_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_answer_ar')}}</label>
                                    <input type="text" name="answer_ar" class="form-control">
                                </div>
                                @error('answer_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_answer_en')}}</label>
                                    <input type="text" name="answer_en" class="form-control">
                                </div>
                                @error('answer_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_right_answer_ar')}}</label>
                                    <input type="text" name="right_answer_ar" class="form-control">
                                </div>
                                @error('right_answer_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_right_answer_en')}}</label>
                                    <input type="text" name="right_answer_en" class="form-control">
                                </div>
                                @error('right_answer_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_degree')}}</label>
                                    <input type="text" name="degree" class="form-control">
                                </div>
                                @error('degree')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name')}}</label>
                                    <select class="custom-select mr-sm-2" name="quiz_id">
                                        <option selected disabled>{{trans('parent_trans.Choose')}}...</option>
                                        @foreach($quizzes as $quiz)
                                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('quiz_id')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('Students_trans.submit')}}</button>
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