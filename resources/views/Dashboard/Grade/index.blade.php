@extends('Dashboard.layouts.master')

@section('css')
@toastr_css
<style>
    /* تحسينات التصميم الاحترافي ليتناسب مع صفحة الفصول */
    .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; }
    .table thead th { background-color: #f8f9fa; color: #333; font-weight: 600; border-top: none; text-transform: uppercase; font-size: 0.85rem; }
    .btn { border-radius: 8px; font-weight: 500; transition: all 0.2s; }
    .breadcrumb-item a { color: #888; }
    .breadcrumb-item.active { color: #007bff; font-weight: bold; }
    .action-icons i { font-size: 1.1rem; }
</style>
@section('title')
{{trans('sidebar_trans.Grade_list')}}
@stop
@endsection

@section('page-header')
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-sm-6 text-right">
            <h4 class="mb-0 font-weight-bold"><i class="fa fa-graduation-cap ml-2 text-primary"></i> {{trans('sidebar_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-6 text-left">
            <ol class="breadcrumb bg-transparent p-0 m-0 d-inline-flex">
                <li class="breadcrumb-item"><a href="{{route('grades.index')}}">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.Grade_list')}}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row text-right" dir="rtl">
    <div class="col-md-12 mb-30">
        <div class="card h-100">
            <div class="card-body">
                
                <div class="mb-4">
                    <a href="{{route('grades.create')}}" class="btn btn-primary px-4 shadow-sm shadow-hover">
                        <i class="fa fa-plus-circle ml-1"></i> {{trans('grades_trans.add_grade')}}
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-hover text-center" data-page-length="50">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>{{trans('grades_trans.grade_name')}}</th>
                                <th>{{trans('grades_trans.description')}}</th>
                                <th width="150">{{trans('grades_trans.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                            <tr>
                                <td class="text-muted">{{$loop->iteration}}</td>
                                <td class="font-weight-bold text-dark">{{$grade->name}}</td>
                                <td class="text-muted small">{{$grade->desc ?? '---'}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('grades.edit',$grade->id)}}" class="btn btn-outline-info btn-sm ml-2" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">
                                                <i class="fa fa-exclamation-triangle ml-2"></i> {{trans('grades_trans.Delete_grade')}}
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('grades.destroy',$grade->id)}}" method="Post">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-body text-center p-5">
                                                <div class="mb-3 text-danger">
                                                    <i class="fa fa-trash-alt fa-3x"></i>
                                                </div>
                                                <h5 class="font-weight-bold">{{trans('grades_trans.sure delete')}}</h5>
                                                <p class="text-muted small">سيتم حذف المرحلة "{{$grade->name}}" وجميع البيانات المرتبطة بها.</p>
                                                <input type="hidden" name="id" value="{{$grade->id}}">
                                            </div>
                                            <div class="modal-footer border-0 d-flex justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4" data-dismiss="modal">{{trans('teacher_trans.Close')}}</button>
                                                <button type="submit" class="btn btn-danger px-5 shadow-sm">{{trans('teacher_trans.Delete')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection