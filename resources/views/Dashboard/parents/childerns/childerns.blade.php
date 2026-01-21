@extends('Dashboard.layouts.master')

@section('title', __('Students_trans.children_list'))

@section('content')
<style>
    /* تصميم الصفحة الأنيق */
    .page-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .badge-count {
        font-size: 1.1rem;
        padding: 0.5em 1em;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.25);
    }

    /* إصلاح حاوية الجدول للسماح بظهور القوائم */
    .students-table-card {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: visible !important;
        /* مهم جداً */
    }

    .table-responsive {
        overflow: visible !important;
        /* لمنع قص الدروب داون */
    }

    .modern-table {
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .modern-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .modern-table tbody tr {
        transition: background-color 0.3s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f8f9ff;
        /* تم حذف الـ transform هنا لأنه يسبب مشاكل في طبقات الـ z-index للدروب داون */
    }

    /* Dropdown محسن ومعالج لمشكلة السكرول */
    .actions-dropdown {
        position: relative;
    }

    .actions-dropdown .btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
        font-size: 0.9rem;
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
    }

    .actions-dropdown .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }

    .actions-dropdown .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        padding: 0.75rem 0;
        min-width: 250px;

        /* إعدادات السكرول الداخلي */
        max-height: 250px;
        overflow-y: auto !important;
        overflow-x: hidden;

        z-index: 9999;
        /* التأكد من ظهوره فوق كل شيء */
        background: #fff;
    }

    /* تخصيص الـ scrollbar داخل القائمة */
    .actions-dropdown .dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .actions-dropdown .dropdown-menu::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .actions-dropdown .dropdown-menu::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .actions-dropdown .dropdown-item {
        padding: 0.7rem 1.3rem;
        border-radius: 8px;
        margin: 0.2rem 0.5rem;
        transition: all 0.2s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        text-align: right;
    }

    .actions-dropdown .dropdown-item:hover {
        background-color: #f0f4ff;
        transform: translateX(-5px);
    }

    .actions-dropdown .dropdown-item i {
        margin-left: 10px;
        width: 20px;
    }
</style>

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card border-0">
                <div class="card-body d-flex justify-content-between align-items-center py-4">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        {{ __('Students_trans.children_list') }}
                    </h4>
                    <span class="badge badge-count">
                        {{ $students->count() }} {{ __('Students_trans.students') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card students-table-card">
                <div class="card-body p-0" style="overflow: visible;">
                    <div class="table-responsive" style="overflow: visible;">
                        <table class="table table-hover modern-table text-center align-middle">
                            <thead>
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
                                        <i class="fas fa-user-graduate text-primary me-2"></i>
                                        {{ $student->name }}
                                    </td>
                                    <td>{{ $student->email ?? '-' }}</td>
                                    <td>{{ $student->grade->name ?? '-' }}</td>
                                    <td>{{ $student->classroom->name ?? '-' }}</td>
                                    <td>{{ $student->Section->section_name ?? '-' }}</td>
                                    <td>
                                        <div class="dropdown actions-dropdown">
                                            <button class="btn dropdown-toggle" type="button"
                                                id="dropdownMenuButton{{ $student->id }}"
                                                data-toggle="dropdown"
                                                data-boundary="window"
                                                aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ trans('Students_trans.Actions') }}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton{{ $student->id }}">
                                                <a class="dropdown-item" href="{{ route('parent.show', $student->id) }}">
                                                    <i class="fa fa-eye text-warning"></i> {{ trans('Students_trans.show_student_data') }}
                                                </a>
                                                <a class="dropdown-item" href="{{route('get.son.fees',$student->id)}}">
                                                    <i class="fa fa-edit text-primary"></i> {{ trans('Students_trans.show_student_invoice') }}
                                                </a>
                                                <a class="dropdown-item" href="{{route('parent.pay.form',$student->id)}}">
                                                    <i class="fas fa-money-bill-alt text-info"></i> {{ trans('Students_trans.Add_payment_student') }}
                                                </a>
                                                <a class="dropdown-item" href="{{route('get.son.quiz',$student->id)}}">
                                                    <i class="fa fa-question-circle"></i> {{ trans('Students_trans.show_student_quiz') }}
                                                </a>
                                            </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-muted py-5">
                                        <i class="fas fa-info-circle me-2"></i>
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