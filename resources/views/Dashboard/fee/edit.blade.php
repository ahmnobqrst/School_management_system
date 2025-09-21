@extends('Dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('fee_trans.Fees_Edit')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('fee_trans.Fees_Edit')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0"> {{trans('fee_trans.Fees_Edit')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('fee_trans.Fees_Edit')}}</li>
            </ol>
        </div>
    </div>
</div>

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                

                <form method="post"  action="{{ route('fees.update','test') }}" autocomplete="off">
                    @csrf
                    {{ method_field('patch') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('fee_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control" value="{{$fee->getTranslation('name','ar')}}">
                                    <input  type="hidden" name="id"  class="form-control" value="{{$fee->id}}">
                                </div>
                            </div>
                            @error('name_ar')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('fee_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" value="{{$fee->getTranslation('name','en')}}">
                                </div>
                            </div>
                            @error('name_en')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <!-- <option selected disabled value="{{$fee->year}}">{{$fee->year}}</option> -->
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                    <option value="{{ $year }}" {{ $year == $fee->year? "selected" : " " }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            @error('academic_year')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('fee_trans.amount')}} : </label>
                                    <input type="text"  name="amount" class="form-control" value="{{$fee->amount}}" >
                                </div>
                                @error('amount')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('fee_trans.desc_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="desc_ar"  class="form-control" value="{{$fee->getTranslation('desc','ar')}}">
                                </div>
                            </div>
                            @error('desc_ar')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('fee_trans.desc_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="desc_en" type="text" value="{{$fee->getTranslation('desc','en')}}">
                                </div>
                            </div>
                            @error('desc_en')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror 
                        </div>
                        </div>

                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id" id="grade_id">
                                    <!-- <option selected disabled value="{{$fee->grade_id}}">{{$fee->Grades->name}}</option> -->
                                        @foreach($grades as $grade)
                                            <option  value="{{ $grade->id }}"{{$grade->id == $fee->grade_id ? "selected": "" }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('grade_id')
                                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                @enderror 
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id" id="classroom_id">
                                      <option selected disabled value="{{$fee->classroom_id}}">{{$fee->Classes->name}}</option>
                                    </select>
                                </div>
                                @error('classroom_id')
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
@endsection