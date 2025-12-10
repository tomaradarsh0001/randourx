@extends('member.layouts.app')

@section('title', 'Fund Transfer')

@section('content')
<div class="container">
    <div class="row justify-content-center page-inner">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Transfer Funds</h5>
                    <small class="text-muted">Available Balance: $<span id="wallet-balance">{{ number_format(auth()->user()->wallet1, 2) }}</span></small>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('transfer.execute') }}" id="transfer-form">
                        @csrf

                        <div class="form-group">
                            <label for="to_username">Transfer To (Username)</label>
                            <input type="text" 
                                   name="to_username" 
                                   id="to_username" 
                                   class="form-control"
                                   placeholder="Enter username"
                                   required
                                   autocomplete="off">
                            <input type="hidden" name="to_user_id" id="to_user_id">
                            
                            <div id="user-validation-result" class="mt-2" style="display: none;">
                                <span id="validation-icon" class="mr-1"></span>
                                <span id="validation-message"></span>
                            </div>
                            <div id="username-suggestions" class="list-group mt-1" style="display: none; position: absolute; z-index: 1000; width: 100%;"></div>
                        </div>

                        <div class="form-group">
                            <label for="wallet_type">Wallet Type</label>
                            <select name="wallet_type" id="wallet_type" class="form-control" required readonly>
                                <option value="wallet1">Wallet 1 - ${{ number_format(auth()->user()->wallet1, 2) }}</option>
                            </select>
                            <small class="form-text text-muted">Currently only Wallet 1 transfers are supported</small>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" 
                                   step="0.01" 
                                   min="0.01" 
                                   name="amount" 
                                   id="amount" 
                                   class="form-control"
                                   placeholder="Enter amount"
                                   required>
                            <div id="amount-validation" class="mt-2" style="display: none;">
                                <span id="amount-icon" class="mr-1"></span>
                                <span id="amount-message"></span>
                            </div>
                            <small class="form-text text-muted">
                                Maximum transferable: $<span id="max-amount">{{ number_format(auth()->user()->wallet1, 2) }}</span>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description (Optional)</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Optional description for this transfer"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit-btn" disabled>
                            <span id="btn-text">Transfer Funds</span>
                            <span id="btn-loading" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i> Processing...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .validation-valid {
        color: #28a745;
        font-weight: 500;
    }
    .validation-invalid {
        color: #dc3545;
        font-weight: 500;
    }
    .validation-loading {
        color: #ffc107;
        font-weight: 500;
    }
    #username-suggestions {
        max-height: 200px;
        overflow-y: auto;
    }
    .suggestion-item {
        cursor: pointer;
        padding: 8px 12px;
    }
    .suggestion-item:hover {
        background-color: #f8f9fa;
    }
    #submit-btn:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentBalance = {{ auth()->user()->wallet1 }};
    let isValidUser = false;
    let isValidAmount = false;
    let debounceTimer;

    // Real-time username validation with debounce
    $('#to_username').on('input', function() {
        clearTimeout(debounceTimer);
        const username = $(this).val().trim();
        
        if (username.length < 2) {
            hideValidation();
            hideSuggestions();
            return;
        }

        showLoading();
        
        debounceTimer = setTimeout(() => {
            validateUsername(username);
            if (username.length >= 2) {
                searchUsers(username);
            }
        }, 500);
    });

    // Amount validation
    $('#amount').on('input', function() {
        validateAmount();
    });

    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#username-suggestions').length && !$(e.target).is('#to_username')) {
            hideSuggestions();
        }
    });

    function validateUsername(username) {
        $.ajax({
            url: '{{ route("user.validate") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                username: username
            },
            success: function(response) {
                if (response.exists) {
                    showValidUser(response.user.name, response.user.email);
                    $('#to_user_id').val(response.user.id);
                    isValidUser = true;
                } else {
                    showInvalidUser('User not found');
                    $('#to_user_id').val('');
                    isValidUser = false;
                }
                checkFormValidity();
            },
            error: function() {
                showInvalidUser('Error validating user');
                isValidUser = false;
                checkFormValidity();
            }
        });
    }

    function searchUsers(query) {
        $.ajax({
            url: '{{ route("user.search") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                query: query
            },
            success: function(response) {
                showSuggestions(response.users);
            }
        });
    }

    function validateAmount() {
        const amount = parseFloat($('#amount').val()) || 0;
        const maxAmount = currentBalance;
        
        if (amount <= 0) {
            hideAmountValidation();
            isValidAmount = false;
        } else if (amount > maxAmount) {
            showInvalidAmount('Amount exceeds available balance');
            isValidAmount = false;
        } else {
            showValidAmount('Amount is valid');
            isValidAmount = true;
        }
        
        checkFormValidity();
    }

    function showValidUser(name, email) {
        $('#user-validation-result').show().removeClass('validation-invalid').addClass('validation-valid');
        $('#validation-icon').html('<i class="fas fa-check-circle"></i>');
        $('#validation-message').text(`Verified:  (${email})`);
    }

    function showInvalidUser(message) {
        $('#user-validation-result').show().removeClass('validation-valid').addClass('validation-invalid');
        $('#validation-icon').html('<i class="fas fa-times-circle"></i>');
        $('#validation-message').text(message);
    }

    function showLoading() {
        $('#user-validation-result').show().removeClass('validation-valid validation-invalid').addClass('validation-loading');
        $('#validation-icon').html('<i class="fas fa-spinner fa-spin"></i>');
        $('#validation-message').text('Validating user...');
    }

    function hideValidation() {
        $('#user-validation-result').hide();
        $('#to_user_id').val('');
        isValidUser = false;
        checkFormValidity();
    }

    function showValidAmount(message) {
        $('#amount-validation').show().removeClass('validation-invalid').addClass('validation-valid');
        $('#amount-icon').html('<i class="fas fa-check-circle"></i>');
        $('#amount-message').text(message);
    }

    function showInvalidAmount(message) {
        $('#amount-validation').show().removeClass('validation-valid').addClass('validation-invalid');
        $('#amount-icon').html('<i class="fas fa-times-circle"></i>');
        $('#amount-message').text(message);
    }

    function hideAmountValidation() {
        $('#amount-validation').hide();
    }

    function showSuggestions(users) {
        const $suggestions = $('#username-suggestions');
        
        if (users.length === 0) {
            hideSuggestions();
            return;
        }

        let html = '';
        users.forEach(user => {
            html += `
                <div class="list-group-item suggestion-item" data-user-id="${user.id}" data-username="${user.name}">
                    <div class="d-flex justify-content-between">
                        <span>${user.name}</span>
                        <small class="text-muted">${user.email}</small>
                    </div>
                </div>
            `;
        });

        $suggestions.html(html).show();

        // Add click event to suggestions
        $('.suggestion-item').on('click', function() {
            const username = $(this).data('username');
            const userId = $(this).data('user-id');
            
            $('#to_username').val(username);
            $('#to_user_id').val(userId);
            hideSuggestions();
            validateUsername(username);
        });
    }

    function hideSuggestions() {
        $('#username-suggestions').hide();
    }

    function checkFormValidity() {
        if (isValidUser && isValidAmount) {
            $('#submit-btn').prop('disabled', false);
        } else {
            $('#submit-btn').prop('disabled', true);
        }
    }

    // Form submission
    $('#transfer-form').on('submit', function(e) {
        if (!isValidUser || !isValidAmount) {
            e.preventDefault();
            return false;
        }

        $('#btn-text').hide();
        $('#btn-loading').show();
        $('#submit-btn').prop('disabled', true);
    });
});
</script>
@endsection