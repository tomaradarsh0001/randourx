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
    }

    .auth-title {
        font-size: 28px;
        font-weight: 700;
        color: #222;
    }

    .auth-subtitle {
        font-size: 15px;
        color: #666;
        margin-top: -5px;
    }

    .material-input {
        position: relative;
    }

    .material-input input {
        padding-left: 45px;
        height: 48px;
        border-radius: 12px;
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
    }

    .banner-img img {
        width: 70%;
        height: auto;
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
        100% { transform: translateY(0px); }
    }
</style>

<div class="container">
    <div class="row align-items-center page-inner">

        <!-- Left Side Form -->
        <div class="col-lg-6">
            <div class="auth-card">

                <h3 class="auth-title">Reset Your Password</h3>
                <p class="auth-subtitle">Enter your registered User ID and we will send you the reset instructions.</p>

                <form id="request-password-reset-form" 
                      name="request-password-reset-form"
                      action="{{ route('forgot.password') }}"
                      method="POST"
                      onsubmit="return checkform();">

                    @csrf

                    <script>
                        function checkform() {
                            var username = document.getElementById('username').value.trim();
                            if (username === '') {
                                alert("Please type your User ID!");
                                return false;
                            }
                            return true;
                        }
                    </script>

                    <div class="material-input mt-4">
                        <span class="material-icons">account_circle</span>
                      
                               <input type="text" 
       id="username" 
       name="username"
       value="{{ auth()->user()->username }}"
        placeholder="Enter your USER ID"
       class="form-control"
       readonly>

                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">
                        <span class="material-icons" style="vertical-align: middle;">send</span>
                        &nbsp; Send New Password in Email
                    </button>

                </form>

                @if(session('success'))
                    <div class="alert alert-success text-center mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger text-center mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif

            </div>
        </div>

    </div>

   <div class="row py-4">
    <div class="col-lg-12">
        <div class="text-center" style="font-size: 14px; color: #777;">
            <span>
                © <script>document.write(new Date().getFullYear())</script> 
                <a href="#" class="text-decoration-none" style="color: #555; font-weight: 600;">
                    randour-x.com
                </a>  
                — All Rights Reserved.
            </span>
        </div>
    </div>
</div>

</div>
<script>
    function checkform() {
        let entered = document.getElementById('username').value.trim();
        let current = "{{ auth()->user()->username }}";

        if (entered === '') {
            alert("Please type your User ID!");
            return false;
        }

        if (entered !== current) {
            alert("User ID does not match the logged-in account!");
            return false;
        }

        return true;
    }
</script>

@endsection
