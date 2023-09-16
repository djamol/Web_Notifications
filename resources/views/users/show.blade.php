@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone Number:</strong> {{ $user->phone_number ?? 'N/A' }}</p>
                    <p><strong>Unread Notifications:</strong> {{ $user->unreadNotificationsCount($user->id) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
