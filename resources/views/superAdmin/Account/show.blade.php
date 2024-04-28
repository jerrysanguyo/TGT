@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-4">Account / Account details</span>
                <div class="ms-auto"> 
                    <a href="{{ route('superadmin.account.index') }}" class="btn btn-primary">
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
                    <form action="{{route('superadmin.account.update', ['user' => $user->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="col-lg-12 col-md-12">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="Role" class="form-label">Role:</label>
                            <select name="role" id="Role" class="form-select">
                                <option value="{{$user->role}}">{{$user->role}}</option>
                                <option value="user">user</option>
                                <option value="admin">admin</option>
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
                    <form action="{{route('superadmin.account.destroy', ['user' => $user->id])}}" method="POST">
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