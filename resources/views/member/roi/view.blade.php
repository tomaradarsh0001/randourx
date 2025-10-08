@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner" style="margin-bottom: 6rem !important;">
        <h2 class="mb-4">
            <i class="fas fa-wallet text-primary"></i> 
            ROI Income
            <small class="text-muted d-block d-md-inline">(My Daily Income History)</small>
        </h2>

        <!-- Summary Card for Mobile -->
        <div class="card bg-primary text-white mb-4 d-md-none">
            <div class="card-body py-3">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end border-white-50">
                            <h4 class="fw-bold mb-1">{{ $roiIncomes->count() }}</h4>
                            <small class="opacity-75">Total Records</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <h4 class="fw-bold mb-1">{{ number_format($roiIncomes->sum('roi_bonus'), 2) }}</h4>
                            <small class="opacity-75">Total ROI (USD)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="card shadow-sm rounded-3 d-none d-md-block">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i> Sno.</th>
                                <th><i class="fas fa-money-bill-wave me-1"></i> Pack Value</th>
                                <th><i class="fas fa-chart-line me-1"></i> ROI Bonus</th>
                                <th><i class="fas fa-clock me-1"></i> Timing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roiIncomes as $index => $income)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ ($roiIncomes->currentPage() - 1) * $roiIncomes->perPage() + $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-info text-white fs-6">
                                            <i class="fas fa-dollar-sign me-1"></i>
                                            {{ number_format($income->wallet_value, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-dollar-sign me-1"></i>
                                            {{ number_format($income->roi_bonus, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-muted small me-2"></i>
                                            <span>{{ \Carbon\Carbon::parse($income->timing)->format('d M Y, h:i A') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                                        <p class="h5 text-muted">No ROI Records Found</p>
                                        <p class="text-muted mb-0">Your ROI income history will appear here.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination for Desktop -->
                @if($roiIncomes->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Showing {{ $roiIncomes->firstItem() }} to {{ $roiIncomes->lastItem() }} of {{ $roiIncomes->total() }} entries
                    </div>
                    <div class="custom-pagination">
                        {{ $roiIncomes->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="d-block d-md-none">
            @forelse($roiIncomes as $index => $income)
                <div class="card mb-3 border">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">
                                <i class="fas fa-hashtag me-1"></i>#{{ ($roiIncomes->currentPage() - 1) * $roiIncomes->perPage() + $index + 1 }}
                            </span>
                            <span class="badge bg-success">
                                <i class="fas fa-dollar-sign me-1"></i>{{ number_format($income->roi_bonus, 2) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row g-2">
                            <!-- Pack Value -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        Pack Value:
                                    </span>
                                    <span class="badge bg-info text-white">
                                        <i class="fas fa-dollar-sign me-1"></i>{{ number_format($income->wallet_value, 2) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- ROI Bonus -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-chart-line me-1"></i>
                                        ROI Bonus:
                                    </span>
                                    <span class="fw-bold text-success">
                                        <i class="fas fa-dollar-sign me-1"></i>{{ number_format($income->roi_bonus, 2) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Date -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-calendar me-1"></i>
                                        Date:
                                    </span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($income->timing)->format('d M Y') }}</small>
                                </div>
                            </div>
                            
                            <!-- Time -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>
                                        Time:
                                    </span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($income->timing)->format('h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center border">
                    <div class="card-body py-5">
                        <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                        <h5 class="card-title text-muted">No ROI Records Found</h5>
                        <p class="card-text text-muted mb-0">Your ROI income history will appear here.</p>
                    </div>
                </div>
            @endforelse

            <!-- Pagination for Mobile -->
            @if($roiIncomes->hasPages())
            <div class="card mt-3">
                <div class="card-body py-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="text-muted small mb-2">
                            Showing {{ $roiIncomes->firstItem() }} to {{ $roiIncomes->lastItem() }} of {{ $roiIncomes->total() }} entries
                        </div>
                        <div class="custom-pagination-mobile">
                            {{ $roiIncomes->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    /* Font Awesome icons */
    .fas, .far, .fab {
        vertical-align: middle;
    }
.card {
    margin-bottom: 6rem !important;
}
    /* Custom Pagination Styling */
    .custom-pagination .pagination {
        margin-bottom: 0;
    }
    
    .custom-pagination .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #007bff;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
    }
    
    .custom-pagination .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0056b3;
    }
    
    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border-color: #007bff;
        color: white;
    }
    
    .custom-pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    
    /* Mobile Pagination */
    .custom-pagination-mobile .pagination {
        margin-bottom: 0;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .custom-pagination-mobile .page-link {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 4px;
        margin: 1px;
    }
    
    /* Mobile-specific enhancements */
    @media (max-width: 768px) {
        .card {
            border-radius: 8px;
                margin-bottom: 6rem !important;

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
        
        /* Amount styling */
        .fw-bold.text-success {
            font-size: 1rem;
        }
        
        /* Icon sizing for mobile */
        .fas, .far, .fab {
            font-size: 0.875em;
        }
        
        /* Summary card for mobile */
        .bg-primary .border-end {
            padding-right: 1rem;
        }
        
        .bg-primary h4 {
            font-size: 1.25rem;
        }
        
        .bg-primary small {
            font-size: 0.7rem;
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
    
    .badge.bg-info {
        background: linear-gradient(45deg, #0dcaf0, #0aa2c0) !important;
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
    
    // Add subtle animation to ROI amounts
    docu mb-5ment.querySelectorAll('.fw-bold.text-success').forEach(amount => {
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