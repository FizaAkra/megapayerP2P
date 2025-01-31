@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header d-flex gap-2 justify-content-between align-items-center">
                    <span>
                        @lang('Deposit Commission')
                        @if ($general->deposit_commission == 0)
                            <span class="badge badge--danger">@lang('Disabled')</span>
                        @else
                            <span class="badge badge--success">@lang('Enabled')</span>
                        @endif
                    </span>

                    @if ($general->deposit_commission == 0)
                        <a href="{{ route('admin.referral.status.update', 'deposit_commission') }}" class="btn btn-outline--success">@lang('Enable Now')</a>
                    @else
                        <a href="{{ route('admin.referral.status.update', 'deposit_commission') }}" class="btn btn-outline--danger">@lang('Disable Now')</a>
                    @endif

                </h5>

                <div class="card-body parent">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Level')</th>
                                    <th>@lang('Commission')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($levels->where('commission_type', 'deposit') as $item)
                                    <tr>
                                        <td>@lang('LEVEL')# {{ $item->level }}</td>
                                        <td>{{ $item->percent }} %</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                        <div class="flex-fill">
                            <input type="number" name="level" placeholder="@lang('How many level')" class="form-control levelGenerate">
                        </div>
                        <button type="button" class="btn btn--primary generate flex-fill">
                            @lang('GENERATE')
                        </button>
                    </div>

                    <form action="{{ route('admin.referral.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commission_type" value="deposit">
                        <div class="d-none levelForm">
                            <div class="form-group">
                                <label class="text--success"> @lang('Level & Commission :')
                                    <small>@lang('(Old Levels will Remove After Generate)')</small>
                                </label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="description referral-desc">
                                            <div class="row">
                                                <div class="col-md-12 planDescriptionContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header d-flex gap-2 justify-content-between align-items-center">
                    <span>
                        @lang('Trade Commission')
                        @if ($general->trade_commission == 0)
                            <span class="badge badge--danger">@lang('Disabled')</span>
                        @else
                            <span class="badge badge--success">@lang('Enabled')</span>
                        @endif
                    </span>

                    @if ($general->trade_commission == 0)
                        <a href="{{ route('admin.referral.status.update', 'trade_commission') }}" class="btn btn-outline--success">@lang('Enable Now')</a>
                    @else
                        <a href="{{ route('admin.referral.status.update', 'trade_commission') }}" class="btn btn-outline--danger">@lang('Disable Now')</a>
                    @endif
                </h5>

                <div class="card-body parent">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Level')</th>
                                    <th>@lang('Commission')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($levels->where('commission_type', 'trade') as $item)
                                    <tr>
                                        <td>@lang('LEVEL')# {{ $item->level }}</td>
                                        <td>{{ $item->percent }} %</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table><!-- table end -->
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                        <div class="flex-fill">
                            <input type="number" name="level" placeholder="@lang('How many level')" class="form-control input-lg levelGenerate">
                        </div>
                        <button type="button" class="btn btn--primary generate flex-fill"> @lang('GENERATE') </button>
                    </div>

                    <form action="{{ route('admin.referral.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commission_type" value="trade">
                        <div class="d-none levelForm">
                            <div class="form-group">
                                <label class="text--success"> @lang('Level & Commission :')
                                    <small>@lang('(Old Levels will Remove After Generate)')</small>
                                </label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="description referral-desc">
                                            <div class="row">
                                                <div class="col-md-12 planDescriptionContainer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            "use strict";

            var max = 1;
            $(document).ready(function() {
                $(".generate").on('click', function() {

                    var levelGenerate = $(this).parents('.parent').find('.levelGenerate').val();
                    var a = 0;
                    var val = 1;
                    var viewHtml = '';
                    if (levelGenerate !== '' && levelGenerate > 0) {
                        $(this).parents('.parent').find('.levelForm').removeClass('d-none');
                        $(this).parents('.parent').find('.levelForm').addClass('d-block');

                        for (a; a < parseInt(levelGenerate); a++) {
                            viewHtml += `<div class="input-group mt-4">
                                            <span class="input-group-text form-control">@lang('Level')</span>
                                            <input name="level[]" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" type="number" readonly value="${val++}" required placeholder="Level">
                                            <input name="percent[]" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" type="number" step=".01" required placeholder="@lang('Commission Percentage %')">
                                            <span class="input-group-text btn btn--danger delete_desc"><i class='fa fa-times'></i></span>


                                        </div>`;
                        }
                        $(this).parents('.parent').find('.planDescriptionContainer').html(viewHtml);

                    } else {
                        notify('Error', 'Level field is required');
                    }
                });

                $(document).on('click', '.delete_desc', function() {
                    $(this).closest('.input-group').remove();
                });
            });


        });
    </script>
@endpush
