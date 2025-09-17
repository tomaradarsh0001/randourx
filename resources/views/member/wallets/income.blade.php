@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
        <h2 class="mb-4">All Income
            <i class="material-icons text-primary">(ROI + Level + Bonus Income History)</i> 
        </h2>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="material-icons">Sno.</i> #</th>
                            <th><i class="material-icons">Invested</i> (Pack Value)</th>
                            <th><i class="material-icons">Income</i> (Amount)</th>
                            <th><i class="material-icons">schedule</i> Timing</th>
                            <th><i class="material-icons">Income Source</i> Origin</th>
                            <th><i class="material-icons">category</i> Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allIncomes as $index => $income)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($income->investment > 0)
                                        <span class="badge bg-info text-white">{{ number_format($income->investment, 2) }}</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($income->type == 'ROI Income')
                                        <span class="badge bg-success">{{ number_format($income->amount, 2) }}</span>
                                    @elseif($income->type == 'Level Income')
                                        <span class="badge bg-warning text-white">{{ number_format($income->amount, 2) }}</span>
                                    @else
                                        <span class="badge bg-primary">{{ number_format($income->amount, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="material-icons text-muted small">event</i>
                                    {{ \Carbon\Carbon::parse($income->timing)->format('d M Y, h:i A') }}
                                </td>
                                <td>{{ $income->source }}</td>
                                <td>
                                    @if($income->type == 'ROI Income')
                                        <span class="badge bg-success">{{ $income->type }}</span>
                                    @elseif($income->type == 'Level Income')
                                        <span class="badge bg-warning text-white">{{ $income->type }}</span>
                                    @else
                                        <span class="badge bg-primary">{{ $income->type }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="material-icons">info</i> No income records found.
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
<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
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
    }
</style>
@endpush