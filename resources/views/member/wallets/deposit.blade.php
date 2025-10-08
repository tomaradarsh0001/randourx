@extends('member.layouts.app')

@section('title', 'Deposit History')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Deposit History</h2>
            <a href="{{ route('member.transactions.deposit') }}" class="btn btn-primary btn-sm">
                <span class="d-none d-md-inline">New Deposit</span>
                <span class="d-inline d-md-none">Deposit</span>
            </a>
        </div>

        <!-- Desktop Table View -->
        <div class="card shadow-sm rounded-3 d-none d-md-block">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Sno.</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Reference ID</th>
                                <th>Status</th>
                                <th>Deposit Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deposits as $index => $deposit)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-success fs-6">${{ number_format($deposit->amount, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-white">{{ ucfirst($deposit->payment_method) }}</span>
                                    </td>
                                    <td>
                                        @if($deposit->reference_id)
                                            <code class="text-muted small">{{ $deposit->reference_id }}</code>
                                        @else
                                            <span class="badge bg-secondary">Not provided</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($deposit->status == 'approved')
                                            <span class="badge bg-success">
                                               
                                                Approved
                                            </span>
                                        @elseif($deposit->status == 'pending')
                                            <span class="badge bg-warning text-dark">
                                              
                                                Pending
                                            </span>
                                        @elseif($deposit->status == 'rejected')
                                            <span class="badge bg-danger">
                                               
                                                Rejected
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($deposit->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        <small>{{ \Carbon\Carbon::parse($deposit->created_at)->format('d M Y, h:i A') }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="material-icons display-4 text-muted">account_balance_wallet</i>
                                        <p class="mt-2 mb-3">No deposit records found.</p>
                                        <a href="{{ route('member.transactions.deposit') }}" class="btn btn-primary">
                                            Make Your First Deposit
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($deposits->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $deposits->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="d-block d-md-none">
            @forelse($deposits as $index => $deposit)
                <div class="card mb-3 border">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary me-2">#{{ $index + 1 }}</span>
                                <small class="text-muted">
                                    <i class="material-icons me-1" style="font-size: 16px;">event</i>
                                    {{ \Carbon\Carbon::parse($deposit->created_at)->format('d M Y') }}
                                </small>
                            </div>
                            <span class="badge bg-success fs-6">${{ number_format($deposit->amount, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Payment Method:</span>
                                    <span class="badge bg-info">{{ ucfirst($deposit->payment_method) }}</span>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Reference ID:</span>
                                    <div class="text-end">
                                        @if($deposit->reference_id)
                                            <code class="small text-muted">{{ Str::limit($deposit->reference_id, 12) }}</code>
                                        @else
                                            <span class="badge bg-secondary small">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Time:</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($deposit->created_at)->format('h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Status:</small>
                            <div>
                                @if($deposit->status == 'approved')
                                    <span class="badge bg-success">
                                        
                                        Approved
                                    </span>
                                @elseif($deposit->status == 'pending')
                                    <span class="badge bg-warning text-dark">
                                       
                                        Pending
                                    </span>
                                @elseif($deposit->status == 'rejected')
                                    <span class="badge bg-danger">
                                      
                                        Rejected
                                    </span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($deposit->status) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center border">
                    <div class="card-body py-5">
                        <i class="material-icons text-muted mb-3" style="font-size: 3rem;">account_balance_wallet</i>
                        <h5 class="card-title text-muted">No Deposit History</h5>
                        <p class="card-text text-muted mb-3">You haven't made any deposits yet.</p>
                        <a href="{{ route('member.transactions.deposit') }}" class="btn btn-primary">
                            Make Your First Deposit
                        </a>
                    </div>
                </div>
            @endforelse

            <!-- Mobile Pagination -->
            @if($deposits->hasPages())
                <div class="mt-4">
                    {{ $deposits->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .material-icons {
        vertical-align: middle;
    }
    
    /* Mobile-specific enhancements */
    @media (max-width: 768px) {
        .card {
            border-radius: 8px;
        }
        
        .card-header {
            padding: 0.75rem 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .card-footer {
            padding: 0.75rem 1rem;
        }
        
        /* Better badge sizing for mobile */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        
        .badge.fs-6 {
            font-size: 0.875rem !important;
        }
    }
    
    /* Hover effects for better interaction */
    @media (hover: hover) {
        .card:hover {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    }
    
    /* Ensure proper spacing */
    .row.g-2 > [class*="col-"] {
        margin-bottom: 0.25rem;
    }
    
    /* Code styling for reference IDs */
    code {
        background-color: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.8rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Simple click feedback for mobile cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.backgroundColor = '#f8f9fa';
            setTimeout(() => {
                this.style.backgroundColor = '';
            }, 200);
        });
    });
</script>
@endpush