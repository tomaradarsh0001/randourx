@extends('member.layouts.app')

@section('title', 'My Investments')

@section('content')
<div class="container">
    <div class="page-inner">
        <h2 class="mb-4">
            <i class="fas fa-wallet text-primary"></i> 
            My Investment History
        </h2>

        <!-- Desktop Table View -->
        <div class="card shadow-sm rounded-3 d-none d-md-block">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i> Sno.</th>
                            <th><i class="fas fa-dollar-sign me-1"></i> Purchase Value</th>
                            <th><i class="fas fa-calendar-alt me-1"></i> Date & Time</th>
                            <th><i class="fas fa-check-circle me-1"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($investments as $index => $investment)
                            <tr>
                                <td class="fw-bold text-muted">#{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-dollar-sign me-1"></i>
                                        {{ number_format($investment->purchase_value, 2) }} USD
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-muted small me-2"></i>
                                        <span>{{ $investment->purchased_at->format('d M Y, h:i A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success py-2 px-3">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Success
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                                    <p class="h5 text-muted">No Investments Found</p>
                                    <p class="text-muted mb-0">Your investment history will appear here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="d-block d-md-none">
            @forelse($investments as $index => $investment)
                <div class="card mb-3 border">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">
                                <i class="fas fa-hashtag me-1"></i>#{{ $index + 1 }}
                            </span>
                            <span class="badge bg-success">
                                <i class="fas fa-dollar-sign me-1"></i>{{ number_format($investment->purchase_value, 2) }} USD
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row g-2">
                            <!-- Date -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-calendar me-1"></i>
                                        Date:
                                    </span>
                                    <small class="text-muted">{{ $investment->purchased_at->format('d M Y') }}</small>
                                </div>
                            </div>
                            
                            <!-- Time -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>
                                        Time:
                                    </span>
                                    <small class="text-muted">{{ $investment->purchased_at->format('h:i A') }}</small>
                                </div>
                            </div>
                            
                            <!-- Status -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Status:
                                    </span>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Success
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center border">
                    <div class="card-body py-5">
                        <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                        <h5 class="card-title text-muted">No Investments Found</h5>
                        <p class="card-text text-muted mb-0">Your investment history will appear here.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
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
        
        /* Better badge sizing for mobile */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        
        /* Icon sizing for mobile */
        .fas, .far, .fab {
            font-size: 0.875em;
        }
    }
    
    /* Desktop table improvements */
    @media (min-width: 768px) {
        .table th {
            border-top: none;
            font-weight: 600;
            background-color: #f8f9fa;
        }
        
        .table-responsive {
            border-radius: 0.5rem;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        .table td {
            padding: 1rem 0.75rem;
        }
    }
    
    /* Ensure proper spacing in mobile cards */
    .row.g-2 > [class*="col-"] {
        margin-bottom: 0.25rem;
    }
    
    /* Status badge improvements */
    .badge.bg-success {
        background: linear-gradient(45deg, #198754, #157347) !important;
    }
    
    .badge.bg-primary {
        background: linear-gradient(45deg, #0d6efd, #0b5ed7) !important;
    }
    
    /* Icon styling */
    .fas, .far, .fab {
        vertical-align: middle;
    }
    
    /* Custom styling for empty state */
    .fa-3x {
        font-size: 3rem;
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
    
    // Add subtle animation to investment amounts
    document.querySelectorAll('.badge.bg-success').forEach(amount => {
        amount.style.transition = 'transform 0.2s ease';
        amount.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        amount.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
@endpush