@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Notification List</span>
                        <div class="input-group">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="searchButton">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                        <tbody id="notificationTable">
                            <!-- Filtered notifications will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#searchButton').click(function () {
            search();
        });
        search();
        function search(){
            var searchValue = $('#search').val();
            $.ajax({
                type: 'GET',
                url: '{{ route('get_notification') }}', // Change to your search route
                data: { search: searchValue },
                success: function (data) {
                    // Replace the content of the notification table with the filtered data
                    $('#notificationTable').empty();
                    $.each(data, function (index, notification) {
                        var row = '<tr>';
                        row += '<td>' + notification.type + '</td>';
                        row += '<td>' + notification.short_text + '</td>';
                        row += '<td>' + notification.expiration + '</td>';
                        row += '<td>' + notification.destination + '</td>';
                        row += '<td>';
                        row += '<a href="/notifications/'+notification.id+'" class="btn btn-info">View</a>';
                        row += '</td>';
                        row += '</tr>';

                        $('#notificationTable').append(row);
                    });
                },
                error: function () {
                    alert('Error fetching data.');
                }
            });
        }

        });
</script>

@endsection
