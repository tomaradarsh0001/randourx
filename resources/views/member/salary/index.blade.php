@extends('member.layouts.app')

@section('title', 'Salary Income')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <h2>Salary Income Progress</h2>
            
            <div class="row">
                <!-- 30 Days Target -->
                <div class="col-md-4 mb-4">
                    <div class="card {{ $achieved30Days ? 'bg-success text-white' : ($expired30Days ? 'bg-light text-muted' : '') }} position-relative">
                        @if($expired30Days)
                        <div class="watermark-overlay">
                            <div class="watermark-text">EXPIRED</div>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">30 Days Target</h5>
                            <h6 class="card-subtitle mb-2">$2,500</h6>
                            <p class="card-text">
                                @if($achieved30Days)
                                <span class="badge bg-light text-success">Achieved!</span>
                                @elseif($expired30Days)
                                <span class="badge bg-danger">Expired</span>
                                @else
                                <span class="badge bg-info">Days left: {{ $daysTo30Target }}</span>
                                @endif
                            </p>
                            <div class="progress mb-3">
                                <div class="progress-bar {{ $expired30Days ? 'bg-secondary' : '' }}" 
                                    role="progressbar" style="width: {{ $progress30 }}%;" 
                                    aria-valuenow="{{ $progress30 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($progress30) }}%
                                </div>
                            </div>
                            <p class="card-text">
                                Current: ${{ number_format($totalBusinessDownline, 2) }}
                                @if($achieved30Days)
                                <br><strong>Reward: 4% Generated</strong>
                                @elseif($expired30Days)
                                <br><small class="text-danger">You missed this salary opportunity</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- 60 Days Target -->
                <div class="col-md-4 mb-4">
                    <div class="card {{ $achieved60Days ? 'bg-success text-white' : ($expired60Days ? 'bg-light text-muted' : '') }} position-relative">
                        @if($expired60Days)
                        <div class="watermark-overlay">
                            <div class="watermark-text">EXPIRED</div>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">60 Days Target</h5>
                            <h6 class="card-subtitle mb-2">$5,000</h6>
                            <p class="card-text">
                                @if($achieved60Days)
                                <span class="badge bg-light text-success">Achieved!</span>
                                @elseif($expired60Days)
                                <span class="badge bg-danger">Expired</span>
                                @else
                                <span class="badge bg-info">Days left: {{ $daysTo60Target }}</span>
                                @endif
                            </p>
                            <div class="progress mb-3">
                                <div class="progress-bar {{ $expired60Days ? 'bg-secondary' : '' }}" 
                                    role="progressbar" style="width: {{ $progress60 }}%;" 
                                    aria-valuenow="{{ $progress60 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($progress60) }}%
                                </div>
                            </div>
                            <p class="card-text">
                                Current: ${{ number_format($totalBusinessDownline, 2) }}
                                @if($achieved60Days)
                                <br><strong>Reward: 10% Generated</strong>
                                @elseif($expired60Days)
                                <br><small class="text-danger">You missed this salary opportunity</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- 90 Days Target -->
                <div class="col-md-4 mb-4">
                    <div class="card {{ $achieved90Days ? 'bg-success text-white' : ($expired90Days ? 'bg-light text-muted' : '') }} position-relative">
                        @if($expired90Days)
                        <div class="watermark-overlay">
                            <div class="watermark-text">EXPIRED</div>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">90 Days Target</h5>
                            <h6 class="card-subtitle mb-2">$10,000</h6>
                            <p class="card-text">
                                @if($achieved90Days)
                                <span class="badge bg-light text-success">Achieved!</span>
                                @elseif($expired90Days)
                                <span class="badge bg-danger">Expired</span>
                                @else
                                <span class="badge bg-info">Days left: {{ $daysTo90Target }}</span>
                                @endif
                            </p>
                            <div class="progress mb-3">
                                <div class="progress-bar {{ $expired90Days ? 'bg-secondary' : '' }}" 
                                    role="progressbar" style="width: {{ $progress90 }}%;" 
                                    aria-valuenow="{{ $progress90 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($progress90) }}%
                                </div>
                            </div>
                            <p class="card-text">
                                Current: ${{ number_format($totalBusinessDownline, 2) }}
                                @if($achieved90Days)
                                <br><strong>Reward: 16% Generated</strong>
                                @elseif($expired90Days)
                                <br><small class="text-danger">You missed this salary opportunity</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CSS for Watermark -->
            <style>
                .watermark-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(255, 255, 255, 0.43);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 10;
                }
                .watermark-text {
                    transform: rotate(-45deg);
                    font-size: 3rem;
                    font-weight: bold;
                    color: rgba(220, 53, 69, 0.3);
                    text-transform: uppercase;
                    letter-spacing: 5px;
                }
                .position-relative {
                    position: relative;
                }
                .mb-8{
                    margin-bottom: 8rem !important;
                }
            </style>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-8">
                        <div class="card-header">
                            <h5>Salary Income Details</h5>
                        </div>
                        <div class="card-body">
                            <p>Your total downline business: <strong>${{ number_format($totalBusinessDownline, 2) }}</strong></p>
                            <p>Your direct referrals: <strong>{{ $level1Count }}</strong></p>
                            <p>Total downline members: <strong>{{ $downlineCount }}</strong></p>
                            
                            @if($expired30Days || $expired60Days || $expired90Days)
                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation-triangle"></i> 
                                Some salary opportunities have expired. Focus on the remaining targets!
                            </div>
                            @endif
                            
                            <h6>How it works:</h6>
                            <ul>
                                <li>Reach $2,500 in downline business within 30 days to qualify for 4% salary income</li>
                                <li>Reach $5,000 in downline business within 60 days to qualify for 10% salary income</li>
                                <li>Reach $10,000 in downline business within 90 days to qualify for 16% salary income</li>
                                <li>After reaching each target, you need to add one more direct referral</li>
                                <li><strong class="text-danger">Expired targets cannot be reactivated</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection