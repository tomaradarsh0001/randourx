<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - randour-x.com</title>
    
    <meta name="designer" href="https://uniquehyips.com/">
    
    <!--Basic Bootstrap-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!--Font icons-->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <!--Carousel Slider-->
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
    <!--Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- banner start-->
    <div class="banner-bg py-lg-4 position-relative">
        <div class="container">
            <header>
                <div class="row">
                    <div class="col-xl-4 col-lg-3">
                        <div class="head-logo"> <a href="{{ url('/') }}" class=""><img src="{{ asset('imagess/logorandour.png') }}" width="300px" height="100px" class=""></a> </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="server-time">
                            <div class="server-time-img"> <img src=> </div>
                            <div class="server-content ms-3">
                                <h6 class="text-white fw-normal"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nav-btn">
                             
                        <a href="{{ url('login') }}" class="btn btn-outline-primary">Login</a>
                            <a href="{{ url('register') }}" class="btn btn-primary ms-4">Register</a>
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
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page" href="{{ url('/') }}"> <img src="{{ asset('imagess/menu-ico1.png') }}"><br>
                                                    <span class="text-white"> Home </span></a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page" href="{{ url('about') }}"> <img
                                                        src="{{ asset('imagess/menu-ico2.png') }}"><br>
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
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page" href="{{ route('rules') }}"> <img src="{{ asset('imagess/menu-ico4.png') }}"><br>
                                                    <span class="text-white"> Rules</span> </a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a href="{{ url('faq') }}" class="nav-link active"
                                                    aria-current="page"> <img src="{{ asset('imagess/menu-ico5.png') }}"><br>
                                                    <span class="text-white"> FAQ</span></a> </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="menu-ico text-center"> <a href="{{ url('contact-us') }}"
                                                    class="nav-link active" aria-current="page"> <img
                                                        src="{{ asset('imagess/menu-ico6.png') }}"> <br>
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
            <h1 class="text-white">About Us</h1>
            <p class="text-white fw-medium">Our company specializes in Ether Collateralized services, leveraging the potential of Ethereum's blockchain <br> technology. By utilizing Ether as collateral, we offer innovative financial solutions that enable <br> investors to access liquidity without selling their cryptocurrency holdings. </p>
        </div>
    </div>

</div>

</div>
</div>
<!-- banner end -->
<!-- about start-->
<div class="abt-bg pt-lg-5 position-relative ">
    <div class="container">
        <div class="abt-pad">
            <div class="row">
                <div class="col-lg-5">
                    <div class="abt-sec">
                        <h2 class="text-white fw-normal">Randour-X</h2>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="abt-content">
                            <p class="text-white-50">We ensure transparency, security, and efficiency in collateralized transactions. Our platform provides flexible borrowing options, allowing clients to unlock the value of their Ether assets while retaining exposure to potential price appreciation.  </p>
                            <p class="text-white-50">With robust risk management measures and personalized support, we empower investors to optimize their financial strategies and capitalize on the opportunities presented by the evolving crypto landscape.</p>
                            <p class="text-white-50">Ether Collateralized works by allowing users to lock up Ether as collateral to access loans or liquidity without selling their cryptocurrency.</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about end-->
<!-- How to start-->
    <div class="fea-sec position-relative pb-lg-4 head-pad">
        <div class="container">
            <div class="row mb-lg-4">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h2 class="text-white fw-normal">How it Works</h2>
                        <p class="text-white fw-normal">Here are the some basic reasons how our systems works </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="how-it-bg position-relative fea-number1">
                        <div class="how-it-ico mb-3 position-relative"> <img src="{{ asset('imagess/how-it-ico1.png') }}"> </div>
                        <h4 class="text-white fw-bold mb-0">Strong Security</h4>
                        <p class="text-white-50 fw-light mb-o mt-lg-3">We Implement HTTPS, robust firewalls, regular security audits, 2FA, strong password policies, encrypted data storage for our website. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir1.png') }}"> </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="how-it-bg position-relative fea-number2">
                        <div class="how-it-ico mb-3 position-relative"> <img src="{{ asset('imagess/how-it-ico2.png') }}"> </div>
                        <h4 class="text-white fw-bold mb-0">Excellence Coverage</h4>
                        <p class="text-white-50 fw-light mb-o mt-lg-3">Our company conducting through market research and prioritizing risk management to achieve excellence for our investors. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir2.png') }}"> </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="how-it-bg position-relative fea-number3">
                        <div class="how-it-ico mb-3 position-relative"> <img src="{{ asset('imagess/how-it-ico3.png') }}"> </div>
                        <h4 class="text-white fw-bold mb-0">Stable Funds</h4>
                        <p class="text-white-50 fw-light mb-o mt-lg-3">Our company offers stable funds through diversified portfolios and prudent asset allocation, ensuring consistent returns for investors. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir3.png') }}"> </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- How to end-->



    <!-- footer start -->
    <div class="footer-bg py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-logo">
                        <div class="footer-img mb-lg-4"> <img src=""></div>
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
                                <li><a href="{{ url('about') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        About
                                    </a></li>
                                <li><a href="{{ url('partners') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        Partners
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
                                <li><a href="{{ url('faq') }}" class="text-decoration-none text-white fw-medium">
                                        <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                                        FAQ
                                    </a></li>
                                <li><a href="{{ url('contact-us') }}" class="text-decoration-none text-white fw-medium">
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
                            <a href="{{ url('login') }}" class="text-white text-decoration-none fw-medium ms-2">Login</a>
                        </div>
                        <div class="reg-page ms-5">
                            <div class="reg-img"> <img src="{{ asset('imagess/reg-img.png') }}"> </div>
                            <a href="{{ url('register') }}" class="text-white text-decoration-none fw-medium ms-2">Register</a>
                        </div>
                                            </div>
                    <div class="company-email mt-4 mb-3">
                        <h6 class="text-white fw-medium mb-0">
                            <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                            E-Mail : randourx@gmail.com
                        </h6>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-lg-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="copy-rights "> <span class="text-white fw-normal"><a href="#" class="text-white text-decoration-none">randour-x.com </a> | @ Copyright <script>document.write(new Date().getFullYear())</script>. All Rights Reserved.</span> </div>
                </div>
                <div class="col-lg-4 offset-lg-2 order-1 order-lg-2">
                    <div class="company-rules"> 
                    <a href="{{ route('rules') }}" class="text-decoration-none text-white">Terms and Conditions</a> 
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
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.0.0/dist/iconify-icon.min.js"></script>
</body>

</html>