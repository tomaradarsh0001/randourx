@extends('member.layouts.app')

@section('title', 'Deposit Funds')

@section('content')
<div class="container mb-5"><!-- margin bottom -->
    <div class="page-inner row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm rounded-3 mb-5"><!-- margin bottom on card too -->
                <div class="card-header">
                    <h4 class="mb-0">Deposit Funds</h4>
                </div>
                <!-- scrollable area -->
                <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                    <form action="{{ route('member.transactions.deposit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Amount ($)</label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror" 
                                        id="payment_method" name="payment_method" required>
                                    <option value="">Select</option>
                                    <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="PayPal" {{ old('payment_method') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="Cryptocurrency" {{ old('payment_method') == 'Cryptocurrency' ? 'selected' : '' }}>Cryptocurrency</option>
                                    <option value="Other" {{ old('payment_method') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="reference_id" class="form-label">Reference/Transaction ID</label>
                                <input type="text" class="form-control @error('reference_id') is-invalid @enderror" 
                                       id="reference_id" name="reference_id" value="{{ old('reference_id') }}" required>
                                @error('reference_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="screenshot" class="form-label">Payment Proof (Screenshot)</label>
                                <input type="file" class="form-control @error('screenshot') is-invalid @enderror" 
                                       id="screenshot" name="screenshot" accept="image/*" required>
                                @error('screenshot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <p class="text-muted small mt-1">
                                    Upload a screenshot of your payment confirmation. Supported formats: JPG, PNG, GIF. Max size: 2MB
                                </p>
                                
                                <!-- Example proof -->
                                <div class="border p-3 text-center bg-light rounded mb-3">
                                    <h6 class="text-muted">Example Payment Proof</h6>
                                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGRvbWluYW50LWJhc2VsaW5lPSJtaWRkbGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZvbnQtZmFtaWx5PSJtb25vc3BhY2UiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5OTkiPlBBWU1FTlQgUFJPT0Y8L3RleHQ+PC9zdmc+" 
                                         alt="Payment Proof Example" class="img-fluid mt-2" style="max-height: 150px;">
                                    <p class="small text-muted mt-2">Your screenshot should show transaction details, amount, and reference ID clearly</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Deposit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
