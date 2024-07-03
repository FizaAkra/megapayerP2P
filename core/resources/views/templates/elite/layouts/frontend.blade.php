@extends($activeTemplate . 'layouts.app')
@section('panel')

    @if (Request::routeIs('user.login') || Request::routeIs('user.register'))
        @include($activeTemplate . 'partials.auth_header')
    @else
        @include($activeTemplate . 'partials.header')
    @endif

    @yield('content')

    @if (!Request::routeIs('user.register') && !Request::routeIs('user.login'))
        @include($activeTemplate . 'partials.footer')
    @endif

    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp

    
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);
        })(jQuery);
    </script>
@endpush
