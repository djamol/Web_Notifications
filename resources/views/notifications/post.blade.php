@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post New Notification</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('notifications.store') }}">
                        @csrf

                        <!-- Notification fields -->
                        <div class="form-group">
                            <label  class="form-label" for="type">Type</label>
                            <select  class="form-control" name="type" id="type" required>
                                <option value="marketing">Marketing</option>
                                <option value="invoices">Invoices</option>
                                <option value="system">System</option>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="form-group">
                            <label class="form-label" for="short_text">Short Text</label>
                            <input  class="form-control" type="text" name="short_text" id="short_text" required>
                        </div>

                        <div class="form-group">
                            <label for="expiration">Expiration</label>
                            <input  class="form-control" type="date" name="expiration" id="expiration" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="destination">Destination</label>
                            <select  class="form-control" name="destination" id="destination" required>
                                <option value="all">All Users</option>
                                <option value="user">Specific User</option>
                            </select>
                        </div>
                        <div class="form-group" id="specific-user-dropdown" style="display: none;">
                            <label class="form-label" for="specific_user_id">Select User</label>
                            <select  class="form-control" name="specific_user_id" id="specific_user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Notification</button>
                    </form>
                        <script>
                            document.getElementById('destination').addEventListener('change', function() {
                                var specificUserDropdown = document.getElementById('specific-user-dropdown');
                                if (this.value === 'user') {
                                    specificUserDropdown.style.display = 'block';
                                } else {
                                    specificUserDropdown.style.display = 'none';
                                }
                            });
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
