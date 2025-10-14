@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <div class="page-inner mb-5 mx-5">
        <!-- Welcome Header -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-2"><span class="fw-bold">Welcome back</span>, {{ $user->full_name }}</h3>
                <div class="d-flex align-items-center">
                    <h6 class="op-7 mb-0 me-3">Status:</h6>
                    <div class="status-badge">
                        <span class="badge bg-success">
                            <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                            Active
                        </span>
                    </div>
                </div>
            </div>
            <div class="ms-md-auto mt-3 mt-md-0">
                <button class="btn btn-light btn-refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        
        <!-- Wallet Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card wallet-card wallet-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="wallet-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('member.deposit.history')}}">View Transactions</a></li>
                                    <li><a class="dropdown-item" href="#">Deposit Funds</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="wallet-amount">{{ $user->wallet1 }} USD</h3>
                        <p class="wallet-label">My Wallet</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card wallet-card wallet-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="wallet-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('user.income')}}">View Transactions</a></li>
                                    <li><a class="dropdown-item" href="#">Withdraw Income</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="wallet-amount">{{ $user->wallet2 }} USD</h3>
                        <p class="wallet-label">Income Wallet</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card wallet-card wallet-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="wallet-icon">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.investments')}}">View Investments</a></li>
                                    <li><a class="dropdown-item" href="#">New Investment</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="wallet-amount">{{ $user->wallet3 }} USD</h3>
                        <p class="wallet-label">Investment</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card wallet-card wallet-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="wallet-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="withdrawal-report">View Transactions</a></li>
                                    <li><a class="dropdown-item" href="#">Request Withdrawal</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="wallet-amount">{{ $user->wallet4 }} USD</h3>
                        <p class="wallet-label">Withdrawn</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Income Stats -->
        <div class="row mb-4">
            <div class="col-sm-6 col-md-4 mb-3">
                <a href="{{ route('roi.history')}}" class="stats-card-link">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="stats-value">${{ $user->income1 }} USD</h4>
                                    <p class="stats-label">ROI Bonus</p>
                                </div>
                            </div>
                            <div class="stats-footer">
                                <span>View Details <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-sm-6 col-md-4 mb-3">
                <a href="{{route('member.wallets.level')}}" class="stats-card-link">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-success">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="stats-value">${{ $user->income2 }} USD</h4>
                                    <p class="stats-label">Level Bonus</p>
                                </div>
                            </div>
                            <div class="stats-footer">
                                <span>View Details <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-sm-6 col-md-4 mb-3">
                <a href="/salary" class="stats-card-link">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-info">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="stats-value">${{ $user->income3 }} USD</h4>
                                    <p class="stats-label">Royalty Income</p>
                                </div>
                            </div>
                            <div class="stats-footer">
                                <span>View Details <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Referral & User Info Section -->
        <div class="row g-4 mb-10">
            <!-- Referral Link Card -->
            <div class="col-12 col-md-6">
                <div class="card referral-card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-share-alt me-2"></i>Your Referral Link
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        @php
                            $username = Auth::user()->username;
                            $referralUrl = url('/') . '?ref=' . $username;
                        @endphp

                        <div class="referral-input-container mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="url" value="{{ $referralUrl }}" readonly>
                                <button class="btn btn-primary" type="button" onclick="copyReferral()">
                                    <i class="fas fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="referral-info text-center">
                            <div class="referral-icon mb-3">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h6 class="fw-semibold">Invite Friends & Earn Rewards!</h6>
                            <p class="text-muted small">
                                Share your referral link and grow with <span class="fw-bold text-primary">Randour-x</span>. 
                                The more you refer, the more you earn!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="col-12 col-md-6">
                <div class="card user-info-card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-circle me-2"></i>Account Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="user-basic-info mb-4">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    <div class="avatar-circle bg-primary">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1"><strong>UserID:</strong> {{ Auth::user()->username }}</h6>
                                    <p class="mb-0 text-muted small">
                                        <strong>SponsorID:</strong> {{ Auth::user()->sponsor_username ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stat-tile">
                                    <div class="tile-icon bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="tile-content">
                                        <h5 class="tile-value">{{$downlineCount}}</h5>
                                        <p class="tile-label">Total Sponsored</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-tile">
                                    <div class="tile-icon bg-success">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="tile-content">
                                        <h5 class="tile-value">{{$downlineCount}}</h5>
                                        <p class="tile-label">Active Sponsored</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-tile">
                                    <div class="tile-icon bg-info">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="tile-content">
                                        <h5 class="tile-value">{{$totalBusinessDownline}}</h5>
                                        <p class="tile-label">Total Downline BV</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-tile">
                                    <div class="tile-icon bg-warning">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="tile-content">
                                        <h5 class="tile-value">{{$level1Count}}</h5>
                                        <p class="tile-label">Direct Sponsors</p>
                                    </div>
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
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header bg-gradient-primary text-white rounded-top-4 py-2">
                <div class="d-flex align-items-center">
                    <div class="modal-icon me-2 fs-4">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0">Congratulations!</h6>
                        <small class="text-white-50">You've reached a new milestone</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body py-3 px-4">
                <div class="text-center mb-3">
                    <h5 class="fw-semibold text-success mb-2">
                        Level {{ $salaryProgress['currentLevel'] }} Achieved!
                    </h5>
                    <div class="achievement-badge mx-auto mb-2 bg-light border rounded-pill py-1 px-3 d-inline-flex align-items-center shadow-sm">
                        <i class="fas fa-medal text-warning me-2"></i>
                        <span class="fw-semibold">Level {{ $salaryProgress['currentLevel'] }}</span>
                    </div>
                </div>

                <div class="row text-center mb-3">
                    <div class="col-6">
                        <div class="p-2 bg-light rounded-3 shadow-sm">
                            <i class="fas fa-chart-line text-primary mb-1"></i>
                            <h6 class="mb-0">${{ number_format($totalBusinessDownline, 2) }}</h6>
                            <small class="text-muted">Total Business</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 bg-light rounded-3 shadow-sm">
                            <i class="far fa-clock text-info mb-1"></i>
                            <h6 class="mb-0">{{ $salaryProgress['daysElapsed'] }}</h6>
                            <small class="text-muted">Days Elapsed</small>
                        </div>
                    </div>
                </div>

                <!-- Progress Levels -->
                <div class="progress-levels mb-3">
                    <h6 class="fw-semibold text-secondary mb-2">Your Progress</h6>
                    @foreach($salaryProgress['levels'] as $level)
                    <div class="level-progress-item mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="level-name">
                                <i class="fas fa-star me-1 text-warning"></i> 
                                Level {{ $level['level'] }}
                            </span>
                            <span class="level-amount fw-semibold">${{ number_format($level['amount']) }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-{{ $level['status'] == 'achieved' ? 'success' : 'warning' }}"
                                role="progressbar"
                                style="width: {{ $level['percent'] }}%;"
                                aria-valuenow="{{ $level['percent'] }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Eligibility Info -->
                <div class="alert alert-info shadow-sm rounded-3 py-2 px-3 small d-flex align-items-start mb-0">
                    <div class="me-3 mt-1 text-info">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-dark mb-1">Next Step</div>
                        <div class="text-muted">
                            Add a new <strong>direct user</strong> with an investment of 
                            <strong>${{ number_format($lastDeposit, 2) }}</strong> or more to claim your salary income.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 pt-0 pb-3">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
                <button type="button" class="btn btn-primary btn-sm" id="claimRewardBtn" onclick="copyReferralCode()">
                    <i class="fas fa-link me-1"></i> Copy Referral Link
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
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btn.classList.add('btn-success');
            btn.classList.remove('btn-primary');

            // Revert back after 2 seconds
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
            }, 2000);
        }
        </script>
        @endif
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* General Styling */
    .page-inner {
        padding: 0 10px;
    }
    .mb-10{
        margin-bottom: 8rem !important;
    }
    .status-badge .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .btn-refresh {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Wallet Cards */
    .wallet-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .wallet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .wallet-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    
    .wallet-primary::before {
        background: linear-gradient(90deg, #42a5f5, #478ed1);
    }
    
    .wallet-secondary::before {
        background: linear-gradient(90deg, #66bb6a, #4caf50);
    }
    
    .wallet-info::before {
        background: linear-gradient(90deg, #26c6da, #00acc1);
    }
    
    .wallet-warning::before {
        background: linear-gradient(90deg, #ffa726, #ff9800);
    }
    
    .wallet-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .wallet-primary .wallet-icon {
        background: linear-gradient(135deg, #42a5f5, #478ed1);
    }
    
    .wallet-secondary .wallet-icon {
        background: linear-gradient(135deg, #66bb6a, #4caf50);
    }
    
    .wallet-info .wallet-icon {
        background: linear-gradient(135deg, #26c6da, #00acc1);
    }
    
    .wallet-warning .wallet-icon {
        background: linear-gradient(135deg, #ffa726, #ff9800);
    }
    
    .wallet-amount {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 10px 0 5px;
    }
    
    .wallet-label {
        color: #6c757d;
        margin-bottom: 0;
        font-weight: 500;
    }
    
    .btn-icon {
        background: transparent;
        border: none;
        color: #6c757d;
        padding: 4px 8px;
    }
    
    /* Stats Cards */
    .stats-card-link {
        text-decoration: none;
        color: inherit;
    }
    
    .stats-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .stats-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stats-label {
        color: #6c757d;
        margin-bottom: 0;
        font-weight: 500;
    }
    
    .stats-footer {
        margin-top: 15px;
        padding-top: 10px;
        border-top: 1px solid #e9ecef;
        color: #42a5f5;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    /* Referral Card */
    .referral-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .referral-card .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
    }
    
    .referral-card .card-title {
        font-weight: 600;
        color: #343a40;
    }
    
    .referral-input-container {
        margin-bottom: 1.5rem;
    }
    
    .referral-input-container .input-group {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .referral-input-container .form-control {
        border: none;
        padding: 12px 15px;
        font-size: 0.9rem;
    }
    
    .referral-input-container .btn {
        border-radius: 0;
        padding: 12px 20px;
        font-weight: 500;
    }
    
    .referral-info {
        padding: 1rem 0;
    }
    
    .referral-icon {
        font-size: 3rem;
        color: #42a5f5;
        margin-bottom: 1rem;
    }
    
    /* User Info Card */
    .user-info-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .user-info-card .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
    }
    
    .user-info-card .card-title {
        font-weight: 600;
        color: #343a40;
    }
    
    .user-avatar .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }
    
    .stat-tile {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .stat-tile:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }
    
    .tile-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        margin-right: 15px;
    }
    
    .tile-value {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .tile-label {
        color: #6c757d;
        margin-bottom: 0;
        font-size: 0.85rem;
    }
    
    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }
    
    .modal-header {
        padding: 1.5rem;
    }
    
    .modal-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .achievement-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #ffd700, #ffa500);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
    }
    
    .achievement-badge i {
        margin-right: 8px;
    }
    
    .stat-box {
        padding: 15px;
        border-radius: 12px;
        background: #f8f9fa;
    }
    
    .stat-box i {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    
    .level-progress-item {
        padding: 10px 0;
    }
    
    .level-name {
        font-weight: 500;
    }
    
    .level-amount {
        font-weight: 600;
        color: #343a40;
    }
    
    .progress {
        height: 8px;
        border-radius: 4px;
    }
    
    .section-title {
        font-weight: 600;
        color: #343a40;
        padding-bottom: 8px;
        border-bottom: 1px solid #e9ecef;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .page-inner {
            padding: 0 5px;
        }
        
        .wallet-amount {
            font-size: 1.5rem;
        }
        
        .stats-value {
            font-size: 1.25rem;
        }
        
        .user-basic-info {
            flex-direction: column;
            text-align: center;
        }
        
        .user-avatar {
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .wallet-card .card-body {
            padding: 1.25rem;
        }
        
        .stats-card .card-body {
            padding: 1.25rem;
        }
        
        .stat-tile {
            flex-direction: column;
            text-align: center;
        }
        
        .tile-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>

<!-- Copy Script -->
<script>
    function copyReferral() {
        let copyText = document.getElementById("url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        // Show temporary feedback
        const btn = document.querySelector('.referral-input-container .btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
        }, 2000);
    }
</script>

@endsection