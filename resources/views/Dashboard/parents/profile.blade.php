@extends('Dashboard.layouts.master')

@section('title')
{{ __('Students_trans.profile') }}
@endsection

@section('css')
@toastr_css
<style>
    .profile-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .profile-header {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: white;
        padding: 30px;
        text-align: center;
        border-bottom-left-radius: 50% 20%;
        border-bottom-right-radius: 50% 20%;
    }

    .profile-header img {
        border-radius: 50%;
        border: 4px solid #fff;
        width: 130px;
        height: 130px;
        object-fit: cover;
        cursor: pointer;
        transition: 0.3s;
    }

    .profile-header img:hover {
        opacity: 0.85;
        transform: scale(1.05);
    }

    .profile-body {
        padding: 30px;
    }

    .profile-body label {
        font-weight: 600;
        color: #555;
    }

    .profile-body input {
        border-radius: 10px;
        border: 1px solid #ccc;
        transition: 0.2s;
    }

    .profile-body input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 5px rgba(78, 115, 223, 0.4);
    }

    .btn-update {
        background: linear-gradient(90deg, #1cc88a, #17a673);
        border: none;
        border-radius: 10px;
        padding: 10px 30px;
        color: white;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-update:hover {
        opacity: 0.9;
        transform: scale(1.03);
    }

    .form-check-label {
        font-size: 14px;
        color: #777;
    }
</style>
@endsection

@section('page-header')
@section('PageTitle')
{{ __('Students_trans.profile') }}
@stop
@endsection

@section('content')
<div class="container mt-5">
    <div class="profile-card">

        <div class="profile-body">
            <form action="{{ route('parent.update.profile', $parent->id) }}" method="post" enctype="multipart/form-data">

                <div class="profile-header">
                    <input type="file" id="profileImageInput" name="image" accept="image/*" style="display:none;">
                    <img id="profileImagePreview"
                        src="{{ $parent->image && file_exists(public_path('storage/'.$parent->image)) 
            ? asset('storage/'.$parent->image) 
            : asset('images/user.jpeg') }}"
                        onclick="document.getElementById('profileImageInput').click();">

                    <h4 class="mt-3">{{ $parent->name }}</h4>
                    <p class="text-light mb-0">{{ $parent->email }}</p>
                    <small>{{ __('Students_trans.parent') }}</small>
                </div>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>{{ __('Students_trans.parent_name_ar') }}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="name_of_father_ar"
                            value="{{ $parent->getTranslation('name_of_father', 'ar') }}"
                            class="form-control">
                            @error('name_of_father_ar') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>{{ __('Students_trans.parent_name_en') }}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="name_of_father_en"
                            value="{{ $parent->getTranslation('name_of_father', 'en') }}"
                            class="form-control">
                            @error('name_of_father_en') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>{{ __('Students_trans.password') }}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" id="password" class="form-control" name="password">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" onclick="togglePassword()" id="showPassword">
                           
                            <label class="form-check-label" for="showPassword">
                                {{ __('Students_trans.show_password') }}
                            </label>
                            
                        </div>
                         @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-update">{{ __('Students_trans.Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
<script>
    // Show/Hide password
    function togglePassword() {
        const x = document.getElementById("password");
        x.type = x.type === "password" ? "text" : "password";
    }

    // Preview image when selected
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('profileImagePreview').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection