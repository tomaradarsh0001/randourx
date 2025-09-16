@extends('member.layouts.appadmin')

@section('title', 'All Transactions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">All Transactions</h4>
                    <a href="{{ route('admin.transactions.pending') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-clock"></i> View Pending
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Reference ID</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $transaction->user->username }}<br>
                                        <small class="text-muted">{{ $transaction->user->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ $transaction->payment_method }}</td>
                                    <td>{{ $transaction->reference_id ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No transactions found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection