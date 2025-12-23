@extends('Dashboard.layouts.master')

@section('css')
@toastr_css
<style>
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .action-btns .btn {
        margin: 0 2px;
    }
    .answer-badge {
        display: inline-block;
        background: #eef2f7;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 12px;
    }
</style>
@endsection

@section('title')
{{ trans('sidebar_trans.question') }}
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('sidebar_trans.question') }}
@endsection
@endsection

@section('content')

<div class="page-title mb-3">
    <h4>{{ trans('sidebar_trans.question') }}</h4>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- زر إضافة --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('questions.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                        {{ trans('sidebar_trans.create_question') }}
                    </a>
                </div>

                {{-- جدول الأسئلة --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Students_trans.question_name') }}</th>
                                <th>{{ trans('Students_trans.answer') }}</th>
                                <th>{{ trans('Students_trans.right_answer') }}</th>
                                <th>{{ trans('Students_trans.degree') }}</th>
                                <th>{{ trans('Students_trans.quiz_name') }}</th>
                                <th>{{ trans('Students_trans.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $question)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $question->title }}</td>

                                    <td>
                                        <span class="answer-badge">
                                            {{ $question->answer }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge badge-success">
                                            {{ $question->right_answer }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge badge-info">
                                            {{ $question->degree }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $question->quizz->name }}
                                        </span>
                                    </td>

                                    <td class="action-btns">
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                           class="btn btn-sm btn-info"
                                           title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="modal"
                                                data-target="#delete_question_{{ $question->id }}"
                                                title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Delete --}}
                                <div class="modal fade"
                                     id="delete_question_{{ $question->id }}"
                                     tabindex="-1"
                                     role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form action="{{ route('questions.destroy', 'test') }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        {{ trans('Students_trans.Delete_question') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <p>
                                                        {{ trans('Students_trans.Deleted_question_tilte') }}
                                                    </p>
                                                    <strong class="text-danger">
                                                        {{ $question->title }}
                                                    </strong>
                                                    <input type="hidden" name="id" value="{{ $question->id }}">
                                                </div>

                                                <div class="modal-footer justify-content-center">
                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        {{ trans('Students_trans.Close') }}
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">
                                                        {{ trans('Students_trans.Delete') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted">
                                        لا توجد أسئلة
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-center">
                    {{ $questions->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
