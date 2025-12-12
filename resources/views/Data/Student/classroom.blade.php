@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
@section('title')
{{trans('sidebar_trans.class_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="mb-0">{{trans('class_trans.classrooms')}}</h4>
    </div>
    <div class="col-sm-12">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="{{url('/teacher/dashboard')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
        <li class="breadcrumb-item active">{{trans('sidebar_trans.class_list')}}</li>
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



<!-- the form to filter the grade -->


<!-- Modal -->


<div class="table-responsive">


  <table id="table_id" class="table  table-hover table-sm table-bordered p-0"
    data-page-length="50"
    style="text-align: center">

    <thead>
      <tr>
        <!-- ده معناه ان انا اول ما اضغط عليه يعلم عليهم كلهم واول ما ادوس -->
        <th scope="col">#</th>
        <th scope="col">{{trans('class_trans.class_name')}}</th>
        <th scope="col">{{trans('class_trans.class_description')}}</th>
        <th scope="col">{{trans('class_trans.grade_name')}}</th>
      </tr>
    </thead>
    <tbody>

      <?php $i = 0; ?>

      <tr>
        <?php $i++; ?>
        <td scope="row">{{$i++; }}</td>
        <td>{{$studentClassroom->name}}</td>
        <td>{{$studentClassroom->desc}}</td>
        <td>{{$studentClassroom->grades->name}}</td>
      </tr>

    </tbody>
  </table>
</div>

@endsection