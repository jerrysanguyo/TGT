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
            background: url('{{ asset("image/bgwol.png") }}') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
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
                <img src="{{ asset('storage/contestant/' . $contestant->file_name) }}" alt="Contestant image" class="img-fluid contestant-img shadow border-0 rounded">
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
</body>
</html>