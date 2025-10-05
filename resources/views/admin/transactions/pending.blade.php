@extends('member.layouts.appadmin')

@section('title', 'Pending Transactions')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h4 class="mb-0">
                                <i class="fas fa-clock me-2 text-warning"></i>Pending Transactions
                            </h4>
                            <p class="text-muted mb-0 d-none d-md-block">Review and process pending transactions</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-list me-1"></i>
                                <span class="d-none d-sm-inline">View All</span>
                            </a>
                            <button class="btn btn-success btn-sm" id="refreshBtn">
                                <i class="fas fa-sync me-1"></i>
                                <span class="d-none d-sm-inline">Refresh</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Stats Bar -->
                    <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center">
                        <i class="fas fa-info-circle me-2 fs-5"></i>
                        <div class="flex-grow-1">
                            <strong>{{ $transactions->total() }}</strong> pending transactions awaiting review
                        </div>
                        @if($transactions->total() > 0)
                        <div class="badge bg-danger fs-6">{{ $transactions->total() }} Pending</div>
                        @endif
                    </div>

                    <!-- Desktop Table -->
                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover mb-0">
                            <thead class="table-warning">
                                <tr>
                                    <th class="ps-3">#</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Reference ID</th>
                                    <th>Date</th>
                                    <th class="pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr class="pending-transaction">
                                    <td class="ps-3 fw-semibold">{{ $loop->iteration }}</td>
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
                                            <i class="fas fa-{{ $transaction->type == 'deposit' ? 'arrow-down' : 'arrow-up' }} me-1"></i>
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-{{ $transaction->type == 'deposit' ? 'success' : 'primary' }}">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td>
                                        <span class="text-capitalize">{{ $transaction->payment_method }}</span>
                                    </td>
                                    <td>
                                        <code class="text-muted small">{{ $transaction->reference_id ?? 'N/A' }}</code>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="small">{{ $transaction->created_at->format('M d, Y') }}</div>
                                        <div class="text-muted smaller">{{ $transaction->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="pe-3">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary" title="Review Details">
                                                <i class="fas fa-eye me-1"></i>
                                                <span class="d-none d-xl-inline">Review</span>
                                            </a>
                                            <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Approve Transaction">
                                                    <i class="fas fa-check me-1"></i>
                                                    <span class="d-none d-xl-inline">Approve</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.transactions.reject', $transaction) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject Transaction">
                                                    <i class="fas fa-times me-1"></i>
                                                    <span class="d-none d-xl-inline">Reject</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                            <h5>All Caught Up!</h5>
                                            <p>No pending transactions to review.</p>
                                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-list me-1"></i>View All Transactions
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="d-lg-none">
                        @forelse($transactions as $transaction)
                        <div class="border-bottom p-3 pending-transaction-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold small">
                                        {{ substr($transaction->user->username, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $transaction->user->username }}</div>
                                        <small class="text-muted">{{ $transaction->user->email }}</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }} mb-1">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                    <div class="fw-bold text-{{ $transaction->type == 'deposit' ? 'success' : 'primary' }} fs-5">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2 small">
                                <div class="col-6">
                                    <span class="text-muted">Payment Method</span>
                                    <div class="fw-medium text-capitalize">{{ $transaction->payment_method }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Reference ID</span>
                                    <div class="font-monospace">{{ $transaction->reference_id ?? 'N/A' }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Date</span>
                                    <div class="small">{{ $transaction->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Time</span>
                                    <div class="small">{{ $transaction->created_at->format('h:i A') }}</div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <div class="d-flex flex-column flex-sm-row gap-2 w-100">
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                        <i class="fas fa-eye me-1"></i>Review
                                    </a>
                                    <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST" class="d-inline flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <i class="fas fa-check me-1"></i>Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.transactions.reject', $transaction) }}" method="POST" class="d-inline flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 px-3">
                            <div class="text-muted">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h5>All Caught Up!</h5>
                                <p class="mb-3">No pending transactions to review.</p>
                                <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-list me-1"></i>View All Transactions
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($transactions->hasPages())
                    <div class="card-footer">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="text-muted small">
                                Showing <strong>{{ $transactions->firstItem() ?? 0 }}</strong> to 
                                <strong>{{ $transactions->lastItem() ?? 0 }}</strong> of 
                                <strong>{{ $transactions->total() }}</strong> pending transactions
                            </div>
                            <div class="mobile-pagination">
                                {{ $transactions->onEachSide(1)->links() }}
                            </div>
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
    .container-fluid {
        padding-left: 12px;
        padding-right: 12px;
    }
    
    .card {
        border-radius: 12px;
        border: 1px solid #e3e6f0;
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        padding: 1.25rem;
    }
    
    .pending-transaction-card {
        transition: background-color 0.2s ease;
        border-left: 4px solid #ffc107;
    }
    
    .pending-transaction-card:hover {
        background-color: #fffbf0;
    }
    
    .pending-transaction {
        border-left: 4px solid #ffc107;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    
    .badge {
        font-size: 0.75em;
        padding: 0.5em 0.75em;
        border-radius: 6px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-sm {
        padding: 0.5rem 0.75rem;
    }
    
    .smaller {
        font-size: 0.75rem;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .pending-transaction-card {
            padding: 1rem;
        }
        
        .alert {
            padding: 0.75rem 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 6px;
            padding-right: 6px;
        }
        
        .card-header {
            padding: 0.75rem;
        }
        
        .pending-transaction-card {
            padding: 0.75rem;
        }
        
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.7rem;
            padding: 0.4em 0.6em;
        }
        
        .avatar-sm {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }
        
        .fs-5 {
            font-size: 1.1rem !important;
        }
        
        .alert {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    @media (max-width: 360px) {
        .container-fluid {
            padding-left: 4px;
            padding-right: 4px;
        }
        
        .card-header {
            padding: 0.5rem;
        }
        
        .pending-transaction-card {
            padding: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.35rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .fs-5 {
            font-size: 1rem !important;
        }
    }
    
    /* Pagination mobile styles */
    .mobile-pagination .pagination {
        margin-bottom: 0;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .mobile-pagination .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 6px;
        margin: 1px;
    }
    
    @media (max-width: 576px) {
        .mobile-pagination .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    }
    
    /* Highlight pending transactions */
    .table-warning {
        background-color: #fffbf0;
    }
    
    /* Button hover effects */
    .btn:hover {
        transform: translateY(-1px);
    }
    
    /* Empty state styling */
    .text-muted i.fa-check-circle {
        opacity: 0.7;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for approve/reject actions
        const approveForms = document.querySelectorAll('form[action*="approve"]');
        const rejectForms = document.querySelectorAll('form[action*="reject"]');
        
        approveForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to approve this transaction? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
        
        rejectForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to reject this transaction? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
        
        // Add loading states to action buttons
        const actionButtons = document.querySelectorAll('.btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href') || this.type === 'submit') {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Processing...';
                    this.disabled = true;
                    
                    // Revert after 3 seconds if still on same page
                    setTimeout(() => {
                        if (this.disabled) {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }
                    }, 3000);
                }
            });
        });
        
        // Refresh button functionality
        const refreshBtn = document.getElementById('refreshBtn');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Refreshing...';
                this.disabled = true;
                
                // Reload the page after a short delay to show loading state
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });
        }
        
        // Auto-refresh every 30 seconds if there are pending transactions
        @if($transactions->total() > 0)
        setInterval(() => {
            if (!document.hidden) {
                window.location.reload();
            }
        }, 30000); // 30 seconds
        @endif
        
        // Add visual feedback for quick actions
        const quickActionButtons = document.querySelectorAll('form button[type="submit"]');
        quickActionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.pending-transaction-card, .pending-transaction');
                if (card) {
                    card.style.opacity = '0.7';
                    card.style.transition = 'opacity 0.3s ease';
                }
            });
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + R to refresh
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                refreshBtn?.click();
            }
        });
    });
</script>
@endsection