@extends('member.layouts.appadmin')

@section('title', 'All Transactions')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h4 class="mb-0">
                                <i class="fas fa-exchange-alt me-2 text-primary"></i>All Transactions
                            </h4>
                            <p class="text-muted mb-0 d-none d-md-block">Manage all user transactions</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.transactions.pending') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-clock me-1"></i>
                                <span class="d-none d-sm-inline">View Pending</span>
                                @if($pendingCount ?? 0 > 0)
                                <span class="badge bg-danger ms-1">{{ $pendingCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-sync me-1"></i>
                                <span class="d-none d-sm-inline">Refresh</span>
                            </a>
                        </div>
                    </div>
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
                                    <th>Payment Method</th>
                                    <th>Reference ID</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startNumber = ($transactions->currentPage() - 1) * $transactions->perPage() + 1;
                                @endphp
                                @forelse($transactions as $transaction)
                                <tr>
                                    <td class="ps-3 fw-semibold">{{ $startNumber++ }}</td>
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
                                    <td>
                                        <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                            <i class="fas fa-{{ $transaction->status == 'approved' ? 'check' : ($transaction->status == 'pending' ? 'clock' : 'times') }} me-1"></i>
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="small">{{ $transaction->created_at->format('M d, Y') }}</div>
                                        <div class="text-muted smaller">{{ $transaction->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="pe-3">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-xl-inline">View</span>
                                            </a>
                                            @if($transaction->status == 'pending')
                                            <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.transactions.reject', $transaction) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-exchange-alt fa-3x mb-3"></i>
                                            <h5>No Transactions Found</h5>
                                            <p>There are no transactions in the system yet.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="d-lg-none">
                        @php
                            $mobileStartNumber = ($transactions->currentPage() - 1) * $transactions->perPage() + 1;
                        @endphp
                        @forelse($transactions as $transaction)
                        <div class="border-bottom p-3 transaction-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold small">
                                        {{ substr($transaction->user->username, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $transaction->user->username }}</div>
                                        <small class="text-muted">#{{ $mobileStartNumber++ }}</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }} mb-1">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                    <div class="fw-bold text-{{ $transaction->type == 'deposit' ? 'success' : 'primary' }}">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2 small">
                                <div class="col-6">
                                    <span class="text-muted">Type</span>
                                    <div>
                                        <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Payment Method</span>
                                    <div class="fw-medium text-capitalize">{{ $transaction->payment_method }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Reference ID</span>
                                    <div class="font-monospace small">{{ $transaction->reference_id ?? 'N/A' }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Date</span>
                                    <div class="small">{{ $transaction->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="text-muted smaller">
                                    <i class="fas fa-clock me-1"></i>{{ $transaction->created_at->format('h:i A') }}
                                </div>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1 d-none d-sm-inline"></i>View
                                    </a>
                                    @if($transaction->status == 'pending')
                                    <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.transactions.reject', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 px-3">
                            <div class="text-muted">
                                <i class="fas fa-exchange-alt fa-3x mb-3"></i>
                                <h5>No Transactions Found</h5>
                                <p>There are no transactions in the system yet.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Laravel Pagination -->
                    @if($transactions->hasPages())
                    <div class="card-footer">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="text-muted small">
                                Showing <strong>{{ $transactions->firstItem() ?? 0 }}</strong> to 
                                <strong>{{ $transactions->lastItem() ?? 0 }}</strong> of 
                                <strong>{{ $transactions->total() }}</strong> transactions
                            </div>
                            <div class="mobile-pagination">
                                <nav aria-label="Transaction pagination">
                                    <ul class="pagination pagination-sm mb-0 justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($transactions->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $transactions->previousPageUrl() }}" aria-label="Previous">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @php
                                            $current = $transactions->currentPage();
                                            $last = $transactions->lastPage();
                                        @endphp

                                        {{-- Show limited pages on mobile --}}
                                        @if($last <= 5)
                                            {{-- Show all pages if total pages is small --}}
                                            @for ($page = 1; $page <= $last; $page++)
                                                <li class="page-item {{ $page == $current ? 'active' : '' }} d-none d-sm-block">
                                                    <a class="page-link" href="{{ $transactions->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor
                                        @else
                                            {{-- Show first page --}}
                                            <li class="page-item {{ 1 == $current ? 'active' : '' }} d-none d-sm-block">
                                                <a class="page-link" href="{{ $transactions->url(1) }}">1</a>
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
                                                    <a class="page-link" href="{{ $transactions->url($page) }}">{{ $page }}</a>
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
                                                <a class="page-link" href="{{ $transactions->url($last) }}">{{ $last }}</a>
                                            </li>
                                        @endif

                                        {{-- Current Page Indicator for Mobile --}}
                                        <li class="page-item active d-sm-none">
                                            <span class="page-link">{{ $current }}</span>
                                        </li>

                                        {{-- Next Page Link --}}
                                        @if ($transactions->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $transactions->nextPageUrl() }}" aria-label="Next">
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
    
    .transaction-card {
        transition: background-color 0.2s ease;
    }
    
    .transaction-card:hover {
        background-color: #f8f9fa;
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
    
    /* Pagination Styles */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-link {
        border-radius: 6px;
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
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .transaction-card {
            padding: 1rem;
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
        
        .transaction-card {
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
        
        .page-link {
            min-width: 36px;
            padding: 0.375rem 0.5rem;
            font-size: 0.75rem;
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
        
        .transaction-card {
            padding: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.35rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .page-link {
            min-width: 32px;
            padding: 0.25rem 0.375rem;
            font-size: 0.7rem;
            margin: 0 1px;
        }
    }
    
    /* Action buttons styling */
    .btn-outline-success, .btn-outline-danger {
        border-width: 1px;
    }
    
    /* Hover effects */
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .transaction-card {
        cursor: pointer;
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
                if (!confirm('Are you sure you want to approve this transaction?')) {
                    e.preventDefault();
                }
            });
        });
        
        rejectForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to reject this transaction?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Add loading states to buttons
        const actionButtons = document.querySelectorAll('.btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href') || this.type === 'submit') {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Processing...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        if (this.disabled) {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }
                    }, 3000);
                }
            });
        });
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
        
        // Enhance transaction cards clickability
        const transactionCards = document.querySelectorAll('.transaction-card');
        transactionCards.forEach(card => {
            const viewLink = card.querySelector('a[href*="transactions"]');
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons or forms
                if (!e.target.closest('button') && !e.target.closest('form') && !e.target.closest('a')) {
                    viewLink.click();
                }
            });
        });
        
        // Pagination loading state
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const cardBody = document.querySelector('.card-body');
                if (cardBody) {
                    cardBody.style.opacity = '0.7';
                    cardBody.style.transition = 'opacity 0.3s ease';
                }
            });
        });
    });
</script>
@endsection