@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Pengguna Fix Table OMI</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('users.create')}}" class="btn btn-primary mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </a>
                <table class="table table-hover table-bordered table-stripped" id="tabel-user">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $key => $user)
                        @if($user->deleted_at)
                        <tr style="color:red">
                            @else
                        <tr style="color:green">
                            @endif
                            <td style="color:black">{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>
                                <a href="{{route('users.edit', $user)}}" class="btn btn-primary btn-sm">Ubah</a>
                                @if($user->deleted_at)
                                <a href="{{route('delete-user', $user)}}" onclick="notificationBeforeEnable(event, this)" class="btn btn-success btn-sm"> Aktifkan</a>
                                @else
                                <a href="{{route('users.destroy', $user)}}" onclick="notificationBeforeDisable(event, this)" class="btn btn-danger btn-sm"> Non-Aktifkan</a>
                                @endif
                            </td>
                            @endforeach
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
@endpush