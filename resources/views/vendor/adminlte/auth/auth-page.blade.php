@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
<div class="{{ $auth_type ?? 'login' }}-box">
    <div class="{{ $auth_type ?? 'login' }}-logo">
        <a href="{{ $dashboard_url }}">
            @if (config('adminlte.auth_logo.enabled', false))
            <img src="{{ asset(config('adminlte.auth_logo.img.path')) }}" alt="{{ config('adminlte.auth_logo.img.alt') }}" @if (config('adminlte.auth_logo.img.class', null)) class="{{ config('adminlte.auth_logo.img.class') }}" @endif @if (config('adminlte.auth_logo.img.width', null)) width="{{ config('adminlte.auth_logo.img.width') }}" @endif @if (config('adminlte.auth_logo.img.height', null)) height="{{ config('adminlte.auth_logo.img.height') }}" @endif>
            @else
            <img src="{{ asset(config('adminlte.logo_img')) }}" alt="{{ config('adminlte.logo_img_alt') }}" height="50">
            @endif

            {!! config('adminlte.logo', '<b>Bethany</b>Salatiga') !!}
        </a>
    </div>

    <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">
        @hasSection('auth_header')
        <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
            <p class="card-title float-none text-center">
                Creative Ministry Bethany Salatiga
            </p>
        </div>
        @endif

        <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
            @yield('auth_body')
        </div>

        @hasSection('auth_footer')
        <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
            @yield('auth_footer')
        </div>
        @endif
    </div>
</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@stop