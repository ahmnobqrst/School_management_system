@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.subject_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.subject_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.subject_list')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.subject_list')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('subjects.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('Students_trans.Add_subject')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.subject_name')}}</th>
                                            <th>{{trans('section_trans.Grade_id')}}</th>
                                            <th>{{trans('section_trans.Class_id')}}</th>
                                            <th>{{trans('section_trans.Teacher_name')}}</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjects as $subject)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grades->name}}</td>
                                            <td>{{$subject->classrooms->name}}</td>
                                            <td>{{$subject->teachers->name}}</td>
                                            <td>
                                                <a href="{{route('subjects.edit',$subject->id)}}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_subject{{ $subject->id }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="delete_subject{{$subject->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('subjects.destroy','test')}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{trans('Students_trans.Delete_subject')}}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                {{ trans('Students_trans.sure_Delete_subject') }}
                                                                <span class="text-danger">{{ $subject->name }}</span>
                                                            </p>
                                                            <input type="hidden" name="id" value="{{$subject->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $subjects->links() }}
                                </div>
                            </div>
                        </div>
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