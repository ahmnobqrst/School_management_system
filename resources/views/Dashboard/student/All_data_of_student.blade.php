@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Students_trans.Student_details') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('Students_trans.Student_details') }}
@stop
@endsection

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{ trans('Students_trans.Student_details') }}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('students.index')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.Student_details') }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="student-details-tab" data-toggle="tab" href="#student-details"
                            role="tab" aria-controls="student-details" aria-selected="true">
                            {{ trans('Students_trans.Student_details') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab"
                            aria-controls="attachments" aria-selected="false">
                            {{ trans('Students_trans.Attachments') }}
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-4">
                    {{-- Tab 1: Student Details --}}
                    <div class="tab-pane fade show active" id="student-details" role="tabpanel"
                        aria-labelledby="student-details-tab">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ trans('Students_trans.name') }}</th>
                                    <td>{{ $Student->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.email') }}</th>
                                    <td>{{ $Student->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.gender') }}</th>
                                    <td>{{ $Student->Gender->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.BloodType') }}</th>
                                    <td>{{ $Student->BloodType->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Nationality') }}</th>
                                    <td>{{ $Student->Nationality->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Grade') }}</th>
                                    <td>{{ $Student->Grade->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.classrooms') }}</th>
                                    <td>{{ $Student->Classroom->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.section') }}</th>
                                    <td>{{ $Student->Section->section_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Date_of_Birth') }}</th>
                                    <td>{{ $Student->birth_of_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.parent') }}</th>
                                    <td>{{ $Student->Parents->name_of_father }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.academic_year') }}</th>
                                    <td>{{ $Student->academic_year }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Tab 2: Attachments --}}
                    <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                        <form method="Post" action="{{url('upload_new_attachments')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="photos">{{ trans('Students_trans.Attachments') }} <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept="image/*" name="photos[]" multiple required
                                    class="form-control">
                                <input type="hidden" name="student_name" value="{{ $Student->name }}">
                                <input type="hidden" name="student_id" value="{{ $Student->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                {{ trans('Students_trans.submit') }}
                            </button>
                        </form>

                        <hr>

                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Students_trans.filename') }}</th>
                                    <th>{{ trans('Students_trans.created_at') }}</th>
                                    <th>{{ trans('Students_trans.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Student->images as $attachment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attachment->filename }}</td>
                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            href="{{ url('Download_attachment') }}/{{ $attachment->imageable->name }}/{{ $attachment->filename }}">
                                            <i class="fas fa-download"></i> {{ trans('Students_trans.Download') }}
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#Delete_img{{ $attachment->id }}">
                                            {{ trans('Students_trans.delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="Delete_img{{ $attachment->id }}" tabindex="-1"
                                    aria-labelledby="DeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('Delete_attachment') }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        {{ trans('Students_trans.Delete_attachment') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $attachment->id }}">
                                                    <input type="hidden" name="student_name"
                                                        value="{{ $attachment->imageable->name }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $attachment->imageable->id }}">
                                                    <p>{{ trans('Students_trans.Delete_attachment_tilte') }}</p>
                                                    <input type="text" name="filename" readonly
                                                        value="{{ $attachment->filename }}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Students_trans.Close') }}</button>
                                                    <button
                                                        class="btn btn-danger">{{ trans('Students_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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