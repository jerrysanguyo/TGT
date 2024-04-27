@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-4">Participants / Edit</span>
                <div class="ms-auto"> 
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                            Back
                        </a>
                        @elseif(Auth::user()->role === 'superadmin')
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-primary">
                                Back
                            </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                                    Back
                                </a>
                    @endif()
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow border mt-2">
                <div class="card-body">
                    @if(Auth::user()->role === 'admin')
                        <form action="{{ route('admin.contestant.update', ['contestant' => $contestant->id]) }}" method="POST">
                        @elseif(Auth::user()->role === 'superadmin')
                            <form action="{{ route('superadmin.contestant.update', ['contestant' => $contestant->id]) }}" method="POST">
                    @endif
                    @csrf
                    @method('PUT')
                        <div class="col-lg-12 col-md-12">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $contestant->name }}">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="talent" class="form-label">Talent:</label>
                            <input type="text" name="talent" id="talent" class="form-control" value="{{ $contestant->talent }}">
                        </div>
                        <div class="mt-3">
                            <input type="submit" value="Submit details" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            @if(Auth::user()->role === 'superadmin')
            <div class="card shadow border mt-2">
                <div class="card-body">
                    <div class="col-lg-12">
                        <span class="fs-3">Delete this Record</span>
                    </div>
                    Deleting a record will be pemanently erase. I highly suggest to consult other before proceeding to deletion.
                    <form action="{{ route('superadmin.contestant.destroy', $contestant->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return confirm('Are you sure you want to delete this Item?');" value="Delete" class="btn btn-danger mt-3">
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>  
@endsection