@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('sidebar_trans.attendence_list_list') }}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0"> {{ trans('sidebar_trans.attendence_list_list') }}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('section.index')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active"> {{ trans('sidebar_trans.attendence_list_list') }}</li>
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

<!-- breadcrumb -->
<div class="card-body">
    <button type="button" class="button x-small" data-toggle="modal" data-target="#addsection">
        {{trans('section_trans.add_Section')}}
    </button>
</div>



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
                                                                  <a type="button" class="btn btn-primary" href="{{route('attendence.show',$list_Sections->id)}}">{{trans('Students_trans.student')}}</a>
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



                        <!--------------------------------------------------------------------- the modal for insert section ----------------------------------------------------------------------------------------------------->
                        <div class="modal" tabindex="-1" role="dialog" id="addsection" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{trans('section_trans.modal_insert_section')}}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('section.store')}}" method="Post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="module-name">{{__('section_trans.section_name_ar')}}</label>
                                                <input type="text" class="form-control modal_runsetup_name"
                                                    name="section_name_ar"
                                                    placeholder="{{__('section_trans.section_name_ar')}}">
                                            </div>
                                            @error('section_name_ar')
                                            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                            @enderror
                                            <div class="form-group">
                                                <label for="module-name">{{__('section_trans.section_name_en')}}</label>
                                                <input type="text" class="form-control modal_runsetup_name"
                                                    name="section_name_en"
                                                    placeholder="{{__('section_trans.section_name_en')}}">
                                            </div>
                                            @error('section_name_en')
                                            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                            @enderror

                                            <div class="form-group col-md-12">
                                                <label>{{trans('section_trans.Grade_id')}}</label>
                                                <select name="Grade_id" id="Grade_id" class="form-control"
                                                    onchange="console.log($(this).val())">
                                                    <option value="" selected disabled>
                                                        {{trans('section_trans.name_grade')}}</option>
                                                    @foreach($grade as $gardes){
                                                    <option value="{{$gardes->id}}">{{$gardes->name}} </option>
                                                    }
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>{{trans('section_trans.Class_id')}}</label>
                                                <select name="Class_id" id="Class_id" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>{{trans('section_trans.Teacher_name')}}</label>
                                                <select name="teacher_id[]" id="teacher_id[]" class="form-control"
                                                    multiple>
                                                    <option value="" selected disabled>
                                                        {{trans('section_trans.Teacher_name')}}</option>
                                                    @foreach($teachers as $teacher){
                                                    <option value="{{$teacher->id}}">{{$teacher->name}} </option>
                                                    }
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                    class="btn btn-primary">{{trans('section_trans.Add Section')}}</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{trans('section_trans.Close')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-----------------------------------------------------------------------End the modal for insert section ------------------------------------------------------------------------------------------------------->
                </div>
            </div>
            @endsection




            @endsection
            @section('js')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


            <!-- Js for add Section -->


            @toastr_js
            @toastr_render
            <script>
            $('select[name="Grade_id"]').on('change', function() {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Class_id"]').empty();
                            //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                            $.each(data, function(key, value) {
                                $('select[name="Class_id"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
            </script>

            @endsection