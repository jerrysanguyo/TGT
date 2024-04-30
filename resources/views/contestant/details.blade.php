<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('image/IT-White.webp') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .dt-input{
            margin-right: 3%;
        }

        .btn.btn-primary {
            background-color: #727CF5;
            border-color: #727CF5;
        }

        .contestant-img {
            width:40%;
        }

        body {
            background: url('{{ asset("image/bg2.webp") }}') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center mt-1">
        <div class="col-md-8">
            <div class="d-flex justify-content-between">
                <figure>
                    <blockquote class="blockquote">
                        <p  class="fs-3">{{ $contestant->name }}</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-5">
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

            <div class="row">
                <div class="col-md-3" id="voteCard5">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="text-center">
                                    <img src="{{ asset('image/default.webp') }}" alt="Result" class="img-fluid">
                                    <div class="voter-name fs-4 mt-3">Judge 1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3" id="voteCard6">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="text-center">
                                    <img src="{{ asset('image/default.webp') }}" alt="Result" class="img-fluid">
                                    <div class="voter-name fs-4 mt-3">Judge 2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-3" id="voteCard7">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="text-center">
                                    <img src="{{ asset('image/default.webp') }}" alt="Result" class="img-fluid">
                                    <div class="voter-name fs-4 mt-3">Judge 3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-3" id="voteCard8">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="text-center">
                                    <img src="{{ asset('image/default.webp') }}" alt="Result" class="img-fluid">
                                    <div class="voter-name fs-4 mt-3">Judge 4</div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        console.log("Fetching votes from URL:", url); // Debug URL

        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                console.log("Received data:", data); // Debug data received

                if (Array.isArray(data)) {
                    data.forEach(function(vote) {
                        var cardSelector = '#voteCard' + vote.rated_by; // Use rated_by as ID for card
                        var cardImage = vote.result === 'Yes' ? "{{ asset('image/yes.webp') }}" : "{{ asset('image/no.webp') }}";
                        var userName = vote.user ? vote.user.name : 'Unknown User';

                        $(cardSelector + ' img').attr('src', cardImage);
                        $(cardSelector + ' .voter-name').text(userName);
                    });
                } else {
                    console.error('Data is not an array:', data);
                }
            },
            error: function(xhr, status, err) {
                console.error('Error fetching votes:', xhr, status, err);
            }
        });
    }

    fetchVotes();
    setInterval(fetchVotes, 3000);
</script>
</body>
</html>