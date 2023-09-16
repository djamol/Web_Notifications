@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Notifications</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('notifications.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="marketing">Marketing</option>
                                <option value="invoices">Invoices</option>
                                <option value="system">System</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="short_text">Short Text</label>
                            <input type="text" name="short_text" id="short_text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="expiration">Expiration</label>
                            <input type="date" name="expiration" id="expiration" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <select name="destination" id="destination" class="form-control" required>
                                <option value="all">All Users</option>
                                <option value="user">Specific User</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Notification</button>
                    </form>

                    <hr>

                    <!-- Edit notification form goes here -->
                    @if(isset($editNotification))
                        <form method="POST" action="{{ route('notifications.update', $editNotification->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit_type">Type</label>
                                <select name="edit_type" id="edit_type" class="form-control" required>
                                    <option value="marketing" {{ $editNotification->type === 'marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="invoices" {{ $editNotification->type === 'invoices' ? 'selected' : '' }}>Invoices</option>
                                    <option value="system" {{ $editNotification->type === 'system' ? 'selected' : '' }}>System</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_short_text">Short Text</label>
                                <input type="text" name="edit_short_text" id="edit_short_text" class="form-control" value="{{ $editNotification->short_text }}" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_expiration">Expiration</label>
                                <input type="date" name="edit_expiration" id="edit_expiration" class="form-control" value="{{ $editNotification->expiration }}" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_destination">Destination</label>
                                <select name="edit_destination" id="edit_destination" class="form-control" required>
                                    <option value="all" {{ $editNotification->destination === 'all' ? 'selected' : '' }}>All Users</option>
                                    <option value="user" {{ $editNotification->destination === 'user' ? 'selected' : '' }}>Specific User</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Notification</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
