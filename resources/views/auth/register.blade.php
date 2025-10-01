
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to randour-x</title>
    <meta name="designer" href="https://uniquehyips.com/">
  <!-- CSS Files -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

<!-- jQuery & Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    .btn-primary {
        margin-left: 410px;
    }
</style>

<body>
   
    <!-- banner start-->
    <div class="banner-bg py-lg-4 position-relative">
        <div class="container">
            <header>
                <div class="row">
                    <div class="col-xl-4 col-lg-3">
                        <div class="head-logo"> <a href="/" class=""><img
                                    src="imagess/logorandour.png" width="300px" height="100px" class=""></a> </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="server-time">
                            <div class="server-time-img"> <img src="imagess/server-time.png"> </div>
                            <div class="server-content ms-3">
                                <h6 class="text-white fw-normal">Servertime : 19:13:07 PM</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nav-btn">
                            <a href="login" class="btn btn-outline-primary">Login</a>
                            <a href="register" class="btn btn-primary ms-4">Register</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="desktop-view mt-lg-3">
                            <nav class="navbar navbar-expand-lg nav-head">
                                <div class="navbar-head">
                                    <h4 class="mb-0">Main Menu</h4>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class=" list-unstyled head-nav-link mb-0">
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page" href="/"> <img src="imagess/menu-ico1.png"><br>
                                                    <span class="text-white"> Home </span></a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page" href="about"> <img
                                                        src="imagess/menu-ico2.png"><br>
                                                    <span class="text-white"> About</span> </a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#upcomingProjectModal">
                                                    <img src="{{ asset('imagess/menu-ico3.png') }}">
                                                    <br>
                                                    <span class="text-white">Upcoming Project</span>
                                                </a>
                                            </div>
                                        </li>
                                        <!-- Modal Structure -->
                                        <div class="modal fade" id="upcomingProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Upcoming Project</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('assets/img/upcoming_project.jpg') }}" class="img-fluid" alt="Upcoming Project">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <style>
                                            .modal.fade .modal-dialog {
                                            transition: transform 0.3s ease-out;
                                            transform: scale(0.8);
                                        }

                                        .modal.show .modal-dialog {
                                            transform: scale(1);
                                        }

                                        </style>
                                        <li>
                                            <div class="menu-ico text-center"> <a href="terms-conditions" class="nav-link active"
                                                    aria-current="page"> <img src="imagess/menu-ico4.png"><br>
                                                    <span class="text-white"> Rules</span> </a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a href="faq" class="nav-link active"
                                                    aria-current="page"> <img src="imagess/menu-ico5.png"><br>
                                                    <span class="text-white"> FAQ</span></a> </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="menu-ico text-center"> <a href="contact-us"
                                                    class="nav-link active" aria-current="page"> <img
                                                        src="imagess/menu-ico6.png"> <br>
                                                    <span class="text-white"> Contact Us</span></a> </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">
                <div class="col-lg-6">
                    <div class="innerpages text-center">

                        <div class="title mt-5 mb-4">
                            <h3 class="text-white fw-normal mb-0">Register Your Account</h3>
                        </div>
                        <script language=javascript>
                            function checkform() {
                                if (document.regform.fullname.value == '') {
                                    alert("Please enter your full name!");
                                    document.regform.fullname.focus();
                                    return false;
                                }


                                if (document.regform.username.value == '') {
                                    alert("Please enter your username!");
                                    document.regform.username.focus();
                                    return false;
                                }
                                if (!document.regform.username.value.match(/^[A-Za-z0-9_\-]+$/)) {
                                    alert("For username you should use English letters and digits only!");
                                    document.regform.username.focus();
                                    return false;
                                }
                                if (document.regform.password.value == '') {
                                    alert("Please enter your password!");
                                    document.regform.password.focus();
                                    return false;
                                }
                                if (document.regform.password.value != document.regform.password2.value) {
                                    alert("Please check your password!");
                                    document.regform.password2.focus();
                                    return false;
                                }


                                if (document.regform.email.value == '') {
                                    alert("Please enter your e-mail address!");
                                    document.regform.email.focus();
                                    return false;
                                }
                                if (document.regform.email.value != document.regform.email1.value) {
                                    alert("Please retype your e-mail!");
                                    document.regform.email.focus();
                                    return false;
                                }

                                for (i in document.regform.elements) {
                                    f = document.regform.elements[i];
                                    if (f.name && f.name.match(/^pay_account/)) {
                                        if (f.value == '') continue;
                                        var notice = f.getAttribute('data-validate-notice');
                                        var invalid = 0;
                                        if (f.getAttribute('data-validate') == 'regexp') {
                                            var re = new RegExp(f.getAttribute('data-validate-regexp'));
                                            if (!f.value.match(re)) {
                                                invalid = 1;
                                            }
                                        } else if (f.getAttribute('data-validate') == 'email') {
                                            var re = /^[^\@]+\@[^\@]+\.\w{2,4}$/;
                                            if (!f.value.match(re)) {
                                                invalid = 1;
                                            }
                                        }
                                        if (invalid) {
                                            alert('Invalid account format. Expected ' + notice);
                                            f.focus();
                                            return false;
                                        }
                                    }
                                }

                                if (document.regform.agree.checked == false) {
                                    alert("You have to agree with the Terms and Conditions!");
                                    return false;
                                }

                                return true;
                            }

                            function IsNumeric(sText) {
                                var ValidChars = "0123456789";
                                var IsNumber = true;
                                var Char;
                                if (sText == '') return false;
                                for (i = 0; i < sText.length && IsNumber == true; i++) {
                                    Char = sText.charAt(i);
                                    if (ValidChars.indexOf(Char) == -1) {
                                        IsNumber = false;
                                    }
                                }
                                return IsNumber;
                            }
                        </script>
