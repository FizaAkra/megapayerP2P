@php
    $content = getContent('trade.content', true);
    $elements = App\Models\Frontend::where('tempname', activeTemplate())->where('data_keys', 'trade.element');
    $buyElements = (clone $elements)->where('data_values->trade_type', 'buy')->get();
    $sellElements = (clone $elements)->where('data_values->trade_type', 'sell')->get();
@endphp



        <div class="tab-content" id="myTabContent">
            <div aria-labelledby="first-tab" class="tab-pane fade show active" id="first" role="tabpanel">
                <div class="row justify-content-center">
                    @foreach ($buyElements as $buyElement)
                        <div class="col-lg-4 col-md-6">
                            
                        </div>
                    @endforeach
                </div>
            </div>
            <div aria-labelledby="second-tab" class="tab-pane fade" id="second" role="tabpanel">
                <div class="row justify-content-center">

                    
                </div>
            </div>
        </div>
    </div>
</div>
