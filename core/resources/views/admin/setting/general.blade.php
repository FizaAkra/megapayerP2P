@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <label> @lang('Site Title')</label>
                                    <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="site_name" required type="text" value="{{ $general->site_name }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <label> @lang('Completed Trade Charge')</label>
                                    <div class="input-group">
                                        <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" min="0" name="trade_charge" required step="0.01" type="number" value="{{ getAmount($general->trade_charge) }}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group select2-parent position-relative col-sm-4">
                                <label> @lang('Timezone')</label>
                                <select class="select2-basic" name="timezone">
                                    @foreach ($timezones as $timezone)
                                        <option value="'{{ @$timezone }}'">{{ __($timezone) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-sm-6">
                                <label> @lang('Site Base Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input class="form-control colorPicker" type='text' value="{{ $general->base_color }}">
                                    </span>
                                    <input class="form-control colorCode" name="base_color" type="text" value="{{ $general->base_color }}">
                                </div>
                            </div>
                            <div class="form-group  col-sm-6">
                                <label> @lang('Site Secondary Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input class="form-control colorPicker" type='text' value="{{ $general->secondary_color }}">
                                    </span>
                                    <input class="form-control colorCode" name="secondary_color" type="text" value="{{ $general->secondary_color }}">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/admin/css/spectrum.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.select2-parent')
            });
        })(jQuery);
    </script>
@endpush
