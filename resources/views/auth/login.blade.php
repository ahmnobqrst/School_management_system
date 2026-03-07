<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ trans('Students_trans.School_Management_system') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        /* Container for the entire login screen */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            /* Subtly patterned or soft gradient background */
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        }

        /* The main card holding the form and info */
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            max-width: 950px;
            width: 100%;
            position: relative;
        }

        /* The left/informational side (hidden on small screens) */
        .login-side-panel {
            background: linear-gradient(135deg, #0f766e, #0d9488);
            /* Trustworthy teal/green */
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            text-align: center;
            width: 45%;
            position: relative;
            z-index: 1;
        }

        /* Decorative circle behind the text */
        .login-side-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: -1;
        }

        .login-side-panel::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            z-index: -1;
        }

        .login-side-panel img {
            max-width: 80%;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 10px rgba(0, 0, 0, 0.2));
        }

        .login-side-panel h2 {
            font-weight: 800;
            font-size: 32px;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .login-side-panel p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            font-weight: 300;
        }

        /* The right/form side */
        .login-form-panel {
            padding: 50px 60px;
            width: 55%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
            text-align: right;
        }

        .login-header h3 {
            font-weight: 800;
            color: #111827;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 15px;
            margin: 0;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            height: 52px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 10px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .form-control:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.1);
            background-color: #ffffff;
            outline: none;
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            color: #ef4444;
        }

        /* Options row (Remember me & Forgot password) */
        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #4b5563;
        }

        .custom-checkbox input {
            margin-left: 8px;
            width: 18px;
            height: 18px;
            accent-color: #0d9488;
            cursor: pointer;
        }

        .forgot-link {
            color: #0d9488;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #0f766e;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            background: #0d9488;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            height: 54px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(13, 148, 136, 0.2), 0 2px 4px -1px rgba(13, 148, 136, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: #0f766e;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.3), 0 4px 6px -2px rgba(13, 148, 136, 0.15);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .login-side-panel {
                display: none !important;
            }

            .login-form-panel {
                width: 100%;
                padding: 40px 30px;
            }

            .login-card {
                max-width: 500px;
            }
        }
    </style>


</head>

<body>

    <div class="wrapper">
        <!--=================================
preloader -->

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        <!--=================================
preloader -->

        <!--=================================
login-->

        <section class="login-wrapper">
            <div class="login-card">

                <!-- Left Side: Educational Branding (Hidden on mobile) -->
                <div class="login-side-panel d-none d-lg-flex">
                    <img src="https://img.freepik.com/free-vector/gradient-high-school-logo-design_23-2149626932.jpg"
                        alt="School Logo"
                        style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; border: 4px solid rgba(255,255,255,0.2);">
                    <h2>{{ trans('Students_trans.School_Management_system') }}</h2>
                    <p>{{ trans('Students_trans.description_for_website') }}</p>
                </div>

                <!-- Right Side: Login Form -->
                <div class="login-form-panel">
                    <div class="login-header">
                        @if ($type == 'student')
                            <h3>{{ trans('Students_trans.login_for_student') }}</h3>
                            <p>{{ trans('Students_trans.hello') }}</p>
                        @elseif($type == 'parent')
                            <h3>{{ trans('Students_trans.login_for_parent') }}</h3>
                            <p>{{ trans('Students_trans.hello') }}</p>
                        @elseif($type == 'teacher')
                            <h3>{{ trans('Students_trans.login_for_teacher') }}</h3>
                            <p>{{ trans('Students_trans.hello') }}</p>
                        @else
                            <h3>{{ trans('Students_trans.login_for_Admin') }}</h3>
                            <p>{{ trans('Students_trans.hello') }}</p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" value="{{ $type }}" name="type">

                        <div class="form-group">
                            <label for="email">{{ trans('Students_trans.email') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('Students_trans.password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="login-options">
                            <label class="custom-checkbox" for="remember">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <span>{{ __('Students_trans.remember_me') }}</span>
                            </label>
                            <a href="#" class="forgot-link">{{ trans('Students_trans.forget_password') }}</a>
                        </div>

                        <button type="submit" class="btn-login">
                            <span>{{ __('Students_trans.login') }}</span>
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </form>
                </div>

            </div>
        </section>

        <!--=================================
login-->

    </div>
    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>

    <!-- chart -->
    <script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
    <!-- calendar -->
    <script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
    <!-- charts sparkline -->
    <script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
    <!-- charts morris -->
    <script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
    <!-- toastr -->
    @yield('js')
    <script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
    <!-- validation -->
    <script src="{{ URL::asset('assets/js/validation.js') }}"></script>
    <!-- lobilist -->
    <script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
