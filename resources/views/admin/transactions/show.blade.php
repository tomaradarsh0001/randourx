@extends('member.layouts.appadmin')

@section('title', 'Transaction Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Transaction Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Transaction Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Transaction ID:</th>
                                    <td>{{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <th>Type:</th>
                                    <td>
                                        <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'info' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td class="fw-bold">${{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ $transaction->payment_method }}</td>
                                </tr>
                                <tr>
                                    <th>Reference ID:</th>
                                    <td>{{ $transaction->reference_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>User Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Username:</th>
                                    <td>{{ $transaction->user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $transaction->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Full Name:</th>
                                    <td>{{ $transaction->user->full_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Wallet Balance:</th>
                                    <td class="fw-bold">${{ number_format($transaction->user->wallet1, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($transaction->screenshot)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Payment Proof</h5>
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $transaction->screenshot) }}" 
                                     alt="Payment Proof" class="img-fluid rounded" style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($transaction->admin_notes)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Admin Notes</h5>
                            <div class="alert alert-info">
                                {{ $transaction->admin_notes }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($transaction->status == 'pending')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Approve Transaction</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="approve_notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="approve_notes" name="admin_notes" 
                                      rows="3" placeholder="Add any notes about this approval"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check-circle"></i> Approve Transaction
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Reject Transaction</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.transactions.reject', $transaction) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="reject_reason" class="form-label">Reason for Rejection</label>
                            <textarea class="form-control" id="reject_reason" name="admin_notes" 
                                      rows="3" placeholder="Explain why this transaction is being rejected" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-times-circle"></i> Reject Transaction
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Transaction Status</h5>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-{{ $transaction->status == 'approved' ? 'success' : 'danger' }}">
                        <h4>Transaction {{ ucfirst($transaction->status) }}</h4>
                        <p class="mb-0">
                            @if($transaction->approved_at)
                            Processed on: {{ $transaction->approved_at->format('M d, Y h:i A') }}
                            @endif
                        </p>
                    </div>
                    
                    @if($transaction->admin_notes)
                    <div class="mt-3">
                        <h6>Admin Notes:</h6>
                        <p class="text-muted">{{ $transaction->admin_notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection