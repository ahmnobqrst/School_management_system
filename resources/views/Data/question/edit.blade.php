@extends('Dashboard.layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{ __('Students_trans.Edit_question') }} - {{ $question->name }}
@endsection

@section('page-header')
@section('PageTitle')
{{ __('Students_trans.Edit_question') }} - {{ $question->name }}
@endsection
@endsection

@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">
                {{ __('Students_trans.Edit_question') }} - {{ $question->name }}
            </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                {{-- رسالة خطأ عامة --}}
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('question.update', $question->id) }}"
                      method="POST"
                      autocomplete="off">
                    @csrf
                    @method('PUT')

                    {{-- 🔔 تنبيه مهم (خارج form-row) --}}
                    <div class="alert alert-info mb-4">
                        <i class="fa fa-info-circle"></i>
                        <strong>تنبيه:</strong>
                        يجب فصل الإجابات باستخدام علامة
                        <span class="badge badge-secondary">-</span>
                        <br>
                        <small>مثال: إجابة1 - إجابة2 - إجابة3</small>
                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_name_ar') }}</label>
                            <input type="text"
                                   name="name_ar"
                                   class="form-control"
                                   value="{{ $question->getTranslation('title','ar') }}">
                            @error('name_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_name_en') }}</label>
                            <input type="text"
                                   name="name_en"
                                   class="form-control"
                                   value="{{ $question->getTranslation('title','en') }}">
                            @error('name_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_answer_ar') }}</label>
                            <input type="text"
                                   name="answer_ar"
                                   class="form-control"
                                   value="{{ $question->getTranslation('answer','ar') }}">
                            @error('answer_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_answer_en') }}</label>
                            <input type="text"
                                   name="answer_en"
                                   class="form-control"
                                   value="{{ $question->getTranslation('answer','en') }}">
                            @error('answer_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_right_answer_ar') }}</label>
                            <input type="text"
                                   name="right_answer_ar"
                                   class="form-control"
                                   value="{{ $question->getTranslation('right_answer','ar') }}">
                            @error('right_answer_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('Students_trans.question_right_answer_en') }}</label>
                            <input type="text"
                                   name="right_answer_en"
                                   class="form-control"
                                   value="{{ $question->getTranslation('right_answer','en') }}">
                            @error('right_answer_en')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>{{ __('Students_trans.question_degree') }}</label>
                            <input type="number"
                                   name="degree"
                                   class="form-control"
                                   value="{{ $question->degree }}">
                            @error('degree')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-8 mb-3">
                            <label>{{ __('Students_trans.quiz_name') }}</label>
                            <select name="quiz_id" class="custom-select">
                                @foreach($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}"
                                        {{ $quiz->id == $question->quiz_id ? 'selected' : '' }}>
                                        {{ $quiz->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('quiz_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success">
                            {{ trans('Students_trans.Update') }}
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
