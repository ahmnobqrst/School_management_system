@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@section('title')
{{trans('sidebar_trans.section_list')}}
@stop
@endsection

@section('page-header')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('section_trans.Sections')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.section_list')}}</li>
            </ol>
        </div>
    </div>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="container">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsection">
  {{trans('section_trans.add_Section')}}
</button>
<br><br>
  <div class="panel-group">
    <div class="panel panel">
    @foreach($grades as $grade)
      <div class="panel-heading">
        <h4 class="panel-title">
       
          <a data-toggle="collapse" href="#collapse1" class="navbar navbar-light bg-light">{{$grade->name}}</a>
        </h4>
      </div>
   

    <div id="collapse1" class="panel-collapse collapse" class="navbar navbar-light bg-light">
   
      <table class="table" class="table table-striped table-dark" id="table_id">

         <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">{{trans('section_trans.section_name')}}</th>
              <th scope="col">{{trans('section_trans.status')}}</th>
              <th scope="col">{{trans('section_trans.Class_id')}}</th>
              <th scope="col">{{trans('section_trans.Teacher_name')}}</th>
              <th scope="col">{{trans('section_trans.Action')}}</th>
             </tr>
         </thead>
        <tbody>

        @foreach($grade->Sections as $section)
            <tr>
             <th scope="row">{{$section->id}}</th>
             <td>{{$section->section_name}}</td>
             <td>{{$section->status}}
             @if ($section->status === 1)
              <label class="badge badge-success">{{ trans('section_trans.Status_Section_AC') }}</label>
             @else
              <label class="badge badge-danger">{{ trans('section_trans.Status_Section_No') }}</label>
             @endif
             </td>
             <td>{{$section->Classes->Class_name}}</td>
             <td>{{$section->Teachers->name}}</td>
             <td>
                <a href="{{route('section.edit',$section)}}" class="btn btn-outline-info btn-sm"
                  data-toggle="modal"
                  data-target="#edit{{ $section->id }}"><i class="fa fa-edit"></i></a>
                <button  id="deleteBtn"class="btn btn-outline-danger btn-sm"
                  data-toggle="modal"
                  data-target="#delete{{ $section->id }}">
                <i class="fa fa-trash"></i></button>
             </td>

            </tr>

<!------------------ the modal for edit section ------------------------------>

