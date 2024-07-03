@php
    $socialIconElements = getContent('social_icon.element');
    $policyElements = getContent('policy_pages.element');
    $cryptos = App\Models\CryptoCurrency::active()->orderBy('name')->take(7)->get();
@endphp

<footer class="footer-area" style="background:#1D5550">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <a href="{{ route('home') }}">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="Logo" class="footer-logo">
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title text-white">@lang('Quick Links')</h5>
                <ul class="footer-menu">
                    @auth
                        <li><a href="{{ route('user.home') }}">@lang('Dashboard')</a></li>
                    @else
                        <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                    @endauth
                    <li><a href="{{ route('pages', 'about') }}">@lang('About')</a></li>
                    <li><a href="{{ route('user.trade.request.running') }}">@lang('Trade')</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title text-white">@lang('Legal')</h5>
                <ul class="footer-menu">
                    @foreach ($policyElements as $policy)
                        <li><a href="{{ route('policy.pages', encrypt([slug(@$policy->data_values->title), $policy->id])) }}">{{ __($policy->data_values->title) }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title text-white">@lang('Buy Asset')</h5>
                <ul class="footer-menu">
                    @foreach ($cryptos as $crypto)
                        <li><a href="{{ route('advertisement.all', ['buy', $crypto->code, 'all']) }}">{{ $crypto->code }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title text-white">@lang('Sell Asset')</h5>
                <ul class="footer-menu">
                    @foreach ($cryptos as $crypto)
                        <li><a href="{{ route('advertisement.all', ['sell', $crypto->code, 'all']) }}">{{ $crypto->code }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 text-center">
                <h5 class="footer-title text-white">@lang('Follow Us')</h5>
                <ul class="social-list">
                    @foreach ($socialIconElements as $social)
                        <li class="social-list__item">
                            <a href="{{ @$social->data_values->url }}" target="_blank">
                                @php echo @$social->data_values->social_icon @endphp
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="bottom-footer py-3 mt-4 text-center">
            <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}" class="text--base">{{ __(gs('site_name')) }}</a> @lang('All Rights Reserved')</p>
        </div>
    </div>
</footer>

@push('style')
<style>
    .footer-area {
        background: #000;
        color: #fff;
        padding: 30px 0;
        font-size: 14px;
    }
    .footer-logo {
        max-width: 200px; /* Increased size for logo */
    }
    .footer-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #fff; /* Ensure footer title text is white */
    }
    .footer-menu {
        list-style: none;
        padding: 0;
    }
    .footer-menu li {
        margin-bottom: 10px;
    }
    .footer-menu a {
        color: #fff; /* Ensure all text is white */
        text-decoration: none;
        transition: color 0.3s;
    }
    .footer-menu a:hover {
        color: #aaa;
    }
    .social-list {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 20px; /* Increased gap for more prominence */
    }
    .social-list__item a {
        color: #fff;
        font-size: 28px; /* Increased size for social icons */
        transition: color 0.3s;
    }
    .social-list__item a:hover {
        color: #aaa;
    }
    .bottom-footer {
        border-top: 1px solid #444;
        margin-top: 20px;
        padding-top: 10px;
    }
    .text--base {
        color: #fff; /* Ensure all text is white */
        text-decoration: none;
        font-weight: 600;
    }
    .text--base:hover {
        color: #0000;
    }
</style>
@endpush