<form method="POST" action="{{ route('register') }}" onsubmit="return checkform()" name="regform">
    @csrf
    <div class="row">
        <!-- Sponsor Username -->
        <div class="col-lg-6">
    <div class="form-block position-relative">
        <div class="form-ico">
            <iconify-icon icon="carbon:user-profile"></iconify-icon>
        </div>
        <input type="text" name="sponsor_username" id="sponsor_username"
       class="form-control"
       placeholder="Enter Sponsor ID"
       minlength="5" maxlength="15"
       autocomplete="off"
       value="{{ session('sponsor') ?? '' }}"
       @if(session('sponsor')) readonly @endif>

        <div class="alert alert-info p-2 mt-2" id="showsponsername" style="display:none"></div>
        <!-- <div class="alert alert-danger p-2 mt-2" id="err1" style="display:none"></div> -->
    </div>
</div>


        <!-- Full Name -->
        <div class="col-lg-6">
            <div class="form-block position-relative">
                <div class="form-ico">
                    <iconify-icon icon="carbon:user"></iconify-icon>
                </div>
                <input type="text" name="full_name" id="full_name"
                       class="form-control"
                       placeholder="Enter Full Name"
                       maxlength="40"
                       autocomplete="off" required>
            </div>
        </div>
    </div>

    <!-- Country Code + Mobile -->
    <!-- Country Code Dropdown -->
