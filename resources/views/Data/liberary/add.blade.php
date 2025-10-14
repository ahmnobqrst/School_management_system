@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Add_new_liberary')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Add_new_liberary')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Add_new_liberary')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Add_new_liberary')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post" action="{{ route('liberary.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('grade_id')
                              <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>

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

                    </div><br>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.book_title_ar')}}: <span class="text-danger">*</span></label>
                                <input class="form-control" name="title_ar" type="text">
                            </div>

                        </div>
                        @error('title_ar')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.book_title_en')}}: <span class="text-danger">*</span></label>
                                <input class="form-control" name="title_en" type="text">
                            </div>
                        </div>
                        @error('title_ar')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 

                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.Attachments')}}:: <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="file_name[]" multiple>
                            </div>
                        </div>
                        @error('file_name')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('select[name="grade_id"]').on('change', function() {
        var Grade_id = $(this).val();
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('teacher/dashboard/classes_for_grade') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="classroom_id"]').empty();
                    $('select[name="classroom_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                    $.each(data, function(key, value) {
                        $('select[name="classroom_id"]').append('<option value="' +
                            key + '">' + value + '</option>');
                            console.log("this is id For Classroom : ",key);
                    });
                },
            });
            
        } else {
            console.log('AJAX load did not work');
        }
    });
});

$('select[name="classroom_id"]').on('change', function() {
    var Classroom_id = $(this).val();
    if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('teacher/dashboard/sections_for_grade') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="section_id"]').empty();
                // $('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $('select[name="section_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                $.each(data, function(key, value) {
                    $('select[name="section_id"]').append('<option value="' + key + '">' +
                        value + '</option>');
                });
            },
        });
    } else {
        console.log('AJAX load did not work');
    }
});
</script>
@toastr_js
@toastr_render

@endsection