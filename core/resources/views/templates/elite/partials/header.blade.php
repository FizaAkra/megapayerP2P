@php
    $cryptos = App\Models\CryptoCurrency::active()
        ->orderBy('name')
        ->get();
    $pages = App\Models\Page::where('tempname', $activeTemplate)
        ->where('is_default', Status::NO)
        ->get();

    $user = auth()->user();

    if ($general->multi_language) {
        $language  = App\Models\Language::all();
        $localLang = $language->where('code', config('app.locale'))->first();
    }
@endphp


<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img alt=""
                    src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}"></a>
            <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler header-button" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
                type="button">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu  align-items-xl-center">
                    <li class="nav-item dropdown d-block d-xl-none">
                        <div class="header-right d-flex justify-content-end">

                            <!-- Account -->
                            <a class="header-right__button account" href="javascript:void(0)">
                                <i class="las la-user"></i>
                            </a>
                            <!-- @if ($general->multi_language)
                                <div class="language-wrapper">
                                    <div class="header-right__button language">
                                        <img src="{{ getImage(getFilePath('language') . '/' . @$localLang->flag, getFileSize('language')) }}">
                                    </div>
                                    <ul class="language-list">
                                        @foreach ($language as $lang)
                                            <li class="language-list__item">
                                                <a class="language-list__link" href="{{ route('lang', $lang->code) }}">
                                                    <span class="thumb">
                                                        <img src="{{ getImage(getFilePath('language') . '/' . @$lang->flag, getFileSize('language')) }}">
                                                    </span>
                                                    <span class="text">{{ __($lang->name) }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div> -->
                    </li>

                    <li class="nav-item">
                        <a aria-current="page" class="nav-link" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a aria-expanded="false" class="nav-link" data-bs-toggle="dropdown" href="#" role="button">
                            @lang('Buy') <span class="nav-item__icon"><i class="fas fa-caret-down"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($cryptos as $crypto)
                                <li class="dropdown-menu__list">
                                    <a class="dropdown-item dropdown-menu__link" href="{{ route('advertisement.all', ['buy', $crypto->code, 'all']) }}">{{ $crypto->code }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a aria-expanded="false" class="nav-link" data-bs-toggle="dropdown" href="#"
                            role="button">@lang('Sell')<span class="nav-item__icon"><i
                                    class="fas fa-caret-down"></i></span></a>
                        <ul class="dropdown-menu">
                            @foreach ($cryptos as $crypto)
                                <li class="dropdown-menu__list">
                                    <a class="dropdown-item dropdown-menu__link" href="{{ route('advertisement.all', ['sell', $crypto->code, 'all']) }}">{{ $crypto->code }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @if ($user)
                        <li class="nav-item dropdown">
                            <a aria-expanded="false" class="nav-link" data-bs-toggle="dropdown" href="#"
                                role="button">@lang('Trades')<span class="nav-item__icon"><i
                                        class="fas fa-caret-down"></i></span></a>
                            <ul class="dropdown-menu" style="background-color:#D2DDDD; color:#1D5550;">
                                <li class="dropdown-menu__list">
                                    <a class="dropdown-item dropdown-menu__link" href="{{ route('user.trade.request.running') }}" style="color:#1D5550">@lang('Running')</a>
                                </li>
                                <li class="dropdown-menu__list">
                                    <a class="dropdown-item dropdown-menu__link" href="{{ route('user.trade.request.completed') }}"style="color:#1D5550">@lang('Completed')</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                </ul>
            </div>
            <div class="header-right ms-auto flex-between d-none d-xl-flex">
                @if ($user)
                    @php
                        $wallets = \App\Models\Wallet::where('user_id', auth()->id())
                            ->with('crypto:id,name,code')
                            ->get();
                    @endphp
                    <div class="wallet-wrapper">
                        <div class="wallet">
                            <span class="thumb">
                                <img src="{{ getImage('assets/images/wallet.png') }}" ></span>
                            <span class="text">@lang('Wallets')</span>
                        </div>
                        <ul class="wallet-list">
                            <li class="wallet-list__item"><a class="wallet-list__link"
                                    href="{{ route('user.wallets') }}">@lang('All')</a></li>
                            @foreach ($wallets as $wallet)
                                <li class="wallet-list__item">
                                    <a class="wallet-list__link" href="{{ route('user.wallets.single', [$wallet->crypto->id, $wallet->crypto->code]) }}">{{ __($wallet->crypto->name) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Account -->
                <div class="account-wrapper">
    <button class="header-right__button account">
        <i class="las la-user"></i>
    </button>
    <div class="account-popup @if ($user) authenticated @endif">
        @if ($user)
            <div class="account-header" style="background:#90A3A2; padding: 1.5em; border-radius: 8px 8px 0 0; text-align: center;">
                <h5 style="color: white; margin: 0; font-size: 1.5em; text-transform: capitalize;">{{ __($user->fullname) }}</h5>
                <div style="margin-top: 0.5em;">
                    <span class="badge badge--warning"style="background-color:#D2DDDD;  color:#1D5550; border:1px solid #1D5550" >
                        <i class="fas fa-check-circle" ></i> {{ $user->status == Status::ENABLE ? __('Verified') : __('Unverified') }}
                    </span>
                    <span class="badge badge--secondary" style="background-color:#D2DDDD;  color:#1D5550; border:1px solid #1D5550">
                        <i class="fas fa-globe"></i> {{ @$user->address->country }}
                    </span>
                </div>
            </div>
        @endif

        <style>
            .account-popup {
                background: #90A3A2; /* Set background color for pop-up */
            }

            .account-list-container {
                max-height: 300px; /* Set a max height for the container */
                overflow-y: auto; /* Enable vertical scrolling */
                scrollbar-width: none; /* Hide the scrollbar */
                -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
                padding: 1em;
                background:#90A3A2;
            }

            .account-list {
                list-style: none; /* Remove bullet points */
                margin: 0;
                padding: 0;
            }

            .account-list__item {
                margin-bottom: 10px; /* Add some space between list items */
            }

            .account-list__link {
                color: white;
                text-decoration: none;
                transition: all 0.3s ease; /* Smooth transition for hover effect */
                display: block; /* Make the link fill its parent list item */
                padding: 10px 15px; /* Add some padding for better clickability */
                border-radius: 8px; /* Add some rounded corners */
                background-color: #90A3A2; /* Set background color */
                font-weight: 500; /* Increase font weight */
                border:1px solid #1D5550;
            }

            .account-list__link:hover {
                background-color: #1D5550;
                color: white !important; /* Ensure text color remains white on hover */
            }

            .logout-btn {
                background-color: #1D5550;
                color: white;
                text-align: center;
                padding: 10px;
                margin: 10px 0;
                border-radius: 8px;
                display: block;
                text-decoration: none;
                transition: background-color 0.3s ease;
                position: relative;
            }

            .logout-btn:hover {
                background-color: #1D5550;
                color: white;
            }

            /* Adjusting background behind logout button */
            .account-popup::before {
                content: '';
                position: absolute;
                top: -10px;
                left: 50%;
                width: 20px;
                height: 20px;
                background: #90A3A2;
                transform: translateX(-50%) rotate(45deg);
                z-index: -1;
            }
        </style>

        <div class="account-list-container">
            <ul class="account-list">
                @if ($user)
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.profile.setting') }}">@lang('Account Setting')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.twofactor') }}">@lang('2FA Security')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.change.password') }}">@lang('Change Password')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.advertisement.index') }}">@lang('Advertisements')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.transaction.index') }}">@lang('Transactions')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.withdraw.history') }}">@lang('Withdrawals')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.deposit.history') }}">@lang('Deposits')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('ticket.index') }}">@lang('Support Tickets')</a>
                    </li>
                @else
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.login') }}">@lang('Login')</a>
                    </li>
                    <li class="account-list__item">
                        <a class="account-list__link" href="{{ route('user.register') }}">@lang('Register')</a>
                    </li>
                @endif
            </ul>
        </div>

        @if ($user)
            <a class="logout-btn" href="{{ route('user.logout') }}">@lang('Logout')</a>
        @endif
    </div>
</div>

@if ($general->multi_language)
    <!-- <div class="language-wrapper">
        <div class="header-right__button language">
            <img src="{{ getImage(getFilePath('language') . '/' . @$localLang->flag, getFileSize('language')) }}">
        </div>
        <ul class="language-list">
            @foreach ($language as $lang)
                <li class="language-list__item">
                    <a class="language-list__link" href="{{ route('lang', $lang->code) }}">
                        <span class="thumb">
                            <img src="{{ getImage(getFilePath('language') . '/' . @$lang->flag, getFileSize('language')) }}">
                        </span>
                        <span class="text">{{ __($lang->name) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div> -->
@endif

        </nav>
    </div>
</header>
