@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ $userName }}</div>

                <div class="card-body">
                    <p>Welcome to the Web Notification Service, {{ $userName }}!</p>
                    @if(auth()->check())
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-danger">  {{ __('Logout') }}</a>
                    @else
                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
