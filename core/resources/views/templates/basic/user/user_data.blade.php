@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="card custom--card">
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                                <strong> <i class="la la-info-circle"></i> @lang('You need to complete your profile to get access to your dashboard')</strong>
                            </div>

                            <form method="POST" action="{{ route('user.data.submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('First Name')</label>
                                        <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="firstname" value="{{ old('firstname') }}" required>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Last Name')</label>
                                        <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Address')</label>
                                        <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="address" value="{{ old('address') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('State')</label>
                                        <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="state" value="{{ old('state') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Zip Code')</label>
                                        <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" name="zip" value="{{ old('zip') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('City')</label>
                                        <input type="text" class="form-control form--control" name="city" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100 mt-4">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
