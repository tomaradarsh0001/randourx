<!-- resources/views/my-account.blade.php -->
@extends('member.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <div class="page-inner row justify-content-center">
        <div class="col-md-8">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="h2 font-weight-bold text-dark mb-2">My Account</h1>
                <p class="text-muted">Manage your wallet address and account details</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Wallet Address Card -->
            <div class="card shadow-sm border-0 margin54">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-wallet fa-lg mr-3"></i>
                        <h4 class="mb-0 font-weight-semibold">Wallet Address</h4>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="card-body p-4">
                    @if($user->wallet_address)
                        <!-- Display Wallet Address (Read-only) -->
                        <div class="space-y-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2 fa-lg"></i>
                                    <span class="text-success font-weight-bold">Wallet Address Saved</span>
                                </div>
                                <span class="badge badge-success badge-pill py-2 px-3">
                                    Verified
                                </span>
                            </div>
                            
                            <div class="bg-light rounded p-3 border">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div class="d-flex align-items-center mb-2 mb-md-0 w-100">
                                        <i class="fas fa-key text-muted mr-3 flex-shrink-0"></i>
                                        <div class="wallet-address-container w-100">
                                            <!-- Truncated display -->
                                            <code class="text-dark font-monospace small wallet-address" 
                                                  id="walletDisplay"
                                                  data-full-address="{{ $user->wallet_address }}">
                                                {{ Str::length($user->wallet_address) > 15 ? Str::substr($user->wallet_address, 0, 15) . '...' : $user->wallet_address }}
                                            </code>
                                            <!-- Full address (hidden by default) -->
                                            <code class="text-dark font-monospace small wallet-address d-none" 
                                                  id="walletFull">
                                                {{ $user->wallet_address }}
                                            </code>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-2 mt-md-0 flex-shrink-0">
                                        <button 
                                            onclick="toggleWalletAddress()"
                                            class="btn btn-sm btn-outline-secondary d-flex align-items-center"
                                            id="toggleBtn"
                                            title="Toggle full address"
                                        >
                                            <i class="fas fa-eye mr-1"></i>
                                            <span class="d-none d-sm-inline">Show</span>
                                        </button>
                                        <button 
                                            onclick="copyToClipboard('{{ $user->wallet_address }}')"
                                            class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                        >
                                            <i class="fas fa-copy mr-1"></i>
                                            <span class="d-none d-sm-inline">Copy</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-muted small mt-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Your wallet address is set and cannot be modified for security reasons.
                            </p>
                        </div>
                    @else
                        <!-- Wallet Address Form -->
                        <form action="{{ route('wallet.update') }}" method="POST" id="walletForm">
                            @csrf
                            
                            <div class="form-group">
                                <label for="wallet_address" class="font-weight-bold text-dark">
                                    <i class="fas fa-key mr-2 text-muted"></i>
                                    Crypto Wallet Address
                                </label>
                                
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        id="wallet_address"
                                        name="wallet_address"
                                        value="{{ old('wallet_address') }}"
                                        placeholder="Enter your wallet address..."
                                        class="form-control form-control-lg font-monospace @error('wallet_address') is-invalid @enderror"
                                        required
                                        minlength="1"
                                        maxlength="255"
                                    />
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-wallet text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                @error('wallet_address')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                <small class="form-text text-muted mt-2">
                                    Enter your cryptocurrency wallet address. This can be any valid wallet address and can only be set once.
                                </small>
                                
                                <!-- Character Counter -->
                                <div class="mt-1">
                                    <small class="text-muted">
                                        <span id="charCount">0</span>/255 characters
                                    </small>
                                </div>
                            </div>

                            <div class="alert alert-info mt-4">
                                <div class="d-flex">
                                    <i class="fas fa-exclamation-circle fa-lg mr-3 mt-1 text-primary"></i>
                                    <div>
                                        <strong class="d-block">Important:</strong>
                                        This address will be used for all cryptocurrency transactions and cannot be modified once saved. Please double-check the address before submitting.
                                    </div>
                                </div>
                            </div>

                            <button 
                                type="submit"
                                id="submitBtn"
                                class="btn btn-primary btn-lg btn-block mt-4 py-3 font-weight-bold"
                            >
                                <i class="fas fa-save mr-2"></i>
                                Save Wallet Address
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Supported Wallets Card -->
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-dark mb-3">
                        <i class="fas fa-coins mr-2 text-muted"></i>
                        Supported Wallet Types
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="text-warning mr-2 mt-1"></i><img src="{{ asset('images/usdt.png')}}" height="20px" width="20px"></img>
                                    <span class="text-muted">&nbsp; USDT BEP-20</span>
                                </li>
                               
                            </ul>
                        </div>
                       
                    </div>
                </div>
            </div>

        
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalHtml = button.innerHTML;
        button.innerHTML = `
            <i class="fas fa-check mr-1"></i>
            <span class="d-none d-sm-inline">Copied!</span>
        `;
        button.classList.remove('btn-outline-primary');
        button.classList.add('btn-success');
        
        setTimeout(() => {
            button.innerHTML = originalHtml;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-primary');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
        alert('Failed to copy to clipboard. Please copy manually.');
    });
}

