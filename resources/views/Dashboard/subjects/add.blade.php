@extends('Dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Students_trans.Add_subject_New')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Add_subject_New')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Add_subject_New')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Add_subject_New')}}</li>
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
                            <form action="{{route('subjects.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.subject_name_ar')}}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                    </div>
                                    @error('name_ar')
                                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 
                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.subject_name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control">
                                    </div>
                                    @error('name_en')
                                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                     @enderror 
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('grades_trans.grade_name')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('Grade_id')
                                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 

                                    <div class="form-group col">
                                        <label for="inputState">{{trans('class_trans.class_name')}}</label>
                                        <select name="Class_id" class="custom-select"></select>
                                    </div>
                                    @error('Class_id')
                                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 


                                    <div class="form-group col">
                                        <label for="inputState">{{trans('section_trans.Teacher_name')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id[]">
                                        </select>
                                    </div>
                                    @error('teacher_id')
                                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
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