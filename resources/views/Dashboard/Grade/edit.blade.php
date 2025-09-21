@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Edit_Grade')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Edit_Grade')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Edit_Grade')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Edit_Grade')}}</li>
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
                        <form action="{{route('grades.update','update')}}" method="Post" enctype="multipart/form-data">

@method('PUT')
         @csrf
         <div class="row">
            <div class="card">
               <div class="card-header">
                   <strong>{{trans('grades_trans.grade_name')}}</strong>
               </div>
               <div class="card-block">
                   <div class="form-group col-md-12">
                    <input type="hidden" name="id" value="{{$Grade->id}}"/>
                      <label ><h4>{{trans('grades_trans.grade_name_ar')}}</h4></label>
                      <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$Grade->getTranslation('name','ar')}}" >
                      @error('name_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('grades_trans.grade_name_en')}}</h4></label>
                      <input type="text" class="form-control" name="name_en" id="name_en" value="{{$Grade->getTranslation('name','en')}}" >
                      @error('name_en')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('grades_trans.description_ar')}}</h4></label>
                      <input type="text" class="form-control" name="desc_ar" id="desc_ar" value="{{$Grade->getTranslation('desc','ar')}}">
                      @error('desc_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('grades_trans.description_en')}}</h4></label>
                      <input type="text" class="form-control" name="desc_en" id="desc_en" value="{{$Grade->getTranslation('desc','en')}}">
                      @error('desc_en')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
               </div>
               <div class="form-group col-md-12">
                   <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i>{{trans('Students_trans.Update')}}</button>
               </div>
            </div>
               
            
            
            

         </div>






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