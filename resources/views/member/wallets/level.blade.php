@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner mb-5">
        <!-- Main Content -->
        <div class="col-md-12 ml-sm-auto col-lg-12 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Level Commission Earnings</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <span class="btn btn-sm btn-outline-secondary">Total Earnings: ${{ number_format($totalCommissions, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards - Desktop -->
            <div class="row mb-4 d-none d-md-flex">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Commissions</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalCommissions, 2) }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        This Month</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($monthlyCommissions, 2) }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Today's Earnings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($todayCommissions, 2) }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Active Levels</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeLevelsCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards - Mobile -->
            <div class="row mb-4 d-block d-md-none">
                <div class="col-12 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body py-3">
                            <div class="row text-center">
                                <div class="col-6 border-end border-white-50">
                                    <div class="mb-2">
                                        <i class="fas fa-dollar-sign fa-lg mb-1"></i>
                                    </div>
                                    <div class="small opacity-75">Total Commissions</div>
                                    <div class="h6 fw-bold mb-0">${{ number_format($totalCommissions, 2) }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <i class="fas fa-calendar fa-lg mb-1"></i>
                                    </div>
                                    <div class="small opacity-75">This Month</div>
                                    <div class="h6 fw-bold mb-0">${{ number_format($monthlyCommissions, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-success text-white">
                        <div class="card-body py-3">
                            <div class="row text-center">
                                <div class="col-6 border-end border-white-50">
                                    <div class="mb-2">
                                        <i class="fas fa-coins fa-lg mb-1"></i>
                                    </div>
                                    <div class="small opacity-75">Today</div>
                                    <div class="h6 fw-bold mb-0">${{ number_format($todayCommissions, 2) }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <i class="fas fa-layer-group fa-lg mb-1"></i>
                                    </div>
                                    <div class="small opacity-75">Active Levels</div>
                                    <div class="h6 fw-bold mb-0">{{ $activeLevelsCount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commission by Level - Desktop -->
           <div class="row mb-4 d-none d-md-block">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Commissions by Level</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Level</th>
                                <th>Commission Rate</th>
                                <th>Total Earned</th>
                                <th>Number of Transactions</th>
                                <th>Last Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissionByLevel as $level => $levelData)
                                @if($levelData && $levelData->transaction_count > 0)
                                    @php
                                        $percentage = 0;
                                        if($level == 1) $percentage = 60;
                                        elseif($level == 2) $percentage = 3;
                                        elseif($level == 3 ) $percentage = 2;
                                        elseif($level == 4) $percentage = 1;
                                        elseif($level >= 6 && $level <= 10) $percentage = 1;
                                        else $percentage = 1;

                                        $total = $levelData->total_commission ?? 0;
                                        $count = $levelData->transaction_count ?? 0;
                                        $lastDate = $levelData->last_commission ?? null;
                                    @endphp
                                    <tr>
                                        <td><strong>Level {{ $level }}</strong></td>
                                        <td><span class="badge badge-primary">{{ $percentage }}%</span></td>
                                        <td class="font-weight-bold text-success">${{ number_format($total, 2) }}</td>
                                        <td>{{ $count }} transactions</td>
                                        <td>
                                            @if($lastDate)
                                                {{ \Carbon\Carbon::parse($lastDate)->format('M d, Y') }}
                                            @else
                                                No commissions yet
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


            <!-- Commission by Level - Mobile -->
            <div class="row mb-4 d-block d-md-none">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Commissions by Level</h6>
                        </div>
                        <div class="card-body">
    @for($i = 1; $i <= 15; $i++)
        @php
            $percentage = 0;
            if($i == 1) $percentage = 60;
            elseif($i == 2) $percentage = 3;
            elseif($i == 3 ) $percentage = 2;
            elseif($i == 4) $percentage = 1;
            elseif($i >= 6 && $i <= 10) $percentage = 1;
            else $percentage = 1;
            
            $levelData = $commissionByLevel->get($i);
            $total = $levelData->total_commission ?? 0;
            $count = $levelData->transaction_count ?? 0;
            $lastDate = $levelData->last_commission ?? null;
            
            // Define colors for each level
            $levelColors = [
                1 => '#e74c3c',
                2 => '#3498db', 
                3 => '#2ecc71',
                4 => '#9b59b6',
                5 => '#f39c12',
                6 => '#34495e',
                7 => '#34495e',
                8 => '#34495e', 
                9 => '#34495e',
                10 => '#34495e',
               
            ];
            $levelColor = $levelColors[$i] ?? '#6c757d';
        @endphp
        <div class="card mb-3 border">
            <div class="card-header bg-light py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge fw-bold text-white" style="background-color: {{ $levelColor }}; font-size: 0.75rem; padding: 0.4em 0.8em;">
                        Level {{ $i }}
                    </span>
                    <span class="badge bg-primary text-white" style="font-size: 0.75rem; padding: 0.4em 0.8em;">
                        {{ $percentage }}%
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center py-1">
                            <span class="text-muted small">Total Earned:</span>
                            <span class="fw-bold text-success">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center py-1">
                            <span class="text-muted small">Transactions:</span>
                            <span class="fw-medium">{{ $count }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center py-1">
                            <span class="text-muted small">Last Commission:</span>
                            <small class="text-muted">
                                @if($lastDate)
                                    {{ \Carbon\Carbon::parse($lastDate)->format('M d, Y') }}
                                @else
                                    No commissions yet
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>
                    </div>
                </div>
            </div>

            <!-- Recent Commissions - Desktop -->
            <div class="row mb-5 d-none d-md-block">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Commission Transactions</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                     aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('member.commissions.export') }}">
                                        <i class="fas fa-download fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Export to CSV
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="commissionsTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>From User</th>
                                            <th>Level</th>
                                            <th>Amount</th>
                                            <th>Percentage</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentCommissions as $commission)
                                        <tr>
                                            <td>{{ $commission->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <span class="font-weight-bold">{{ $commission->fromUser->username }}</span>
                                                <br>
                                                <small class="text-muted">{{ $commission->fromUser->full_name }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">
                                                    Level {{ $commission->level }}
                                                </span>
                                            </td>
                                            <td class="font-weight-bold text-success">
                                                ${{ number_format($commission->amount, 2) }}
                                            </td>
                                            <td>{{ number_format($commission->percentage, 2) }}%</td>
                                            <td>{{ $commission->description }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <i class="fas fa-coins fa-3x text-gray-300 mb-3"></i>
                                                <p class="text-muted">No commission earnings yet</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($recentCommissions->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $recentCommissions->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Commissions - Mobile -->
            <div class="row mb-5 d-block d-md-none">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Transactions</h6>
                        </div>
                        <div class="card-body">
                            @forelse($recentCommissions as $commission)
                                <div class="card mb-3 border">
                                    <div class="card-header bg-light py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-level-{{ $commission->level }}">
                                                Level {{ $commission->level }}
                                            </span>
                                            <span class="fw-bold text-success">
                                                ${{ number_format($commission->amount, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="text-muted small">Date:</span>
                                                    <small class="text-muted">{{ $commission->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="text-muted small">Time:</span>
                                                    <small class="text-muted">{{ $commission->created_at->format('h:i A') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="text-muted small">From User:</span>
                                                    <span class="fw-medium text-end">{{ $commission->fromUser->username }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="text-muted small">Percentage:</span>
                                                    <span class="fw-medium">{{ number_format($commission->percentage, 2) }}%</span>
                                                </div>
                                            </div>
                                            @if($commission->description)
                                            <div class="col-12">
                                                <div class="py-1">
                                                    <span class="text-muted small">Description:</span>
                                                    <p class="mb-0 small">{{ $commission->description }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card text-center border">
                                    <div class="card-body py-5">
                                        <i class="fas fa-coins fa-3x text-muted mb-3"></i>
                                        <h5 class="card-title text-muted">No Commission Earnings</h5>
                                        <p class="card-text text-muted mb-0">Your commission history will appear here.</p>
                                    </div>
                                </div>
                            @endforelse

                            @if($recentCommissions->hasPages())
                            <div class="card mt-3">
                                <div class="card-body py-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="text-muted small mb-2">
                                            Showing {{ $recentCommissions->firstItem() }} to {{ $recentCommissions->lastItem() }} of {{ $recentCommissions->total() }}
                                        </div>
                                        <nav>
                                            {{ $recentCommissions->onEachSide(1)->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
.badge-level-1 { 
    background-color: #e74c3c !important; 
    color: white !important;
}
.badge-level-2 { 
    background-color: #3498db !important; 
    color: white !important;
}
.badge-level-3 { 
    background-color: #2ecc71 !important; 
    color: white !important;
}
.badge-level-4 { 
    background-color: #9b59b6 !important; 
    color: white !important;
}
.badge-level-5 { 
    background-color: #f39c12 !important; 
    color: white !important;
}
.badge-level-6, .badge-level-7, .badge-level-8, .badge-level-9, .badge-level-10 { 
    background-color: #34495e !important; 
    color: white !important;
}
.badge-level-11, .badge-level-12, .badge-level-13, .badge-level-14, .badge-level-15 { 
    background-color: #7f8c8d !important; 
    color: white !important;
}

.mb-5 {
    margin-bottom: 6rem !important;
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
        font-size: 0.75rem !important;
        padding: 0.4em 0.7em !important;
        font-weight: 600 !important;
    }
    
    /* Ensure level badges are visible */
    .badge-level-1,
    .badge-level-2,
    .badge-level-3,
    .badge-level-4,
    .badge-level-5,
    .badge-level-6,
    .badge-level-7,
    .badge-level-8,
    .badge-level-9,
    .badge-level-10,
    .badge-level-11,
    .badge-level-12,
    .badge-level-13,
    .badge-level-14,
    .badge-level-15 {
        min-width: 70px;
        text-align: center;
    }
    
    /* Stats cards for mobile */
    .bg-primary .border-end,
    .bg-success .border-end {
        padding-right: 1rem;
    }
    
    /* Ensure proper spacing in mobile cards */
    .row.g-2 > [class*="col-"] {
        margin-bottom: 0.25rem;
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
    
    /* Ensure desktop badges are visible too */
    .badge-level-1,
    .badge-level-2,
    .badge-level-3,
    .badge-level-4,
    .badge-level-5,
    .badge-level-6,
    .badge-level-7,
    .badge-level-8,
    .badge-level-9,
    .badge-level-10,
    .badge-level-11,
    .badge-level-12,
    .badge-level-13,
    .badge-level-14,
    .badge-level-15 {
        color: white !important;
        font-weight: 600;
    }
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
    
    // Add subtle animation to commission amounts
    document.querySelectorAll('.fw-bold.text-success').forEach(amount => {
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