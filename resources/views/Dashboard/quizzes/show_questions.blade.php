@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
<style>
    .content-wrapper { background-color: #f4f7f6 !important; }
    
    /* ستايل الدرجة الكلية */
    .total-degree-card {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        border-radius: 12px;
        padding: 10px 20px;
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .degree-number {
        font-size: 24px;
        font-weight: 800;
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .question-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        transition: 0.3s;
        border-right: 5px solid #e0e0e0;
    }

    .q-number {
        width: 35px; height: 35px;
        background: #4e73df; color: white;
        border-radius: 8px; display: flex;
        align-items: center; justify-content: center;
        font-weight: bold; margin-left: 15px;
    }

    .right-answer-badge {
        background-color: #d4edda; color: #155724;
        padding: 8px 15px; border-radius: 20px;
        font-weight: 600; display: inline-block;
        border: 1px solid #c3e6cb;
    }

    .degree-badge {
        background: #fff5f5; color: #e74a3b;
        font-weight: bold; padding: 5px 12px;
        border-radius: 50px; border: 1px solid #ffe5e5;
    }
</style>
@section('title')
{{ trans('sidebar_trans.question') }}
@stop
@endsection

@section('page-header')
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-md-6 text-right">
            <h4 class="mb-0 font-weight-bold">
                <i class="fas fa-question-circle text-primary ml-2"></i>{{ trans('sidebar_trans.question') }}
            </h4>
        </div>
        
        <div class="col-md-6 d-flex justify-content-start justify-content-md-end mt-3 mt-md-0">
            <div class="total-degree-card shadow-sm">
                <div>
                   
                    <span style="font-weight: 600;">{{trans('Students_trans.total_degree')}}</span>
                </div>
                <div class="degree-number">
                    {{ $totalDegree }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row" style="direction: rtl;">
    <div class="col-md-12">
        @forelse($questions as $index => $question)
        <div class="card question-card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <div class="q-number shadow-sm">
                            {{ $questions->firstItem() + $index }}
                        </div>
                        <h5 class="mb-0 font-weight-bold" style="color: #2e3759;">{{ $question->title }}</h5>
                    </div>
                    <div>
                        <span class="degree-badge shadow-sm">
                            {{ $question->degree }} {{ trans('Students_trans.degree') }}
                        </span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-7">
                        <p class="text-muted small mb-2 font-weight-bold text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-list-ul ml-1 text-primary"></i> {{ trans('Students_trans.answers') }}
                        </p>
                        <div class="p-3 border rounded bg-light text-secondary">
                            {{ $question->answer }}
                        </div>
                    </div>
                    <div class="col-md-5 mt-3 mt-md-0">
                        <p class="text-muted small mb-2 font-weight-bold text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-check-circle ml-1 text-success"></i> {{ trans('Students_trans.right_answer') }}
                        </p>
                        <div class="right-answer-badge w-100 text-center">
                            {{ $question->right_answer }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                <h5 class="text-muted">{{ trans('Students_trans.no_questions') }}</h5>
            </div>
        </div>
        @endforelse

        <div class="d-flex justify-content-center mt-4">
            {!! $questions->links() !!}
        </div>
    </div>
</div>
@endsection