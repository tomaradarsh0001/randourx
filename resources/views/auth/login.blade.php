<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to randour-x.com</title>

    <meta name="designer" content="https://uniquehyips.com/">

    <!-- Bootstrap & Plugins CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- banner start-->
    <div class="banner-bg py-lg-4 position-relative">
        <div class="container">
            <header>
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-3">
                        <div class="head-logo">
                            <a href="{{ url('/') }}">
                                <img width="300" height="100" src="{{ asset('imagess/logorandour.png') }}" alt="RandourX Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="server-time d-flex align-items-center">
                            <div class="server-time-img">
                                <img src="{{ asset('imagess/server-time.png') }}" alt="Server Time">
                            </div>
                            <div class="server-content ms-3">
                                <h6 class="text-white fw-normal">Server Time : {{ now()->format('H:i:s A') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary ms-4">Register</a>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="desktop-view mt-lg-3">
                            <nav class="navbar navbar-expand-lg nav-head">
                                <div class="navbar-head">
                                    <h4 class="mb-0">Main Menu</h4>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="list-unstyled head-nav-link mb-0">
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a class="nav-link active" href="{{ url('/') }}">
                                                    <img src="{{ asset('imagess/menu-ico1.png') }}" alt="Home"><br>
                                                    <span class="text-white"> Home </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a class="nav-link active" href="{{ url('about') }}">
                                                    <img src="{{ asset('imagess/menu-ico2.png') }}" alt="About"><br>
                                                    <span class="text-white"> About </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#upcomingProjectModal">
                                                    <img src="{{ asset('imagess/menu-ico3.png') }}" alt="Upcoming Project"><br>
                                                    <span class="text-white"> Upcoming Project </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a class="nav-link active" href="#">
                                                    <img src="{{ asset('imagess/menu-ico4.png') }}" alt="Rules"><br>
                                                    <span class="text-white"> Rules </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a href="{{ url('faq') }}" class="nav-link active">
                                                    <img src="{{ asset('imagess/menu-ico5.png') }}" alt="FAQ"><br>
                                                    <span class="text-white"> FAQ </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center">
                                                <a href="{{ url('contact-us') }}" class="nav-link active">
                                                    <img src="{{ asset('imagess/menu-ico6.png') }}" alt="Contact Us"><br>
                                                    <span class="text-white"> Contact Us </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Login Form -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="innerpages text-center">
                        <div class="title mt-5 mb-4">
                            <h2 class="text-white fw-normal mb-0">Login Account</h2>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mt-4">
                                <!-- Email / Username / Mobile -->
                                <div class="col-lg-6">
                                    <div class="form-block position-relative">
                                        <div class="form-ico">
                                            <iconify-icon icon="tabler:user"></iconify-icon>
                                        </div>
                                        <input type="text" class="form-control" id="login" name="login"
                                            value="{{ old('login') }}" placeholder="Email, Username or Mobile"
                                            required autofocus>
                                        @error('login')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-6">
                                    <div class="form-block position-relative">
                                        <div class="form-ico">
                                            <iconify-icon icon="material-symbols:lock-outline"></iconify-icon>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-12 text-center">
                                    <h6 class="text-white mb-0 fw-normal">
                                        Forgot Password?
                                        <a href="{{ route('password.request') }}"
                                            class="fw-normal text-decoration-none text-white">Click Here</a>
                                    </h6>
                                </div>
                            </div>

                            <div class="innerpage-btn text-center mt-3 mb-3">
                                <button type="submit" class="btnMain btn btn-primary">Login Now</button>
                            </div>

                            <div class="login-con text-center reg-left">
                                <h6 class="text-white mb-0 fw-normal">
                                    New Member?
                                    <a href="{{ route('register') }}"
                                        class="fw-normal text-decoration-none text-white">Register</a>
                                </h6>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Banner Image -->
                <div class="col-lg-6">
                    <div class="banner-img">
                        <img src="{{ asset('imagess/banner-img.png') }}" alt="Banner">
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="copy-rights text-center">
                        <span class="text-white fw-normal">
                            <a href="{{ url('/') }}" class="text-white text-decoration-none">randour-x.com</a> |
                            © <script>document.write(new Date().getFullYear())</script>. All Rights Reserved.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Project Modal -->
    <div class="modal fade" id="upcomingProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upcoming Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/img/upcoming_project.jpg') }}" class="img-fluid"
                        alt="Upcoming Project">
                </div>
            </div>
        </div>
    </div>

    <!-- YouTube Modal -->
    <div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.0.0/dist/iconify-icon.min.js"></script>
</body>

</html>
