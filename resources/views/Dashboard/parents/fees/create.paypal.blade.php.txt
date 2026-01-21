@extends('Dashboard.layouts.master')

@section('title', trans('fee_trans.Add_fee_New'))

@section('css')
@toastr_css
<style>
    .fee-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    }

    .student-info-box {
        background: linear-gradient(135deg, #f6f8fb 0%, #f1f4f9 100%);
        border-radius: 12px;
        padding: 20px;
        border-right: 5px solid #3b82f6;
    }

    .form-control,
    .custom-select {
        border-radius: 8px;
        padding: 10px;
        height: auto;
    }

    .btn-paypal {
        background-color: #ffc439;
        color: #003087;
        font-weight: bold;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-paypal:hover {
        background-color: #f4b41a;
        transform: translateY(-2px);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 30px 0;
        color: #888;
        font-weight: bold;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #eee;
    }

    .divider:not(:empty)::before {
        margin-left: .5em;
    }

    .divider:not(:empty)::after {
        margin-right: .5em;
    }
</style>
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0 font-weight-bold">{{trans('fee_trans.Add_fee_New')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right bg-transparent">
                <li class="breadcrumb-item"><a href="{{route('parent.dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('fee_trans.Add_fee_New')}}</li>
            </ol>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card fee-card">
            <div class="card-body p-4 p-md-5">

                <div class="student-info-box mb-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 24px;">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mb-1 font-weight-bold text-dark">{{ $student->name }}</h5>
                            <p class="mb-0 text-muted small">
                                {{ trans('Students_trans.Grade') }}: {{ $student->grade->name }} |
                                {{ trans('Students_trans.classrooms') }}: {{ $student->classroom->name }}
                            </p>
                        </div>
                    </div>
                </div>

                <form method="post" action="{{route('make.payment',$student->id)}}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">{{trans('fee_trans.feee_type')}} <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    <option value="">{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($fees as $fee)
                                    <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-primary">{{trans('fee_trans.Amount') ?? 'Amount'}} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="amount" id="amount_input" class="form-control font-weight-bold" step="0.01">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white">$</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        <div class="col-md-6 mb-3">
                            <button id="paypalBtn" class="btn btn-warning mt-3">
                                Pay with PayPal
                            </button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
<script>
    document.getElementById('paypalBtn').onclick = function() {
        let amount = document.getElementById('amount').value;
        if (!amount || amount <= 0) return alert('Enter amount');

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('make.payment', $student->id) }}";

        form.innerHTML = `
        @csrf
        <input type="hidden" name="amount" value="${amount}">
    `;

        document.body.appendChild(form);
        form.submit();
    };
</script>
@endsection