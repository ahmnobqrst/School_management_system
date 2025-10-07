@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.question_sections')}}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0"> {{trans('sidebar_trans.question_sections')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active"> {{trans('sidebar_trans.question_sections')}}</li>
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


@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">


            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">
                        @foreach ($grade as $grades)
                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{$grades->name}}</a>
                            <div class="acd-des">
                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{trans('section_trans.section_name')}}</th>
                                                                <th>{{trans('section_trans.ClassName')}}</th>
                                                                <th>{{trans('section_trans.status')}}</th>
                                                                <th>{{trans('section_trans.Operations')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php $i = 0; ?>
                                                            @foreach ($grades->Sections as $list_Sections)

                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $list_Sections->section_name }}</td>
                                                                <td>{{ $list_Sections->Classes->name }}
                                                                </td>
                                                                </td>

                                                                </td>
                                                                <td>
                                                                    @if ($list_Sections->status === 1)
                                                                    <label
                                                                        class="badge badge-success">{{ trans('section_trans.Status_Section_AC') }}</label>
                                                                    @else
                                                                    <label
                                                                        class="badge badge-danger">{{ trans('section_trans.Status_Section_No') }}</label>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                  <a type="button" class="btn btn-primary" href="{{route('questions',$list_Sections->id)}}">{{trans('sidebar_trans.question_sections_report')}}</a>
                                                                </td>

                                                            </tr>





                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            @endforeach

                        </div>


                </div>
            </div>
            @endsection




            @endsection
            @section('js')
           
            @endsection