<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contestant details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('superadmin.account.create') }}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="role" class="form-label">Role:</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
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