@extends('member.layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
<div class="container">
    <div class="page-inner justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Withdraw Funds</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Current Balance:</strong> $<span id="currentBalance">{{ number_format(Auth::user()->wallet2, 2) }}</span>
                    </div>
                    
                    <form action="{{ route('member.transactions.withdraw.store') }}" method="POST" id="withdrawForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount to Withdraw ($)</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required
                                   max="{{ Auth::user()->wallet2 }}"
                                   placeholder="Enter withdrawal amount">
                            <div class="form-text text-muted">
                                Maximum withdrawal amount: $<span id="maxAmount">{{ number_format(Auth::user()->wallet2, 2) }}</span>
                            </div>
                            <div id="amountError" class="invalid-feedback d-none">
                                Withdrawal amount cannot exceed your current balance.
                            </div>
                            @error('amount')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Withdrawal Method</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                              
                                <option value="Cryptocurrency" {{ old('payment_method') == 'Cryptocurrency' ? 'selected' : '' }}>Cryptocurrency</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                       
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">Submit Withdrawal Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const amountError = document.getElementById('amountError');
    const submitBtn = document.getElementById('submitBtn');
    const maxAmount = parseFloat(amountInput.max);
    const form = document.getElementById('withdrawForm');
    
    // Real-time validation
    amountInput.addEventListener('input', function() {
        validateAmount();
    });
    
    amountInput.addEventListener('blur', function() {
        validateAmount();
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        if (!validateAmount()) {
            e.preventDefault();
            amountInput.focus();
        }
    });
    
    function validateAmount() {
        const amount = parseFloat(amountInput.value) || 0;
        
        // Clear previous states
        amountInput.classList.remove('is-invalid', 'is-valid');
        amountError.classList.add('d-none');
        submitBtn.disabled = false;
        
        // Validation checks
        if (amount <= 0) {
            amountInput.classList.add('is-invalid');
            amountError.textContent = 'Please enter a valid amount greater than 0.';
            amountError.classList.remove('d-none');
            submitBtn.disabled = true;
            return false;
        }
        
        if (amount > maxAmount) {
            amountInput.classList.add('is-invalid');
            amountError.textContent = `Withdrawal amount cannot exceed your current balance of $${maxAmount.toFixed(2)}.`;
            amountError.classList.remove('d-none');
            submitBtn.disabled = true;
            return false;
        }
        
        // If amount is valid
        amountInput.classList.add('is-valid');
        return true;
    }
    
    // Auto-correct if user enters more than max amount
    amountInput.addEventListener('change', function() {
        const amount = parseFloat(this.value) || 0;
        if (amount > maxAmount) {
            this.value = maxAmount.toFixed(2);
            validateAmount();
        }
    });
    
    // Prevent entering values beyond max
    amountInput.addEventListener('keydown', function(e) {
        // Allow: backspace, delete, tab, escape, enter, decimal point
        if ([46, 8, 9, 27, 13, 110, 190].includes(e.keyCode) ||
            // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
            (e.keyCode === 65 && e.ctrlKey === true) ||
            (e.keyCode === 67 && e.ctrlKey === true) ||
            (e.keyCode === 86 && e.ctrlKey === true) ||
            (e.keyCode === 88 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        
        // Ensure that it is a number and stop the keypress if not
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>

<style>
.is-valid {
    border-color: #198754 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.is-invalid {
    border-color: #dc3545 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.4.4-.4'/%3e%3cpath d='M6 7v1'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>
@endsection