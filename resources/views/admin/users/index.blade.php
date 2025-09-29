@extends('member.layouts.appadmin')

@section('title', 'Users')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users me-2"></i>Users Management
                            @if(session('impersonating'))
                                <span class="badge bg-warning ms-2">
                                    <i class="fas fa-user-secret me-1"></i>Impersonating
                                </span>
                            @endif
                        </h4>
                        <div>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Add New User
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('info'))
                        @php
                            $infoMsg = session('info');
                            preg_match('/https?:\/\/[^\s]+/', $infoMsg, $matches);
                            $foundLink = $matches[0] ?? null;
                        @endphp

                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $infoMsg }}

                            @if($foundLink)
                                <button type="button" class="btn btn-sm btn-light ms-2 copy-btn" data-link="{{ $foundLink }}">
                                    📋 Copy Link
                                </button>
                            @endif

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Copy Script -->
                    <script>
                        document.addEventListener('click', function(e) {
                            if(e.target.classList.contains('copy-btn')) {
                                let link = e.target.getAttribute('data-link');
                                navigator.clipboard.writeText(link).then(() => {
                                    e.target.innerText = "✅ Copied!";
                                    setTimeout(() => {
                                        e.target.innerText = "📋 Copy Link";
                                    }, 2000);
                                });
                            }
                        });
                    </script>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Sponsor</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Wallet</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    <tr>
                                        <td><strong>#{{ $u->id }}</strong></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold">
                                                    {{ substr($u->username, 0, 2) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $u->username }}</strong>
                                                    @if($u->id == auth()->id())
                                                        <span class="badge bg-info ms-1">You</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $u->full_name }}</td>
                                        <td>{{ $u->sponsor_username }}     
                                            @php
                                                $sponsorEmail = \App\Models\User::where('username', $u->sponsor_username)->value('email');
                                            @endphp
                                            <br><small class="text-muted">{{ $sponsorEmail ?? 'N/A' }}</small>
                                        </td>
                                        <td>{{ $u->mobile }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>
                                            <span class="badge bg-success fs-6">${{ number_format($u->wallet1, 2) }}</span>
                                        </td>
                                        <td>
                                            @if($u->is_admin)
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <!-- Generate Impersonation Link -->
                                                <form action="{{ route('admin.users.impersonation-link', $u->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm rounded-pill" title="Generate login link for this user and open in incognito Tab">
                                                        <i class="fas fa-link me-1"></i>Get Login Link
                                                    </button>
                                                </form>

                                                <!-- Login as User -->
                                                @if($u->id != auth()->id())
                                                    <form action="{{ route('admin.users.login-as', $u->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm rounded-pill" title="Login as this user">
                                                            <i class="fas fa-sign-in-alt me-1"></i> Login
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Edit User -->
                                                <a href="{{ route('admin.users.edit', $u->id) }}" 
                                                   class="btn btn-warning btn-sm rounded-pill" 
                                                   title="Edit User">
                                                    <i class="fas fa-user-edit me-1"></i> Edit
                                                </a>

                                                <!-- Delete User -->
                                                <form action="{{ route('admin.users.destroy', $u->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete {{ $u->username }}? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill" title="Delete User">
                                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-3x mb-3"></i>
                                                <h5>No Users Found</h5>
                                                <p>Get started by creating your first user.</p>
                                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-1"></i> Create User
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing <strong>{{ $users->firstItem() }}</strong> to 
                                <strong>{{ $users->lastItem() }}</strong> of 
                                <strong>{{ $users->total() }}</strong> users
                            </div>
                            <div class="custom-pagination">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .btn-group .btn {
        border-radius: 4px;
        margin: 0 2px;
    }
    
    .badge {
        font-size: 0.75em;
    }
    
    /* Style for login button */
    .btn-success.btn-sm {
        background-color: #28a745;
        border-color: #28a745;
    }
    
    .btn-success.btn-sm:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Custom Pagination Styles */
    .custom-pagination .pagination {
        margin: 0;
    }

    .custom-pagination .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        border: 1px solid #dee2e6;
        color: #6c757d;
        background-color: #fff;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .custom-pagination .page-link:hover {
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .custom-pagination .pagination-lg .page-link {
        padding: 0.75rem 1.5rem;
        font-size: 1.25rem;
    }

    .custom-pagination .pagination-sm .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Responsive pagination */
    @media (max-width: 768px) {
        .custom-pagination .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .custom-pagination .page-item {
            margin: 2px;
        }
        
        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.justify-content-between.align-items-center > div {
            text-align: center;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Confirm before logging in as user
    document.addEventListener('DOMContentLoaded', function() {
        const loginForms = document.querySelectorAll('form[action*="login-as"]');
        
        loginForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to login as this user? You will be redirected to their dashboard.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection