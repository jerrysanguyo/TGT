@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-4">List of participants</span>
                <div class="ms-auto">
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Contestant
                    </button>
                    @endif
                    @include('contestant.create')
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow border mt-2">
                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped" id="participants-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Talent</th>
                                    <th>Number of Yes</th>
                                    <th>Number of No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listOfContestant as $contestant)
                                <tr>
                                    <td>{{ $contestant->name }}</td>
                                    <td>{{ $contestant->talent }}</td>
                                    <td>{{ $contestant->yes_votes }}</td>
                                    <td>{{ $contestant->no_votes }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            
                                            <ul class="dropdown-menu">
                                                @if(Auth::user()->role === 'admin')
                                                    <li>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('admin.contestant.edit', ['contestant' => $contestant->id]) }}">
                                                            Update
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('admin.contestant.show', ['contestant' => $contestant->id]) }}">
                                                            View details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.vote', ['contestant' => $contestant->id]) }}">
                                                            Vote
                                                        </a>
                                                    </li>
                                                    @elseif(Auth::user()->role === 'superadmin')
                                                    <li>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('superadmin.contestant.edit', ['contestant' => $contestant->id]) }}">
                                                            Update
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('superadmin.contestant.show', ['contestant' => $contestant->id]) }}">
                                                            View details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('superadmin.vote', ['contestant' => $contestant->id]) }}">
                                                            Vote
                                                        </a>
                                                    </li>
                                                    @else
                                                    <li>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('user.contestant.show', ['contestant' => $contestant->id]) }}">
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
</div>
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#participants-table').DataTable({
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
