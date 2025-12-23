@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
@section('title')
{{trans('sidebar_trans.questions_student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="mb-0">{{trans('sidebar_trans.questions_student')}}</h4>
    </div>
    <div class="col-sm-12">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('Students_trans.Home')}}</a></li>
        <li class="breadcrumb-item active">{{trans('sidebar_trans.questions_student')}}</li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('content')
@livewire('show-student-questions',['quiz_id'=>$quiz_id,'student_id'=>$student_id])
@endsection







