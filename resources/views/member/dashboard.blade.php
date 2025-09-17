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
                <a href="rank-income" class="animated-card-link card-link">
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
        
        <div class="row" style="margin-bottom: 50px;">
            <!-- Referral Link Card -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 align-self-stretch pb-5">
                <div class="card text-center p-4 card-secondary bg-info-gradient h-100">
                    <div class="card-body skew-shadow d-flex flex-column justify-content-between">
                        <div class="row align-items-center">
                            <div class="col-8 col-md-6 col-xl-6">
                                <div class="form-group form-floating is-valid mb-1 mt-4">
                                    <input type="text" class="form-control" id="url" placeholder="Referral Link" value="https://randour-x.com?username" readonly>
                                    <label class="form-control-label text-dark" for="url">Referral Link</label>
                                    <button type="button" class="text-color-theme tooltip-btn" onclick="geturl()">
                                        <i class="bi bi-files p-3"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4 col-md-3 col-xl-3 ps-0">
                                <img src="{{ asset('assets/img/linkcopy.png') }}" height="70" alt="Copy Link" class="mw-100">
                            </div>
                        </div>
                        <div class="mt-auto">
                            <p class="text-white fw-bold mb-3">
                                Invite your friends and earn rewards! Share your referral link and let them join 
                                Randour-x. The more you refer, the more you earn!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 align-self-stretch pb-5">
                <div class="card text-center p-4 card-secondary bg-info-gradient h-100">
                    <div class="card-body skew-shadow d-flex flex-column justify-content-between">
                        <!-- User Info Row -->
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="me-2">
                                <img src="{{ asset('imagess/logorandour.png') }}" class="img-fluid" style="width: 150px; height: 50px;" alt="User Logo">
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0 text-white"><b>UserID : </b> 'username'</h6>
                                <small class="text-white"><b>SponsorID : </b> 'sponsername'</small>
                            </div>
                        </div>

                        <!-- Stats Section -->
                        <div class="row text-center mt-3">
                            <div class="col-md-6">
                                <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                    <h6>Total Sponsored <i class="bi bi-person"></i></h6>
                                    <p class="fw-bold">4</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                    <h6>Active Sponsored <i class="bi bi-person"></i></h6>
                                    <p class="fw-bold">7</p>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-3">
                            <div class="col-md-6">
                                <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                    <h6>Total Downline BV <i class="bi bi-bar-chart"></i></h6>
                                    <p class="fw-bold">54</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                    <h6>Total Downline <i class="bi bi-people"></i></h6>
                                    <p class="fw-bold"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
