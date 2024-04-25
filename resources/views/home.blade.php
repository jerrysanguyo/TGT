@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border">
                <div class="card-body">
                    <div class="col-lg-12">
                        <span class="fs-4">List of participants</span>
                    </div>
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped" id="participant-table">
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
        $('#participant-table').DataTable({
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
