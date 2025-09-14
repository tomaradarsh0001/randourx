@extends('member.layouts.appadmin')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <div class="page-inner">
           <h2>Edit User</h2>

    <form action="{{ route('users.update', $editUser->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control"
               value="{{ old('username', $editUser->username) }}">
    </div>

    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control"
               value="{{ old('full_name', $editUser->full_name) }}">
    </div>

    <div class="mb-3">
        <label>Mobile</label>
        <input type="text" name="mobile" class="form-control"
               value="{{ old('mobile', $editUser->mobile) }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $editUser->email) }}">
    </div>

    <div class="mb-3">
        <label>Wallet 1 Balance</label>
        <input type="number" name="wallet1" class="form-control"
               value="{{ old('wallet1', $editUser->wallet1) }}">
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="is_admin" class="form-check-input"
               {{ old('is_admin', $editUser->is_admin) ? 'checked' : '' }}>
        <label class="form-check-label">Admin</label>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

</div>
</div>
@endsection