<div class="modal fade" id="edit{{ $sections->id }}" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel"  aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
            {{ trans('Sections_trans.edit_Section') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="{{ route('section.update', 'test') }}" method="POST">
                {{ method_field('patch') }}
                 {{ csrf_field() }}
               <div class="row">
                  <div class="col">
                    <input type="text" name="section_name_ar" class="form-control"
                    value="{{ $sections->getTranslation('section_name', 'ar') }}">
               </div>

               <div class="col">
                    <input type="text" name="section_name_en" class="form-control"
                    value="{{ $sections->getTranslation('section_name', 'en') }}">
                    <!--<input id="id" type="hidden" name="id"  class="form-control"-->
                    <!-- value="{{ $sections->id }}"> -->
               </div>

               </div>
               <br>


               <div class="col">
                  <label for="inputName" class="control-label">{{trans('section_trans.Grade_id')}}</label>
                  <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                 <!--placeholder-->
                 <option value="">{{ $grade->name }}</option>
                 @foreach ($grades as $grade)
                    <option value="{{ $grade->name }}">{{ $grade->name }} </option>
                 @endforeach
                  </select>
               </div>
               <br>

               <div class="col">
                  <label for="inputName" class="control-label">{{ trans('Sections_trans.name_class') }}</label>
                  <select name="Class_id" class="custom-select">
                     <option value="{{ $sections->Classes->id }}">{{ $section->Classes->name }}</option>
                  </select>
               </div>
               <br>

               <div class="col">
                    <div class="form-check">

                      @if ($sections->status === 1)
                        <input type="checkbox" checked class="form-check-input" name="status" id="exampleCheck1">
                      @else
                      <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
                      @endif
                      <label class="form-check-label" for="exampleCheck1">{{ trans('Sections_trans.Status') }}</label>
                    </div>
               </div>


               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                  <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
               </div>
            </form>
          </div>
        </div>
</div>

<!------------------ end the modal for edit section --------------------------->

  
  



         @endforeach
        </tbody>
       </table>

      
      </div>
      @endforeach  
    </div>
  </div>
</div>

@endsection

<!--------------------------------------------------------------------------------->

<!-- the modal for add section -->

<div class="modal" tabindex="-1" role="dialog" id="addsection">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans('section_trans.section_list')}}</h5>
      </div>
      <div class="modal-body">
      <form action="{{route('section.store')}}" method="Post">
        @csrf
        <div class="form-group">
            <label for="module-name">{{__('section_trans.section_name_ar')}}</label>
            <input type="text" class="form-control modal_runsetup_name" name="section_name_ar" placeholder="{{__('section_trans.section_name_ar')}}">
        </div>
        @error('section_name_ar')
           <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
        @enderror 
        <div class="form-group">
            <label for="module-name">{{__('section_trans.section_name_en')}}</label>
            <input type="text" class="form-control modal_runsetup_name" name="section_name_en" placeholder="{{__('section_trans.section_name_en')}}">
        </div>
        @error('section_name_en')
           <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
        @enderror 
        <div class="form-group">
            <label for="module-name">{{__('section_trans.status_ar')}}</label>
            <input type="text" class="form-control modal_runsetup_name" name="status_ar" placeholder="{{__('section_trans.status_ar')}}">
        </div>
        @error('status_ar')
           <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
        @enderror 
        <div class="form-group">
            <label for="module-name">{{__('section_trans.status_en')}}</label>
            <input type="text" class="form-control modal_runsetup_name" name="status_en" placeholder="{{__('section_trans.status_en')}}">
        </div>
        @error('status_en')
           <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
        @enderror
        <div class="form-group col-md-12">
            <label >{{trans('section_trans.Teacher_name')}}</label>
               <select name="teacher_id" id="teacher_id" class="form-control">
               <option value="" selected disabled >{{trans('section_trans.Teacher_name')}}</option>
                  @foreach($teachers as $teacher){
                     <option value="{{$teacher->id}}" >{{$teacher->name}} </option>
                      }
                  @endforeach
            </select>
        </div> 
        <div class="form-group col-md-12">
            <label >{{trans('section_trans.Grade_id')}}</label>
               <select name="Grade_id" id="Grade_id" class="form-control" onchange="console.log($(this).val())">
               <option value="" selected disabled >{{trans('section_trans.name_grade')}}</option>
                  @foreach($grade as $gardes){
                     <option value="{{$gardes->id}}" >{{$gardes->name}} </option>
                      }
                  @endforeach
            </select>
        </div> 
        <div class="form-group col-md-12">
            <label >{{trans('section_trans.Class_id')}}</label>
            <select name="Class_id" id="Class_id" class="form-control">
            </select>
        </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{trans('section_trans.Add Section')}}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('section_trans.close')}}</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------- end the modal for add section -------------------------------------------------->


</div>

<!-- end the modal for add section -->

<!--------------------------------------------------------------------------------------------------->



















@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- Js for add Section -->


            @toastr_js
            @toastr_render
            <script>
                // $(document).ready(function () {
                //     $('select[name="Grade_id"]').on('click', function () {
                //         var Grade_id = $(this).val();
                       

                //         if (Grade_id) {
                //             $.ajax({
                //                 url: "{{ URL::to('classes') }}/" + Grade_id,
                //                 type: "GET",
                //                 dataType: "json",
                //                 success: function (data) {
                //                     $('select[name="Class_id"]').empty();
                //                     $.each(data, function (key, value) {
                //                         $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                //                     });
                //                 },
                //             });
                //         } else {
                //             console.log('AJAX load did not work');
                //         }
                //     });
                // });

$('select[name="Grade_id"]').on('change', function () {
    var Grade_id = $(this).val();
   if (Grade_id) {
        $.ajax({
            url: "{{ URL::to('classes') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="Class_id"]').empty();
                //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $.each(data, function (key, value) {
                    $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});


            </script>

@endsection



 

<!-- Js for End add Section -->