@extends('member.layouts.app')

@section('title', 'Fund Transfer')

@section('content')
<div class="container">
    <div class="row justify-content-center page-inner">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Transfer History</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Type</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Wallet</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transfers as $transfer)
                                    <tr>
                                        <td>{{ $transfer->reference_id }}</td>
                                        <td>
                                            @if($transfer->from_user_id == auth()->id())
                                                <span class="badge badge-danger">Sent</span>
                                            @else
                                                <span class="badge badge-success">Received</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transfer->from_user_id == auth()->id())
                                                To: {{ $transfer->receiver->name }}
                                            @else
                                                From: {{ $transfer->sender->name }}
                                            @endif
                                        </td>
                                        <td>${{ number_format($transfer->amount, 2) }}</td>
                                        <td>{{ ucfirst($transfer->wallet_type) }}</td>
                                        <td>{{ $transfer->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge badge-success">{{ ucfirst($transfer->status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $transfers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection