@extends('member.layouts.app')

@section('title', 'My Transactions')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Transactions</h4>
                    <div>
                        <a href="{{ route('member.transactions.deposit') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Deposit
                        </a>
                        <a href="{{ route('member.transactions.withdraw') }}" class="btn btn-primary btn-sm ms-2">
                            <i class="fas fa-money-bill-wave"></i> Withdraw
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Payment After Deduction (10%)</th>
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
                                        <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($transaction->amount, 2) }}</td>
                                    <td>${{ number_format($transaction->amount * 0.90, 2) }}</td>
                                    <td>{{ $transaction->payment_method }}</td>
                                    <td>{{ $transaction->reference_id ?? 'No actions allowed' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : ($transaction->status == 'cancelled' ? 'secondary' : 'danger')) }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        @if($transaction->type == 'withdrawal' && $transaction->status == 'pending')
                                        <form action="{{ route('member.transactions.cancel-withdrawal', $transaction->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to cancel this withdrawal request?')">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-muted">No actions allowed</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No transactions found.</td>
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