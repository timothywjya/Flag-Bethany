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
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>

<script>
    $('#tabel-user').DataTable({
        "responsive": true,
    });

    function notificationBeforeDisable(event, el) {
        event.preventDefault();
        if (confirm('Are you sure you will disable the account? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }

    function notificationBeforeEnable(event, el) {
        event.preventDefault();
        if (confirm('Are you sure you will activate the account? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>

<script src="{{ url('/js/usermanagement/users.js?time=') . rand() }}"></script>
@endpush