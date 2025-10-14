@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('fee_trans.Invoices')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('fee_trans.Invoices')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('fee_trans.Invoices')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('feeinvoices.index')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('fee_trans.Invoices')}}</li>
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
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.student_name')}}</th>
                                            <th>{{trans('fee_trans.feee_type')}}</th>
                                            <th>{{trans('fee_trans.amount')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('fee_trans.fee_desc')}}</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $fee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->student->name}}</td>
                                            <td>{{$fee->fees->name}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$fee->grade->name}}</td>
                                            <td>{{$fee->classroom->name}}</td>
                                            <td>{{$fee->description}}</td>
                                            <td>
                                                <a href="{{route('feeinvoices.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Invoice{{$fee->id}}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!-------------------------------------------------- Modal for Delete invoice --------------------------------------------->

                                        <div class="modal fade" id="Delete_Invoice{{$fee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Deleted_invoice')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('feeinvoices.destroy',$fee->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id" value="{{$fee->id}}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Deleted_invoice_tilte')}}</h5>
                                                            <input type="text" readonly value="{{$fee->fees->name}}" class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------------------------------ End modal For Delete invoice -------------------------->
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