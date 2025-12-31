@extends('Dashboard.layouts.master')

@section('title', __('Students_trans.children_list'))

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users text-primary"></i>
                        {{ __('Students_trans.children_list') }}
                    </h4>
                    <span class="badge badge-primary">
                        {{ $students->count() }} {{ __('Students_trans.students') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Students_trans.name') }}</th>
                                    <th>{{ __('Students_trans.email') }}</th>
                                    <th>{{ __('Students_trans.grade') }}</th>
                                    <th>{{ __('Students_trans.classroom') }}</th>
                                    <th>{{ __('Students_trans.section') }}</th>
                                    <th>{{ __('Students_trans.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="font-weight-bold">
                                        <i class="fas fa-user-graduate text-info"></i>
                                        {{ $student->name }}
                                    </td>
                                    <td>{{ $student->email ?? '-' }}</td>
                                    <td>{{ $student->grade->name ?? '-' }}</td>
                                    <td>{{ $student->classroom->name ?? '-' }}</td>
                                    <td>{{ $student->Section->section_name ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('parent.show', $student->id) }}"
                                            class="btn btn-outline-primary btn-sm"
                                            title="{{ trans('Students_trans.show_student_data') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted py-4">
                                        <i class="fas fa-info-circle"></i>
                                        {{ __('Students_trans.no_students') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection