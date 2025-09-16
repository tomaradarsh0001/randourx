@extends('member.layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Withdraw Funds</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Current Balance:</strong> ${{ number_format(Auth::user()->wallet1, 2) }}
                    </div>
                    
                    <form action="{{ route('member.transactions.withdraw.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount to Withdraw ($)</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required
                                   max="{{ Auth::user()->wallet1 }}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Withdrawal Method</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="">Select Withdrawal Method</option>
                                <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="PayPal" {{ old('payment_method') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                                <option value="Cryptocurrency" {{ old('payment_method') == 'Cryptocurrency' ? 'selected' : '' }}>Cryptocurrency</option>
                                <option value="Other" {{ old('payment_method') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="account_details" class="form-label">Account Details</label>
                            <textarea class="form-control @error('account_details') is-invalid @enderror" 
                                      id="account_details" name="account_details" rows="3" required
                                      placeholder="Enter your account details for withdrawal (account number, PayPal email, crypto address, etc.)">{{ old('account_details') }}</textarea>
                            @error('account_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Withdrawal Request</button>
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
    const maxAmount = parseFloat(amountInput.max);
    
    amountInput.addEventListener('input', function() {
        if (parseFloat(this.value) > maxAmount) {
            this.value = maxAmount;
        }
    });
});
</script>
@endsection