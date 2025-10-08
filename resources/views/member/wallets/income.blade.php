@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner mb-5">
        <h2 class="mb-4">All Income
            <small class="text-muted d-block d-md-inline">(ROI + Level Income History)</small> 
        </h2>

        <!-- Income Type Tabs -->
        <div class="card mb-4">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill" id="incomeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $type == 'roi' ? 'active' : '' }}" 
                           href="{{ request()->fullUrlWithQuery(['type' => 'roi', 'page' => 1]) }}">
                            ROI Income
                            <span class="badge bg-primary ms-2">{{ App\Models\RoiIncome::where('user_id', Auth::id())->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $type == 'level' ? 'active' : '' }}" 
                           href="{{ request()->fullUrlWithQuery(['type' => 'level', 'page' => 1]) }}">
                            Level Income
                            <span class="badge bg-success ms-2">{{ App\Models\LevelIncome::where('to_user_id', Auth::id())->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Summary Cards -->
        

        <!-- Desktop Table View -->
        <div class="card shadow-sm rounded-3 d-none d-md-block">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Pack Value</th>
                                <th>Amount</th>
                                <th>Timing</th>
                                <th>Origin</th>
                                <th>Type</th>
                                @if($type == 'level')
                                <th>Details</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incomes as $index => $income)
                                <tr>
                                    <td class="fw-bold text-muted">
                                        #{{ ($incomes->currentPage() - 1) * $incomes->perPage() + $index + 1 }}
                                    </td>
                                    <td>
                                        @if($income->investment > 0)
                                            <span class="badge bg-info text-white">${{ number_format($income->investment, 2) }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($income->type == 'ROI Income')
                                            <span class="badge bg-success">${{ number_format($income->amount, 2) }}</span>
                                        @elseif($income->type == 'Level Income')
                                            <span class="badge bg-warning text-dark">${{ number_format($income->amount, 2) }}</span>
                                        @else
                                            <span class="badge bg-primary">${{ number_format($income->amount, 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        <small>{{ \Carbon\Carbon::parse($income->timing)->format('d M Y, h:i A') }}</small>
                                    </td>
                                    <td>{{ $income->source }}</td>
                                    <td>
                                        @if($income->type == 'ROI Income')
                                            <span class="badge bg-success">{{ $income->type }}</span>
                                        @elseif($income->type == 'Level Income')
                                            <span class="badge bg-warning text-dark">{{ $income->type }}</span>
                                        @else
                                            <span class="badge bg-primary">{{ $income->type }}</span>
                                        @endif
                                    </td>
                                    @if($type == 'level')
                                    <td class="text-muted small">
                                        {{ $income->details ?? 'N/A' }}
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $type == 'level' ? 7 : 6 }}" class="text-center text-muted py-4">
                                        
                                        <p class="mt-2 mb-0">No {{ $type == 'roi' ? 'ROI' : 'Level' }} income records found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination for Desktop -->
                @if($incomes->hasPages())
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="text-muted small">
                            Showing {{ $incomes->firstItem() }} to {{ $incomes->lastItem() }} of {{ $incomes->total() }} entries
                        </div>
                    </div>
                    <div class="col-md-6">
    <nav aria-label="Income pagination" class="d-flex justify-content-end">
        <ul class="pagination mb-0">
            <!-- Previous Page Link -->
            @if($incomes->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        &lt;
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $incomes->previousPageUrl() }}&type={{ $type }}" rel="prev">
                        &lt;
                    </a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @foreach($incomes->getUrlRange(1, $incomes->lastPage()) as $page => $url)
                @if($page == $incomes->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}&type={{ $type }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if($incomes->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $incomes->nextPageUrl() }}&type={{ $type }}" rel="next">
                        &gt;
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        &gt;
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="d-block d-md-none">
            @forelse($incomes as $index => $income)
                <div class="card mb-3 border">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">
                                #{{ ($incomes->currentPage() - 1) * $incomes->perPage() + $index + 1 }}
                            </span>
                            <div class="text-end">
                                @if($income->type == 'ROI Income')
                                    <span class="badge bg-success">{{ $income->type }}</span>
                                @elseif($income->type == 'Level Income')
                                    <span class="badge bg-warning text-dark">{{ $income->type }}</span>
                                @else
                                    <span class="badge bg-primary">{{ $income->type }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row g-2">
                            <!-- Amount -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Amount:</span>
                                    <span class="fw-bold fs-5 
                                        @if($income->type == 'ROI Income') text-success
                                        @elseif($income->type == 'Level Income') text-warning
                                        @else text-primary @endif">
                                        ${{ number_format($income->amount, 2) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Pack Value -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Pack Value:</span>
                                    <div>
                                        @if($income->investment > 0)
                                            <span class="badge bg-info text-white">${{ number_format($income->investment, 2) }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Source -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Source:</span>
                                    <span class="fw-medium text-end">{{ $income->source }}</span>
                                </div>
                            </div>
                            
                            @if($type == 'level' && isset($income->details))
                            <!-- Details for Level Income -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">From:</span>
                                    <span class="fw-medium text-end small">{{ $income->details }}</span>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Date -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Date:</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($income->timing)->format('d M Y') }}</small>
                                </div>
                            </div>
                            
                            <!-- Time -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted small">Time:</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($income->timing)->format('h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center border">
                    <div class="card-body py-5">
                       
                        <h5 class="card-title text-muted">No {{ $type == 'roi' ? 'ROI' : 'Level' }} Income Records</h5>
                        <p class="card-text text-muted mb-0">Your {{ $type == 'roi' ? 'ROI' : 'Level' }} income history will appear here.</p>
                    </div>
                </div>
            @endforelse

            <!-- Pagination for Mobile -->
            @if($incomes->hasPages())
            <div class="card mt-3">
                <div class="card-body py-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="text-muted small mb-2">
                            Showing {{ $incomes->firstItem() }} to {{ $incomes->lastItem() }} of {{ $incomes->total() }} entries
                        </div>
                        <nav aria-label="Income pagination mobile">
                            <ul class="pagination pagination-sm mb-0">
                                <!-- Previous Page Link -->
                                @if($incomes->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                           
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $incomes->previousPageUrl() }}&type={{ $type }}" rel="prev">
                                           
                                        </a>
                                    </li>
                                @endif

                                <!-- Current Page Info -->
                                <li class="page-item disabled">
                                    <span class="page-link text-dark fw-bold">
                                        {{ $incomes->currentPage() }} / {{ $incomes->lastPage() }}
                                    </span>
                                </li>

                                <!-- Next Page Link -->
                                @if($incomes->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $incomes->nextPageUrl() }}&type={{ $type }}" rel="next">
                                           
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                           
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
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
    
    /* Tab styling */
    .nav-pills .nav-link {
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(45deg, #007bff, #0056b3);
        box-shadow: 0 2px 4px rgba(0,123,255,0.3);
    }
    
    .nav-pills .nav-link:not(.active):hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }
    
    /* Summary Cards */
    .card-statistic {
        border-radius: 8px;
        transition: transform 0.2s ease;
    }
    
    .card-statistic:hover {
        transform: translateY(-2px);
    }
    
    .card-statistic .material-icons {
        font-size: 2rem;
        opacity: 0.8;
    }
    
    /* Pagination Styling */
    .pagination {
        margin-bottom: 0;
    }

    .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #007bff;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0056b3;
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border-color: #007bff;
        color: white;
        box-shadow: 0 2px 4px rgba(0,123,255,0.3);
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
        transform: none;
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
        
        /* Better badge sizing for mobile */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        
        /* Amount styling */
        .fs-5 {
            font-size: 1.1rem !important;
        }
        
        /* Summary cards for mobile */
        .card-statistic {
            margin-bottom: 1rem;
        }
        
        .card-statistic .card-body {
            padding: 0.75rem;
        }
        
        .card-statistic h4 {
            font-size: 1.25rem;
        }
        
        .card-statistic h6 {
            font-size: 0.75rem;
        }
        
        /* Tabs for mobile */
        .nav-pills .nav-link {
            padding: 0.75rem 0.5rem;
            font-size: 0.9rem;
        }
        
        /* Mobile pagination */
        .pagination-sm .page-link {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
        }
        
        .page-link .material-icons {
            font-size: 16px;
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
    }
    
    /* Ensure proper spacing */
    .row.g-2 > [class*="col-"] {
        margin-bottom: 0.25rem;
    }
    
    /* Color coding for income types */
    .text-success {
        color: #198754 !important;
    }
    
    .text-warning {
        color: #ffc107 !important;
    }
    
    .text-primary {
        color: #0d6efd !important;
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
    
    // Add subtle animation to income amounts
    document.querySelectorAll('.fw-bold.fs-5').forEach(amount => {
        amount.style.transition = 'transform 0.2s ease';
        amount.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        amount.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // Tab persistence
    document.addEventListener('DOMContentLoaded', function() {
        const currentType = '{{ $type }}';
        const tabs = document.querySelectorAll('.nav-link');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                localStorage.setItem('incomeType', this.href.includes('type=level') ? 'level' : 'roi');
            });
        });
    });
</script>
@endpush