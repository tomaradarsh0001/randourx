@extends('member.layouts.app')

@section('title', 'Forgot Password')

@section('content')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    .auth-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .auth-card:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .auth-title {
        font-size: 28px;
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .auth-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 600;
        color: #1976d2;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .option-card {
        border-left: 4px solid #1976d2;
        background-color: #f8fbff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .option-card.success {
        border-left-color: #28a745;
        background-color: #f8fff9;
    }

    .option-icon {
        font-size: 40px;
        color: #1976d2;
        margin-bottom: 15px;
    }

    .option-icon.success {
        color: #28a745;
    }

    .option-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .option-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .material-input {
        position: relative;
        margin-bottom: 20px;
    }

    .material-input input {
        padding-left: 45px;
        height: 48px;
        border-radius: 12px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .material-input input:focus {
        border-color: #1976d2;
        box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
    }

    .material-input .material-icons {
        position: absolute;
        top: 10px;
        left: 12px;
        font-size: 26px;
        color: #1976d2;
    }

    .btn-primary {
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 10px;
        background: #1976d2;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #1565c0;
        transform: translateY(-2px);
    }

    .btn-success {
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 10px;
        background: #28a745;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
    }

    .password-strength {
        height: 5px;
        margin-top: 5px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .password-weak {
        background-color: #dc3545;
        width: 25%;
    }

    .password-medium {
        background-color: #ffc107;
        width: 50%;
    }

    .password-strong {
        background-color: #28a745;
        width: 100%;
    }

    .password-strength-text {
        font-size: 12px;
        margin-top: 5px;
        color: #666;
    }

    .alert {
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
    }

    .copyright {
        font-size: 14px;
        color: #777;
        text-align: center;
        padding: 20px 0;
    }

    .copyright a {
        color: #555;
        font-weight: 600;
        text-decoration: none;
    }

    .copyright a:hover {
        text-decoration: underline;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
        100% { transform: translateY(0px); }
    }

    .tab-container {
        display: flex;
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
    }

    .tab {
        padding: 12px 25px;
        cursor: pointer;
        font-weight: 600;
        color: #666;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .tab.active {
        color: #1976d2;
        border-bottom: 3px solid #1976d2;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="container">
    <div class="row align-items-center page-inner">
        <div class="col-lg-8 mx-auto">
            <div class="auth-card">
                <h3 class="auth-title">Reset Your Password</h3>
                <p class="auth-subtitle">Choose how you want to reset your password</p>

                <!-- Tab Navigation -->
                <div class="tab-container">
                    <div class="tab " data-tab="email-reset">Request via Email</div>
                    <div class="tab active" data-tab="manual-change">Change Manually</div>
                </div>

                <!-- Email Reset Tab -->
                <div id="email-reset" class="tab-content ">
                    <div class="option-card">
                        <div class="option-icon">
                            <span class="material-icons">email</span>
                        </div>
                        <h4 class="option-title">Request Password Reset via Email</h4>
                        <p class="option-description">
                            Enter your registered User ID and we will send password reset instructions to your email address.
                        </p>

                        <form id="request-password-reset-form" 
                              name="request-password-reset-form"
                              action="{{ route('forgot.password') }}"
                              method="POST">

                            @csrf

                            <div class="material-input">
                                <span class="material-icons">account_circle</span>
                                <input type="text" 
                                       id="username" 
                                       name="username"
                                       value="{{ auth()->user()->username }}"
                                       placeholder="Enter your USER ID"
                                       class="form-control"
                                       readonly>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                <span class="material-icons" style="vertical-align: middle;">send</span>
                                &nbsp; Send Reset Instructions
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Manual Change Tab -->
                <div id="manual-change" class="tab-content active">
                    <div class="option-card success">
                        <div class="option-icon success">
                            <span class="material-icons">lock</span>
                        </div>
                        <h4 class="option-title">Change Password Manually</h4>
                        <p class="option-description">
                            Enter your current password and set a new password. Make sure it's strong and secure.
                        </p>

                        <form id="change-password-form" 
                              name="change-password-form"
                              action="{{ route('change.password') }}"
                              method="POST">

                            @csrf

                            <div class="material-input">
                                <span class="material-icons">lock</span>
                                <input type="password" 
                                       id="old_password" 
                                       name="old_password"
                                       placeholder="Enter your current password"
                                       class="form-control">
                            </div>

                            <div class="material-input">
                                <span class="material-icons">lock_reset</span>
                                <input type="password" 
                                       id="new_password" 
                                       name="new_password"
                                       placeholder="Enter new password"
                                       class="form-control"
                                       onkeyup="checkPasswordStrength(this.value)">
                                <div id="password-strength-bar" class="password-strength"></div>
                                <div id="password-strength-text" class="password-strength-text"></div>
                            </div>

                            <div class="material-input">
                                <span class="material-icons">lock_reset</span>
                                <input type="password" 
                                       id="confirm_password" 
                                       name="confirm_password"
                                       placeholder="Confirm new password"
                                       class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-3">
                                <span class="material-icons" style="vertical-align: middle;">lock</span>
                                &nbsp; Change Password
                            </button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success text-center mt-3">
                        <span class="material-icons" style="vertical-align: middle;">check_circle</span>
                        &nbsp; {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger text-center mt-3">
                        <span class="material-icons" style="vertical-align: middle;">error</span>
                        &nbsp; {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row py-4">
        <div class="col-lg-12">
            <div class="copyright">
                <span>
                    © <script>document.write(new Date().getFullYear())</script> 
                    <a href="#" class="text-decoration-none">
                        randour-x.com
                    </a>  
                    — All Rights Reserved.
                </span>
            </div>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Form validation for email reset
    document.getElementById('request-password-reset-form').addEventListener('submit', function(e) {
        let entered = document.getElementById('username').value.trim();
        let current = "{{ auth()->user()->username }}";

        if (entered === '') {
            alert("Please type your User ID!");
            e.preventDefault();
            return false;
        }

        if (entered !== current) {
            alert("User ID does not match the logged-in account!");
            e.preventDefault();
            return false;
        }

        return true;
    });

    // Form validation for manual password change
    document.getElementById('change-password-form').addEventListener('submit', function(e) {
        const oldPassword = document.getElementById('old_password').value.trim();
        const newPassword = document.getElementById('new_password').value.trim();
        const confirmPassword = document.getElementById('confirm_password').value.trim();

        if (oldPassword === '') {
            alert("Please enter your current password!");
            e.preventDefault();
            return false;
        }

        if (newPassword === '') {
            alert("Please enter a new password!");
            e.preventDefault();
            return false;
        }

        if (newPassword.length < 8) {
            alert("Password must be at least 8 characters long!");
            e.preventDefault();
            return false;
        }

        if (newPassword !== confirmPassword) {
            alert("New password and confirm password do not match!");
            e.preventDefault();
            return false;
        }

        return true;
    });

    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        
        // Reset classes and text
        strengthBar.className = 'password-strength';
        strengthText.textContent = '';
        
        if (password.length === 0) {
            return;
        }
        
        // Calculate strength
        let strength = 0;
        let feedback = [];
        
        // Length check
        if (password.length >= 8) {
            strength += 1;
        } else {
            feedback.push("at least 8 characters");
        }
        
        // Contains lowercase
        if (/[a-z]/.test(password)) {
            strength += 1;
        } else {
            feedback.push("lowercase letters");
        }
        
        // Contains uppercase
        if (/[A-Z]/.test(password)) {
            strength += 1;
        } else {
            feedback.push("uppercase letters");
        }
        
        // Contains numbers
        if (/[0-9]/.test(password)) {
            strength += 1;
        } else {
            feedback.push("numbers");
        }
        
        // Contains special characters
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 1;
        } else {
            feedback.push("special characters");
        }
        
        // Apply visual feedback
        if (strength <= 2) {
            strengthBar.classList.add('password-weak');
            strengthText.textContent = 'Weak password. Consider adding: ' + feedback.slice(0, 2).join(', ');
            strengthText.style.color = '#dc3545';
        } else if (strength <= 4) {
            strengthBar.classList.add('password-medium');
            strengthText.textContent = 'Medium password. For better security add: ' + feedback.slice(0, 1).join(', ');
            strengthText.style.color = '#ffc107';
        } else {
            strengthBar.classList.add('password-strong');
            strengthText.textContent = 'Strong password!';
            strengthText.style.color = '#28a745';
        }
    }
</script>

@endsection