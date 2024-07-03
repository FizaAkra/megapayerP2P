@php
    $cryptos = App\Models\CryptoCurrency::active()
        ->orderBy('name')
        ->get();
    $pages = App\Models\Page::where('tempname', $activeTemplate)
        ->where('is_default', Status::NO)
        ->get();
@endphp

<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ getImage(getFilePath('logoIcon') .'/logo.png') }}" alt="site-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">@lang('Home')</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="buyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">@lang('Buy')</a>
                        <ul class="dropdown-menu" aria-labelledby="buyDropdown">
                            @foreach ($cryptos as $crypto)
                                <li><a class="dropdown-item" href="{{ route('advertisement.all', ['buy', $crypto->code, 'all']) }}">{{ $crypto->code }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="sellDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">@lang('Sell')</a>
                        <ul class="dropdown-menu" aria-labelledby="sellDropdown">
                            @foreach ($cryptos as $crypto)
                                <li><a class="dropdown-item" href="{{ route('advertisement.all', ['sell', $crypto->code, 'all']) }}">{{ $crypto->code }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- Add more menu items as needed -->
                </ul>
                <div class="d-flex">
                    @if ($general->multi_language)
                        <select class="form-select rounded-2 me-2">
                            @foreach ($language as $item)
                                <option @if (session('lang') == $item->code) selected @endif value="{{ $item->code }}">{{ __($item->name) }}</option>
                            @endforeach
                        </select>
                    @endif
                    <ul class="navbar-nav account-menu">
                        @auth
                            <li class="nav-item"><a class="btn btn--base btn-sm" href="{{ route('user.home') }}">@lang('Dashboard')</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="las la-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="{{ route('user.login') }}">@lang('Login')</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.register') }}">@lang('Registration')</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

