@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
<h1 class="m-0 text-dark">User Management Creative Ministry</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="" class="btn btn-primary mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </a>
                <table class="table table-hover table-bordered table-stripped" id="tabel-user" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Edit User Information</h5>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="update-nama-pengguna" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="update-nama-pengguna" required>
                </div>

                <div class="mb-3">
                    <label for="update-username-pengguna" class="form-label">Username</label>
                    <input type="text" class="form-control" id="update-username-pengguna" required>
                </div>


                <div class="mb-3">
                    <label for="update-role" class="form-label">Roles</label>
                    <select class="selectpicker form-control" id="update-role"></select>
                </div>

                <div class="mb-3">
                    <label for="update-email-pengguna" class="form-label">Email</label>
                    <input type="email" class="form-control" id="update-email-pengguna" maxlength="255">
                </div>

                <div class="mb-3">
                    <label for="update-password-pengguna" class="form-label">Password</label>
                    <input type="password" class="form-control" id="update-password-pengguna" maxlength="255">
                </div>

                <div class="mb-3">
                    <label for="confirmation-pengguna" class="form-label">Confirmation Password</label>
                    <input type="password" class="form-control" id="confirmation-password" maxlength="255">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="close-update" class="btn btn-secondary">Tutup</button>
                <button type="button" id="save-update" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script src="{{ url('/js/usermanagement/users.js?time=') . rand() }}"></script>
@endpush