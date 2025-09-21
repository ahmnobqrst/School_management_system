@extends('Dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Students_trans.Add_student_reciept')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Add_student_reciept')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Add_student_reciept')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Add_student_reciept')}}</li>
            </ol>
        </div>
    </div>
</div>

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                   

                        <form method="post"  action="{{ route('reciept.store') }}" autocomplete="off">
                        @csrf
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.balance')}}: </label>
                                    <input  class="form-control" name="final_balance" value="{{ number_format($student->student_account->sum('debit') - $student->student_account->sum('credit'), 2) }}" type="text" readonly>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.fee_amount')}} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="Debit" type="text" >
                                        <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                    </div>
                                    @error('Debit')
                                      <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 
                                </div>
                                
                            </div>
                            </div>
                            

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.desc_ar')}} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_ar" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    @error('description_ar')
                                      <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('fee_trans.desc_en')}} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_en" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    @error('description_en')
                                      <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                                    @enderror 
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