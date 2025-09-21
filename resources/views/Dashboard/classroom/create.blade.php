@extends('dashboard.layouts.master')
@section('content')

@if (session('exists'))
<div class="container">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p>{{{ session('exists') }}}</p>
    </div>
</div>
@endif

<!-- <form action="{{route('grades.store')}}" method="Post" enctype="multipart/form-data">
<div class="card-block">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">{{trans('grades_trans.grade_name')}}</label>
      <input type="text" class="form-control" id="name" placeholder="{{trans('grades_trans.grade_name')}}">
    </div>
    <div class="form-group col-md-6">
      <label for="description">{{trans('grades_trans.description')}}</label>
      <input type="text" class="form-control" id="desc" placeholder="{{trans('grades_trans.description')}}">
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">{{trans('grades_trans.submit')}}</button>
</div>
</form> -->

<form action="{{route('classrooms.store')}}" method="Post" enctype="multipart/form-data">
         
         @csrf
         <div class="row">
            <div class="card">
               <div class="card-header">
                   <strong>{{trans('class_trans.class_name')}}</strong>
               </div>
               <div class="card-block">
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_name_ar')}}</h4></label>
                      <input type="text" class="form-control" name="name_ar" id="name_ar" >
                      @error('name_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_name_en')}}</h4></label>
                      <input type="text" class="form-control" name="name_en" id="name_en" >
                      @error('name_en')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_description_ar')}}</h4></label>
                      <input type="text" class="form-control" name="desc_ar" id="desc_ar" >
                      @error('desc_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_description_en')}}</h4></label>
                      <input type="text" class="form-control" name="desc_en" id="desc_en" >
                      @error('desc_en')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                       <label ><h4>{{trans('grades_trans.grade_id')}}</h4></label>
                       <select name="Grade_id" id="" class="form-control">
                          @foreach($grades as $grade){
                           <option value="{{$grade->id}}" >{{$grade->name}} </option>
                          }
                          @endforeach
                       </select>
                    </div>
               </div>
               <div class="form-group col-md-12">
                   <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i>{{trans('class_trans.class_submit')}}</button>
               </div>
            </div>
               
            
            
            

         </div>






      </form>


@endsection