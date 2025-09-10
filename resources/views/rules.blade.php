<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules - Randour-X</title>
    
    <meta name="designer" href="https://uniquehyips.com/">
    
    <!--Basic Bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!--Font icons-->
    <link href="css/all.css" rel="stylesheet" type="text/css">
    <!--Carousel Slider-->
    <link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="css/owl.theme.default.min.css" rel="stylesheet" type="text/css">
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
    <!--Theme CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- banner start-->
    <div class="banner-bg py-lg-4 position-relative">
        <div class="container">
            <header>
                <div class="row">
                    <div class="col-xl-4 col-lg-3">
                        <div class="head-logo"> <a href="/" class=""><img width="300px" height="100px" src="imagess/logorandour.png" class=""></a> </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="server-time">
                            <div class="server-time-img"> <img src="imagess/server-time.png"> </div>
                            <div class="server-content ms-3">
                                <h6 class="text-white fw-normal">Servertime : 19:13:08 PM</h6>
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
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class=" list-unstyled head-nav-link mb-0">
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ url('/') }}"> <img src="{{ asset('imagess/menu-ico1.png') }}"><br>
                                                    <span class="text-white"> Home </span></a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ route('about') }}"> <img src="{{ asset('imagess/menu-ico2.png') }}"><br>
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
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ route('rules') }}"> <img src="{{ asset('imagess/menu-ico4.png') }}"><br>
                                                    <span class="text-white"> Rules</span> </a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ route('faq') }}"> <img src="{{ asset('imagess/menu-ico5.png') }}"><br>
                                                    <span class="text-white"> FAQ</span></a> </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ route('contact') }}"> <img src="{{ asset('imagess/menu-ico6.png') }}"> <br>
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
    <div class="col-lg-12">
        <div class="abt-page-sec mt-lg-5 text-center">
            <h1 class="text-white">Rules & Agreements</h1>
            <p class="text-white fw-medium">Please read the following rules carefully before signing in</p>
        </div>
    </div>

</div>

</div>
</div>
<!-- banner end -->
    <!-- affiliate start -->
    <div class="py-lg-5 affiliate-aft position-relative head-pad">
        <div class="container">


<p align=justify class="text-white">

You agree to be of legal age in your country to partake in this program, and in all the cases your minimal age must be 18 years.<br><br>

bitlom.io is not available to the general public and is opened only to the qualified members of bitlom.io, the use of this site is restricted to our members and to individuals personally invited by them. Every deposit is considered to be a private transaction between the bitlom.io and its Member.<br><br>
	
As a private transaction, this program is exempt from the US Securities Act of 1933, the US Securities Exchange Act of 1934 and the US Investment Company Act of 1940 and all other rules, regulations and amendments thereof. We are not FDIC insured. We are not a licensed bank or a security firm.<br><br>
  You agree that all information, communications, materials coming from bitlom.io 
  are unsolicited and must be kept private, confidential and protected from any 
  disclosure. Moreover, the information, communications and materials contained 
  herein are not to be regarded as an offer, nor a solicitation for investments 
  in any jurisdiction which deems non-public offers or solicitations unlawful, 
  nor to any person to whom it will be unlawful to make such offer or solicitation.<br>
  <br>

All the data giving by a member to bitlom.io will be only privately used and not disclosed to any third parties. bitlom.io is not responsible or liable for any loss of data.<br><br>
  You agree to hold all principals and members harmless of any liability. You 
  are investing at your own risk and you agree that a past performance is not 
  an explicit guarantee for the same future performance. You agree that all information, 
  communications and materials you will find on this site are intended to be regarded 
  as an informational and educational matter and not an investment advice.<br>
  <br>
  We reserve the right to change the rules, commissions and rates of the program 
  at any time and at our sole discretion without notice, especially in order to 
  respect the integrity and security of the members' interests. You agree that 
  it is your sole responsibility to review the current terms. <br>
  <br>

bitlom.io is not responsible or liable for any damages, losses and costs resulting from any violation of the conditions and terms and/or use of our website by a member. You guarantee to bitlom.io that you will not use this site in any illegal way and you agree to respect your local, national and international laws.<br><br>

Don't post bad vote on Public Forums and at Gold Rating Site without contacting the administrator of our program FIRST. Maybe there was a technical problem with your transaction, so please always CLEAR the thing with the administrator.<br><br>

We will not tolerate SPAM or any type of UCE in this program. SPAM violators will be immediately and permanently removed from the program.<br><br>

bitlom.io reserves the right to accept or decline any member for membership without explanation.<br><br>

If you do not agree with the above disclaimer, please do not go any further.



</p>

</div>
</div>
    <!-- footer start -->
    <div class="footer-bg py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-logo">
                        <div class="footer-img mb-lg-4"> <img src="imagess/footer-logo.png"></div>
                        <p class="text-white fw-semibold">By utilizing Ether as collateral, we offer innovative financial solutions that enable investors to access liquidity without selling their cryptocurrency holdings. </p>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled mb-0 footer-menu-list">
                                <li><a href="{{ url('/') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        Home
                                    </a></li>
                                <li><a href="{{ route('about') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        About
                                    </a></li>
                        
                            </ul>
                            </li>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled mb-0 footer-menu-list">
                                <li><a href="{{ route('rules') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        Rules
                                    </a></li>
                                <li><a href="{{ route('faq') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        FAQ
                                    </a></li>
                                <li><a href="{{ route('contact') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        Support
                                    </a></li>
                            </ul>
                            </li>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="footer-form-page">
                        <div class="login-page">
                            <div class="login-img"> <img src="{{ asset('imagess/login-img.png') }}"> </div>
                            <a href="{{ route('login') }}" class="text-white text-decoration-none fw-medium ms-2">Login</a>
                        </div>
                        <div class="reg-page ms-5">
                            <div class="reg-img"> <img src="{{ asset('imagess/reg-img.png') }}"> </div>
                            <a href="{{ route('register') }}" class="text-white text-decoration-none fw-medium ms-2">Register</a>
                        </div>
                    </div>
                    <div class="company-email mt-4 mb-3">
                        <h6 class="text-white fw-medium mb-0">
                            <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                            E-Mail : admin@bitlom.io
                        </h6>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-lg-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="copy-rights "> <span class="text-white fw-normal"><a href="#" class="text-white text-decoration-none">bitlom.io </a> | @ Copyright <script>document.write(new Date().getFullYear())</script>. All Rights Reserved.</span> </div>
                </div>
                <div class="col-lg-4 offset-lg-2 order-1 order-lg-2">
                    <div class="company-rules"> 
                    <a href="{{ route('rules') }}" class="text-decoration-none text-white">Tearms and Conditions</a> 
                    <a href="{{ route('rules') }}" class="text-decoration-none text-white">Privacy and Policy</a> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer end -->
    <!-- Modal -->
    <div class="modal fade  modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="../cdn.jsdelivr.net/npm/iconify-icon%402.0.0/dist/iconify-icon.min.js"></script>
</body>


<!-- Mirrored from bitlom.io/?a=rules by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2024 11:13:23 GMT -->
</html>