// Toggle between truncated and full wallet address
function toggleWalletAddress() {
    const displayElement = document.getElementById('walletDisplay');
    const fullElement = document.getElementById('walletFull');
    const toggleBtn = document.getElementById('toggleBtn');
    
    if (displayElement.classList.contains('d-none')) {
        // Show truncated
        displayElement.classList.remove('d-none');
        fullElement.classList.add('d-none');
        toggleBtn.innerHTML = '<i class="fas fa-eye mr-1"></i><span class="d-none d-sm-inline">Show</span>';
        toggleBtn.title = "Show full address";
    } else {
        // Show full
        displayElement.classList.add('d-none');
        fullElement.classList.remove('d-none');
        toggleBtn.innerHTML = '<i class="fas fa-eye-slash mr-1"></i><span class="d-none d-sm-inline">Hide</span>';
        toggleBtn.title = "Hide full address";
    }
}

// Character counter and validation
document.addEventListener('DOMContentLoaded', function() {
    const walletInput = document.getElementById('wallet_address');
    const charCount = document.getElementById('charCount');
    const submitBtn = document.getElementById('submitBtn');
    
    if (walletInput && charCount) {
        // Initialize character count
        charCount.textContent = walletInput.value.length;
        
        // Update character count on input
        walletInput.addEventListener('input', function(e) {
            const value = e.target.value;
            const length = value.length;
            
            // Update character count
            charCount.textContent = length;
            
            // Update color based on length
            if (length === 0) {
                charCount.className = 'text-muted';
            } else if (length > 0 && length <= 255) {
                charCount.className = 'text-success';
            } else {
                charCount.className = 'text-danger';
            }
            
            // Validate input
            validateWalletAddress(value);
        });
        
        // Form submission validation
        const form = document.getElementById('walletForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const value = walletInput.value.trim();
                if (!validateWalletAddress(value, true)) {
                    e.preventDefault();
                }
            });
        }
    }
    
    // Auto-truncate long wallet addresses in display mode
    const walletDisplay = document.getElementById('walletDisplay');
    if (walletDisplay) {
        const fullAddress = walletDisplay.getAttribute('data-full-address');
        if (fullAddress && fullAddress.length > 15) {
            walletDisplay.textContent = fullAddress.substring(0, 15) + '...';
        }
    }
    
    function validateWalletAddress(value, showAlert = false) {
        const trimmedValue = value.trim();
        
        // Basic validation - just check length
        if (trimmedValue.length === 0) {
            if (showAlert) {
                showValidationError('Please enter a wallet address.');
            }
            return false;
        }
        
        if (trimmedValue.length > 255) {
            if (showAlert) {
                showValidationError('Wallet address must not exceed 255 characters.');
            }
            return false;
        }
        
        // If we reach here, validation passed
        clearValidationError();
        return true;
    }
    
    function showValidationError(message) {
        // Remove any existing error alerts
        clearValidationError();
        
        // Create error alert
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger alert-dismissible fade show mt-3';
        errorAlert.innerHTML = `
            <i class="fas fa-exclamation-triangle mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
        
        // Insert after the form
        const form = document.getElementById('walletForm');
        form.parentNode.insertBefore(errorAlert, form.nextSibling);
    }
    
    function clearValidationError() {
        const existingAlerts = document.querySelectorAll('.alert-danger');
        existingAlerts.forEach(alert => {
            if (alert.textContent.includes('Wallet address must not exceed') || 
                alert.textContent.includes('Please enter a wallet address')) {
                alert.remove();
            }
        });
    }
});
</script>

<style>
.card {
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border-bottom: none;
}

.btn {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.form-control {
    border-radius: 8px;
    border: 1px solid #e1e5e9;
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    border-color: #007bff;
}

.alert {
    border-radius: 10px;
    border: none;
}

.badge {
    font-size: 0.75rem;
}
.margin54{
    margin-bottom: 0.5rem !important;
}

.font-monospace {
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
}

/* Wallet address container for mobile responsiveness */
.wallet-address-container {
    min-width: 0; /* Important for text overflow */
}

.wallet-address {
    word-break: break-all;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    max-width: 100%;
    display: block;
    line-height: 1.4;
}

/* Custom scrollbar for code elements */
code {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

code::-webkit-scrollbar {
    height: 4px;
}

code::-webkit-scrollbar-track {
    background: #f7fafc;
    border-radius: 2px;
}

code::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 2px;
}

code::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Gradient background for card header */
.card-header.bg-primary {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%) !important;
}

/* Input group styling */
.input-group-text {
    border-radius: 0 8px 8px 0;
    border-left: none;
}

.form-control:focus + .input-group-append .input-group-text {
    border-color: #007bff;
}

/* Crypto icon colors */
.text-orange {
    color: #ff6b35 !important;
}

.text-purple {
    color: #6f42c1 !important;
}

.page-inner{
   margin-bottom: 90px;   
}

/* Wallet address display styling */
#walletDisplay, #walletFull {
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 4px 8px;
    border-radius: 4px;
    background: rgba(0, 0, 0, 0.02);
}

#walletDisplay:hover, #walletFull:hover {
    color: #007bff !important;
    background: rgba(0, 123, 255, 0.05);
}

.gap-2 {
    gap: 0.5rem;
}

/* Mobile-specific styles */
@media (max-width: 767.98px) {
    .card-body {
        padding: 1rem !important;
    }
    
    .wallet-address {
        font-size: 0.8rem;
        padding: 6px 8px;
    }
    
    .btn-sm {
        padding: 0.375rem 0.5rem;
        font-size: 0.775rem;
    }
    
    /* Ensure buttons stack properly on mobile */
    .d-flex.gap-2 {
        width: 100%;
        justify-content: flex-end;
    }
    
    /* Adjust layout for mobile */
    .d-flex.flex-column.flex-md-row .wallet-address-container {
        margin-bottom: 0.5rem;
    }
}

/* Extra small devices */
@media (max-width: 575.98px) {
    .wallet-address {
        font-size: 0.75rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.375rem;
        font-size: 0.7rem;
    }
    
    /* Make buttons icon-only on very small screens */
    .btn-sm span.d-none.d-sm-inline {
        display: none !important;
    }
    
    .btn-sm i {
        margin-right: 0 !important;
    }
}

/* Ensure proper text breaking on all devices */
.wallet-address {
    white-space: normal !important;
}

/* Add smooth transitions */
.wallet-address {
    transition: all 0.3s ease;
}
</style>

<!-- Add Font Awesome for crypto icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection