@extends('Dashboard.layouts.master')
@section('css')
<style>
    .btn-outline-success{
        width:150px;
    }
</style>
    @toastr_css
@section('title')
{{trans('Students_trans.Edit_payment')}} 
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Edit_payment')}}
@stop
<!-- breadcrumb -->
@endsections
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Edit_payment')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Edit_payment')}}</li>
            </ol>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                            <form action="{{route('payments.update','test')}}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.fee_amount')}} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="Debit" value="{{$payment_student->amont}}" type="number" >
                                        <input  type="hidden" name="student_id" value="{{$payment_student->student->id}}" class="form-control">
                                        <input  type="hidden" name="id"  value="{{$payment_student->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.desc_ar')}} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_ar" id="exampleFormControlTextarea1" rows="3">{{$payment_student->getTranslation('description','ar')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.desc_ar')}} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_en" id="exampleFormControlTextarea1" rows="3">{{$payment_student->getTranslation('description','en')}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

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