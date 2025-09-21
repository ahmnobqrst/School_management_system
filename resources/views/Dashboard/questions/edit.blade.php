@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{__('Students_trans.Edit_question')}} - {{$question->name}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('Students_trans.Edit_question')}} - {{$question->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{__('Students_trans.Edit_question')}} - {{$question->name}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{__('Students_trans.Edit_question')}} - {{$question->name}}</li>
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
                        <form action="{{route('questions.update',$question->id)}}" method="Post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control" value="{{$question->getTranslation('title','ar')}}">
                                    <input type="hidden" name="id" value="{{$question->id}}">
                                </div>
                                @error('name_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control" value="{{$question->getTranslation('title','en')}}">
                                </div>
                                @error('name_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_answer_ar')}}</label>
                                    <input type="text" name="answer_ar" class="form-control" value="{{$question->getTranslation('answer','ar')}}">
                                </div>
                                @error('answer_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_answer_en')}}</label>
                                    <input type="text" name="answer_en" class="form-control" value="{{$question->getTranslation('answer','en')}}">
                                </div>
                                @error('answer_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_right_answer_ar')}}</label>
                                    <input type="text" name="right_answer_ar" class="form-control" value="{{$question->getTranslation('right_answer','ar')}}">
                                </div>
                                @error('right_answer_ar')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_right_answer_en')}}</label>
                                    <input type="text" name="right_answer_en" class="form-control" value="{{$question->getTranslation('right_answer','en')}}">
                                </div>
                                @error('right_answer_en')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                                <div class="col">
                                    <label for="title">{{__('Students_trans.question_degree')}}</label>
                                    <input type="text" name="degree" class="form-control" value="{{$question->degree}}">
                                </div>
                                @error('degree')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name')}}</label>
                                    <select class="custom-select mr-sm-2" name="quiz_id">
                                        @foreach($quizzes as $quiz)
                                        <option  value="{{ $quiz->id }}" {{$quiz->id == $question->quiz_id ? "selected":""}}>{{ $quiz->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('quiz_id')
                                    <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('Students_trans.Update')}}</button>
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