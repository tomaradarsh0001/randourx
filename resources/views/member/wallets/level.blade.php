@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
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

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-9 mb-4">
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

            <!-- Commission by Level Chart -->
            <div class="row mb-4">
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
                                        @for($i = 1; $i <= 15; $i++)
                                            @php
                                                $percentage = 0;
                                                if($i == 1) $percentage = 20;
                                                elseif($i == 2) $percentage = 3;
                                                elseif($i == 3 || $i == 4) $percentage = 2;
                                                elseif($i == 5) $percentage = 3;
                                                elseif($i >= 6 && $i <= 10) $percentage = 0.5;
                                                else $percentage = 1;
                                                
                                                $levelData = $commissionByLevel->get($i);
                                                $total = $levelData->total_commission ?? 0;
                                                $count = $levelData->transaction_count ?? 0;
                                                $lastDate = $levelData->last_commission ?? null;
                                            @endphp
                                            <tr>
                                                <td><strong>Level {{ $i }}</strong></td>
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
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Commissions -->
            <div class="row mb-5">
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
                                                <span class="badge badge-level-{{ $commission->level }}">
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
        </div>
 

<style>
.badge-level-1 { background-color: #e74c3c; }
.badge-level-2 { background-color: #3498db; }
.badge-level-3 { background-color: #2ecc71; }
.badge-level-4 { background-color: #9b59b6; }
.badge-level-5 { background-color: #f39c12; }
.badge-level-6, .badge-level-7, .badge-level-8, .badge-level-9, .badge-level-10 { 
    background-color: #34495e; 
    
}
.mb-5 {
    margin-bottom: 6rem !important;
}
</style>
        </div>
</div>
@endsection

@push('styles')
<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
