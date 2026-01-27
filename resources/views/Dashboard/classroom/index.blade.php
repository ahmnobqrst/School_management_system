@extends('Dashboard.layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
<style>
    /* تحسينات الواجهة الأساسية */
    .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    .table thead th { background-color: #f8f9fa; color: #333; font-weight: 600; border-top: none; }
    
    /* تصميم الـ Modal المطور */
    .modal-xl { max-width: 90%; } /* تجعل المودال يأخذ مساحة أكبر */
    .modal-content { border-radius: 15px; border: none; overflow: hidden; }
    .modal-header { background-color: #f8f9fa; border-bottom: 2px solid #eee; }
    
    /* تصميم أسطر الإدخال (Repeater) */
    .repeater-item { 
        background: #ffffff; 
        border: 1px solid #e0e0e0; 
        border-radius: 10px; 
        padding: 20px; 
        margin-bottom: 15px; 
        position: relative; 
        transition: all 0.3s ease;
    }
    .repeater-item:hover { border-color: #007bff; box-shadow: 0 5px 15px rgba(0,123,255,0.05); }
    .repeater-item .delete-btn { 
        position: absolute; 
        top: -10px; 
        left: -10px; 
        background: #ff3547; 
        color: white; 
        border-radius: 50%; 
        width: 25px; 
        height: 25px; 
        border: none;
        line-height: 25px;
        text-align: center;
        padding: 0;
        z-index: 10;
    }
    .field-label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 5px; display: block; }
</style>
@section('title')
{{trans('sidebar_trans.class_list')}}
@stop
@endsection

@section('page-header')
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-sm-6 text-right">
            <h4 class="mb-0 font-weight-bold"><i class="fa fa-university ml-2 text-primary"></i> {{trans('class_trans.classrooms')}}</h4>
        </div>
        <div class="col-sm-6 text-left">
            <ol class="breadcrumb bg-transparent p-0 m-0 d-inline-flex">
                <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="text-muted">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active text-primary font-weight-bold">{{trans('sidebar_trans.class_list')}}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger shadow-sm border-0">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li><i class="fa fa-exclamation-circle ml-2"></i>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row text-right" dir="rtl">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <button type="button" class="btn btn-primary px-4 shadow-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle ml-1"></i> {{trans('class_trans.add_classroom')}}
                        </button>
                        <button id="delete_all_selected" type="button" class="btn btn-outline-danger px-4" data-toggle="modal" data-target="#Delete_all">
                            <i class="fa fa-trash-alt ml-1"></i> {{trans('class_trans.remove_more_class')}}
                        </button>
                    </div>
                    
                    <div class="w-25">
                        <form action="{{route('filter_grade')}}" method="POST">
                            @csrf
                            <select name="Grade_id" class="form-control custom-select shadow-none" required onchange="this.form.submit()">
                                <option value="" selected disabled>{{trans('class_trans.search_by_grade')}}</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="table_id" class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"/></th>
                                <th>#</th>
                                <th>{{trans('class_trans.class_name')}}</th>
                                <th>{{trans('class_trans.class_description')}}</th>
                                <th>{{trans('class_trans.grade_name')}}</th>
                                <th>{{trans('class_trans.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $list_classes = isset($details) ? $details : $myclass; @endphp
                            @foreach($list_classes as $index => $myclasses)
                            <tr>
                                <td><input type="checkbox" name="check" value="{{$myclasses->id}}" class="select_classes"/></td>
                                <td>{{ $index + 1 }}</td>
                                <td class="font-weight-bold">{{$myclasses->name}}</td>
                                <td class="text-muted small">{{$myclasses->desc}}</td>
                                <td><span class="badge badge-light p-2 px-3 border text-primary">{{$myclasses->grades->name}}</span></td>
                                <td>
                                    <a href="{{route('classrooms.edit',$myclasses)}}" class="btn btn-info btn-sm ml-1"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete.class',$myclasses->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $list_classes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title font-weight-bold"><i class="fa fa-layer-group ml-2 text-primary"></i> {{trans('class_trans.add_classroom')}}</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form repeater-default" action="{{route('classrooms.store')}}" method="Post">
                @csrf
                <div class="modal-body bg-light p-4">
                    <div data-repeater-list="class_list">
                        <div data-repeater-item class="repeater-item shadow-sm text-right">
                            <button data-repeater-delete type="button" class="delete-btn shadow-sm" title="حذف هذا السطر">
                                <i class="fa fa-times"></i>
                            </button>
                            
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <label class="field-label">{{trans('class_trans.class_name_ar')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name_ar" placeholder="مثال: الفصل الأول" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <label class="field-label">{{trans('class_trans.class_name_en')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name_en" placeholder="Example: First Class" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <label class="field-label">{{trans('class_trans.grade_name')}} <span class="text-danger">*</span></label>
                                    <select name="grade_id" class="form-control custom-select">
                                        @foreach($grades as $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <label class="field-label">{{trans('class_trans.desc_class_room')}}</label>
                                    <input type="text" class="form-control" name="desc_ar" placeholder="{{trans('class_trans.desc_class_room')}}...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm px-4 rounded-pill" data-repeater-create type="button">
                            <i class="fa fa-plus-circle ml-1"></i> {{trans('class_trans.add')}}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">{{trans('class_trans.close')}}</button>
                    <button type="submit" class="btn btn-success px-5 shadow-sm font-weight-bold">{{trans('class_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Delete_all" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{route('delete_all')}}" method="POST" class="modal-content">
            @csrf
            <div class="modal-body text-center p-5">
                <i class="fa fa-exclamation-triangle fa-4x text-danger mb-4"></i>
                <h4 class="font-weight-bold">{{trans('class_trans.sure_delete_all')}}</h4>
                <input type="hidden" name="delete_all_id" id="delete_all_id" value="">
                <div class="mt-4">
                    <button type="button" class="btn btn-light px-4 ml-2" data-dismiss="modal">{{trans('class_trans.close')}}</button>
                    <button type="submit" class="btn btn-danger px-4">{{trans('class_trans.Delete_all')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>
<script>
    $('.repeater-default').repeater({
        show: function () { 
            $(this).slideDown(); 
            $(this).find('input').first().focus();
        },
        hide: function (deleteElement) {
            if (confirm('هل أنت متأكد من حذف هذا السطر؟')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    function check_uncheck_checkbox(isChecked) {
        $('input[name="check"]').prop('checked', isChecked);
        updateDeleteButton();
    }

    $(document).on('change', 'input[name="check"]', function() {
        updateDeleteButton();
    });

    function updateDeleteButton() {
        var selected = [];
        $("input[name='check']:checked").each(function(){
            selected.push($(this).val());
        });
        
        if(selected.length > 0) {
            $("#delete_all_selected").prop("disabled", false);
            $('#delete_all_id').val(selected.join(','));
        } else {
            $("#delete_all_selected").prop("disabled", true);
        }
    }

    $(document).ready(function() {
        $("#delete_all_selected").prop("disabled", true);
    });
</script>
@endpush