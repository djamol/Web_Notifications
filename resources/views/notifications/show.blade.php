@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" class="btn btn-primary">⇦</a>
            Notification Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $notification->type }} Notification</h5>
            <p class="card-text"><strong>Short Text:</strong> {{ $notification->short_text }}</p>
            <p class="card-text"><strong>Expiration:</strong> {{ $notification->expiration }}</p>
            <p class="card-text"><strong>Destination:</strong> {{ $notification->destination }}</p>

            <!-- You can customize this part as needed to display more notification details -->
        </div>
    </div>
</div>
@endsection
