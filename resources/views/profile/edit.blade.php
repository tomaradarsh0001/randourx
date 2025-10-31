@extends('member.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="page-inner row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <h1 class="h3 mb-0">My Profile</h1>
                    <p class="text-muted mb-0">View your account information</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Profile Information Card -->
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-id-card me-2"></i>
                        <h5 class="card-title mb-0 text-white">Personal Information</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                      <!-- Username -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user text-primary me-2"></i>
                            <label class="form-label fw-semibold text-muted mb-0">Username</label>
                        </div>
                        <div class="p-3 bg-light rounded-2 border">
                            <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->username ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    <!-- Full Name -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            <label class="form-label fw-semibold text-muted mb-0">Full Name</label>
                        </div>
                        <div class="p-3 bg-light rounded-2 border">
                            <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->full_name ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <label class="form-label fw-semibold text-muted mb-0">Email Address</label>
                        </div>
                        <div class="p-3 bg-light rounded-2 border">
                            <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <label class="form-label fw-semibold text-muted mb-0">Phone Number</label>
                        </div>
                        <div class="p-3 bg-light rounded-2 border">
                            <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->mobile ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <!-- Member Since -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-calendar-plus text-primary me-2"></i>
                            <label class="form-label fw-semibold text-muted mb-0">Member Since</label>
                        </div>
                        <div class="p-3 bg-light rounded-2 border">
                            <p class="mb-0 fw-semibold text-dark">
                                {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('F j, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Material UI Inspired Styles */
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    
    .card-header {
        border-bottom: none;
        font-weight: 600;
        background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
    }
    
    .bg-primary {
        background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%) !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
        transition: background-color 0.3s ease;
    }
    
    .bg-light:hover {
        background-color: #e9ecef !important;
    }
    
    .rounded-3 {
        border-radius: 12px !important;
    }
    
    .rounded-2 {
        border-radius: 8px !important;
    }
    
    /* Typography */
    .h3 {
        font-weight: 500;
        color: #1976d2;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
    
    .fw-semibold {
        font-weight: 500;
    }
    
    /* Icon styling */
    .fa-user, .fa-id-card, .fa-user-circle, .fa-envelope, .fa-phone, .fa-calendar-plus {
        font-size: 1.1em;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 1.25rem !important;
        }
        
        .h3 {
            font-size: 1.5rem;
        }
        
        .p-3 {
            padding: 0.75rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1rem !important;
        }
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card {
        animation: fadeInUp 0.6s ease-out;
    }
    
    /* Material Design inspired shadows */
    .shadow-lg {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    }
</style>
@endsection