@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Vote table</span>
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
            
            </div>
        </div>
    </div>
</div>  
@endsection