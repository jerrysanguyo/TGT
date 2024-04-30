@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-1">{{ $contestant->name }}</span>
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
            @if(session('Yes'))
                <div class="alert alert-success">
                    {{ session('Yes') }}
                </div>
                <audio src="{{ asset('audio/yes.mp3') }}" autoplay></audio>
            @endif
            @if(session('No'))
                <div class="alert alert-danger">
                    {{ session('No') }}
                </div>
                <audio src="{{ asset('audio/wrong.mp3') }}" autoplay></audio>
            @endif
            <!-- <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/contestant/' . $contestant->file_name) }}" alt="Contestant image" class="img-fluid contestant-img shadow border-0 rounded">
            </div> -->
            <div class="row mt-5">
                @if(!$userHasVoted)
                    <div class="col-lg-6">
                        <!-- Button trigger modal -->
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success shadow border-0" data-bs-toggle="modal" data-bs-target="#YesModal" style="padding:100px;">
                                <i class="fa-solid fa-check fs-1" style="color: #ffffff;"></i>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade border-0" id="YesModal" tabindex="-1" aria-labelledby="YesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Vote for YES {{ $contestant->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('admin.vote.yes', ['contestant' => $contestant->id]) }}" method="post">
                                        @elseif(Auth::user()->role === 'superadmin')
                                        <form action="{{ route('superadmin.vote.yes', ['contestant' => $contestant->id]) }}" method="post">
                                    @endif
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-lg-12 col-md-12">
                                                <span class="fs-5">Are you sure you want to vote YES to {{ $contestant->name }}</span>
                                            </div>
                                            <input type="text" name="contestant_id" value="{{ $contestant->id }}" hidden>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" value="Confirm" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Button trigger modal -->
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger shadow border-0" data-bs-toggle="modal" data-bs-target="#NoModal" style="padding:100px;">
                                <i class="fa-solid fa-xmark fs-1" style="color: #ffffff;"></i>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="NoModal" tabindex="-1" aria-labelledby="NoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Vote for NO {{ $contestant->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.vote.no', ['contestant' => $contestant->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-lg-12 col-md-12">
                                                <span class="fs-5">Are you sure you want to vote NO to {{ $contestant->name }}</span>
                                            </div>
                                            <input type="text" name="contestant_id" value="{{ $contestant->id }}" hidden>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" value="Confirm" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        @foreach ($votes as $vote)
                            <div class="text-center">
                                @if ($vote->result === 'Yes')
                                    <img src="{{ asset('image/yes.png') }}" alt="Yes" class="img-fluid" style="width:40%;">
                                    <div class="mt-3">
                                        <span class="fs-3">You have voted: {{ $vote->result }}</span>
                                    </div>
                                @else
                                    <img src="{{ asset('image/no.png') }}" alt="No" class="img-fluid" style="width:40%;">
                                    <div class="mt-3">
                                        <span class="fs-3">You have voted: {{ $vote->result }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>  
@endsection