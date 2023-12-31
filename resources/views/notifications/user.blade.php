@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notification List {{ $user_id }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Short Text</th>
                                <th>Expiration</th>
                                <th>Destination</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                            @if (!$notification->isExpired() && $notification->notifiable_id === auth()->id())
                            <tr @if ( !$notification->read_at ) class="table-primary" @endif>
                                <td>{{ $notification->type }}</td>
                                <td>{{ $notification->short_text }}</td>
                                <td>{{ $notification->expiration }}</td>
                                <td>{{ $notification->destination }}</td>
                                <td>
                                    <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
