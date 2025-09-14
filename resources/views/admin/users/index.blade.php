@extends('member.layouts.appadmin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3 mx-3">Create User</a>

    <table class="table table-striped table-bordered mx-3" id="users-table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Wallet 1 Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
</div>
</div>

<!-- jQuery, Bootstrap, DataTables -->
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'username', name: 'username' },
            { data: 'full_name', name: 'full_name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'email', name: 'email' },
            { 
                data: 'wallet1', 
                name: 'wallet1',
                render: function(data, type, row) {
                    return '$' + data; // prepend $ sign
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
            { width: '5%', targets: 0 },      // # index
            { width: '12%', targets: 1 },     // Username
            { width: '15%', targets: 2 },     // Full Name
            { width: '12%', targets: 3 },     // Mobile
            { width: '10%', targets: 4 },     // Email
            { width: '10%', targets: 5 },     // Wallet1
            { width: '10%', targets: 6 }      // Action buttons
        ],
        lengthMenu: [10, 25, 50, 80],
        pageLength: 10,
        autoWidth: false,  // Disable auto width to respect our widths
    });
});
</script>

@endsection
