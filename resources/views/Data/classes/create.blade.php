@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Add_online_class')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Add_online_class')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Add_online_class')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Add_online_class')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post" action="{{ route('onlineclasses.store') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="grad_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('grad_id')
                              <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="class_id">

                                </select>
                            </div>
                        </div>
                        @error('class_id')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 

                        <div class="col">
                            <div class="form-group">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="sect_id">

                                </select>
                            </div>
                        </div>
                        @error('sect_id')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 

                    </div><br>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.title_leacture_ar')}}: <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic_ar" type="text">
                            </div>

                        </div>
                        @error('topic_ar')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.title_leacture_en')}}: <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic_en" type="text">
                            </div>
                        </div>
                        @error('topic_en')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.data_time_leacture')}}:: <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time">
                            </div>
                        </div>
                        @error('start_time')
                             <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                        @enderror 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Students_trans.duration')}}: <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="text">
                            </div>
                        </div>
                        @error('duration')
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

@toastr_js
@toastr_render

@endsection