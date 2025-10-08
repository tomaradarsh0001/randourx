@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3"><span class="fw-bold">Hi</span>, {{ $user->full_name }}, {{ $user->username }}</h3>
                <h6 class="op-7 mb-2">Status: <span class="badge bg-success">Active</span></h6>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                    <div class="card-body skew-shadow">
                        <img src="{{ asset('assets/img/visa.svg') }}" height="35" alt="Visa Logo" />
                        <h2 class="py-4 mb-0">{{ $user->wallet1 }} USD</h2>
                        <div class="row">
                            <div class="col-8 pe-0">
                                <h3 class="fw-bold mb-1">My Wallet</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    <a href="{{route('member.deposit.history')}}" class="text-white size-12">View all Transaction</a>
                                </div>
                            </div>
                            <div class="col-4 ps-0 text-end"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                    <div class="card-body bubble-shadow">
                        <img src="{{ asset('assets/img/visa.svg') }}" height="35" alt="Visa Logo" />
                        <h2 class="py-4 mb-0">{{ $user->wallet2 }} USD</h2>
                        <div class="row">
                            <div class="col-8 pe-0">
                                <h3 class="fw-bold mb-1">Income Wallet</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    <a href="{{route('user.income')}}" class="text-white size-12">View all Transaction</a>
                                </div>
                            </div>
                            <div class="col-4 ps-0 text-end"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                    <div class="card-body curves-shadow">
                        <img src="{{ asset('assets/img/visa.svg') }}" height="35" alt="Visa Logo" />
                        <h2 class="py-4 mb-0">{{ $user->wallet3 }} USD</h2>
                        <div class="row">
                            <div class="col-8 pe-0">
                                <h3 class="fw-bold mb-1">Investment</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    <a href="{{ route('user.investments')}}" class="text-white size-12">View all Transaction</a>
                                </div>
                            </div>
                            <div class="col-4 ps-0 text-end"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                    <div class="card-body skew-shadow">
                        <img src="{{ asset('assets/img/visa.svg') }}" height="35" alt="Visa Logo" />
                        <h2 class="py-4 mb-0">{{ $user->wallet4 }} USD</h2>
                        <div class="row">
                            <div class="col-8 pe-0">
                                <h3 class="fw-bold mb-1">Withdrawen</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    <a href="withdrawal-report" class="text-white size-12">View all Transaction</a>
                                </div>
                            </div>
                            <div class="col-4 ps-0 text-end"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <a href="{{ route('roi.history')}}" class="animated-card-link card-link">
                    <div class="animated-card card card-stats card-round">
                        <div class="animated-card-body card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="animated-category card-category">ROI Bonus</p>
                                        <h4 class="animated-title card-title">${{ $user->income1 }} USD</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-sm-6 col-md-4">
                <a href="{{route('member.wallets.level')}}" class="animated-card-link card-link">
                    <div class="animated-card card card-stats card-round">
                        <div class="animated-card-body card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="animated-category card-category">Level Bonus</p>
                                        <h4 class="animated-title card-title">${{ $user->income2 }} USD</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-sm-6 col-md-4">
                <a href="/salary" class="animated-card-link card-link">
                    <div class="animated-card card card-stats card-round">
                        <div class="animated-card-body card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="animated-category card-category">Royalty Income</p>
                                        <h4 class="animated-title card-title">${{ $user->income3 }} USD</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="row g-4 mb-5">
    <!-- Referral Link Card -->
    <div class="col-12 col-md-6">
        <div class="referral-card h-100 d-flex flex-column justify-content-between p-4 text-center">

            @php
                $username = Auth::user()->username;
                $referralUrl = url('/') . '?ref=' . $username;
            @endphp

            <!-- Referral Section -->
            <div class="row g-3 align-items-center">
                <!-- Input + Copy Button -->
                <div class="col-12 col-md-8">
                    <div class="input-group shadow-sm rounded-4 overflow-hidden">
                        <input type="text" class="form-control border-0 py-3" id="url"
                               value="{{ $referralUrl }}" readonly>
                        <button class="btn btn-primary px-3 fs-5" type="button"
                                onclick="copyReferral()" 
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Copy to Clipboard">
                            📋
                        </button>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-12 col-md-4 text-center">
                    <img src="{{ asset('assets/img/linkcopy.png') }}"
                         class="img-fluid rounded-circle shadow-lg border pattern-overlay"
                         style="max-height: 90px;" alt="Copy Link">
                </div>
            </div>

            <!-- Info Text -->
            <div class="mt-4">
                <p class="fw-semibold fs-6 text-dark">
                    🎉 Invite your friends and earn rewards! <br>
                    Share your referral link and grow with <span class="fw-bold text-white">Randour-x</span>. <br>
                    The more you refer, the more you earn!
                </p>
            </div>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="col-12 col-md-6">
        <div class="card text-center p-4 bg-info-gradient h-100 rounded-4 shadow-lg">
            <div class="card-body d-flex flex-column justify-content-between">

                <!-- User Info Row -->
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="me-3">
                        <img src="{{ asset('imagess/logorandour.png') }}" 
                             class="img-fluid" style="width: 150px; height: 50px;" alt="User Logo">
                    </div>
                    <div class="text-start">
                        <h6 class="mb-1 text-white"><b>UserID : </b>{{ Auth::user()->username }}</h6>
                        <small class="text-white"><b>SponsorID : </b>{{ Auth::user()->sponsor_username ?? 'N/A' }}</small>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="row text-center g-3">
                    <div class="col-6">
                        <div class="tile bg-lightblue text-dark p-3 rounded shadow-sm">
                            <h6>Total Sponsored <i class="bi bi-person"></i></h6>
                            <p class="fw-bold">{{$downlineCount}}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tile bg-lightblue text-dark p-3 rounded shadow-sm">
                            <h6>Active Sponsored <i class="bi bi-person-check"></i></h6>
                            <p class="fw-bold">{{$downlineCount}}</p>
                        </div>
                    </div>
                </div>

                <div class="row text-center g-3 mt-2">
                    <div class="col-6">
                        <div class="tile bg-lightblue text-dark p-3 rounded shadow-sm">
                            <h6>Total Downline BV <i class="bi bi-bar-chart"></i></h6>
                            <p class="fw-bold">{{$totalBusinessDownline}}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tile bg-lightblue text-dark p-3 rounded shadow-sm">
                            <h6>Direct Sponsors <i class="bi bi-people"></i></h6>
                            <p class="fw-bold">{{$level1Count}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@if($showSalaryModal && $isEligibleForSalary)
<!-- Salary Eligibility Modal -->
<div class="modal fade" id="salaryEligibilityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3 border-0">
            
            <!-- Header -->
            <div class="modal-header bg-gradient-primary text-white d-flex align-items-center">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-trophy me-2 text-warning"></i> Congratulations!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h4 class="fw-semibold text-success">
                        You've reached <span class="text-primary">Level {{ $salaryProgress['currentLevel'] }}</span> Eligibility!
                    </h4>
                    <p class="text-muted mb-1">
                        <i class="fas fa-chart-line text-success me-1"></i> Total Business: 
                        <strong class="text-dark">${{ number_format($totalBusinessDownline, 2) }}</strong>
                    </p>
                    <p class="text-muted">
                        <i class="far fa-clock text-primary me-1"></i> Days Elapsed: 
                        <strong>{{ $salaryProgress['daysElapsed'] }} days</strong>
                    </p>
                </div>

                <!-- Progress Levels -->
                <div class="progress-container mt-4">
                    @foreach($salaryProgress['levels'] as $level)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold">
                                <i class="fas fa-medal me-1 text-warning"></i> 
                                Level {{ $level['level'] }}
                            </span>
                            <span class="small text-muted">
                                ${{ number_format($level['amount']) }}
                            </span>
                        </div>
                        <div class="progress mt-1" style="height: 20px; border-radius: 10px;">
                            <div class="progress-bar bg-{{ $level['status'] == 'achieved' ? 'success' : 'warning' }} fw-semibold"
                                role="progressbar"
                                style="width: {{ $level['percent'] }}%;">
                                {{ $level['percent'] }}%
                            </div>
                        </div>
                        <small class="text-muted">Status: 
                            <span class="{{ $level['status'] == 'achieved' ? 'text-success fw-semibold' : 'text-warning fw-semibold' }}">
                                {{ ucfirst($level['status']) }}
                            </span>
                        </small>
                    </div>
                    @endforeach
                </div>

                <!-- Eligibility Condition -->
                <div class="alert alert-info mt-4 d-flex align-items-center">
                    <i class="fas fa-user-plus fa-lg me-2 text-primary"></i>
                    <div>
                        To be <strong>eligible for Salary Income</strong>, please add a new direct user 
                        with an investment of <span class="fw-bold text-success">${{ number_format($lastDeposit, 2) }}</span> 
                        or more (based on your last deposit).
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-primary" id="claimRewardBtn" onclick="copyReferralCode()">
                    <i class="fas fa-link me-1"></i> Copy Referral Link
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Show the modal when conditions are met
document.addEventListener('DOMContentLoaded', function() {
    @if($showSalaryModal && $isEligibleForSalary)
    var salaryModal = new bootstrap.Modal(document.getElementById('salaryEligibilityModal'));
    salaryModal.show();
    @endif
});

function copyReferralCode() {
    const btn = document.getElementById('claimRewardBtn');
    const originalText = btn.innerHTML;
    const copyText = document.getElementById("url");

    // Select and copy text
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    // Change button state
    btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Copied!';
    btn.classList.add('btn-success');
    btn.classList.remove('btn-outline-primary');

    // Revert back after 2 seconds
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline-primary');
    }, 2000);
}
</script>
@endif
<!-- Styles -->
<style>
    .mb-5 {
    margin-bottom: 7rem !important;
}
    .referral-card {
        background: linear-gradient(135deg, #42a5f5, #478ed1);
        border-radius: 1.5rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .referral-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255,255,255,0.12) 1px, transparent 1px);
        background-size: 25px 25px;
        pointer-events: none;
    }

    .referral-card input {
        font-size: 0.95rem;
        background: #fff;
    }

    .referral-card .btn-primary {
        background-color: #1565c0;
        border: none;
        transition: all 0.3s ease;
    }

    .referral-card .btn-primary:hover {
        background-color: #0d47a1;
    }

    .tile {
        background: #e3f2fd;
        border-radius: 1rem;
    }
</style>

<!-- Copy Script -->
<script>
    function copyReferral() {
        let copyText = document.getElementById("url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        // Tooltip feedback
        let tooltipBtn = document.querySelector('[data-bs-toggle="tooltip"]');
        let tooltip = bootstrap.Tooltip.getInstance(tooltipBtn);
        tooltip.setContent({ '.tooltip-inner': 'Copied!' });
        setTimeout(() => {
            tooltip.setContent({ '.tooltip-inner': 'Copy to Clipboard' });
        }, 2000);
    }

    document.addEventListener("DOMContentLoaded", function () {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>

    </div>
</div>

@endsection
