@extends('admin.layouts.master')
@section('content')
    @php
      
        $pageTitle = 'Admin Login'; // Ensure $pageTitle is properly set
    @endphp

    <section class="account py-5" style="background-color: #fff;">
        <div class="container">
            <div class="account-inner mx-auto">
                <div class="account-left d-none d-md-flex align-items-center justify-content-center">
                    <img alt="Illustration" src="{{ asset('assets/images/logoIcon/adminlogin.png') }}" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
                </div>
                <div class="account-right">
                    <div class="account-form-wrapper bg--white border rounded p-5 shadow" style="max-width: 450px; margin: auto;">
                        <div class="text-center mb-4">
                            <img alt="Logo" src="{{ asset('assets/images/logoIcon/favicon.png') }}" class="img-fluid mb-3" style="height: 80px;">
                        </div>
                       
                        
                        <form action="{{ route('admin.login') }}" method="POST" class="account-form" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Username')</label>
                                <input class="form--control" name="username" required type="text" value="{{ old('username') }}" style="font-size: 14px; background:#D2DDDD; border:1px solid #1D5550">
                            </div>
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Password')</label>
                                <div class="position-relative">
                                    <input class="form--control" id="password" name="password" required type="password" style="font-size: 14px; background:#D2DDDD; border:1px solid #1D5550">
                                    <div class="password-show-hide fas fa-eye-slash toggle-password" id="togglePassword" style="cursor: pointer; position: absolute; right: 15px; top: 50%; transform: translateY(-50%);"></div>
                                </div>
                            </div>
                            <x-captcha />
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input custom-checkbox" id="remember" style="margin-right: 10px;">
                                    <label class="form-check-label" for="remember" style="color: #1D5550; margin-bottom: 0;">@lang('Remember Me')</label>
                                </div>
                                <a class="forgot" href="{{ route('admin.password.reset') }}" style="color: #1D5550; text-decoration: none; font-size: 14px;">@lang('Forgot Password?')</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn--base-two w-100 mb-2" type="submit" style="background-color:#1D5550; color:#FEFFFF; font-weight: bold;">@lang('LOGIN')</button>
                            </div>
                        </form>
                    </div>
                    <div class="account-footer text-center mt-4">
                        <p class="account-footer__text">
                            &copy; {{ date('Y') }}
                           
                            @lang('All Rights Reserved')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .account {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #fff;
        }
        .account-inner {
            display: flex;
            flex-direction: row;
            max-width: 1000px; /* Adjusted max-width */
            width: 100%;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .account-left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }
        .account-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            background: #fff;
        }
        .account-form-wrapper {
            max-width: 450px;
            width: 100%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px #1D5550;
            background: #fff;
        }
        .form--label {
            font-weight: 600;
        }
        .form--control {
            width: 100%;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background: #fff;
            color: #1D5550;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .password-show-hide {
            cursor: pointer;
            color: #1D5550;
        }
        .btn--base-two {
            background: #000;
            color: #fff;
            border: 1px solid #000;
            font-weight: bold;
        }
        .btn--base-two:hover {
            background: #1D5550;
            color: #fff;
            border: 1px solid #1D5550;
        }
        .form-check-input.custom-checkbox:checked {
            background-color: #1D5550;
            border-color: #1D5550;
        }
        .form-check-label {
            color: #1D5550;
        }
        .forgot {
            color: #1D5550;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot:hover {
            font-weight: bold;
        }
        .link {
            color: #1D5550;
            text-decoration: none;
            font-size: 14px;
        }
        .link:hover {
            font-weight: bold;
        }
        .account-footer {
            text-align: center;
        }
        .account-footer__text {
            color: #1D5550;
        }
        .account-footer__text a {
            color: #1D5550;
            text-decoration: none;
        }
        .account-footer__text a:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@push('script')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endpush
