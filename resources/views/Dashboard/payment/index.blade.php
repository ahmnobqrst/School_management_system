@extends('Dashboard.layouts.master')
@section('css')
<style>
.btn-outline-success {
    width: 150px;
}
</style>
@toastr_css
@section('title')
{{trans('Students_trans.list_payment')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.list_payment')}}
@stop
<!-- breadcrumb -->
@endsections
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.list_payment')}} </h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active"> {{trans('Students_trans.list_payment')}} </li>
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
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}} :</th>
                                            <th>{{trans('fee_trans.fee_amount')}} :</th>
                                            <th>{{trans('fee_trans.description')}} :</th>
                                            <th>{{trans('Students_trans.Actions')}}</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payment_students as $payment_student)
                                       
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$payment_student->student->name}}</td>
                                            <td>{{ number_format($payment_student->amont,2) }}</td>
                                            <td>{{$payment_student->description}}</td>
                                            <td>
                                                <a href="{{route('payments.edit',$payment_student->id)}}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#Delete_payment{{$payment_student->id}}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_payment{{$payment_student->id}}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Delete_payment')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('payments.destroy','test')}}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id"
                                                                value="{{$payment_student->id}}">
                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Deleted_reciept_tilte')}}</h5>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button
                                                                    class="btn btn-danger">{{trans('Students_trans.Delete')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                </table>
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