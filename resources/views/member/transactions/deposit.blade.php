@extends('member.layouts.app')

@section('title', 'Deposit Funds')

@section('content')
<div class="container mb-5">
    <div class="page-inner row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm rounded-4 mb-5">
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0"><i class="material-icons me-2"></i>Deposit Funds</h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('member.transactions.deposit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Amount Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="form-label fw-semibold">Amount ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">$</span>
                                        <input type="number" step="0.01" min="1" class="form-control @error('amount') is-invalid @enderror" 
                                               id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter amount" required>
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                                    <select class="form-select @error('payment_method') is-invalid @enderror" 
                                            id="payment_method" name="payment_method" required>
                                       
                                        <option value="Cryptocurrency" {{ old('payment_method') == 'Cryptocurrency' ? 'selected' : '' }}>Cryptocurrency</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Reference ID Field -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="reference_id" class="form-label fw-semibold">Reference/Transaction ID</label>
                                    <input type="text" class="form-control @error('reference_id') is-invalid @enderror" 
                                           id="reference_id" name="reference_id" value="{{ old('reference_id') }}" 
                                           placeholder="Enter your transaction reference ID" required>
                                    @error('reference_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Screenshot Upload Field -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="screenshot" class="form-label fw-semibold">Payment Proof (Screenshot)</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="form-control @error('screenshot') is-invalid @enderror" 
                                               id="screenshot" name="screenshot" accept="image/*" required>
                                        <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 5MB</div>
                                        @error('screenshot')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Instructions -->
                            <div class="col-12">
                                <div class="payment-instructions bg-light p-4 rounded-3">
                                    <h6 class="fw-semibold mb-3"><i class="material-icons me-2">info</i>Payment Instructions</h6>
                                    <p class="text-muted mb-2">
                                        Scan & Pay using the QR Code below and upload the payment screenshot.
                                    </p>
                                    
                                    <!-- QR Code Placeholder -->
                                    <div class="text-center mt-3">
                                        <div class="qr-code-placeholder mx-auto bg-white p-3 rounded-3 shadow-sm" style="max-width: 200px;">
                                            <img src="{{asset('images/dep.jpeg')}}" 
                                                 alt="QR Code" class="img-fluid">
                                        </div>
                                        <p class="small text-muted mt-3">
                                            Your screenshot should clearly show transaction details, amount, and reference ID.
                                        </p>
                                    </div>
                                    <!-- Wallet Address Copy -->
                                <div class="mt-3 text-center">
                                    <input type="text"
                                        id="walletAddress"
                                        class="form-control text-center fw-semibold"
                                        value="0x54Cc65c6B4e16ef2e8B23729058CF4245b262046"
                                        readonly
                                        onclick="copyWalletAddress()">
        
                                    <small class="text-muted d-block mt-1">
                                        Click to copy wallet address
                                    </small>
                                </div>
        <!-- Copy Toast -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ✅ Wallet address copied!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-semibold">
                                <i class="material-icons me-2"></i>Submit Deposit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function copyWalletAddress() {
    const input = document.getElementById('walletAddress');
    input.select();
    input.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(input.value).then(() => {
        const toastEl = document.getElementById('copyToast');
        const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
        toast.show();
    });
}
</script>

<style>
    #walletAddress {
    cursor: pointer;
    background-color: #f8f9fa;
    border: 1px dashed #ced4da;
}

#walletAddress:focus {
    outline: none;
    box-shadow: none;
    border-color: #0d6efd;
}

    .mb-5 {
        margin-bottom: 6rem !important;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .form-label {
        margin-bottom: 0.5rem;
        color: #495057;
    }
    
    .form-control, .form-select {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        transition: all 0.2s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-radius: 0.5rem 0 0 0.5rem;
    }
    
    .payment-instructions {
        border-left: 4px solid #0d6efd;
    }
    
    .file-upload-wrapper {
        position: relative;
    }
    
    .file-upload-wrapper .form-control {
        padding: 0.75rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
    }
    
    .qr-code-placeholder {
        border: 1px dashed #dee2e6;
    }
    
    .material-icons {
        vertical-align: middle;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1rem;
        }
    }
</style>
@endsection