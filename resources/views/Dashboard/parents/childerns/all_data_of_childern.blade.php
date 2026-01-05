@extends('Dashboard.layouts.master')

@section('title', __('Students_trans.student_details'))

@section('content')

<style>
    /* التنسيقات الإضافية للجمالية */
    .main-content-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .profile-img-container {
        position: relative;
        display: inline-block;
        padding: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        margin-bottom: 20px;
    }
    .profile-img-container img {
        border: 4px solid #fff;
        object-fit: cover;
    }
    .info-label {
        color: #888;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        display: block;
    }
    .info-value {
        color: #333;
        font-weight: 600;
        font-size: 1.05rem;
    }
    .subject-tag {
        background-color: #f0f2f5;
        color: #555;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.85rem;
        margin: 3px;
        display: inline-block;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    .subject-tag:hover {
        background: #764ba2;
        color: #fff;
    }
    .header-gradient {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        border-radius: 15px;
    }
    .detail-card {
        transition: transform 0.3s ease;
    }
    .detail-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card header-gradient border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center py-3">
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">
                            <i class="fas fa-id-card text-primary mr-2"></i>
                            {{ __('Students_trans.student_details') }}
                        </h4>
                        <small class="text-muted">{{ __('Students_trans.view_manage_details') }}</small>
                    </div>

                    <a href="{{ route('get.all.childern') }}"
                       class="btn btn-white shadow-sm btn-sm px-4" style="border-radius: 10px;">
                        <i class="fas fa-chevron-left mr-1"></i>
                        {{ __('Students_trans.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card main-content-card text-center py-4 detail-card">
                <div class="card-body">
                    <div class="profile-img-container">
                        <img src="{{ $student->image && file_exists(public_path('storage/'.$student->image)) 
                            ? asset('storage/'.$student->image) 
                            : asset('images/user.jpeg') }}"
                             class="rounded-circle"
                             width="130"
                             height="130"
                             alt="student">
                    </div>

                    <h4 class="font-weight-bold mb-1">{{ $student->name }}</h4>
                    <p class="text-muted mb-3">{{ __('Students_trans.student') }}</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge badge-pill badge-primary px-3 py-2">
                            <i class="fas fa-graduation-cap mr-1"></i>
                            {{ $student->grade->name ?? '-' }}
                        </span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-left px-3">
                        <span class="info-label">{{ __('Students_trans.email') }}</span>
                        <p class="info-value"><i class="far fa-envelope text-muted mr-2"></i>{{ $student->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card main-content-card detail-card h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="font-weight-bold"><i class="fas fa-info-circle text-primary mr-2"></i>{{ __('Students_trans.academic_info') }}</h5>
                </div>
                <div class="card-body px-4">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <span class="info-label">{{ __('Students_trans.grade') }}</span>
                                <span class="info-value">{{ $student->grade->name ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <span class="info-label">{{ __('Students_trans.classroom') }}</span>
                                <span class="info-value">{{ $student->classroom->name ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <span class="info-label">{{ __('Students_trans.section') }}</span>
                                <span class="info-value">{{ $student->Section->section_name ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <span class="info-label">{{ __('Students_trans.academic_year') }}</span>
                                <span class="info-value">{{ date('Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="font-weight-bold mb-3"><i class="fas fa-book text-success mr-2"></i>{{ __('Students_trans.subjects') }}</h5>
                            <div class="d-flex flex-wrap">
                                @forelse($student->Subjects as $subject)
                                    <span class="subject-tag">
                                        <i class="fas fa-check-circle text-success mr-1"></i>
                                        {{ $subject->name }}
                                    </span>
                                @empty
                                    <p class="text-muted">-</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top">
                        <div class="alert alert-custom bg-soft-primary border-0 rounded-pill text-center py-2" style="background: #f0f7ff; color: #007bff;">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <strong>{{ __('Students_trans.student_note') }}</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection