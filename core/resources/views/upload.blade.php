@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Upload File</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <div>
            <strong>Uploaded File:</strong>
            <a href="{{ asset(session('file')) }}" target="_blank">{{ session('file') }}</a>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose File</label>
            <input type="file" name="file" id="file" class="form-control" style="background-color:#D2DDDD; border:1px solid #1D5550;" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
