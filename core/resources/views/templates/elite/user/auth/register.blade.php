@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $content = getContent('registration.content', true);
        $policyElements = getContent('policy_pages.element');
    @endphp

    <section class="account py-5">
        <div class="container">
            <div class="account-inner mx-auto">
                <div class="account-left d-none d-md-flex align-items-center justify-content-center">
                    <img alt="Illustration" src="{{ getImage('assets/images/frontend/registration/' . @$content->data_values->image) }}" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
                </div>
                <div class="account-right">
                    <div class="account-form-wrapper bg--white border rounded p-4 shadow">
                        <div class="text-center mb-4">
                            <img alt="Logo" src="{{ asset('assets/images/logoIcon/favicon.png') }}" class="img-fluid mb-3" style="height: 50px;">
                        </div>
                        <h1 class="title text-center mb-2" style="font-size: 24px; color: #1D5550;">Register</h1>
                        <p class="desc text-center mb-4" style="color: #5C6867;">Welcome to our platform!</p>
                        <form action="{{ route('user.register') }}" class="account-form" method="post" onsubmit="return submitUserForm();">
                            @csrf

                            @if (session()->get('reference') != null)
                                <div class="form-group">
                                    <label class="form--label" style="color: #1D5550;">@lang('Referred By')</label>
                                    <input class="form--control" id="referenceBy" name="referBy" readonly type="text" value="{{ session()->get('reference') }}" style="font-size: 14px;">
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Username')</label>
                                <input class="form--control checkUser" id="username" name="username" required type="text" value="{{ old('username') }}" style="font-size: 14px;">
                                <small class="text-danger usernameExist"></small>
                            </div>
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Email Address')</label>
                                <input class="form--control checkUser" id="email" name="email" required type="email" value="{{ old('email') }}" style="font-size: 14px;">
                            </div>
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Country')</label>
                                <select class="select form--control" id="country" name="country" required style="font-size: 14px;">
                                    @foreach ($countries as $key => $country)
                                        <option data-code="{{ $key }}" data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}">{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Mobile')</label>
                                <div class="input-group">
                                    <span class="input-group-text mobile-code" style="background-color: #D2DDDD; border: 1px solid #1D5550; color: #1D5550;"></span>
                                    <input name="mobile_code" type="hidden">
                                    <input name="country_code" type="hidden">
                                    <input class="form-control form--control checkUser" name="mobile" placeholder="@lang('Your Phone Number')" required type="number" value="{{ old('mobile') }}" style="font-size: 14px;">
                                </div>
                                <small class="text-danger mobileExist"></small>
                            </div>

                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Password')</label>
                                <div class="position-relative">
                                    <input class="form--control @if ($general->secure_password) secure-password @endif" id="password" name="password" required type="password" style="font-size: 14px;">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password" style="color: #1D5550;"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form--label" style="color: #1D5550;">@lang('Confirm Password')</label>
                                <div class="position-relative">
                                    <input class="form--control" id="password_confirmation" name="password_confirmation" required type="password" style="font-size: 14px;">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password_confirmation" style="color: #1D5550;"></div>
                                </div>
                            </div>

                            @if ($general->agree)
                                <div class="form-group d-flex align-items-center justify-content-start">
                                    <input @checked(old('agree')) class="form-check-input custom-checkbox" id="agree" name="agree" required type="checkbox" style="margin-right: 10px;">
                                    <label class="form-check-label" for="agree" style="color: #1D5550;">@lang('I agree with')</label>
                                    @foreach ($policyElements as $policy)
                                        <a class="link" href="{{ route('policy.pages', encrypt([slug(@$policy->data_values->title), $policy->id])) }}" target="_blank" style="color: #1D5550;">{{ __($policy->data_values->title) }}</a>
                                        @if (!$loop->last)
                                            ,&nbsp;
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <x-captcha :path="$activeTemplate . 'partials.'" />

                            <div class="form-group">
                                <button class="btn btn--base-two w-100 mb-2" id="recaptcha" type="submit" style="background-color: #1D5550; color: #D2DDDD;">@lang('Register Now')</button>
                            </div>
                            <div class="form-group mb-0">
                                <p class="switch text-center" style="font-size: 14px;" style="color:#5C6867">@lang('Already have an account?') <a class="link" href="{{ route('user.login') }}" style="color: #1D5550;">@lang('Login')</a></p>
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
            </div>
        </div>
    </section>
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush

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
            max-width: 1000px;
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
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }
        .account-form-wrapper {
            width: 100%;
            padding: 20px;
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
        }
        .form-check-input.custom-checkbox:checked {
            background-color: #000;
            border-color: #000;
        }
        .form-check-label {
            color: #1D5550;
        }
        .forgot {
            color: #1D5550;
            text-decoration: none;
        }
        .forgot:hover {
            font-weight: bold;
        }
        .link {
            color: #007bff;
            text-decoration: none;
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
            color: #007bff;
            text-decoration: none;
        }
        .account-footer__text a:hover {
            text-decoration: underline;
        }
    </style>
@endpush
