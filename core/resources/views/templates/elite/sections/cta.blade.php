@php
    $content = getContent('cta.content', true);
@endphp

<section class="cta-section pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading cta-content text-center">
                    
                    <p class="section-heading__desc" style="color:#5C6867">{{ __(@$content->data_values->sub_heading) }}</p>
                    <a class="btn btn--base-two sec-btn" style="    background-color: #1D5550;
    border: #1D5550;" href="{{ __(@$content->data_values->button_url) }}">{{ __(@$content->data_values->button_text) }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
