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
        </div>
        
        <!-- Wallet Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card wallet-card wallet-warning">
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
            
            <div class="col-md-3">
                <div class="card wallet-card wallet-warning">
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
            
            <div class="col-md-3">
                <div class="card wallet-card wallet-warning">
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
            
            <div class="col-md-3">
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
                                    <li><a class="dropdown-item" href="{{route('member.transactions.index')}}">View Transactions</a></li>
                                    <li><a class="dropdown-item" href="{{route('member.transactions.withdraw')}}">Request Withdrawal</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="wallet-amount">{{ $user->wallet4 }} USD</h3>
                        <p class="wallet-label">Withdrawn</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Layout: Referral Card First -->
        <div class="d-block d-md-none mb-4">
            <!-- Referral Link Card -->
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
                            <input type="text" class="form-control" id="url-mobile" value="{{ $referralUrl }}" readonly>
                            <button class="btn btn-primary" type="button" onclick="copyReferralMobile()">
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
        
        <!-- Income Stats -->
        <div class="row mb-4">
            <div class="col-sm-6 col-md-4 mb-3">
                <a href="{{ route('roi.history')}}" class="stats-card-link">
                    <div class="card stats-card stats-roi">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon">
                                    <i class="fas fa-chart-line"></i>
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
                    <div class="card stats-card stats-level">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon">
                                    <i class="fas fa-trophy"></i>
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
                    <div class="card stats-card stats-royalty">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon">
                                    <i class="fas fa-crown"></i>
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
        
        <!-- Desktop Layout: Referral & User Info Section After Income Stats -->
        <div class="d-none d-md-block">
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
                                    <div class="stat-tile tile-primary">
                                        <div class="tile-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="tile-content">
                                            <h5 class="tile-value">{{$downlineCount}}</h5>
                                            <p class="tile-label">Total Sponsored</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-tile tile-success">
                                        <div class="tile-icon">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                        <div class="tile-content">
                                            <h5 class="tile-value">{{$downlineCount}}</h5>
                                            <p class="tile-label">Active Sponsored</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-tile tile-info">
                                        <div class="tile-icon">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                        <div class="tile-content">
                                        <h5 class="tile-value">
                                            {{ $totalBusinessDownline - $user->wallet3 }}
                                        </h5>
                                            <p class="tile-label">Total Downline BV</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-tile tile-warning">
                                        <div class="tile-icon">
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
        </div>

        <!-- Mobile Layout: User Info Card After Income Stats -->
        <div class="d-blocks d-md-none">
            <!-- User Info Card -->
            <div class="card user-info-card h-100 mb-4">
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
                            <div class="stat-tile tile-primary">
                                <div class="tile-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="tile-content">
                                    <h5 class="tile-value">{{$downlineCount}}</h5>
                                    <p class="tile-label">Total Sponsored</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-tile tile-success">
                                <div class="tile-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="tile-content">
                                    <h5 class="tile-value">{{$downlineCount}}</h5>
                                    <p class="tile-label">Active Sponsored</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-tile tile-info">
                                <div class="tile-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="tile-content">
                                    <h5 class="tile-value">
                                        {{ $totalBusinessDownline - $user->wallet3 }}
                                    </h5>
                                    <p class="tile-label">Total Downline BV</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-tile tile-warning">
                                <div class="tile-icon">
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
    /* Your existing CSS styles remain the same */
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
    
    /* Wallet Cards - Enhanced with gradients */
    .wallet-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }
    
    .wallet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .wallet-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .wallet-secondary {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    .wallet-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .wallet-warning {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }
    
    .wallet-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }
    
    .wallet-amount {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 10px 0 5px;
    }
    
    .wallet-label {
        opacity: 0.9;
        margin-bottom: 0;
        font-weight: 500;
    }
    
    .btn-icon {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
    }
    
    /* Stats Cards - Colorful variants */
    .stats-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
        overflow: hidden;
        position: relative;
        background: #ffffff;
        border-left: 5px solid transparent;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    /* ROI Bonus Card - Gold Theme */
    .stats-roi {
        border-left-color: #FFD700;
        background: linear-gradient(135deg, #fff9e6 0%, #fff0c2 100%);
    }

    .stats-roi .stats-icon {
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: white;
        box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
    }

    .stats-roi .stats-value {
        color: #B8860B;
    }

    .stats-roi .stats-label {
        color: #8B6914;
    }

    .stats-roi .stats-footer {
        border-top: 1px solid rgba(255, 215, 0, 0.2);
        color: #B8860B;
    }

    /* Level Bonus Card - Emerald Theme */
    .stats-level {
        border-left-color: #10B981;
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    }

    .stats-level .stats-icon {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }

    .stats-level .stats-value {
        color: #047857;
    }

    .stats-level .stats-label {
        color: #065F46;
    }

    .stats-level .stats-footer {
        border-top: 1px solid rgba(16, 185, 129, 0.2);
        color: #047857;
    }

    /* Royalty Income Card - Purple Theme */
    .stats-royalty {
        border-left-color: #8B5CF6;
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
    }

    .stats-royalty .stats-icon {
        background: linear-gradient(135deg, #8B5CF6, #7C3AED);
        color: white;
        box-shadow: 0 4px 10px rgba(139, 92, 246, 0.3);
    }

    .stats-royalty .stats-value {
        color: #7C3AED;
    }

    .stats-royalty .stats-label {
        color: #6D28D9;
    }

    .stats-royalty .stats-footer {
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        color: #7C3AED;
    }

    /* Stats Icon */
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.1);
    }

    .stats-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stats-label {
        font-weight: 600;
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .stats-footer {
        margin-top: 15px;
        padding-top: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-footer {
        transform: translateX(5px);
    }
    
    /* Referral Card */
    .referral-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: linear-gradient(135deg, #fa709a  0%, #fee140 100%);
        color: white;
    }
    
    .referral-card .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1rem 1.25rem;
    }
    
    .referral-card .card-title {
        font-weight: 600;
        color: white;
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
        background: #343a40;
        border: none;
        color: white;
    }
    
    .referral-info {
        padding: 1rem 0;
    }
    
    .referral-icon {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1rem;
    }
    
    /* User Info Card */
    .user-info-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: linear-gradient(135deg, #fa709a  0%, #fee140 100%);
        color: white;
    }
    
    .user-info-card .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1rem 1.25rem;
    }
    
    .user-info-card .card-title {
        font-weight: 600;
        color: white;
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
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }
    
    /* Stat Tiles - Colorful variants */
    .stat-tile {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .stat-tile:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    
    .tile-primary {
        background: rgba(255, 255, 255, 0.15);
    }
    
    .tile-success {
        background: rgba(255, 255, 255, 0.15);
    }
    
    .tile-info {
        background: rgba(255, 255, 255, 0.15);
    }
    
    .tile-warning {
        background: rgba(255, 255, 255, 0.15);
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
        background: rgba(255, 255, 255, 0.2);
    }
    
    .tile-value {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .tile-label {
        opacity: 0.9;
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
    .d-blocks {
    margin-bottom: 120px !important;
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
        
        .mb-10 {
            margin-bottom: 4rem !important;
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
    
    function copyReferralMobile() {
        let copyText = document.getElementById("url-mobile");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        // Show temporary feedback
        const btn = document.querySelector('#url-mobile').nextElementSibling;
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