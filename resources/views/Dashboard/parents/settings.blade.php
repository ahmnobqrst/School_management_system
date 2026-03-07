@extends('Dashboard.layouts.master')
@section('css')

    <style>
        .settings-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .settings-header {
            background: linear-gradient(45deg, #0d9488, #0f766e);
            color: white;
            padding: 20px;
        }

        .form-section-title {
            color: #0f766e;
            font-weight: 700;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .form-section-title i {
            margin-left: 10px;
            background: #ccfbf1;
            padding: 8px;
            border-radius: 8px;
            font-size: 16px;
            color: #0f766e;
        }

        .setting-box {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 12px;
            background-color: #f8fafc;
            color: #334155;
            font-size: 15px;
        }

        .logo-preview-container {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: #f8fafc;
        }

        .logo-preview-container img {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
        }

        label {
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 8px;
            font-size: 14px;
        }
    </style>
    @section('title') {{ trans('Students_trans.settings') }} @stop
@endsection

@section('page-header')
    <div class="page-title mb-4">
        <div class="row align-items-center" style="direction: rtl;">
            <div class="col-sm-6 text-right">
                <h3 class="mb-0 font-weight-bold" style="color: #1e293b;"> <i class="fas fa-school text-primary ml-2"></i>
                    {{ trans('Students_trans.settings') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('Students_trans.settings') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @php
        $settingArray = [];
        $locale = app()->getLocale();
        foreach ($settings as $set) {
            $keyJson = json_decode($set->key, true);
            $valueJson = json_decode($set->value, true);
            $english_key = isset($keyJson['en']) ? $keyJson['en'] : '';
            $settingArray[$english_key] = isset($valueJson[$locale]) ? $valueJson[$locale] : '';
        }
    @endphp

    <div class="row" style="direction: rtl; text-align: right;">
        <div class="col-md-12 mb-30">
            <div class="card settings-card">
                <div class="settings-header">
                    <h5 class="mb-0 text-white"><i class="fas fa-info-circle ml-2"></i>
                        {{ trans('Students_trans.School_data_and_information') }}</h5>
                    <small class="text-white-50">{{ trans('Students_trans.School_details') }}</small>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="form-section-title"><i class="fas fa-list-ul"></i>
                                {{ trans('Students_trans.General_data') }}</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>{{ trans('Students_trans.school_name') }}</label>
                                    <div class="setting-box">
                                        {{ $settingArray['school_name'] ?? trans('Students_trans.Not_Available') }}</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>{{ trans('Students_trans.school_title') }}</label>
                                    <div class="setting-box">
                                        {{ $settingArray['school_title'] ?? trans('Students_trans.Not_Available') }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>{{ trans('Students_trans.school_phone') }}</label>
                                    <div class="setting-box" style="direction: ltr; text-align: right;">
                                        <i class="fas fa-phone mr-2 text-muted"></i>
                                        {{ $settingArray['school_phone'] ?? trans('Students_trans.Not_Available') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>{{ trans('Students_trans.school_email') }}</label>
                                    <div class="setting-box" style="direction: ltr; text-align: right;">
                                        <i class="fas fa-envelope mr-2 text-muted"></i>
                                        {{ $settingArray['school_email'] ?? trans('Students_trans.Not_Available') }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label>{{ trans('Students_trans.school_address') }}</label>
                                <div class="setting-box"><i class="fas fa-map-marker-alt ml-2 text-muted"></i>
                                    {{ $settingArray['school_address'] ?? trans('Students_trans.Not_Available') }}</div>
                            </div>

                            <h5 class="form-section-title mt-4"><i class="fas fa-calendar-alt"></i> المواعيد الدراسية</h5>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label>{{ trans('Students_trans.Current_Academic_Year') }}</label>
                                    <div class="setting-box">
                                        {{ $settingArray['current_Academic_Year'] ?? trans('Students_trans.Not_Available') }}
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label>{{ trans('Students_trans.end_first_term') }}</label>
                                    <div class="setting-box">
                                        {{ $settingArray['end_first_term'] ?? trans('Students_trans.Not_Available') }}
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label>{{ trans('Students_trans.end_second_term') }}</label>
                                    <div class="setting-box">
                                        {{ $settingArray['end_second_term'] ?? trans('Students_trans.Not_Available') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="form-section-title"><i class="fas fa-image"></i> {{ trans('Students_trans.Logo') }}
                            </h5>
                            <div
                                class="logo-preview-container d-flex justify-content-center align-items-center flex-column h-100">
                                @if (isset($settingArray['Logo']) && $settingArray['Logo'])
                                    <img src="{{ asset('storage/' . $settingArray['Logo']) }}" alt="School Logo"
                                        class="mb-3"
                                        onerror="this.onerror=null; this.src='{{ URL::asset('assets/images/user1.jpg') }}';">
                                @else
                                    <div class="text-muted"><i
                                            class="fas fa-image fa-3x mb-3"></i><br>{{ trans('Students_trans.No_Logo') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
