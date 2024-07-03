@extends($activeTemplate . 'layouts.frontend')
@section('content')

@php
    $bannerContent = getContent('banner.content', true);
@endphp

<section class="hero">
    <div class="container position-relative text-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-left">
                <h2 class="hero__title mb-3 animate__animated animate__fadeInDown" style="color: #1D5550; font-size:2rem;">{{ __(@$bannerContent->data_values->heading) }}</h2>
                <h5 class="hero__subtitle mb-3 animate__animated animate__fadeInDown" style="color: #1D5550; font-size:1rem">{{ __(@$bannerContent->data_values->subheading) }}</h5>
            </div>
   

              
            <div class="col-md-6 text-right">
                <img src="{{ asset('assets/images/frontend/banner/' . @$bannerContent->data_values->image) }}"class="img-fluid" alt="Uploaded Image" style="height:400px; width:500px;">
            </div>
        </div>
    </div>
    <div class="star-field"></div>
    <div class="bubble-field"></div>
</section>

<section class="features py-5 text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card p-4 animate__animated animate__fadeInLeft">
                    <div class="icon mb-3">
                        <i class="las la-shield-alt la-3x" style="color:#1D5550"></i>
                    </div>
                    <h5 class="feature-title" style="color: #1D5550;">Secure</h5>
                    <p class="feature-text"style="color:#5C6867">Your transactions are secure with our advanced encryption technology.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card p-4 animate__animated animate__fadeInUp">
                    <div class="icon mb-3">
                        <i class="las la-users la-3x"style="color:#1D5550"></i>
                    </div>
                    <h5 class="feature-title" style="color: #1D5550;">Community</h5>
                    <p class="feature-text"style="color:#5C6867">Join a growing community of traders and enthusiasts.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card p-4 animate__animated animate__fadeInRight">
                    <div class="icon mb-3">
                        <i class="las la-mobile-alt la-3x"style="color:#1D5550"></i>
                    </div>
                    <h5 class="feature-title" style="color: #1D5550;">Mobile-Friendly</h5>
                    <p class="feature-text" style="color:#5C6867">Trade on the go with our fully responsive platform.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($sections->secs != null)
    @foreach (json_decode($sections->secs) as $sec)
        @include($activeTemplate . 'sections.' . $sec)
    @endforeach
@endif
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .hero {
        position: relative;
        padding: 100px 0;
        background: #D2DDDD; /* Changed to #D2DDDD */
        overflow: hidden;
    }
    .container {
        position: relative;
        z-index: 2;
    }
    .hero__title, .hero__subtitle {
        color: #1D5550; /* Keeping the text color consistent */
    }
    .hero__title {
        font-size: 36px;
        font-weight: 700;
        line-height: 1.2;
    }
    .hero__subtitle {
        font-size: 24px;
        margin-bottom: 30px;
    }
    .features {
        background: #ffffff;
    }
    .feature-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px #1D5550;
        transition: transform 0.3s;
    }
    .feature-card:hover {
        transform: translateY(-10px);
    }
    .feature-card .icon {
        color: #1D5550; /* Changed to #1D5550 */
    }
    .feature-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .feature-text {
        font-size: 16px;
        color: #6c757d;
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
        background-color: #1D5550; /* Changed to #1D5550 */
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
@endpush

@push('script')
<script>
    (function($) {
        "use strict";
        
        function createStarField() {
            const starField = document.querySelector('.hero .star-field');

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
            const bubbleField = document.querySelector('.hero .bubble-field');

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
