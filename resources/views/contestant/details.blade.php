@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-4">Participants / Details</span>
                <div class="ms-auto"> 
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        Back
                    </a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-center">
                <img src="https://blog.hubspot.com/hs-fs/hubfs/small-business-website_15.webp?width=595&height=400&name=small-business-website_15.webp" 
                    alt="" class="img-fluid contestant-img shadow border-0">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow border mt-2">
                        <div class="card-body">
                            <div class="row">
                                <span class="fs-4">Participant details:</span>
                                <div class="row">
                                    <label for="name" class="col-sm-4 col-form-label">Contestant name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $contestant->name  }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="talent" class="col-sm-4 col-form-label">Talent:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="talent" value="{{ $contestant->talent  }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow border mt-2">
                        <div class="card-body">
                            <div class="row">
                                <span class="fs-4">Vote:</span>
                                <div class="row">
                                    <label for="jd1" class="col-sm-4 col-form-label">Judge one:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="jd1" value="{{ $contestant->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="jd2" class="col-sm-4 col-form-label">Judge two:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="jd2" value="{{ $contestant->talent }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="jd3" class="col-sm-4 col-form-label">Judge Three:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="jd3" value="{{ $contestant->talent }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="jd4" class="col-sm-4 col-form-label">Judge Four:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="jd4" value="{{ $contestant->talent }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection