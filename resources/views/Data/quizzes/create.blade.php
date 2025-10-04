@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Add_quiz')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Add_quiz')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Add_quiz')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Add_quiz')}}</li>
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
                        <form action="{{route('quizz.store')}}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                                @error('name_ar')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                                <div class="col">
                                    <label for="title">{{__('Students_trans.quiz_name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control">
                                </div>
                                @error('name_en')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{trans('Students_trans.subject_name')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id" disabled>
                                            <option value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('subject_id')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id">
                                            <option selected disabled>{{trans('parent_trans.Choose')}}...</option>
                                            @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('grade_id')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="classroom_id">

                                        </select>
                                    </div>
                                </div>
                                @error('classroom_id')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">

                                        </select>
                                    </div>
                                </div>
                                @error('section_id')
                                   <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 

                            </div>
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
<script>
$('select[name="grade_id"]').on('change', function() {
    var Grade_id = $(this).val();
    if (!Grade_id) return;

    var url = "{{ route('teacher.classes_for_grade', ['grade_id' => '__ID__']) }}";
    url = url.replace('__ID__', Grade_id);

    $.getJSON(url, function(data) {
        var $classroom = $('select[name="classroom_id"]').empty();
        $classroom.append('<option selected disabled>{{ trans("parent_trans.Choose") }}...</option>');
        $.each(data, function(id, name) {
            $classroom.append('<option value="'+ id +'">'+ name +'</option>');
        });
        // مسح الأقسام القديمة لأن الفصل تغيّر
        $('select[name="section_id"]').empty().append('<option selected disabled>{{ trans("parent_trans.Choose") }}...</option>');
    }).fail(function(xhr){
        console.error('Error loading classrooms:', xhr);
    });
});

$('select[name="classroom_id"]').on('change', function() {
    var Classroom_id = $(this).val();
    if (!Classroom_id) return;

    var url = "{{ route('teacher.sections_for_grade', ['classroom_id' => '__ID__']) }}";
    url = url.replace('__ID__', Classroom_id);

    $.getJSON(url, function(data) {
        var $section = $('select[name="section_id"]').empty();
        $section.append('<option selected disabled>{{ trans("parent_trans.Choose") }}...</option>');
        $.each(data, function(id, name) {
            $section.append('<option value="'+ id +'">'+ name +'</option>');
        });
    }).fail(function(xhr){
        console.error('Error loading sections:', xhr);
    });
});
</script>

@endsection