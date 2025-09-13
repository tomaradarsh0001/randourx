@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
        <h2 class="mb-4">All Income
            <i class="material-icons text-primary">(ROI + Level + Bonus Income History)
</i> 
        </h2>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="material-icons">Sno.</i> #</th>
                            <th><i class="material-icons">Invested</i> (Pack Value)</th>
                            <th><i class="material-icons">Income</i> (Bonus)</th>
                            <th><i class="material-icons">schedule</i> Timing</th>
                            <th><i class="material-icons">Income Source</i> Origin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roiIncomes as $index => $income)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="badge bg-info text-white">{{ number_format($income->wallet_value, 2) }}</span></td>
                                <td><span class="badge bg-success">{{ number_format($income->roi_bonus, 2) }}</span></td>
                                <td>
                                    <i class="material-icons text-muted small">event</i>
                                    {{ \Carbon\Carbon::parse($income->timing)->format('d M Y, h:i A') }}
                                </td>
                                <td><p>ROI Income (Daily Process)</p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    <i class="material-icons">info</i> No ROI records found.
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
