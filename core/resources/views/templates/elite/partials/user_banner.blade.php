@php
    $content = getContent('banner.content', true);
    $user = auth()->user()->load('loginLogs');
    $lastLogin = \App\Models\UserLogin::where('user_id', $user->id)->latest()->first();
@endphp

<section class="account-setting-banner py-5 position-relative" style="background-color: #D2DDDD;">
    <div class="star-field"></div>
    <div class="bubble-field"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-lg-6 mb-4">
                <div class="card p-5 bg-white rounded animated fadeIn shadow-custom">
                    <div class="author d-flex align-items-center justify-content-center mb-4">
                        <div class="">
                            <img alt="" src="{{ getImage(getFilePath('userProfile') . '/' . @$user->image, getFileSize('userProfile')) }}" class="rounded-circle" width="120" height="120">
                        </div>
                        <div>
                            <h4 class="author__hello mb-1 text-muted">Welcome, <span style="color: #1D5550; ">{{ __($user->fullname) }}</span></h4>
                            <h5 class="author__email text-muted">{{ __($user->email) }}</h5>
                        </div>
                    </div>
                    <div class="author-details text-start d-flex justify-content-between align-items-center flex-wrap">
                        <div class="author-details__item mb-3 d-flex flex-column align-items-start">
                            <span class="author-details__title text-uppercase fw-bold" style="color:#1D5550">@lang('Username')</span>
                            <p class="author-details__info" >{{ $user->username }}</p>
                        </div>
                        <div class="author-details__item mb-3 d-flex flex-column align-items-start">
                            <span class="author-details__title text-uppercase fw-bold"style="color:#1D5550;">@lang('Security')</span>
                            <p class="author-details__info @if ($user->ts == Status::ENABLE) text-success @else text-warning @endif">
                                <i class="fas fa-shield-alt"></i>
                                @if ($user->ts == Status::ENABLE)
                                    @lang('Highly Secure')
                                @else
                                    @lang('Less Secure')
                                @endif
                                @if ($user->ts == Status::DISABLE)
                                    <a href="{{ route('user.twofactor') }}" class="text-decoration-none d-block" style=color:#1D5550;font-weight:bold;"">@lang('Secure Now')</a>
                                @endif
                            </p>
                        </div>
                        <div class="author-details__item mb-3 d-flex flex-column align-items-start">
                            <span class="author-details__title text-uppercase fw-bold" style="color:#1D5550">@lang('Last Login')</span>
                            <p class="author-details__info">{{ showDateTime(@$lastLogin->created_at, 'F j, Y, g:i A') }}</p>
                        </div>
                    </div>
                    @if (gs('kv') == Status::ENABLE)
                        <div class="author-details__item mb-3">
                            <span class="author-details__title text-uppercase fw-bold">@lang('KYC Verification')</span>
                            <p class="author-details__info @if ($user->kv == Status::KYC_VERIFIED) text-success @elseif($user->kv == Status::KYC_UNVERIFIED) text-warning @endif">
                                @if ($user->kv == Status::KYC_VERIFIED)
                                    <i class="fas fa-check-circle"></i> @lang('Verified')
                                @elseif($user->kv == Status::KYC_PENDING)
                                    <i class="fas fa-hourglass-half"></i> @lang('Pending')
                                @else
                                    <i class="fas fa-times-circle"></i> @lang('Unverified')
                                @endif
                                @if ($user->kv == Status::NO)
                                    <a href="{{ route('user.kyc.form') }}" class="text-decoration-none d-block">@lang('Verify Now')</a>
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-section__shape position-relative">
                    <img alt="" src="{{ getImage('assets/images/userprofile.png') }}" class="img-fluid rounded" style="height:350px; width:350px;">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .banner-section__shape img {
        max-width: 100%;
        height: auto;
    }
    .author__thumb img {
        border: 3px solid #fff;
        object-fit: cover;
    }
    .author__hello {
        font-weight: bold;
        font-size: 1.2rem;
    }
    .author__email {
        font-size: 1.25rem;
    }
    .author-details__title {
        display: block;
        font-size: 0.875rem;
        font-weight: bold;
    }
    .author-details__info {
        font-size: 0.7rem;
    }
    .text-success {
        color: #28a745 !important;
    }
    .text-warning {
        color: #ffc107 !important;
    }
    .card {
        animation: fadeIn 0.5s ease-in-out;
        border-radius: 30px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .shadow-custom {
        box-shadow: 0 4px 8px #1D5550;
    }
    .author-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .author-details__item {
        flex: 1;
        margin-bottom: 15px;
    }
    .star-field, .bubble-field {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }
    .star, .bubble {
        position: absolute;
        background-color: #1D5550;
        border-radius: 50%;
        opacity: 0.8;
    }
    .star {
        width: 2px;
        height: 2px;
        animation: twinkle 2s infinite ease-in-out;
    }
    .bubble {
        width: 10px;
        height: 10px;
        animation: rise 5s infinite ease-in-out;
    }
    @keyframes twinkle {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 0.2; }
    }
    @keyframes rise {
        0% { transform: translateY(100vh); opacity: 0.2; }
        50% { opacity: 0.8; }
        100% { transform: translateY(-100vh); opacity: 0.2; }
    }
</style>

@push('script')
<script>
    (function($) {
        "use strict";
        
        function createStarField() {
            const starField = document.querySelector('.account-setting-banner .star-field');

            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.width = `${Math.random() * 3}px`;
                star.style.height = star.style.width;
                star.style.animationDuration = `${Math.random() * 2 + 1}s`;
                starField.appendChild(star);
            }
        }

        function createBubbleField() {
            const bubbleField = document.querySelector('.account-setting-banner .bubble-field');

            for (let i = 0; i < 50; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.bottom = `-${Math.random() * 100}px`;
                bubble.style.width = `${Math.random() * 10 + 10}px`;
                bubble.style.height = bubble.style.width;
                bubble.style.animationDuration = `${Math.random() * 5 + 5}s`;
                bubbleField.appendChild(bubble);
            }
        }

        createStarField();
        createBubbleField();
    })(jQuery)
</script>
@endpush
