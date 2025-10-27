@extends('member.layouts.appadmin')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <div class="page-inner row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Edit User: {{ $users->username }}
                        </h4>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to Users
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Debug Info -->
                    <div class="alert alert-info mb-4">
                        <strong><i class="fas fa-info-circle me-2"></i>Editing User:</strong><br>
                        User ID: <strong>{{ $users->id }}</strong> | 
                        Username: <strong>{{ $users->username }}</strong> | 
                        Your ID: <strong>{{ auth()->id() }}</strong>
                    </div>

                    <!-- Flash Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> Please fix the following errors:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $users->id) }}" id="userForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username', $users->username) }}" 
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
                                       value="{{ old('full_name', $users->full_name) }}" 
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
                                       value="{{ old('email', $users->email) }}" 
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
                                       value="{{ old('mobile', $users->mobile) }}" 
                                       required>
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Wallet Balance -->
                            <div class="col-md-6 mb-3">
                                <label for="wallet1" class="form-label required">Wallet Balance ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0" 
                                           class="form-control @error('wallet1') is-invalid @enderror" 
                                           id="wallet1" 
                                           name="wallet1" 
                                           value="{{ old('wallet1', $users->wallet1) }}" 
                                           required>
                                    @error('wallet1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Current balance: ${{ number_format($users->wallet1, 2) }}</small>
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
                                           {{ old('is_admin', $users->is_admin) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_admin">
                                        Grant Admin Privileges
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    @if($users->is_admin)
                                        <i class="fas fa-shield-alt text-success me-1"></i>User currently has admin access
                                    @else
                                        <i class="fas fa-user text-secondary me-1"></i>User does not have admin access
                                    @endif
                                </small>
                            </div>
                        </div>

                        <!-- User Information Card -->
                        <div class="card border-0 bg-light mt-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    <i class="fas fa-user-circle me-2"></i>User Information
                                </h6>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Sponsor</small><br>
                                        <strong>{{ $users->sponsor_username ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Country Code</small><br>
                                        <strong>{{ $users->country_code }}</strong>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Member Since</small><br>
                                        <strong>{{ $users->created_at->format('M d, Y') }}</strong>
                                    </div>
                                     <div class="col-md-3 mb-2">
                                        <small class="text-muted">Password</small><br>
                                        <strong>{{ $users->plain_password }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end border-top pt-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-1"></i> Update User
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('userForm');
        const walletInput = document.getElementById('wallet1');

        // Real-time wallet validation
        walletInput.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (value < 0) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Form submission validation
        form.addEventListener('submit', function(e) {
            if (parseFloat(walletInput.value) < 0) {
                e.preventDefault();
                alert('Wallet balance cannot be negative.');
                walletInput.focus();
                return false;
            }
        });
    });
</script>
@endsection