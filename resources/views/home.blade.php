@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h2 class="m-0 text-dark">Mazmur 149:3</h2>
<p class="m-0 text-dark">Biarlah mereka memuji-muji nama-Nya dengan tari-tarian, biarlah mereka bermazmur kepada-Nya dengan rebana dan kecapi!</p>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Selamat Datang di Content Management System, {{Auth::user()->name}}</p>
            </div>
        </div>
    </div>
</div>
@stop