@extends('member.layouts.app')

@section('title', 'Deposit History')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Deposit History</h2>
            <a href="{{ route('member.transactions.deposit') }}" class="btn btn-primary">
                <i class="material-icons"></i> New Deposit
            </a>
        </div>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="material-icons">Sno.</i></th>
                                <th><i class="material-icons">payments</i> Amount</th>
                                <th><i class="material-icons">payment</i> Payment Method</th>
                                <th><i class="material-icons">receipt</i> Reference ID</th>
                                <th><i class="material-icons">info</i> Status</th>
                                <th><i class="material-icons">schedule</i> Deposit Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deposits as $index => $deposit)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-success p-2">${{ number_format($deposit->amount, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-white p-2">{{ ucfirst($deposit->payment_method) }}</span>
                                    </td>
                                    <td>
                                        @if($deposit->reference_id)
                                            <small class="text-muted">{{ $deposit->reference_id }}</small>
                                        @else
                                            <span class="badge bg-secondary p-2">Not provided</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($deposit->status == 'approved')
                                            <span class="badge bg-success p-2"><i class="material-icons"></i> Approved</span>
                                        @elseif($deposit->status == 'pending')
                                            <span class="badge bg-warning text-dark p-2"><i class="material-icons"></i> Pending</span>
                                        @elseif($deposit->status == 'rejected')
                                            <span class="badge bg-danger p-2"><i class="material-icons"></i> Rejected</span>
                                        @else
                                            <span class="badge bg-secondary p-2">{{ ucfirst($deposit->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="material-icons text-muted small">event</i>
                                        {{ \Carbon\Carbon::parse($deposit->created_at)->format('d M Y, h:i A') }}
                                    </td>
                                
                                   
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="material-icons display-4">account_balance_wallet</i>
                                        <p class="mt-2">No deposit records found.</p>
                                        <a href="{{ route('member.transactions.deposit') }}" class="btn btn-primary mt-2">
                                            <i class="material-icons">add</i> Make Your First Deposit
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
    </div>
</div>
@endsection

@push('styles')
<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }
    .material-icons {
        vertical-align: middle;
        margin-right: 5px;
        font-size: 18px;
    }
    .card {
        border: none;
        border-radius: 10px;
    }
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
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush