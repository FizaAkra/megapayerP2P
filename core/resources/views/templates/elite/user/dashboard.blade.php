@extends($activeTemplate . 'layouts.master_with_menu')
@section('content')
    @php
        $kycContent = getContent('kyc.content', true);
        $walletImage = fileManager()->crypto();
        $profileImage = fileManager()->userProfile();
    @endphp
    <div class="row gy-4">
        @if ($user->kv == 0)
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification Required')</h4>
                    <hr>
                    <p class="mb-0">
                        {{ __(@$kycContent->data_values->kyc_required) }}
                        <a class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a>
                    </p>
                </div>
            </div>
        @elseif($user->kv == 2)
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification Pending')</h4>
                    <hr>
                    <p class="mb-0">
                        {{ __(@$kycContent->data_values->kyc_pending) }}
                        <a class="text--base" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
                    </p>
                </div>
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12">
            <h5 class="title">@lang('Referral Link')</h5>
            <div class="input-group">
                <input class="form-control form--control bg-white" id="key" name="key" readonly=""
                    type="text" value="{{ route('user.register', [auth()->user()->username]) }}">
                <button class="input-group-text bg--base-two text-white border-0 copyBtn" id="copyBoard">
                    <i class="lar la-copy"></i>
                </button>
            </div>
        </div>

        @foreach ($wallets as $wallet)
            <div class="col-xl-4 col-md-6 d-widget-item">
                <a class="d-block" href="{{ route('user.transaction.index') }}?crypto={{ $wallet->cryptoId }}">
                    <div class="d-widget">
                        <div class="d-widget__icon">
                            <img src="{{ getImage($walletImage->path . '/' . $wallet->cryptoImage, $walletImage->size) }}">
                        </div>
                        <div class="d-widget__content">
                            <p class="d-widget__caption">{{ __($wallet->cryptoCode) }} </p>
                            <h2 class="d-widget__amount">{{ showAmount($wallet->balance, 8) }}</h2>
                            <h6 class="d-widget__usd text--base">
                                @lang('In USD') <i class="las la-arrow-right"></i>
                                {{ showAmount($wallet->balanceInUsd) }}
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <h4 class="mt-4">@lang('Latest Advertisements')</h4>
    @include($activeTemplate . 'partials.user_ads_table')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.copyBtn').on('click', function() {
                var copyText = document.getElementById("key");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");

                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .d-widget__usd {
            font-size: 15px;
            margin-top: 5px;
        }
    </style>
@endpush
