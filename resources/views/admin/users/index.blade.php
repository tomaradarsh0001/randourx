@extends('member.layouts.appadmin')

@section('title', 'Users Management')

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
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Add User
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
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

                    <!-- Mobile Search & Filters -->
                    <div class="d-lg-none mb-3">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search users..." id="mobileSearch">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped d-none d-lg-table">
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
                                        <td>
                                            {{ $u->sponsor_username }}
                                            @php
                                                $sponsorEmail = \App\Models\User::where('username', $u->sponsor_username)->value('email');
                                            @endphp
                                            <br><small class="text-muted">{{ $sponsorEmail ?? 'N/A' }}</small>
                                        </td>
                                        <td>{{ $u->mobile }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>
                                            <span class="badge bg-success">${{ number_format($u->wallet1, 2) }}</span>
                                        </td>
                                        <td>
                                            @if($u->is_admin)
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <!-- Generate Impersonation Link -->
                                                <form action="{{ route('admin.users.impersonation-link', $u->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm" title="Generate login link">
                                                        <i class="fas fa-link"></i>
                                                    </button>
                                                </form>

                                                <!-- Login as User -->
                                                @if($u->id != auth()->id())
                                                    <form action="{{ route('admin.users.login-as', $u->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm" title="Login as user">
                                                            <i class="fas fa-sign-in-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Edit User -->
                                                <a href="{{ route('admin.users.edit', $u->id) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="Edit User">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>

                                                <!-- Delete User -->
                                                <form action="{{ route('admin.users.destroy', $u->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete {{ $u->username }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                                        <i class="fas fa-trash-alt"></i>
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

                        <!-- Mobile Cards View -->
                        <div class="d-lg-none">
                            @forelse($users as $u)
                                <div class="card mb-3 user-card">
                                    <div class="card-body">
                                        <!-- Header -->
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold">
                                                    {{ substr($u->username, 0, 2) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $u->username }}</h6>
                                                    <small class="text-muted">#{{ $u->id }}</small>
                                                    @if($u->id == auth()->id())
                                                        <span class="badge bg-info ms-1">You</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                @if($u->is_admin)
                                                    <span class="badge bg-danger">Admin</span>
                                                @else
                                                    <span class="badge bg-secondary">User</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- User Info -->
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <small class="text-muted">Full Name</small>
                                                <div class="fw-medium">{{ $u->full_name }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Wallet</small>
                                                <div class="badge bg-success">${{ number_format($u->wallet1, 2) }}</div>
                                            </div>
                                            <div class="col-12">
                                                <small class="text-muted">Email</small>
                                                <div class="fw-medium text-truncate">{{ $u->email }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Mobile</small>
                                                <div class="fw-medium">{{ $u->mobile }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Sponsor</small>
                                                <div class="fw-medium">{{ $u->sponsor_username }}</div>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="d-flex justify-content-between gap-1">
                                            <!-- Generate Impersonation Link -->
                                            <form action="{{ route('admin.users.impersonation-link', $u->id) }}" method="POST" class="d-inline flex-fill">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm w-100" title="Generate login link">
                                                    <i class="fas fa-link me-1"></i> Link
                                                </button>
                                            </form>

                                            <!-- Login as User -->
                                            @if($u->id != auth()->id())
                                                <form action="{{ route('admin.users.login-as', $u->id) }}" method="POST" class="d-inline flex-fill">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm w-100" title="Login as user">
                                                        <i class="fas fa-sign-in-alt me-1"></i> Login
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Edit User -->
                                            <a href="{{ route('admin.users.edit', $u->id) }}" 
                                               class="btn btn-warning btn-sm flex-fill" 
                                               title="Edit User">
                                                <i class="fas fa-user-edit me-1"></i> Edit
                                            </a>

                                            <!-- Delete User -->
                                            <form action="{{ route('admin.users.destroy', $u->id) }}" 
                                                  method="POST" 
                                                  class="d-inline flex-fill"
                                                  onsubmit="return confirm('Are you sure you want to delete {{ $u->username }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100" title="Delete User">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-users fa-3x mb-3"></i>
                                        <h5>No Users Found</h5>
                                        <p>Get started by creating your first user.</p>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Create User
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
                            <div class="text-muted small">
                                Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> to 
                                <strong>{{ $users->lastItem() ?? 0 }}</strong> of 
                                <strong>{{ $users->total() }}</strong> users
                            </div>
                            
                            <div class="mobile-pagination">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0 justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($users->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @php
                                            $current = $users->currentPage();
                                            $last = $users->lastPage();
                                        @endphp

                                        {{-- Show limited pages on mobile --}}
                                        @if($last <= 5)
                                            {{-- Show all pages if total pages is small --}}
                                            @for ($page = 1; $page <= $last; $page++)
                                                <li class="page-item {{ $page == $current ? 'active' : '' }} d-none d-md-block">
                                                    <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor
                                        @else
                                            {{-- Show first page --}}
                                            <li class="page-item {{ 1 == $current ? 'active' : '' }} d-none d-sm-block">
                                                <a class="page-link" href="{{ $users->url(1) }}">1</a>
                                            </li>

                                            {{-- Show dots if current page is far from start --}}
                                            @if($current > 3)
                                                <li class="page-item disabled d-none d-sm-block">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif

                                            {{-- Show pages around current page --}}
                                            @for ($page = max(2, $current - 1); $page <= min($last - 1, $current + 1); $page++)
                                                <li class="page-item {{ $page == $current ? 'active' : '' }} d-none d-sm-block">
                                                    <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor

                                            {{-- Show dots if current page is far from end --}}
                                            @if($current < $last - 2)
                                                <li class="page-item disabled d-none d-sm-block">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif

                                            {{-- Show last page --}}
                                            <li class="page-item {{ $last == $current ? 'active' : '' }} d-none d-sm-block">
                                                <a class="page-link" href="{{ $users->url($last) }}">{{ $last }}</a>
                                            </li>
                                        @endif

                                        {{-- Current Page Indicator for Mobile --}}
                                        <li class="page-item active d-sm-none">
                                            <span class="page-link">{{ $current }}</span>
                                        </li>

                                        {{-- Next Page Link --}}
                                        @if ($users->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>

                            {{-- Mobile page info --}}
                            <div class="d-md-none text-center small text-muted">
                                Page <strong>{{ $current }}</strong> of <strong>{{ $last }}</strong>
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
    
    .badge {
        font-size: 0.75em;
    }
    
    /* Mobile Card Styles */
    .user-card {
        border-left: 4px solid #007bff;
        transition: transform 0.2s ease;
    }
    
    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .user-card .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    /* Pagination Styles */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-link {
        border-radius: 4px;
        margin: 0 2px;
        min-width: 38px;
        text-align: center;
        border: 1px solid #dee2e6;
        color: #007bff;
        font-size: 0.8rem;
    }
    
    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
    }
    
    .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    
    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card-header h4 {
            font-size: 1.1rem;
        }
        
        .btn-group .btn {
            margin: 1px;
            padding: 0.25rem 0.5rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .card-body {
            padding: 1rem;
        }
        
        .user-card .d-flex.justify-content-between.gap-1 {
            flex-wrap: wrap;
        }
        
        .user-card .flex-fill {
            min-width: 45%;
            margin-bottom: 0.25rem;
        }
        
        .pagination {
            font-size: 0.8rem;
        }
        
        .page-link {
            min-width: 36px;
            padding: 0.375rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .pagination-sm .page-link {
            padding: 0.25rem 0.5rem;
        }
        
        .mobile-pagination .pagination {
            flex-wrap: nowrap;
        }
    }
    
    /* Very small devices */
    @media (max-width: 360px) {
        .user-card .flex-fill {
            min-width: 100%;
        }
        
        .card-header .btn-primary {
            font-size: 0.8rem;
            padding: 0.375rem 0.75rem;
        }
        
        .page-link {
            min-width: 32px;
            padding: 0.25rem 0.375rem;
            font-size: 0.7rem;
            margin: 0 1px;
        }
        
        .pagination {
            font-size: 0.8rem;
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

        // Copy link functionality
        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('copy-btn')) {
                let link = e.target.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(() => {
                    const originalText = e.target.innerText;
                    e.target.innerText = "✓ Copied!";
                    setTimeout(() => {
                        e.target.innerText = originalText;
                    }, 2000);
                });
            }
        });

        // Mobile search functionality
        const mobileSearch = document.getElementById('mobileSearch');
        if (mobileSearch) {
            mobileSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const userCards = document.querySelectorAll('.user-card');
                
                userCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    if (cardText.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection