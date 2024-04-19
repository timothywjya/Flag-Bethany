@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
<h1 class="m-0 text-dark">Change Your Password</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="current_password">Password Lama</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <button id="change-password" type="submit" class="btn btn-warning">Change My Password</button>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script src="{{ url('/js/profiles/change-password.js?time=') . rand() }}"></script>
@endpush