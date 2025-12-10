@extends('member.layouts.appadmin')

@section('title', 'Contact Messages')


@section('content')
<div class="container">
    <div class="page-inner row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Fund Transfers</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Reference ID</th>
                                    <th>From User</th>
                                    <th>To User</th>
                                    <th>Amount</th>
                                    <th>Wallet Type</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transfers as $transfer)
                                    <tr>
                                        <td>{{ $transfer->reference_id }}</td>
                                        <td>
                                            {{ $transfer->sender->username ?? 'N/A' }}
                                            <br>
                                            <small class="text-muted">{{ $transfer->sender->email ?? '' }}</small>
                                        </td>
                                        <td>
                                            {{ $transfer->receiver->username ?? 'N/A' }}
                                            <br>
                                            <small class="text-muted">{{ $transfer->receiver->email ?? '' }}</small>
                                        </td>
                                        <td>${{ number_format($transfer->amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($transfer->wallet_type) }}</span>
                                        </td>
                                        <td>{{ $transfer->description ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $transfer->status == 'completed' ? 'success' : ($transfer->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($transfer->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $transfer->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No transfers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $transfers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection