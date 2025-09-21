@extends('Dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Students_trans.Student_Edit')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.Student_Edit')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Student_Edit')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Student_Edit')}}</li>
            </ol>
        </div>
    </div>
</div>

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                

                <form method="post"  action="{{ route('students.update',$students->id) }}" autocomplete="off">
                    @csrf
                    {{ method_field('patch') }}
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control" value="{{$students->getTranslation('name','ar')}}">
                                    <input  type="hidden" name="id"  class="form-control" value="{{$students->id}}">
                                </div>
                            </div>
                            @error('name_ar')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" value="{{$students->getTranslation('name','en')}}">
                                </div>
                            </div>
                            @error('name_en')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.email')}} : </label>
                                    <input type="email"  name="email" class="form-control" value="{{$students->email}}" >
                                </div>
                                @error('email')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" value="{{$students->password}}" >
                                </div>
                                @error('password')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('Students_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <!-- <option selected disabled value="{{$students->gender_id}}">{{$students->Gender->name}}</option> -->
                                        @foreach($Genders as $Gender)
                                        <option value="{{ $Gender->id }}" {{$Gender->id == $students->gender_id ? 'selected' : ""}}>{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('gender_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('Students_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="national_student_id">
                                        @foreach($nationals as $nal)
                                          <option value="{{ $nal->id }}" {{$nal->id == $students->nationalitie_id ? 'selected' : ""}}>{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('national_student_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('Students_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_type_student_id">
                                        @foreach($bloods as $bg)
                                         <option value="{{ $bg->id }}" {{$bg->id == $students->blood_type_student_id ? 'selected' : ""}}> {{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blood_type_student_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.Date_of_Birth')}}  :</label>
                                    <input value="{{$students->birth_of_date}}" class="form-control" type="text"  id="datepicker-action" name="birth_of_date" data-date-format="yyyy-mm-dd">
                                </div>
                                @error('birth_of_date')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.Student_information')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id" id="grade_id">
                                    <!-- <option selected disabled value="{{$students->grade_id}}">{{$students->Grade->name}}</option> -->
                                        @foreach($grades as $grade)
                                            <option  value="{{ $grade->id }}"{{$grade->id == $students->grade_id ? "selected": "" }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('grade_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id" id="classroom_id">
                                      <option selected disabled value="{{$students->classroom_id}}">{{$students->Classroom->name}}</option>
                                    </select>
                                </div>
                                @error('classroom_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id" id="section_id">
                                       <option selected disabled value="{{$students->section_id}}">{{$students->Section->section_name}}</option>
                                    </select>
                                </div>
                                @error('section_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('Students_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                    <!-- <option selected disabled value="{{$students->parent_id}}">{{$students->Parents->name_of_father}}</option> -->
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{$parent->id == $students->Parents->id ? "selected" : " " }}>{{ $parent->name_of_father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <!-- <option selected disabled value="{{$students->academic_year}}">{{$students->academic_year}}</option> -->
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                    <option value="{{ $year }}" {{ $year == $students->academic_year? "selected" : " " }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            @error('academic_year')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>
                        </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.Update')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <!-- <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script> -->
<script>

$('select[name="grade_id"]').on('change', function () {
    var Grade_id = $(this).val();
   if (Grade_id) {
        $.ajax({
            url: "{{ URL::to('classes') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="classroom_id"]').empty();
                
                $.each(data, function (key, value) {
                    $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                    $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});


</script>


    <!-- <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script> -->
    <script>

$('select[name="classroom_id"]').on('change', function () {
    var Classroom_id = $(this).val();
   if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('sections') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="section_id"]').empty();
                //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $.each(data, function (key, value) {
                    $('select[name="section_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                    $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});


</script>
@endsection