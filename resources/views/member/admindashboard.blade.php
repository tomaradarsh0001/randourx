@extends('member.layouts.appadmin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Main Content Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="h3 mb-1">Admin Dashboard</h2>
                <p class="text-muted mb-0 d-none d-md-block">Welcome back! Here's what's happening today.</p>
            </div>
            <div class="text-muted text-nowrap">
                <i class="fas fa-calendar-alt me-2"></i>
                <span class="small">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <div class="flex-grow-1">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card border-start border-primary border-4 h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Users</div>
                                <div class="h4 fw-bold text-gray-800 mb-0">{{ $totalUsers }}</div>
                                <div class="small text-muted mt-1">All registered users</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-users fa-lg text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card border-start border-warning border-4 h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Pending Transactions</div>
                                <div class="h4 fw-bold text-gray-800 mb-0">{{ $pendingCount }}</div>
                                <div class="small text-muted mt-1">Awaiting approval</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-clock fa-lg text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card border-start border-success border-4 h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Approved Transactions</div>
                                <div class="h4 fw-bold text-gray-800 mb-0">{{ $approvedCount }}</div>
                                <div class="small text-muted mt-1">Successfully processed</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-check-circle fa-lg text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card border-start border-danger border-4 h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Rejected Transactions</div>
                                <div class="h4 fw-bold text-gray-800 mb-0">{{ $rejectedCount }}</div>
                                <div class="small text-muted mt-1">Declined transactions</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="bg-danger bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-times-circle fa-lg text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <a href="{{ route('admin.transactions.pending') }}" class="btn btn-warning flex-fill d-flex align-items-center justify-content-center">
                                <i class="fas fa-clock me-2"></i>
                                <span>Review Pending</span>
                                @if($pendingCount > 0)
                                <span class="badge bg-danger ms-2">{{ $pendingCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary flex-fill d-flex align-items-center justify-content-center">
                                <i class="fas fa-list me-2"></i>
                                <span>All Transactions</span>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center">
                                <i class="fas fa-users me-2"></i>
                                <span>Manage Users</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <h5 class="mb-0">
                            <i class="fas fa-exchange-alt me-2 text-info"></i>Recent Transactions
                        </h5>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-primary">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <!-- Desktop Table -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Amount after Deduction</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentTransactions as $transaction)
                                    <tr>
                                        <td class="ps-3 fw-semibold">#{{ $transaction->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold small">
                                                    {{ substr($transaction->user->username, 0, 2) }}
                                                </div>
                                                <div>
                                                    <div class="fw-medium">{{ $transaction->user->username }}</div>
                                                    <small class="text-muted">{{ $transaction->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }}">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">${{ number_format($transaction->amount, 2) }}</td>
                                        <td class="fw-semibold">${{ number_format($transaction->amount * 0.90, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                        <td class="text-nowrap">{{ $transaction->created_at->format('M d, Y') }}</td>
                                        <td class="pe-3">
                                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-exchange-alt fa-2x mb-3"></i>
                                                <p class="mb-0">No recent transactions found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="d-lg-none">
                            @forelse($recentTransactions as $transaction)
                            <div class="border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold small">
                                            {{ substr($transaction->user->username, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $transaction->user->username }}</div>
                                            <small class="text-muted">#{{ $transaction->id }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }} mb-1">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                        <div class="fw-bold text-primary">${{ number_format($transaction->amount, 2) }}</div>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <small class="text-muted">Status</small>
                                        <div>
                                            <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Date</small>
                                        <div class="small">{{ $transaction->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-exchange-alt fa-2x mb-3"></i>
                                    <p class="mb-0">No recent transactions found.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container-fluid {
        padding-left: 12px;
        padding-right: 12px;
    }
    
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    
    .card {
        border-radius: 12px;
        border: 1px solid #e3e6f0;
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        padding: 1rem 1.25rem;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .badge {
        font-size: 0.75em;
        padding: 0.4em 0.6em;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .h3 {
            font-size: 1.5rem;
        }
        
        .h4 {
            font-size: 1.25rem;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 6px;
            padding-right: 6px;
        }
        
        .card-body {
            padding: 0.75rem;
        }
        
        .stat-card .card-body {
            padding: 1rem;
        }
        
        .h3 {
            font-size: 1.375rem;
        }
        
        .h4 {
            font-size: 1.125rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
        }
        
        .avatar-sm {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }
    }
    
    /* Very small screens */
    @media (max-width: 360px) {
        .container-fluid {
            padding-left: 4px;
            padding-right: 4px;
        }
        
        .card-body {
            padding: 0.5rem;
        }
        
        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.7rem;
        }
    }
    
    /* Animation for alerts */
    .alert {
        border: none;
        border-radius: 8px;
    }
    
    /* Quick actions button styling */
    .btn-group-vertical .btn {
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Add loading states to buttons
        const quickActionButtons = document.querySelectorAll('.card .btn');
        quickActionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href')) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 2000);
                }
            });
        });
        
        // Add touch feedback to cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    });
</script>
@endsection