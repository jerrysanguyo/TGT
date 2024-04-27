@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <figure>
                    <blockquote class="blockquote">
                        <p  class="fs-3">{{ $contestant->name }}</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        {{ $contestant->talent }}
                    </figcaption>
                </figure>
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
            <div class="d-flex justify-content-center">
                <img src="https://blog.hubspot.com/hs-fs/hubfs/small-business-website_15.webp?width=595&height=400&name=small-business-website_15.webp" 
                    alt="" class="img-fluid contestant-img shadow border-0 rounded">
            </div>
            <div class="row mt-3">
                <span class="fs-3">Votes:</span>
                <div id="voteCards" class="row d-flex justify-content-evenly"> 

                </div>
            </div>
        </div>
    </div>
</div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function fetchVotes() {
        var url;
        
        if ("{{ Auth::user()->role }}" === 'admin') {
            url = "{{ route('admin.vote.get', $contestant->id) }}";
        } else if ("{{ Auth::user()->role }}" === 'superadmin') {
            url = "{{ route('superadmin.vote.get', $contestant->id) }}";
        } else {
            url = "{{ route('user.vote.get', $contestant->id) }}";
        }

        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                var cardsHtml = '';
                if (Array.isArray(data)) {
                    data.forEach(function(vote) {
                        cardsHtml += '<div class="col-lg-3"><div class="card border-0 shadow"><div class="card-body"><div class="d-flex justify-content-center"><div class="text-center">';
                        if (vote.result === 'Yes') {
                            cardsHtml += '<img src="{{ asset('image/yes.png') }}" alt="Yes" class="img-fluid" style="width:60%;">' + '<br>';
                            // cardsHtml += '<audio src="{{ asset('audio/yes.mp3') }}" autoplay></audio>';
                        } else {
                            cardsHtml += '<img src="{{ asset('image/No.png') }}" alt="Yes" class="img-fluid" style="width:60%;">' + '<br>';
                            // cardsHtml += '<audio src="{{ asset('audio/wrong.mp3') }}" autoplay></audio>';
                        }
                        cardsHtml += '<div class="mt-3"></div><span class="fs-4">' +(vote.user ? vote.user.name : 'Unknown User') + '</span></div><br>';
                        cardsHtml += '</div></div></div></div></div>';
                    });
                } else {
                    console.error('Data is not an array:', data);
                    cardsHtml = '<div class="col-12"><p>No votes data available or data format is incorrect.</p></div>';
                }
                $('#voteCards').html(cardsHtml);
            },
            error: function(xhr, status, err) {
                console.error('Error fetching votes:', xhr, status, err);
            }
        });
    }

    fetchVotes();
    setInterval(fetchVotes, 3000);
</script>
@endsection