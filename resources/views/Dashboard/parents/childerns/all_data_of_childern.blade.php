@extends('Dashboard.layouts.master')

@section('title', __('Students_trans.student_details'))

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-graduate text-primary"></i>
                        {{ __('Students_trans.student_details') }}
                    </h4>

                    <a href="{{ route('get.all.childern') }}"
                       class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('Students_trans.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Info -->
    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="card shadow border-0 text-center">
                <div class="card-body">
                    <img src="{{ $student->image && file_exists(public_path('storage/'.$student->image)) 
            ? asset('storage/'.$student->image) 
            : asset('images/user.jpeg') }}"
                          class="rounded-circle mb-3"
                         width="120"
                         alt="student">

                    <h5 class="font-weight-bold">
                        {{ $student->name }}
                    </h5>

                    <p class="text-muted mb-1">
                        {{ __('Students_trans.student') }}
                    </p>

                    <span class="badge badge-info">
                        {{ $student->grade->name ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ __('Students_trans.email') }}:</strong>
                            <p>{{ $student->email ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            <strong>{{ __('Students_trans.grade') }}:</strong>
                            <p>{{ $student->grade->name ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ __('Students_trans.classroom') }}:</strong>
                            <p>{{ $student->classroom->name ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            <strong>{{ __('Students_trans.section') }}:</strong>
                            <p>{{ $student->Section->section_name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Students_trans.subjects') }}:</strong>
                            @foreach($student->Subjects as $subject)
                            <p>{{ $subject->name ?? '-' }}</p>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="alert alert-light text-center mb-0">
                        <i class="fas fa-info-circle text-primary"></i>
                        {{ __('Students_trans.student_note') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
