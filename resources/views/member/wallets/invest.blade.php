@extends('member.layouts.app')

@section('title', 'My Investments')

@section('content')
<div class="container">
    <div class="page-inner">
        <h2 class="mb-4">
            <i class="material-icons text-primary">payments</i> 
            My Investment History
        </h2>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="material-icons">Sno.</i> #</th>
                            <th>Purchase Value</th>
                            <th><i class="material-icons">event</i> Date & Time</th>
                            <th><i class="material-icons"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($investments as $index => $investment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ number_format($investment->purchase_value, 2) }} USD
                                    </span>
                                </td>
                                <td>
                                    <i class="material-icons text-muted small">schedule</i>
                                    {{ $investment->purchased_at->format('d M Y, h:i A') }}
                                </td>
                                <td>
                                    <p class="text-success fw-bold">
                                        Success
                                    </p>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    <i class="material-icons">info</i> No investments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
