@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
<style>
    .settings-card { border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.08); overflow: hidden; }
    .settings-header { background: linear-gradient(45deg, #1e3a8a, #3b82f6); color: white; padding: 20px; }
    .form-section-title { color: #1e3a8a; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 25px; display: flex; align-items: center; }
    .form-section-title i { margin-left: 10px; background: #eff6ff; padding: 8px; border-radius: 8px; font-size: 16px; }
    .form-control { border-radius: 8px; border: 1px solid #d1d5db; padding: 12px; transition: all 0.3s; }
    .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    .logo-preview-container { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px; text-align: center; background: #f8fafc; }
    .logo-preview-container img { border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s; }
    .logo-preview-container img:hover { transform: scale(1.05); }
    .btn-submit { background: #10b981; border: none; padding: 10px 30px; border-radius: 8px; font-weight: 600; transition: all 0.3s; }
    .btn-submit:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    label { font-weight: 600; color: #4b5563; margin-bottom: 8px; }
</style>
@section('title') {{trans('Students_trans.settings')}} @stop
@endsection

@section('page-header')
<div class="page-title mb-4">
    <div class="row align-items-center" style="direction: rtl;">
        <div class="col-sm-6 text-right">
            <h3 class="mb-0 font-weight-bold" style="color: #1e293b;"> <i class="fas fa-tools text-primary ml-2"></i> {{trans('Students_trans.settings')}}</h3>
        </div>
       
    </div>
</div>
@endsection

@section('content')
@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row" style="direction: rtl; text-align: right;">
    <div class="col-md-12 mb-30">
        <div class="card settings-card">
            <div class="settings-header">
                <h5 class="mb-0 text-white"><i class="fas fa-school ml-2"></i> إعدادات بيانات المنشأة التعليمية</h5>
                <small class="text-white-50">تأكد من دقة البيانات المدخلة حيث تظهر في التقارير الرسمية</small>
            </div>
            <div class="card-body p-5">
                <form enctype="multipart/form-data" method="post" action="{{route('setting.update','test')}}">
                    @csrf @method('PUT')
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="form-section-title"><i class="fas fa-info-circle text-primary"></i> البيانات العامة</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.school_name')}} <span class="text-danger">*</span></label>
                                    <input name="school_name" value="{{ $setting['school_name'] }}" required type="text" class="form-control" placeholder="مثلاً: مدرسة التميز الدولية">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.school_title')}}</label>
                                    <input name="school_title" value="{{ $setting['school_title'] }}" type="text" class="form-control" placeholder="الاسم المختصر">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.school_phone')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text bg-light"><i class="fas fa-phone"></i></span></div>
                                        <input name="school_phone" value="{{ $setting['school_phone'] }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.school_email')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span></div>
                                        <input name="school_email" value="{{ $setting['school_email'] }}" type="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label>{{trans('Students_trans.school_address')}} <span class="text-danger">*</span></label>
                                <input required name="school_address" value="{{ $setting['school_address'] }}" type="text" class="form-control">
                            </div>

                            <h5 class="form-section-title mt-4"><i class="fas fa-calendar-alt text-primary"></i> المواعيد الدراسية</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.end_first_term')}}</label>
                                    <input name="end_first_term" value="{{ $setting['end_first_term'] }}" type="text" class="form-control date-pick">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>{{trans('Students_trans.end_second_term')}}</label>
                                    <input name="end_second_term" value="{{ $setting['end_second_term'] }}" type="text" class="form-control date-pick">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <h5 class="form-section-title"><i class="fas fa-image text-primary"></i> شعار المدرسة</h5>
                            <div class="logo-preview-container">
                                <div class="mb-4">
                                    <img id="viewer" style="width: 150px; height: 150px; object-fit: contain; background: white; padding: 10px; border: 1px solid #eee;" 
                                         src="{{ URL::asset('storage/'.$setting['Logo']) }}" alt="School Logo">
                                </div>
                                <div class="custom-file text-right">
                                    <input name="logo" accept="image/*" type="file" class="custom-file-input" id="customFile" onchange="displayImage(this)">
                                    <label class="custom-file-label" for="customFile">اختر ملف الشعار</label>
                                </div>
                                <small class="text-muted d-block mt-3">يفضل استخدام صورة شفافة بصيغة PNG وبحجم لا يتجاوز 2 ميجا</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top text-left">
                        <button class="btn btn-submit text-white shadow-lg" type="submit">
                             {{trans('Students_trans.submit')}} <i class="fas fa-save mr-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
<script>
    // وظيفة لمعاينة الصورة فور اختيارها
    function displayImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection