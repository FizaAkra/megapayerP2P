@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent shadow-none">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Schedule')</th>
                                    <th>@lang('Next Run')</th>
                                    <th>@lang('Last Run')</th>
                                    <th>@lang('Is Running')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($crons as $cron)
                                    @php
                                        $dateTime = now()->parse($cron->next_run);
                                        $formattedDateTime = $dateTime->format('Y-m-d\TH:i');
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ __($cron->name) }} @if ($cron->logs->where('error', '!=', null)->count())
                                                <i class="fas fa-exclamation-triangle text--danger"></i>
                                            @endif <br>
                                            <code>{{ __($cron->alias) }}</code>
                                        </td>
                                        <td>{{ __($cron->schedule->name) }}</td>
                                        <td>
                                            @if ($cron->next_run)
                                                {{ __($cron->next_run) }}
                                                <br> {{ diffForHumans($cron->next_run) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cron->last_run)
                                                {{ __($cron->last_run) }}
                                                <br> {{ diffForHumans($cron->last_run) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cron->is_running)
                                                <span class="badge badge--success">@lang('Running')</span>
                                            @else
                                                <span class="badge badge--dark">@lang('Pause')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cron->is_default)
                                                <span class="badge badge--success">@lang('Default')</span>
                                            @else
                                                <span class="badge badge--primary">@lang('Customizable')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline--primary" data-bs-toggle="dropdown" id="actionButton">
                                                    <i class="las la-ellipsis-v"></i>
                                                    @lang('Action')
                                                </button>
                                                <div class="dropdown-menu p-0">
                                                    <a class="dropdown-item" href="{{ route('cron') }}?alias={{ $cron->alias }}"><i class="las la-check-circle"></i> @lang('Run Now')</a>
                                                    @if ($cron->is_running)
                                                        <a class="dropdown-item" href="{{ route('admin.cron.schedule.pause', $cron->id) }}"><i class="las la-pause"></i> @lang('Pause')</a>
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('admin.cron.schedule.pause', $cron->id) }}"><i class="las la-play"></i> @lang('Play')</a>
                                                    @endif
                                                    <a class="dropdown-item updateCron" data-cron_schedule_id="{{ $cron->cron_schedule_id }}" data-default="{{ $cron->is_default }}" data-id="{{ $cron->id }}" data-name="{{ $cron->name }}" data-next_run="{{ $formattedDateTime }}" data-url="{{ $cron->url }}" href=""><i class="las la-pen"></i> @lang('Edit')</a>
                                                    <a class="dropdown-item" href="{{ route('admin.cron.schedule.logs', $cron->id) }}"><i class="las la-history"></i> @lang('Logs')</a>
                                                    @if (!$cron->is_default)
                                                        <a class="dropdown-item confirmationBtn" data-action="{{ route('admin.cron.delete', $cron->id) }}" data-question="@lang('Are you sure to delete this cron?')" href="javascript:void(0)"><i class="las la-trash"></i> @lang('Delete')</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <x-confirmation-modal />

    <div a aria-hidden="true" class="modal fade" id="addCron" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Add Cron Job')</h4>
                    <button class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                </div>
                <form action="{{ route('admin.cron.store') }}" class="form-horizontal resetForm" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="name" required type="text">
                        </div>
                        <div class="form-group">
                            <label>@lang('Next Run')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="next_run" required type="datetime-local">
                        </div>
                        <div class="form-group">
                            <label>@lang('Schedule')</label>
                            <select class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;"  name="cron_schedule_id" required>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Url')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="url" required type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div a aria-hidden="true" class="modal fade" id="updateCron" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Edit Cron Job')</h4>
                    <button class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                </div>
                <form action="{{ route('admin.cron.update') }}" class="form-horizontal resetForm" method="post">
                    @csrf
                    <input name="id" type="hidden">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="name" required type="text">
                        </div>
                        <div class="form-group">
                            <label>@lang('Next Run')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="next_run" required type="datetime-local">
                        </div>
                        <div class="form-group">
                            <label>@lang('Schedule')</label>
                            <select class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="cron_schedule_id" required>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group urlGroup">
                            <label>@lang('Url')</label>
                            <input class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="url" type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-outline--primary addCron" type="btn"><i class="las la-plus"></i> @lang('Add')</button>
    <a class="btn btn-outline--primary" href="{{ route('admin.cron.schedule') }}"><i class="las la-clock"></i> @lang('Cron Schedule')</a>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.addCron').on('click', function() {
                let modal = $('#addCron');
                $('.resetForm').trigger('reset');
                modal.modal('show');
            });

            $('.updateCron').on('click', function(e) {
                e.preventDefault();
                var modal = $('#updateCron');
                let id = $(this).data('id');
                let name = $(this).data('name');
                let next_run = $(this).data('next_run');
                let cron_schedule_id = $(this).data('cron_schedule_id');
                let isDefault = $(this).data('default');
                if (isDefault) {
                    modal.find('[name=url]').attr('required', false);
                    $('.urlGroup').hide();
                } else {
                    modal.find('[name=url]').parent().find('label').addClass('required');
                    modal.find('[name=url]').attr('required', true);
                    modal.find('[name=url]').val($(this).data('url'));
                    $('.urlGroup').show();
                }
                modal.find('input[name=id]').val(id);
                modal.find('input[name=name]').val(name);
                modal.find('input[name=next_run]').val(next_run);
                modal.find('select[name=cron_schedule_id]').val(cron_schedule_id);
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .table-responsive {
            background: transparent;
            min-height: 350px;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
    </style>
@endpush
