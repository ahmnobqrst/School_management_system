@extends('Dashboard.layouts.master')

@section('css')
@toastr_css
<style>
    .hint-box {
        background: #f8f9fa;
        border-left: 4px solid #17a2b8;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 14px;
    }
</style>
@endsection

@section('title')
{{ trans('sidebar_trans.create_question') }}
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('sidebar_trans.create_question') }}
@endsection
@endsection

@section('content')

<div class="page-title mb-3">
    <h4>{{ trans('sidebar_trans.create_question') }}</h4>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- تنبيه عام --}}
                <div class="hint-box mb-4">
                    <i class="fa fa-info-circle text-info"></i>
                    <strong>تنبيه مهم:</strong>
                    لازم تفصل بين الإجابات باستخدام علامة
                    <span class="badge badge-dark">-</span>
                    <br>
                    <small>مثال: إجابة1 - إجابة2 - إجابة3</small>
                </div>

                <form action="{{ route('questions.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="row">

                        {{-- اسم السؤال عربي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_name_ar') }}</label>
                            <input type="text" name="name_ar" class="form-control">
                            @error('name_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- اسم السؤال إنجليزي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_name_en') }}</label>
                            <input type="text" name="name_en" class="form-control">
                            @error('name_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الإجابات عربي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_answer_ar') }}</label>
                            <input type="text"
                                   name="answer_ar"
                                   class="form-control"
                                   placeholder="إجابة1 - إجابة2 - إجابة3">
                            @error('answer_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الإجابات إنجليزي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_answer_en') }}</label>
                            <input type="text"
                                   name="answer_en"
                                   class="form-control"
                                   placeholder="Answer1 - Answer2 - Answer3">
                            @error('answer_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الإجابة الصحيحة عربي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_right_answer_ar') }}</label>
                            <input type="text" name="right_answer_ar" class="form-control">
                            @error('right_answer_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الإجابة الصحيحة إنجليزي --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_right_answer_en') }}</label>
                            <input type="text" name="right_answer_en" class="form-control">
                            @error('right_answer_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الدرجة --}}
                        <div class="col-md-4 mb-3">
                            <label>{{ __('Students_trans.question_degree') }}</label>
                            <input type="number" name="degree" class="form-control">
                            @error('degree')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- الكويز --}}
                        <div class="col-md-8 mb-3">
                            <label>{{ __('Students_trans.quiz_name') }}</label>
                            <select name="quiz_id" class="form-control">
                                <option selected disabled>{{ trans('parent_trans.Choose') }}...</option>
                                @foreach($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                            @error('quiz_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save"></i>
                            {{ trans('Students_trans.submit') }}
                        </button>
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