<!-- Country Code + Mobile -->
<div class="col-lg-12">
    <div class="form-block position-relative d-flex align-items-center">

        <!-- Custom Country Dropdown -->
        <div class="custom-dropdown" style="position: relative; width: 200px; margin-right: 10px;">
            <!-- Selected Option -->
            <div class="form-control d-flex align-items-center justify-content-between"
                 id="selected-option" style="cursor: pointer;">
                <span class="d-flex align-items-center">
                    <img src="{{ $default['flag'] }}" id="selected-flag" alt="Flag" width="24" class="me-2">
                    <span id="selected-code">{{ $default['code'] }}</span>
                </span>
                <span class="ms-1">&#x25BC;</span>
            </div>

            <!-- Options List -->
            <div class="options-list border bg-white shadow-sm mt-1"
                 id="options-list"
                 style="display:none; max-height:200px; overflow-y:auto; position:absolute; width:100%; z-index:999;">
                @foreach($countries as $country)
                    @php
                        $countryFlag = "https://flagcdn.com/w40/" . strtolower($country->country_code_name_in_short) . ".png";
                    @endphp
                    <div class="option d-flex align-items-center p-2"
                         style="cursor:pointer;"
                         onclick="selectCountry('{{ $country->country_code_with_plus }}', '{{ $countryFlag }}')">
                        <img src="{{ $countryFlag }}" alt="Flag" width="24" class="me-2">
                        <span>{{ $country->country_code_with_plus }} - {{ $country->country_name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Hidden Select for Form Submission -->
            <select name="country_code" id="hidden-country-code" class="d-none">
                @foreach($countries as $country)
                    <option value="{{ $country->country_code_with_plus }}"
                        {{ $country->country_code_with_plus == $default['code'] ? 'selected' : '' }}>
                        {{ $country->country_code_with_plus }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mobile -->
        <div class="form-ico form-icoo">
            <iconify-icon icon="carbon:phone"></iconify-icon>
        </div>
       <input type="number" name="mobile" id="mobile"
               class="form-control"
               placeholder="Enter Phone"
               autocomplete="off" required>
               
            </div>
            <div class="alert alert-danger p-2 mt-2" id="err_mobile" style="display:none"></div>
</div>


    <!-- Email -->
    <div class="col-lg-12">
        <div class="form-block position-relative">
            <div class="form-ico">
                <iconify-icon icon="cib:mail-ru"></iconify-icon>
            </div>
          <input type="email" name="email" id="email"
               class="form-control"
               placeholder="Enter Email ID"
               maxlength="40"
               autocomplete="off" required>
        <div class="alert alert-danger p-2 mt-2" id="err_email" style="display:none"></div>
        </div>
    </div>
   

    <!-- Password & Confirm -->
    <div class="row">
        <div class="col-lg-6">
            <div class="form-block position-relative">
                <div class="form-ico">
                    <iconify-icon icon="carbon:locked"></iconify-icon>
                </div>
                <input type="password" name="password" id="password"
                       class="form-control"
                       placeholder="******" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-block position-relative">
                <div class="form-ico">
                    <iconify-icon icon="carbon:locked"></iconify-icon>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control"
                       placeholder="******" required>
            </div>
        </div>
    </div>

    <!-- Terms -->
    <div class="formDown">
        <div class="checkInput">
            <label class="custom-checkbox">
                <input type="checkbox" id="signupform-agreement" value="1" required>
                <span class="checkmark"></span>
            </label>
            <label for="signupform-agreement">
                I agree with <a href="{{ url('terms-conditions') }}" target="_blank">terms and conditions</a>
            </label>
        </div>
    </div>

    <!-- Submit -->
    <div class="btnContainer d-flex justify-content-center">
        <div class="innerpage-btn text-center mt-3 mb-3">
            <button type="submit" class="btn btn-primary btn-primary1">
                Register Now
            </button>
        </div>
    </div>
</form>
{{-- Success Registration Popup --}}
@if(session('registration_success'))
<div id="registrationSuccessModal" class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg" style="max-width: 800px;"> {{-- Wider modal --}}
        <div class="modal-content">
            <div class="modal-header bg-success text-white py-2"> {{-- Reduced header height --}}
                <h5 class="modal-title mb-0">
                    <i class="fas fa-check-circle"></i> Registration Successful!
                </h5>
            </div>
            <div class="modal-body p-3"> {{-- Reduced padding --}}
                <div class="alert alert-success py-2 mb-2"> {{-- Compact alert --}}
                    <strong class="h6 mb-0">Congratulations!</strong> You are successfully registered in our portal.
                </div>
                
                <div class="registration-details">
                    <h6 class="mb-2">Your Login Credentials:</h6>
                    <div class="row"> {{-- Using grid layout to reduce height --}}
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered mb-2"> {{-- Smaller table --}}
                                <tr>
                                    <th width="45%" class="p-1">Full Name:</th>
                                    <td class="p-1">{{ session('registration_success.user_data.full_name') }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Username:</th>
                                    <td class="p-1 text-primary font-weight-bold">{{ session('registration_success.user_data.username') }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Email:</th>
                                    <td class="p-1">{{ session('registration_success.user_data.email') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered mb-2">
                                <tr>
                                    <th width="45%" class="p-1">Password:</th>
                                    <td class="p-1 text-warning font-weight-bold">{{ session('registration_success.user_data.password') }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Mobile:</th>
                                    <td class="p-1">{{ session('registration_success.user_data.mobile') }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Sponsor:</th>
                                    <td class="p-1">{{ session('registration_success.user_data.sponsor') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm table-bordered mb-2">
                                <tr>
                                    <th width="20%" class="p-1">Registration Date:</th>
                                    <td class="p-1">{{ session('registration_success.user_data.registration_date') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info py-2 mt-2 mb-0"> {{-- Compact info alert --}}
                    <small class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i> 
                        Save your username and password securely for login.
                    </small>
                </div>
            </div>
            <div class="modal-footer py-2"> {{-- Reduced footer height --}}
                <button type="button" class="btn btn-success btn-sm" onclick="closeModal()">
                    <i class="fas fa-thumbs-up"></i> Got it!
                </button>
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-sign-in-alt"></i> Login Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function closeModal() {
    document.getElementById('registrationSuccessModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('registrationSuccessModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

<style>
.modal {
    backdrop-filter: blur(5px);
}
.registration-details table th {
    background-color: #f8f9fa;
    font-size: 0.85rem;
}
.registration-details table td {
    font-size: 0.85rem;
}
.modal-body {
    max-height: 60vh; /* Limit maximum height */
    overflow-y: auto; /* Add scroll if needed */
}
.modal-lg {
    max-width: 800px !important; /* Force wider modal */
}
.table-sm th, .table-sm td {
    padding: 0.25rem !important; /* Reduced table padding */
}
</style>
@endif

 <script>
$(document).ready(function() {
    $('#sponsor_username').on('blur', function() {
        let username = $(this).val().trim();

        // Clear alerts and related fields first
        $('#showsponsername').hide().text('');
        $('#err1').hide().text('');
        // Disable or clear other fields if already filled
        $('#full_name').val('').prop('disabled', false);

        if(username.length < 5) return; // Skip short usernames

        $.ajax({
            url: '{{ route("sponsor.check") }}', // create this route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                username: username
            },
            success: function(res) {
                if(res.exists) {
                    $('#showsponsername').show().text('Sponsor Name: ' + res.full_name);
                    $('#err1').hide();
                    // Disable the full_name field if you want
                    $('#full_name').val('').prop('disabled', false); // allow user to fill their own full_name
                } else {
                    $('#err1').show().text('Sponsor username does not exist.');
                    $('#full_name').val('').prop('disabled', false); // clear and enable
                }
            },
            error: function(err) {
                console.error(err);
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    function checkExists(type, value, errorDiv) {
        $.ajax({
            url: '{{ route("user.check") }}', // route to check mobile/email
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            },
            success: function(res) {
                if(res.exists){
                    $('#' + errorDiv).show().text(type.charAt(0).toUpperCase() + type.slice(1) + ' already exists.');
                    $('#' + type).val(''); // clear field if exists
                } else {
                    $('#' + errorDiv).hide().text('');
                }
            },
            error: function(err){
                console.error(err);
            }
        });
    }

    $('#mobile').on('blur', function() {
        let mobile = $(this).val().trim();
        if(mobile.length > 0){
            checkExists('mobile', mobile, 'err_mobile');
        }
    });

    // $('#email').on('blur', function() {
    //     let email = $(this).val().trim();
    //     if(email.length > 0){
    //         checkExists('email', email, 'err_email');
    //     }
    // });
});
</script>

            </div>
           <script>
function selectCountry(code, flag) {
    // Update selected display
    document.getElementById("selected-flag").src = flag;
    document.getElementById("selected-code").innerText = code;

    // Update hidden select
    let select = document.getElementById("hidden-country-code");
    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].value === code) {
            select.selectedIndex = i;
            break;
        }
    }

    // Close dropdown
    document.getElementById("options-list").style.display = "none";
}

// Toggle dropdown
document.getElementById("selected-option").addEventListener("click", function () {
    let list = document.getElementById("options-list");
    list.style.display = (list.style.display === "block") ? "none" : "block";
});

// Close dropdown if clicked outside
document.addEventListener("click", function (event) {
    if (!document.querySelector(".custom-dropdown").contains(event.target)) {
        document.getElementById("options-list").style.display = "none";
    }
});
</script>

<style>
/* Custom dropdown styling */
.custom-dropdown {
    position: relative !important;
    width: 270px !important;
}
#selected-name{
    font-size: 12px !important;
}

#selected-code{
    font-size: 12px !important;

}
#selected-flag{
    width: 25pxx !important;
    height: 18px !important;
}
.selected-option {
    display: flex !important;
    align-items: center !important;
    padding: 10px !important;
    border: 1px solid #ccc !important;
    border-radius: 5px !important;
    cursor: pointer !important;
    background: #fff !important;
}

.selected-option img {
    width: 25px !important;
    height: 18px !important;
    margin-right: 10px !important;
    border-radius: 3px !important;
}

.options-list {
    position: absolute; 
    width: 300px !important;
    background: #ffffff;
    border: 1px solid #ccc;
    border-top: none;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    z-index: 1000;
}

.options-list .option {
    display: flex;
    align-items: center;
    padding: 8px 10px;
    cursor: pointer;
}

.options-list .option:hover {
    background: #f1f1f1;
}

.options-list .option img {
    width: 25px;
    height: 18px;
    margin-right: 10px;
    border-radius: 3px;
}

/* Hide default select */
.hidden-select {
    display: none;
}
</style>
 <style>
                    .formDown {
                        padding: 15px;
                        background-color: #222; 
                        border-radius: 10px;
                        text-align: center;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .checkInput {
                        display: flex;
                        align-items: center;
                        gap: 12px; 
                    }

                    .checkInput label {
                        color: white;
                        font-size: 18px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                    }

                    .checkInput a {
                        color:rgb(60, 63, 255);
                        text-decoration: none;
                        font-weight: bold;
                    }

                    .checkInput a:hover {
                        color: rgb(60, 63, 255);
                        text-decoration: underline;
                    }

                    .custom-checkbox {
                        position: relative;
                        display: flex;
                        align-items: center;
                    }

                    .custom-checkbox input {
                        opacity: 0;
                        position: absolute;
                    }

                    .custom-checkbox .checkmark {
                        width: 22px;
                        height: 22px;
                        background: #444;
                        border: 2px rgb(60, 63, 255);
                        border-radius: 6px;
                        display: inline-block;
                        transition: all 0.3s ease-in-out;
                        position: relative;
                    }

                    .custom-checkbox .checkmark::after {
                        content: "";
                        position: absolute;
                        left: 6px;
                        top: 3px;
                        width: 6px;
                        height: 12px;
                        border: solid white;
                        border-width: 0 3px 3px 0;
                        transform: rotate(45deg);
                        opacity: 0;
                        transition: opacity 0.2s ease-in-out;
                    }

                    .custom-checkbox input:checked + .checkmark {
                        background-color: rgb(60, 63, 255);
                        border-color: rgb(60, 63, 255);
                    }

                    .custom-checkbox input:checked + .checkmark::after {
                        opacity: 1;
                    }`
</style>
            <script>
                function AvoidSpace(event) {
                    var k = event ? event.which : window.event.keyCode;
                    if (k == 32) return false;
                    if (k == 08) return true;
                    if ((k >= 48 && k <= 57) || (k >= 97 && k <= 122) || (k >= 65 && k <= 90)) {
                        return true;
                    } else {
                        return false
                    }

                }

            
            </script>

            <script>
                function getDistrict(val) {
                    $.ajax({

                        type: "POST",
                        url: "ajax_get_district.php",
                        data: {
                            val: val
                        },
                        success: function (msg) {
                            $('#district').find('option').remove().end().append(msg);
                        }
                    });
                }

                function checkpsw(repsw) {

                    var psw = $('#password').val();

                    if (psw != repsw) {

                        $('#errpsw').html('**Password Does Not Match');
                        $('#errpsw').show();
                        document.getElementById('submit').disabled = true;
                    } else {
                        $('#errpsw').hide();
                        document.getElementById('submit').disabled = false;
                    }

                }

                function checkPhone(phone) {

                    intRegex = /[0-9 -()+]+$/;
                    if ((phone.length != 10) || (!intRegex.test(phone))) {
                        $('#err2').html('** Please enter 10 digit mobile no.!');
                        $('#err2').show();
                    } else {
                        $('#err2').html('');
                        $('#err2').hide();
                    }
                }
            </script>
              <!-- JS Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.0.0/dist/iconify-icon.min.js"></script>
</body>

</html>