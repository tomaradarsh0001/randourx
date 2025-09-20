@extends('member.layouts.app')

@section('title', 'Salary Income')

@section('content')
<div class="container">
    <div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>Salary Income History</h2>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Target Level</th>
                                    <th>Target Amount</th>
                                    <th>Your Wallet3</th>
                                    <th>Percentage</th>
                                    <th>Credited Amount</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salaryHistory as $history)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}</td>
                                    <td>
                                        @if($history->target_level == '30_days')
                                        <span class="badge bg-primary">30 Days</span>
                                        @elseif($history->target_level == '60_days')
                                        <span class="badge bg-info">60 Days</span>
                                        @else
                                        <span class="badge bg-success">90 Days</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($history->target_amount, 2) }}</td>
                                    <td>${{ number_format($history->user_wallet3_amount, 2) }}</td>
                                    <td><span class="badge bg-warning text-white">{{ $history->calculated_percentage }}%</span></td>
                                    <td class="text-success fw-bold">+ ${{ number_format($history->credited_amount, 2) }}</td>
                                    <td><small>{{ $history->description }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fa fa-history fa-2x mb-2"></i>
                                        <br>No salary income history found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($salaryHistory instanceof \Illuminate\Pagination\LengthAwarePaginator && $salaryHistory->count())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $salaryHistory->links() }}
                    </div>
                    @endif
                </div>
            </div>

            @if($salaryHistory->count())
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Salary Income Summary</h5>
                </div>
                <div class="card-body">
                    @php
                        $totalCredited = $salaryHistory->sum('credited_amount');
                        $thirtyDaysCount = $salaryHistory->where('target_level', '30_days')->count();
                        $sixtyDaysCount = $salaryHistory->where('target_level', '60_days')->count();
                        $ninetyDaysCount = $salaryHistory->where('target_level', '90_days')->count();
                    @endphp
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6>Total Earned</h6>
                                    <h4 class="text-success">${{ number_format($totalCredited, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6>30 Days</h6>
                                    <h4>{{ $thirtyDaysCount }}x</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6>60 Days</h6>
                                    <h4>{{ $sixtyDaysCount }}x</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6>90 Days</h6>
                                    <h4>{{ $ninetyDaysCount }}x</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
</div>

<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .badge {
        font-size: 0.75em;
    }
</style>
@endsection