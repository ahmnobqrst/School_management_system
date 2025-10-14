@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Edit_Book')}}-{{$book->title}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Edit_Book')}}--{{$book->title}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.Edit_Book')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Edit_Book')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('lib.update','Update')}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" value="{{$book->id}}" name="id"/>
                                    <label>{{trans('Students_trans.book_title_ar')}}: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="title_ar" type="text"
                                        value="{{$book->getTranslation('title','ar')}}">
                                </div>

                            </div>
                            @error('title_ar')
                            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.book_title_en')}}: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="title_en" type="text"
                                        value="{{$book->getTranslation('title','en')}}">
                                </div>

                            </div>
                            @error('title_en')
                            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                            @enderror
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('Students_trans.Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grad_id">
                                            @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{$book->grade_id == $grade->id ?'selected':''}}>{{ $grade->name }}
                                            </option>
                                            <option value="{{ $grade->id }}"
                                                {{$book->grade_id == $grade->id ?'selected':''}}>{{ $grade->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="class_id">
                                            <option value="{{$book->classroom_id}}">{{$book->classroom->name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                        <select class="custom-select mr-sm-2" name="sect_id">
                                            <option value="{{$book->section_id}}">{{$book->section->section_name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div><br>

                            <div class="form-row">
                                <div class="col">

                                    <embed src="{{ URL::asset('storage/'.$book->file_name) }}"
                                     height="150px" width="100px"><br><br>

                                    <div class="form-group">
                                        <label for="file_name">{{trans('Students_trans.Attachments')}}: <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="file_name[]">
                                    </div>

                                </div>
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('Students_trans.Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@toastr_js
@toastr_render
@endsection