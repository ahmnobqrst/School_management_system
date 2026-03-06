@extends('Dashboard.layouts.master')

@section('title', trans('fee_trans.Add_fee_New'))

@section('css')
    @toastr_css
    <style>
        /* ===== Page Container ===== */
        .payment-page {
            max-width: 820px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* ===== Main Card ===== */
        .payment-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background: #fff;
        }

        /* ===== Student Header ===== */
        .student-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
            padding: 28px 32px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .student-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .student-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .student-avatar {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .student-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .student-meta {
            font-size: 0.85rem;
            opacity: 0.85;
        }

        .student-meta .badge-light {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* ===== Form Body ===== */
        .payment-body {
            padding: 32px;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #6366f1;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-label i {
            font-size: 0.85rem;
        }

        /* ===== Custom Select ===== */
        .fee-select-wrapper {
            position: relative;
            margin-bottom: 24px;
        }

        .fee-select {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1f2937;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 16px center;
            padding-left: 44px;
        }

        [dir="ltr"] .fee-select,
        html[lang="en"] .fee-select {
            background-position: right 16px center;
            padding-left: 18px;
            padding-right: 44px;
        }

        .fee-select:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .fee-select:hover {
            border-color: #a5b4fc;
        }

        /* ===== Fee Details Card ===== */
        .fee-details-card {
            background: linear-gradient(135deg, #f0f0ff 0%, #faf5ff 100%);
            border: 1px solid #e0e7ff;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 28px;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .fee-details-card.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fee-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }

        .fee-detail-row:not(:last-child) {
            border-bottom: 1px solid rgba(99, 102, 241, 0.08);
        }

        .fee-detail-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fee-detail-label i {
            color: #6366f1;
            width: 16px;
            text-align: center;
        }

        .fee-detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1f2937;
        }

        .fee-detail-value.amount-highlight {
            color: #4f46e5;
            font-size: 1.15rem;
        }

        /* ===== Amount Input ===== */
        .amount-input-group {
            position: relative;
            margin-bottom: 28px;
        }

        .amount-input {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #1f2937;
            background: #f9fafb;
            transition: all 0.3s ease;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .amount-input:focus {
            outline: none;
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .amount-input::placeholder {
            color: #9ca3af;
            font-weight: 400;
            font-size: 0.95rem;
        }

        .amount-currency-hint {
            text-align: center;
            font-size: 0.78rem;
            color: #9ca3af;
            margin-top: 6px;
        }

        /* ===== Divider ===== */
        .payment-divider {
            display: flex;
            align-items: center;
            margin: 8px 0 28px;
            gap: 16px;
        }

        .payment-divider::before,
        .payment-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
        }

        .payment-divider span {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            white-space: nowrap;
        }

        /* ===== Pay Button ===== */
        .btn-pay {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            cursor: pointer;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
        }

        .btn-pay::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.6s ease;
        }

        .btn-pay:hover::before {
            left: 100%;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.4);
        }

        .btn-pay:active {
            transform: translateY(0);
        }

        .btn-pay i {
            font-size: 1.15rem;
        }

        /* ===== Security Note ===== */
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 16px;
            font-size: 0.78rem;
            color: #9ca3af;
        }

        .security-note i {
            color: #22c55e;
        }

        /* ===== Breadcrumb ===== */
        .page-breadcrumb {
            margin-bottom: 24px;
        }

        .page-breadcrumb .page-title-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .page-breadcrumb .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.85rem;
        }

        .page-breadcrumb .breadcrumb-item a {
            color: #6366f1;
            text-decoration: none;
        }

        /* ===== Responsive ===== */
        @media (max-width: 576px) {
            .payment-body {
                padding: 20px;
            }

            .student-header {
                padding: 20px;
            }

            .student-avatar {
                width: 50px;
                height: 50px;
                font-size: 20px;
                border-radius: 12px;
            }

            .student-name {
                font-size: 1.1rem;
            }
        }
    </style>
@endsection

