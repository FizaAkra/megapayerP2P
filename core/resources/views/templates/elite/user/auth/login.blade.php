@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $content = getContent('login.content', true);
        $policyElements = getContent('policy_pages.element');
    @endphp

    <section class="account py-5">
        <div class="container">
            <div class="account-inner mx-auto">
                <div class="account-left">
                    <div class="account-form-wrapper bg--white border rounded p-5 shadow" style="max-width: 450px; margin: auto;">
                        <div class="text-center mb-4">
                            <img alt="Logo" src="{{ asset('assets/images/logoIcon/favicon.png') }}" class="img-fluid mb-3" style="height: 80px;">
                        </div>
                        <h1 class="title text-center mb-2" style="font-size: 24px; color: #1D5550;">Welcome again!</h1>
                        <p class="desc text-center mb-4" style="color: #666;">Please enter your details</p>
                        <form action="{{ route('user.login') }}" class="account-form" method="post" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Email')</label>
                                <input class="form--control" name="username" required type="text" value="{{ old('username') }}" style="font-size: 14px;">
                            </div>
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Password')</label>
                                <div class="position-relative">
                                    <input class="form--control" id="password" name="password" required type="password" style="font-size: 14px;">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password"></div>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input custom-checkbox" id="remember" style="margin-right: 10px;">
                                    <label class="form-check-label" for="remember" style="color: #1D5550; margin-bottom: 0;">@lang('Remember me')</label>
                                </div>
                                <a class="forgot" href="{{ route('user.password.request') }}" style="color: #1D5550; text-decoration: none; font-size: 14px;">@lang('Forgot Password?')</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn--base-two w-100 mb-2" type="submit" style="background-color:#1D5550; color: #D2DDDD; font-weight: bold;">@lang('Log In')</button>
                            </div>
                            <div class="form-group">
                                <p class="switch text-center" style="font-size: 14px;" style="color:#5C6867">@lang('Don\'t have an account?') <a class="link" href="{{ route('user.register') }}" style="color: #1D5550;">@lang('Create Now')</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="account-footer text-center mt-4">
                        <p class="account-footer__text">
                            &copy; {{ date('Y') }}
                            <a href="{{ route('home') }}" class="text--base" style="color:black;">{{ __(gs('site_name')) }}</a>
                            @lang('All Rights Reserved')
                        </p>
                    </div>
                </div>
                <div class="account-right d-none d-md-flex align-items-center justify-content-center">
                    <img alt="Illustration" src="{{ getImage('assets/images/frontend/login/' . @$content->data_values->image) }}" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
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
            flex-direction: column;
            justify-content: center;
        }
        .account-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 20px; /* Added padding for better spacing */
        }
        .account-form-wrapper {
            max-width: 450px; /* Increased max-width for the form box */
            width: 100%;
            padding: 30px; /* Reduced padding */
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
            border: 1px solid #1D5550;
            background: #D2DDDD;
            color: #1D5550;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .password-show-hide {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
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
            background-color: #1D5550; /* Change checkbox tick color to black */
            border-color: #1D5550; /* Change checkbox border color to black */
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
