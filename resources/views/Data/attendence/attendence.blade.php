@extends('Dashboard.layouts.master')
@section('css')
<style>
    .studentname {
        color: blue;
        font-size: 30px;
    }
</style>
@toastr_css
@section('title')
{{trans('Students_trans.attendence_list_register')}}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.attendence_list_register')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('section.index')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.attendence_list_register')}}</li>
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


<h5 style="font-family: 'Cairo', sans-serif;color: red"> {{trans('Students_trans.data_today')}}: {{ date('Y-m-d') }}
</h5>
<form method="post" action="{{ route('registerattendence.store',['sectionId' => $section->id]) }}">

    @csrf
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="30"
        style="text-align: center">
        <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)

            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->Gender->name }}</td>
                <td>{{ $student->Grade->name }}</td>
                <td>{{ $student->Classroom->name }}</td>
                <td>{{ $student->Section->section_name }}</td>
                <td>

                    <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendences[{{ $student->id }}]"
                                   @foreach($student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 1 ? 'checked' : '' }}
                                   @endforeach
                                   class="leading-tight" type="radio"
                                   value="presence">
                            <span class="text-success">{{trans('Students_trans.presence')}}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendences[{{ $student->id }}]"
                                   @foreach($student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 0 ? 'checked' : '' }}
                                   @endforeach
                                   class="leading-tight" type="radio"
                                   value="absent">
                            <span class="text-danger">{{trans('Students_trans.absence')}}</span>
                        </label>

               

                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                    <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                    <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                    <input type="hidden" name="section_id" value="{{ $student->section_id }}">



                </td>

            </tr>



            @endforeach


        </tbody>

    </table>
    @if($students->count() > 0)
    <p>
        <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
    </p>
    @endif

</form><br>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection