@extends('dashboard.layouts.master')
@section('content')

@if (session('updated'))
<div class="container">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p>{{session('updated')}}</p>
    </div>
</div>
@endif
<form action="{{route('classrooms.update',$Classroom)}}" method="Post" enctype="multipart/form-data">

@method('PUT')
         @csrf
         <div class="row">
            <div class="card">
               <div class="card-header">
                   <strong>{{trans('class_trans.class_name_classrooms')}}</strong>
               </div>
               <div class="card-block">
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_name_ar')}}</h4></label>
                      <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$Classroom->getTranslation('name','ar')}}" >
                      @error('name_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.class_name_en')}}</h4></label>
                      <input type="text" class="form-control" name="name_en" id="name_en" value="{{$Classroom->getTranslation('name','en')}}" >
                      @error('name')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.description_ar')}}</h4></label>
                      <input type="text" class="form-control" name="desc_ar" id="desc_ar" value="{{$Classroom->getTranslation('desc','ar')}}">
                      @error('desc_ar')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label ><h4>{{trans('class_trans.description_en')}}</h4></label>
                      <input type="text" class="form-control" name="desc_en" id="desc_en" value="{{$Classroom->getTranslation('desc','en')}}">
                      @error('desc_en')
                       <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                       @enderror 
                   </div>
                   <div class="form-group col-md-12">
                      <label for="gender">{{trans('class_trans.grade_name')}}</label>
        
                      <select name="grade_id" id="grade_id" class="form-control">
                        <option value="{{$Classroom->Grades->id}}">
                            {{$Classroom->Grades->name}}
                        </option>
                         @foreach($grades as $grade)
                           <option value="{{$grade->id}}">{{$grade->name}}</option>
                         @endforeach
                      </select>
          
                  </div>
               </div>
               <div class="form-group col-md-12">
                   <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i>{{trans('class_trans.update')}}</button>
               </div>
            </div>
               
            
            
            

         </div>






      </form>


@endsection