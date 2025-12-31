<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{trans('Students_trans.School_Management_system')}}</title>

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
        }

        .login-fancy-bg {
            background: linear-gradient(180deg, #6366f1, #7c3aed);
        }

        .login-fancy {
            padding: 40px 30px;
        }

        .login-fancy h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
        }

        .section-field label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            height: 44px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, .15);
        }

        .button.btn-main {
            width: 100%;
            border-radius: 10px;
            height: 46px;
            font-weight: 600;
            margin-top: 15px;
        }

        /* Google Button */
        .google-btn {
            margin: 20px 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            background: #fff;
            transition: .3s ease;
        }

        .google-btn img {
            width: 20px;
        }

        .google-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            text-decoration: none;
        }

        .remember-checkbox {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }

        .remember-checkbox label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .remember-checkbox a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }

        .remember-checkbox a:hover {
            text-decoration: underline;
        }
    </style>


</head>

<body>

    <div class="wrapper">
        <!--=================================
preloader -->

        <div id="pre-loader">
            <img src="{{URL::asset('assets/images/pre-loader/loader-01.svg')}}" alt="">
        </div>

        <!--=================================
preloader -->

        <!--=================================
login-->

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">{{trans('Students_trans.hello')}}</h2>
                            <p class="mb-20 text-white">{{trans('Students_trans.description_for_website')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            @if($type == 'student')
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{trans('Students_trans.login_for_student')}}</h3>
                            @elseif($type == 'parent')
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{trans('Students_trans.login_for_parent')}}</h3>
                            @elseif($type == 'teacher')
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{trans('Students_trans.login_for_teacher')}}</h3>
                            @else
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{trans('Students_trans.login_for_Admin')}}</h3>
                            @endif
                            <form method="POST" action="{{route('login')}}">
                                @csrf

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">{{trans('Students_trans.email')}}*</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <input type="hidden" value="{{$type}}" name="type">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">{{trans('Students_trans.password')}}* </label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="section-field">
                                    <div class="remember-checkbox mb-30">
                                        <input type="checkbox" class="form-control" name="two" id="two" />
                                        <label for="two"> {{__('Students_trans.remember_me')}}</label>
                                        <a href="#" class="float-right">{{trans('Students_trans.forget_password')}}</a>
                                    </div>
                                </div>
                                {{-- Google Login --}}
                                @if($type == 'student')
                                <a href="{{ url('auth/google',$type) }}" class="google-btn">
                                    <img src="https://www.svgrepo.com/show/475656/google-color.svg">
                                    Login with Google
                                </a>
                                @elseif($type == 'parent')
                                <a href="{{url('auth/google',$type)}}" class="google-btn">
                                    <img src="https://www.svgrepo.com/show/475656/google-color.svg">
                                    Login with Google
                                </a>
                                @elseif($type == 'teacher')
                                <a href="{{url('auth/google',$type)}}" class="google-btn">
                                    <img src="https://www.svgrepo.com/show/475656/google-color.svg">
                                    Login with Google
                                </a>
                                @else
                                @endif

                                {{-- Normal Login --}}
                                <button class="button btn-main">
                                    <span>{{__('Students_trans.login')}}</span>
                                    <i class="fa fa-check"></i>
                                </button>


                               
                            </form>
                        </div>
                    </div>
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