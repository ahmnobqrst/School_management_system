@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.Accounters')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.Accounters')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.fees')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('fees.index')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.fees')}}</li>
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
                            <a href="{{route('fees.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('fee_trans.add_fees')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('fee_trans.fee_name')}}</th>
                                            <th>{{trans('fee_trans.fee_amount')}}</th>
                                            <th>{{trans('fee_trans.fee_year')}}</th>
                                            <th>{{trans('fee_trans.fee_desc')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $fee)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$fee->name}}</td>
                                            <td>{{$fee->amount}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->desc}}</td>
                                            <td>{{$fee->Grades->name}}</td>
                                            <td>{{$fee->Classes->name}}</td>
                                            <td>
                                                <a href="{{route('fees.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                <a href="{{route('fees.show',$fee->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>


                                        <!-------------------------------------------------- Modal for Delete Fee --------------------------------------------->

                                        <div class="modal fade" id="Delete_Fee{{$fee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('fee_trans.Deleted_fee')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('fees.destroy',$fee->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id" id="id" value="{{$fee->id}}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('fee_trans.Deleted_fee_tilte')}}</h5>
                                                            <input type="text" readonly value="{{$fee->name}}" class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------------------------------ End modal For Delete Fee -------------------------->


                                        @endforeach
                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $fees->links() }}
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