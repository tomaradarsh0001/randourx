@extends('member.layouts.appadmin')

@section('title', 'Create User')

@section('content')
<div class="container">
    <div class="page-inner row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i>Create New User
                        </h4>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to Users
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm">
                        @csrf

                        <div class="row">
                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username') }}" 
                                       required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label required">Full Name</label>
                                <input type="text" 
                                       class="form-control @error('full_name') is-invalid @enderror" 
                                       id="full_name" 
                                       name="full_name" 
                                       value="{{ old('full_name') }}" 
                                       required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required">Email Address</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label required">Mobile Number</label>
                                <input type="text" 
                                       class="form-control @error('mobile') is-invalid @enderror" 
                                       id="mobile" 
                                       name="mobile" 
                                       value="{{ old('mobile') }}" 
                                       required>
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Wallet Balance -->
                            <div class="col-md-6 mb-3">
                                <label for="wallet1" class="form-label required">Initial Wallet Balance ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0" 
                                           class="form-control @error('wallet1') is-invalid @enderror" 
                                           id="wallet1" 
                                           name="wallet1" 
                                           value="{{ old('wallet1', 0) }}" 
                                           required>
                                    @error('wallet1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Admin Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Administrator Access</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_admin" 
                                           name="is_admin" 
                                           value="1" 
                                           {{ old('is_admin') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_admin">
                                        Make this user an Administrator
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    Administrators have full access to the system
                                </small>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end border-top pt-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-user-plus me-1"></i> Create User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection