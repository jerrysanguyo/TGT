@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Vote table</span>
                <div class="ms-auto"> 
                    <!-- button here -->
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow border mt-3">
                <div class="card-body">
                    <table class="table table-striped" id="vote-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Contestant</th>
                                <th>Rated by</th>
                                <th>Vote</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listOfVotes as $vote)
                                <tr>
                                    <td>{{ $vote->id }}</td>
                                    <td>{{ $vote->contestant->name }}</td>
                                    <td>{{ $vote->user->name }}</td>
                                    <td>{{ $vote->result }}</td>
                                    <td>{{ $vote->created_at }}</td>
                                    <td>{{ $vote->updated_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            
                                            <ul class="dropdown-menu">
                                                @if(Auth::user()->role === 'superadmin')
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('superadmin.vote.show', ['vote' => $vote->id]) }}">
                                                            View details
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#vote-table').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });
    </script>
@endpush
@endsection