@section('content')

    <div class="payment-page">

        {{-- Breadcrumb --}}
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="page-title-text">{{ trans('fee_trans.Add_fee_New') }}</h4>
                </div>
                <div class="col-auto">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('parent.dashboard') }}">{{ trans('Students_trans.Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('fee_trans.Add_fee_New') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Payment Card --}}
        <div class="payment-card">

            {{-- Student Header --}}
            <div class="student-header">
                <div class="d-flex align-items-center" style="gap: 18px; position: relative; z-index: 1;">
                    <div class="student-avatar">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <div class="student-name">{{ $student->name }}</div>
                        <div class="student-meta d-flex align-items-center flex-wrap" style="gap: 8px;">
                            <span class="badge-light">
                                <i class="fas fa-layer-group mr-1"></i> {{ $student->grade->name }}
                            </span>
                            <span class="badge-light">
                                <i class="fas fa-chalkboard mr-1"></i> {{ $student->classroom->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <div class="payment-body">

                <form method="POST" action="{{ route('stripe.payment', $student->id) }}" id="paymentForm">
                    @csrf

                    {{-- Fee Selection --}}
                    <div class="section-label">
                        <i class="fas fa-receipt"></i>
                        {{ trans('fee_trans.fee_name') }}
                    </div>

                    <div class="fee-select-wrapper">
                        <select name="fee_id" id="feeSelect" class="fee-select" required>
                            <option value="" disabled selected>-- {{ trans('fee_trans.fee_name') }} --</option>
                            @foreach ($fees as $fee)
                                <option value="{{ $fee->id }}" data-amount="{{ $fee->amount }}"
                                    data-year="{{ $fee->year }}" data-desc="{{ $fee->desc }}">
                                    {{ $fee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fee Details (shown on select) --}}
                    <div class="fee-details-card" id="feeDetailsCard">
                        <div class="fee-detail-row">
                            <span class="fee-detail-label">
                                <i class="fas fa-money-bill-wave"></i>
                                {{ trans('fee_trans.fee_amount') }}
                            </span>
                            <span class="fee-detail-value amount-highlight" id="feeAmount">--</span>
                        </div>
                        <div class="fee-detail-row">
                            <span class="fee-detail-label">
                                <i class="fas fa-calendar-alt"></i>
                                {{ trans('fee_trans.fee_year') }}
                            </span>
                            <span class="fee-detail-value" id="feeYear">--</span>
                        </div>
                        <div class="fee-detail-row">
                            <span class="fee-detail-label">
                                <i class="fas fa-info-circle"></i>
                                {{ trans('fee_trans.fee_desc') }}
                            </span>
                            <span class="fee-detail-value" id="feeDesc">--</span>
                        </div>
                    </div>

                    {{-- Amount --}}
                    <div class="section-label">
                        <i class="fas fa-coins"></i>
                        {{ trans('fee_trans.fee_amount') }}
                    </div>

                    <div class="amount-input-group">
                        <input type="number" name="amount" id="amountInput" class="amount-input" step="0.01"
                            min="0.01" required placeholder="0.00">
                        <div class="amount-currency-hint">
                            <i class="fas fa-lock mr-1"></i>
                            {{ trans('fee_trans.fee_amount') }} (EGP)
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="payment-divider">
                        <span><i class="fas fa-shield-alt mr-1"></i> Secure Payment</span>
                    </div>

                    {{-- Pay Button --}}
                    <button type="submit" class="btn-pay" id="payBtn">
                        <i class="fas fa-credit-card"></i>
                        Pay with Stripe
                    </button>

                    <div class="security-note">
                        <i class="fas fa-lock"></i>
                        Your payment is secured with SSL encryption
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('js')
    @toastr_js
    @toastr_render
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const feeSelect = document.getElementById('feeSelect');
            const detailsCard = document.getElementById('feeDetailsCard');
            const feeAmount = document.getElementById('feeAmount');
            const feeYear = document.getElementById('feeYear');
            const feeDesc = document.getElementById('feeDesc');
            const amountInput = document.getElementById('amountInput');

            feeSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];

                if (selected.value) {
                    const amount = selected.getAttribute('data-amount');
                    const year = selected.getAttribute('data-year');
                    const desc = selected.getAttribute('data-desc');

                    feeAmount.textContent = parseFloat(amount).toFixed(2) + ' EGP';
                    feeYear.textContent = year || '--';
                    feeDesc.textContent = desc || '--';

                    // Auto-fill the amount
                    amountInput.value = parseFloat(amount).toFixed(2);

                    // Show the details card with animation
                    detailsCard.classList.remove('show');
                    void detailsCard.offsetWidth; // trigger reflow for re-animation
                    detailsCard.classList.add('show');
                } else {
                    detailsCard.classList.remove('show');
                    amountInput.value = '';
                }
            });
        });
    </script>
@endsection
