@extends('member.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <h1 class="h3 mb-0">Profile Settings</h1>
                    <p class="text-muted mb-0">Manage your account information and security</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Information Card -->
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-id-card me-2"></i>
                        <h5 class="card-title mb-0">Personal Information</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-warning text-dark py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock me-2"></i>
                        <h5 class="card-title mb-0">Security Settings</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Actions Card -->
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-danger text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <h5 class="card-title mb-0">Account Actions</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section (Optional decorative element) -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light border-0 rounded-3">
                <div class="card-body py-4">
                    <div class="row text-center g-3">
                        <div class="col-6 col-md-3">
                            <div class="p-3">
                                <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                                <h4 class="fw-bold text-primary">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('M Y') }}</h4>
                                <p class="text-muted mb-0">Member Since</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3">
                                <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                <h4 class="fw-bold text-info">{{ \Carbon\Carbon::parse(auth()->user()->last_login_at ?? auth()->user()->created_at)->diffForHumans() }}</h4>
                                <p class="text-muted mb-0">Last Active</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3">
                                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                                <h4 class="fw-bold text-success">Active</h4>
                                <p class="text-muted mb-0">Account Status</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3">
                                <i class="fas fa-user-check fa-2x text-warning mb-2"></i>
                                <h4 class="fw-bold text-warning">Verified</h4>
                                <p class="text-muted mb-0">Profile Status</p>
                            </div>
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
    /* Custom Styles for Enhanced Appearance */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .card-header {
        border-bottom: none;
        font-weight: 600;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        font-weight: 500;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        border: none;
        font-weight: 500;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        border: none;
        font-weight: 500;
    }
    
    .bg-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
    }
    
    .bg-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
    }
    
    .bg-danger {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%) !important;
    }
    
    /* Mobile-specific adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 1.25rem !important;
        }
        
        .h3 {
            font-size: 1.5rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .btn-group .btn {
            width: auto;
        }
        
        /* Improve form spacing on mobile */
        .max-w-xl {
            max-width: 100% !important;
        }
        
        /* Adjust stats section for mobile */
        .col-6 {
            margin-bottom: 15px;
        }
        
        .fa-2x {
            font-size: 1.5rem !important;
        }
        
        h4.fw-bold {
            font-size: 1.1rem;
        }
    }
    
    /* Animation for form sections */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .card {
        animation: fadeIn 0.5s ease-out;
    }
    
    /* Staggered animation for cards */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    
    /* Custom rounded elements */
    .rounded-3 {
        border-radius: 0.75rem !important;
    }
    
    /* Improve focus states for accessibility */
    .btn:focus, .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
</style>

<!-- Optional: Add some interactive JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Add confirmation for delete button
        const deleteButton = document.querySelector('button[type="submit"].btn-danger');
        if (deleteButton) {
            deleteButton.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        }
        
        // Add loading states to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
                    submitButton.disabled = true;
                }
            });
        });
    });
</script>
@endsection