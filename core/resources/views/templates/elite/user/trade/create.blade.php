@extends($activeTemplate . 'layouts.master_without_menu')
@section('content')
    @php
        $profileImage = fileManager()->userProfile();
    @endphp

    <section class="pt-120 pb-120" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 text-center">
                    <h2 style="color: #1D5550;">
                        @if ($ad->type == 1)
                            @lang('Sell')
                        @else
                            @lang('Buy')
                        @endif
                        {{ __($ad->crypto->name) }} @lang('using')
                        {{ __($ad->fiatGateway->name) }} @lang('with') {{ __($ad->fiat->name) }}
                        ({{ __($ad->fiat->code) }})
                    </h2>

                    <p class="mt-2" style="color: #5C6867;">
                        <a class="text--base" href="{{ route('public.profile', $ad->user->username) }}" style="color: #1D5550;">{{ __($ad->user->username) }}</a> @lang('wishes to')
                        @if ($ad->type == 1)
                            @lang('buy') {{ __($ad->crypto->name) }} @lang('from')
                        @else
                            @lang('sell') {{ __($ad->crypto->name) }} @lang('to')
                        @endif
                        @lang('you').
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="card p-4 mb-4" style="border: 1px solid #5C6867; background-color: #FFFFFF;">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #5C6867;">
                                <span class="caption">@lang('Rate')</span>
                                <span class="value">{{ getRate($ad) }} {{ __($ad->fiat->code) }} /{{ __($ad->crypto->code) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #5C6867;">
                                <span class="caption">@lang('Payment Method')</span>
                                <span class="value">{{ __($ad->fiatGateway->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style=" color: #5C6867;">
                                <span class="caption">@lang('User')</span>
                                <span class="value">{{ __($ad->user->username) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #5C6867;">
                                <span class="caption">@lang('Trade Limits')</span>
                                <span class="value">{{ showAmount($ad->min) }} - {{ showAmount($maxLimit) }} {{ __($ad->fiat->code) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #5C6867;">
                                <span class="caption">@lang('Payment Window')</span>
                                <span class="value">{{ __($ad->window) }} (@lang('minutes'))</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #5C6867;">
                                <span class="caption">@lang('Avg. Trade Speed')</span>
                                <span class="value">{{ avgTradeSpeed($ad) }}</span>
                            </li>
                        </ul>
                    </div>

                    <form class="card p-4 trade-request-form mt-5" style="border: 1px solid #5C6867; background-color: #FFFFFF;" action="{{ route('user.trade.request.store', $ad->id) }}" method="POST">
                        @csrf
                        <h3 class="mb-3 text-center" style="color: #1D5550;">@lang('How much you wish to')
                            @if ($ad->type == 1)
                                @lang('sell')?
                            @else
                                @lang('buy')?
                            @endif
                        </h3>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>@lang('I will pay')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" id="amount" name="amount" class="form-control bg-light border-secondary" placeholder="0.00" aria-describedby="payment1" required autocomplete="off" style="border-color: #90A3A2; box-shadow: 0 4px 8px #1D5550;">
                                        <span class="input-group-text" style="background-color: #1D5550; color: white; border: none;" id="payment1">{{ __($ad->fiat->code) }}</span>
                                    </div>
                                    <small class="text-danger message"></small>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>@lang('And receive')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" id="final-amount" class="form-control bg-light border-secondary" placeholder="0.00" aria-describedby="payment2" autocomplete="off" style="border-color: #90A3A2;box-shadow: 0 4px 8px #1D5550;">
                                        <span class="input-group-text" style="background-color: #1D5550; color: white; border: none;" id="payment2">{{ __($ad->crypto->code) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control mt-3" name="details" placeholder="@lang('Write your contact message and other information for the trade here')..." required style="border-color: #90A3A2; box-shadow: 0 2px 2px #1D5550;"></textarea>
                                    <p class="text-danger text-sm mb-1 mt-1" style="color:#1D5550; font-weight:bold;"><i class="fas fa-info"></i> @lang('Remember to write about your convenient payment methods in the message').
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn--base w-100 mt-4" style="background-color: #1D5550; color: white; border: none;">@lang('Send Trade Request')</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-5 pl-xl-5 mt-lg-0 mt-4">
                    <div class="card p-4" style="border: 1px solid #5C6867; background-color: #FFFFFF;">
                        <div class="user-details-wrapper text-center">
                            <div class="user-details-top mb-4">
                                <div class="thumb mb-3">
                                    <a href="{{ route('public.profile', $ad->user->username) }}"><img src="{{ getImage($profileImage->path . '/' . @$ad->user->image, null, true) }}" class="rounded-circle" alt="image" width="100" style="border: 2px solid #90A3A2;"></a>
                                </div>
                                <div class="content">
                                    <h5><a href="{{ route('public.profile', $ad->user->username) }}" class="text--base" style="color: #1D5550;">{{ __($ad->user->username) }}</a></h5>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span title="@lang('Positive Feedback')">
                                                <i class="las la-thumbs-up text--success"></i> {{ $positive }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span title="@lang('Negative Feedback')">
                                                <i class="las la-thumbs-down text--danger"></i> {{ $negative }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span title="@lang('Country')">
                                                <i class="la la-globe"></i> {{ @$ad->user->address->country }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-details-main mt-3">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F5F5F5; color: #5C6867;">
                                        @if ($ad->user->ev)
                                            <i class="fas fa-check-circle text--success"></i>
                                        @else
                                            <i class="fas fa-times-circle text--danger"></i>
                                        @endif
                                        @lang('Email Verified')
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F5F5F5; color: #5C6867;">
                                        @if ($ad->user->sv)
                                            <i class="fas fa-check-circle text--success"></i>
                                        @else
                                            <i class="fas fa-times-circle text--danger"></i>
                                        @endif
                                        @lang('Mobile Number Verified')
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F5F5F5; color: #5C6867;">
                                        @if ($ad->user->kv == 1)
                                            <i class="fas fa-check-circle text--success"></i>
                                        @else
                                            <i class="fas fa-times-circle text--danger"></i>
                                        @endif
                                        @lang('KYC Data Verified')
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F5F5F5; color: #5C6867;">
                                        <i class="las la-clock"></i>
                                        @lang('Avg. Speed'):
                                        @if ($ad->user->completed_trade)
                                            <span class="fw-bold">
                                                {{ round($ad->user->total_min / $ad->user->completed_trade) }}
                                                @lang('Minutes') / @lang('Trade')
                                            </span>
                                        @else
                                            @lang('No trades yet')
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="terms-sidebar__widget mt-4">
                            <h6 class="title" style="color: #1D5550;"><i class="las la-file-invoice"></i> @lang('Terms of This Trade')</h6>
                            <p style="color: #5C6867;">{{ __($ad->terms) }}</p>
                        </div>
                        <div class="terms-sidebar__widget mt-4">
                            <h6 class="title" style="color: #1D5550;"><i class="las la-file-invoice-dollar"></i> @lang('Payment details of This Trade')</h6>
                            <p style="color: #5C6867;">{{ __($ad->details) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h4 class="mt-5 mb-3 text-center" style="color: #1D5550;">@lang('Feedbacks on This Advertisement')</h4>
                    @include($activeTemplate . 'partials.reviews')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
       

        .card {
            box-shadow: 0 4px 8px #1D5550;
            border-radius: 10px;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #1D5550;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .btn--base {
            background-color: #1D5550;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn--base:hover {
            background-color: #D2DDDD;
        }

        .text--base {
            color: #1D5550;
            text-decoration: none;
            font-size:x-large;
        }

        .text--base:hover {
            color: #5C6867;
        }

        .text-danger.text-sm {
            font-size: 0.875rem;
            color:#1D5550;
            font-weight:bold;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('#amount').on('input', function() {
                var min = '{{ $ad->min }}';
                var max = '{{ $maxLimit }}';
                var amount = $('#amount').val();
                var rate = '{{ getRate($ad) }}';
                $('.message').text('');
                if (parseFloat(amount) < parseFloat(min)) {
                    $('.message').text(
                        `@lang('Minimum Limit is') : ${parseFloat(min).toFixed(2)} {{ __($ad->fiat->code) }}`);
                    $('#final-amount').val(0);
                } else if (parseFloat(amount) > parseFloat(max)) {
                    $('.message').text(
                        `@lang('Maximum Limit is') : ${parseFloat(max).toFixed(2)} {{ __($ad->fiat->code) }}`);
                    $('#final-amount').val(0);
                } else {
                    var finalAmount = (1 / parseFloat(rate)) * parseFloat(amount);
                    $('#final-amount').val(parseFloat(finalAmount).toFixed(8));
                }
            });

            $('#final-amount').on('input', function() {
                var min = '{{ $ad->min }}';
                var max = '{{ $maxLimit }}';
                var amount = $('#final-amount').val();
                var rate = '{{ getRate($ad) }}';

                $('.message').text('');

                var finalAmount = parseFloat(rate) * parseFloat(amount);

                if (parseFloat(finalAmount) < parseFloat(min)) {
                    $('.message').text(`@lang('Minimum Limit is') : ${parseFloat(min).toFixed(2)} {{ __($ad->fiat->code) }}`);
                    $('#amount').val(0);
                } else if (parseFloat(finalAmount) > parseFloat(max)) {
                    $('.message').text(`@lang('Maximum Limit is') : ${parseFloat(max).toFixed(2)} {{ __($ad->fiat->code) }}`);
                    $('#amount').val(0);
                } else {
                    $('#amount').val(parseFloat(finalAmount).toFixed(2));
                }

            });

        })(jQuery)
    </script>
@endpush
