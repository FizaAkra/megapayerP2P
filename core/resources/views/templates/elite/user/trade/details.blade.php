@extends($activeTemplate . 'layouts.master_without_menu')
@section('content')
    @php
        $profileImage = fileManager()->userProfile();
        $user = auth()->user();
        $topImage = $trade->buyer_id == $user->id ? $trade->seller->image : $trade->buyer->image;
        $authBuyer = $user->id == $trade->buyer_id;

        $lastTime = Carbon\Carbon::parse($trade->paid_at)->addMinutes($trade->window);
        $remainingMin = $lastTime->diffInMinutes(now());

        $endTime = $trade->created_at->addMinutes($trade->window);
        $remainingMinitues = $endTime->diffInMinutes(now());

        if ($trade->buyer_id == $user->id) {
            $trader = $trade->seller;
        } elseif ($trade->seller_id == $user->id) {
            $trader = $trade->buyer;
        }
    @endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="buy-details two">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="buy-details__left" style="border: 1px solid #90A3A2; border-radius: 8px; background-color: #F4F7F7;">
                            <div class="buy-details__header" style="background-color: #1D5550; border-radius: 8px 8px 0 0; padding: 20px;">
                                <div class="buy-details__header-top d-flex justify-content-between align-items-center">
                                    <div class="customer d-flex align-items-center">
                                        <div class="customer__thumb" style="margin-right: 15px;">
                                            <img alt="" class="fit-image rounded-circle" src="{{ getImage($profileImage->path . '/' . @$topImage, null, true) }}" width="60" style="border: 2px solid #90A3A2;">
                                        </div>
                                        <div class="customer__content">
                                            <h6 class="customer__name text-white">{{ __($trader->fullname) }}</h6>
                                            <span class="customer__info text-light">{{ $trader->username }}</span>
                                        </div>
                                    </div>
                                    @if($general->kv)
                                    <span class="kyc">
                                        @if ($trader->kv == Status::KYC_VERIFIED)
                                            <i class="fas fa-check-circle text-white"></i> @lang('KYC Verified')
                                        @elseif($trader->kv == Status::KYC_PENDING)
                                            <i class="fas fa-spinner text-warning"></i> @lang('KYC Pending')
                                        @else
                                            <i class="fas fa-times text-danger"></i> @lang('KYC Unverified')
                                        @endif
                                    </span>
                                    @endif
                                    <span class="location text-light">
                                        <img alt="" src="{{ getImage('assets/images/globe.png') }}" style="width: 20px;"> {{ __(@$trader->address->country) }}
                                    </span>
                                </div>
                            </div>
                            <div class="buy-details__chatbox-heading d-flex justify-content-between align-items-center p-3" style="border-bottom: 1px solid #90A3A2;">
                                <h5 class="title mb-0" style="color: #1D5550;">@lang('Messages')</h5>
                                <a class="text--base" href="" title="@lang('Click here to load new chat and trade current status')" style="color: #1D5550;"><i class="las la-undo-alt"></i> @lang('Refresh')</a>
                            </div>
                            <div class="p-3">
                                @include($activeTemplate.'user.trade.partials.chat_box')
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="buy-details__right" style="border: 1px solid #90A3A2; border-radius: 8px; background-color: #F4F7F7;">
                            <div class="buy-details__right-top p-3" style="border-bottom: 1px solid #90A3A2;">
                                <div class="trade">
                                    <p class="trade__desc">@lang('Trade Code'): <span class="trade__code">#{{ $trade->uid }}</span></p>
                                    @php echo $trade->statusBadge @endphp
                                </div>

                                @include($activeTemplate . 'user.trade.partials.alerts')

                                <div class="instructions">
                                    <h6 class="heading" style="color: #1D5550;">@lang('Instructions to be followed')</h6>
                                    <div class="instruction_list">
                                        <h6 class="title" style="color: #1D5550;">@lang('Terms of trade')</h6>
                                        <p style="color: #5C6867;">{{ __($trade->advertisement->terms) }}</p>
                                    </div>
                                    <div class="instruction_list">
                                        <h6 class="title" style="color: #1D5550;">@lang('Payment details')</h6>
                                        <p style="color: #5C6867;">{{ __($trade->advertisement->details) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="buy-details__right-middle p-3">
                                <h6 class="title" style="color: #1D5550;">@lang('Trade Information'):</h6>
                                <ul class="list" style="color: #5C6867;">
                                    <li class="list__item"><span class="title">@lang('Buyer Name'):</span> <span class="info">{{ __($trade->buyer->username) }}</span></li>
                                    <li class="list__item"><span class="title">@lang('Seller Name'):</span> <span class="info">{{ __($trade->seller->username) }}</span></li>
                                    <li class="list__item"><span class="title">@lang('Amount'):</span> <span class="info">{{ showAmount($trade->amount) }} {{ __($trade->fiat->code) }}</span></li>
                                    <li class="list__item"><span class="title">{{ __($trade->crypto->code) }}:</span> <span class="info">{{ showAmount($trade->crypto_amount, 8) }}</span></li>
                                    <li class="list__item"><span class="title">@lang('Payment Window'):</span> <span class="info">{{ $trade->window }} @lang('Minutes')</span></li>
                                </ul>
                            </div>

                            @include($activeTemplate . 'user.trade.partials.actions')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <style>
        .buy-details__header {
            background-color: #1D5550;
            color: white;
            border-radius: 8px 8px 0 0;
            padding: 20px;
        }

        .buy-details__header-top {
            border-radius: 8px 8px 0 0;
        }

        .buy-details__right, .buy-details__left {
            border-radius: 8px;
            background-color: #F4F7F7;
            padding: 20px;
        }

        .buy-details__chatbox-heading {
            background-color: #F4F7F7;
            border-bottom: 1px solid #90A3A2;
            padding: 15px;
        }

        .title {
            color: #1D5550;
        }

        .customer__name, .customer__info, .list__item .info, .instruction_list p {
            color: #5C6867;
        }

        .kyc i {
            color: white;
        }

        .kyc .fa-spinner {
            color: #5C6867;
        }

        .kyc .fa-times {
            color: #FF0000;
        }

        .location img {
            width: 20px;
        }

        .text--base {
            color: #1D5550;
        }

        .text--base:hover {
            color: #174a44;
        }

        .list__item {
            margin-bottom: 10px;
        }

        .list__item .title {
            font-weight: bold;
        }

        .instructions {
            margin-top: 20px;
        }

        .instruction_list .title {
            font-weight: bold;
        }

        .instruction_list {
            margin-bottom: 10px;
        }

        .trade__code {
            font-weight: bold;
            color: #1D5550;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            function startTimer(duration, display) {
                let timer = duration;
                let minutes;
                let seconds;
                if (display) {
                    setInterval(function() {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;
                        display.textContent = minutes + ":" + seconds;

                        if (--timer < 0) {
                            timer = duration;
                        }
                    }, 1000);
                }

            }

            @if ($trade->status == Status::TRADE_ESCROW_FUNDED)
                window.onload = function() {
                    let cancelMinutes = 60 * '{{ $remainingMinitues }}';
                    let display = document.querySelector('#cancel-min');
                    startTimer(cancelMinutes, display);
                };
            @endif

            @if ($trade->status == Status::TRADE_BUYER_SENT)
                window.onload = function() {
                    var disputeMinutes = 60 * '{{ $remainingMin }}';
                    let display = document.querySelector('#dispute-min');
                    startTimer(disputeMinutes, display);
                };
            @endif
        })(jQuery);
    </script>
@endpush
