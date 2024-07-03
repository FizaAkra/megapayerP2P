@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label >@lang('Server Key') </label>
                            <input type="text" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" placeholder="@lang('Firebase Server Key')" name="push_notification_config" value="{{ @$general->push_notification_config }}"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn w-100 h-45 btn--primary">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
