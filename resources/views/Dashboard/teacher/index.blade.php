@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@toastr_css
@section('title')
{{trans('teacher_trans.teacher_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('teacher_trans.teacher_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('teacher_trans.Teachers')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('teacher_trans.teacher_list')}}</li>
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
                            <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('teacher_trans.add_Teacher')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('teacher_trans.teacher_name')}}</th>
                                            <th scope="col">{{trans('teacher_trans.teacher_email')}}</th>
                                            <th scope="col">{{trans('teacher_trans.sepcailists')}}</th>
                                            <th scope="col">{{trans('teacher_trans.Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teachers as $teacher)
                                        <tr>
                                            <td scope="col">{{$loop->iteration}}</td>
                                            <td scope="col">{{$teacher->name}}</td>
                                            <td scope="col">{{$teacher->email}}</td>
                                            <td scope="col">{{$teacher->Specializations->name}}</td>
                                            <td>
                                                <a href="{{route('teachers.edit',$teacher->id)}}"
                                                    class="btn btn-outline-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button id="deleteBtn" class="btn btn-outline-danger btn-sm"
                                                    data-toggle="modal" data-target="#delete{{ $teacher->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('teachers.show', $teacher->id) }}"
                                                    class="btn btn-outline-primary btn-sm"
                                                    title="{{ trans('Students_trans.show_teacher_data') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>



                                        </tr>


                                        <!-------------------------------------- the modal for delete teacher ------------------------------------------------>


                                        <div class="modal" tabindex="-1" role="dialog" id="delete{{ $teacher->id }}">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('teachers.destroy',$teacher->id)}}" method="Post">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                {{method_field('delete')}}
                                                                {{csrf_field()}}
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('teacher_trans.Delete_Teacher') }}
                                                                </h5>
                                                                <div class="form-group">
                                                                    <p>{{trans('teacher_trans.sure delete')}}</p>
                                                                    @csrf
                                                                    <input type="hidden" name="id" id="id"
                                                                        value="{{$teacher->id}}">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-info"
                                                                data-dismiss="modal">{{trans('teacher_trans.Close')}}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{trans('teacher_trans.Delete')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-------------------------------------- the End modal for delete teacher ------------------------------------------------>


                                        @endforeach
                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $teachers->links() }}
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