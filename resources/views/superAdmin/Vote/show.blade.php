@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-4">Vote / Vote details</span>
                <div class="ms-auto"> 
                    <a href="{{ route('superadmin.vote.index') }}" class="btn btn-primary">
                        Back
                    </a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow border mt-2">
                <div class="card-body">
                    <form action="{{route('superadmin.vote.update', ['vote' => $vote->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="col-lg-12 col-md-12">
                            <label for="contestant_id" class="form-label">contestant_id:</label>
                            <input type="text" name="contestant_id" id="contestant_id" class="form-control" value="{{ $vote->contestant->name }}" readonly>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="rated_by" class="form-label">Voted by:</label>
                            <input type="text" name="rated_by" id="rated_by" class="form-control" value="{{ $vote->user->name }}" readonly>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="result" class="form-label">Vote:</label>
                            <select name="result" id="result" class="form-select">
                                <option value="{{ $vote->result }}">{{ $vote->result }}</option>
                                @if($vote->result === 'Yes')
                                    <option value="No">No</option>
                                    @else
                                    <option value="Yes">Yes</option>
                                @endif
                            </select>
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
                    <form action="{{route('superadmin.vote.destroy', ['vote' => $vote->id])}}" method="POST">
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