<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contestant details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(Auth::user()->role === 'admin')
                <form action="{{ route('admin.contestant.store') }}" method="POST" enctype="multipart/form-data">
                    @elseif(Auth::user()->role === 'superadmin')
                    <form action="{{ route('superadmin.contestant.store') }}" method="POST" enctype="multipart/form-data">
            @endif
            @csrf
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="talent" class="form-label">Talent:</label>
                        <input type="text" name="talent" id="talent" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="file_name" class="form-label">Picture:</label>
                        <input type="file" name="file_name" id="file_name" class="form-control"  accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Submit details" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>