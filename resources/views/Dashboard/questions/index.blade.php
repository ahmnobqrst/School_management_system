@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
<style>
    /* تحسين شكل الصفحة العام */
    .content-wrapper { background-color: #f4f7f6 !important; } /* خلفية رمادية فاتحة جدا لبروز الكروت البيضاء */
    
    .quiz-card {
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        border-radius: 12px;
        border: none !important;
        background: #ffffff;
        position: relative;
        z-index: 1;
    }

    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.05) !important;
    }

    /* رأس الكارت الملون لإعطاء هوية بصرياً */
    .card-header-accent {
        height: 5px;
        width: 100%;
        background: linear-gradient(90deg, #007bff, #00d2ff);
        border-radius: 12px 12px 0 0;
    }

    .quiz-icon {
        width: 55px;
        height: 55px;
        background: #eef2ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: #4e73df;
        font-size: 22px;
        box-shadow: inset 0 0 0 1px rgba(78,115,223,0.1);
    }

    /* تحسين وضوح النصوص */
    .info-box {
        background: #f8f9fc;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #edf2f9;
    }

    .info-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #858796;
        font-weight: 700;
        display: block;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 14px;
        color: #2e3759;
        font-weight: 600;
        margin: 0;
    }

    .badge-soft-primary {
        background-color: #e1ecff;
        color: #0056b3;
        font-weight: 600;
        padding: 5px 12px;
    }

    .btn-show {
        background: #4e73df;
        color: white !important;
        border: none;
        font-weight: 600;
        padding: 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-show:hover {
        background: #2e59d9;
        box-shadow: 0 4px 12px rgba(78,115,223,0.3);
    }
</style>
@section('title')
{{trans('sidebar_trans.Exam_list')}}
@stop
@endsection

@section('page-header')
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0 font-weight-bold" style="color: #1a202c;">
                <i class="fas fa-clipboard-list text-primary mr-2"></i> {{trans('sidebar_trans.Exam_list')}}
            </h4>
        </div>
        <div class="col-sm-6 text-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 p-0 justify-content-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active text-primary">{{trans('sidebar_trans.Exam_list')}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @forelse($quizzes as $quizze)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card h-100 quiz-card shadow-sm">
            <div class="card-header-accent"></div>
            <div class="card-body p-4">
                <div class="quiz-icon">
                    <i class="fas fa-book-open"></i>
                </div>

                <h5 class="text-center mb-4 font-weight-bold" style="color: #2d3748; min-height: 48px;">
                    {{ $quizze->name }}
                </h5>
                
                <div class="quiz-details text-right" style="direction: rtl;">
                    <div class="info-box">
                        <span class="info-label">{{ trans('section_trans.Teacher_name') }}</span>
                        <p class="info-value"><i class="fas fa-user-tie text-primary ml-2"></i>{{ $quizze->teacher->name }}</p>
                    </div>

                    <div class="row no-gutters">
                        <div class="col-12 mb-2">
                             <span class="info-label">{{ trans('Students_trans.Grade') }}</span>
                             <span class="badge badge-soft-primary w-100 mt-1 text-center" style="font-size: 13px;">
                                <i class="fas fa-layer-group ml-1"></i> {{ $quizze->grade->name }}
                             </span>
                        </div>
                        <div class="col-6 pr-1">
                             <span class="info-label text-truncate">{{ trans('Students_trans.classroom') }}</span>
                             <p class="info-value text-muted" style="font-size: 12px;">{{ $quizze->classroom->name }}</p>
                        </div>
                        <div class="col-6 pl-1 border-right">
                             <span class="info-label text-truncate text-center w-100">{{ trans('Students_trans.section') }}</span>
                             <p class="info-value text-center text-muted" style="font-size: 12px;">{{ $quizze->section->section_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('quizzes.show', $quizze->id) }}" class="btn btn-show btn-block shadow-sm">
                        <i class="fa fa-play-circle ml-1"></i>
                        {{ trans('Students_trans.show_questions') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="card card-body shadow-sm">
            <i class="fas fa-folder-open fa-4x text-light mb-3"></i>
            <h5 class="text-muted">لا توجد اختبارات متاحة حالياً</h5>
        </div>
    </div>
    @endforelse
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center mt-4">
        {{ $quizzes->links() }}
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection