<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us - randour-x.com</title>
    
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
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ url('/') }}"> <img src="{{ asset('imagess/menu-ico1.png') }}"><br>
                                                    <span class="text-white"> Home </span></a> </div>
                                        </li>
                                        <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ url('about') }}"> <img src="{{ asset('imagess/menu-ico2.png') }}"><br>
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
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ url('faq') }}"> <img src="{{ asset('imagess/menu-ico5.png') }}"><br>
                                                    <span class="text-white"> FAQ</span></a> </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="menu-ico text-center"> <a class="nav-link active" aria-current="page" href="{{ url('contact-us') }}"> <img src="{{ asset('imagess/menu-ico6.png') }}"> <br>
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
                            <h2 class="text-white fw-normal mb-0">Contact Support</h2>
                        </div>

                        <script language=javascript>
                        function checkform() {
                            if (document.mainform.name.value == '') {
                                alert("Please type your full name!");
                                document.mainform.name.focus();
                                return false;
                            }
                            if (document.mainform.email.value == '') {
                                alert("Please enter your e-mail address!");
                                document.mainform.email.focus();
                                return false;
                            }
                            if (document.mainform.message.value == '') {
                                alert("Please type your message!");
                                document.mainform.message.focus();
                                return false;
                            }
                            return true;
                        }
                        </script>

                        <!-- Contact Form -->
                        <form method="POST" name="mainform" onsubmit="return checkform()" action="{{ route('contact.submit') }}">
                            @csrf
                            <input type="hidden" name="form_id" value="17226835894470">
                            <input type="hidden" name="form_token" value="0cea44f4a175d032ce40795296be90ea">
                            <input type="hidden" name="a" value="support">
                            <input type="hidden" name="action" value="send">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-block position-relative">
                                        <div class="form-ico">
                                            <iconify-icon icon="iconamoon:profile"></iconify-icon>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your Name" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-block position-relative">
                                        <div class="form-ico">
                                            <iconify-icon icon="ic:outline-lock"></iconify-icon>
                                        </div>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your Email" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-block position-relative">
                                        <textarea class="form-control" name="message" placeholder="Enter your Message" style="height: 180px;" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="innerpage-btn text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Submit Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-3">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="banner-img"> <img src="{{ asset('imagess/banner-img.png') }}"> </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="copy-rights text-center"> 
                        <span class="text-white fw-normal">
                            <a href="#" class="text-white text-decoration-none">randour-x.com </a> | 
                            @ Copyright <script>document.write(new Date().getFullYear())</script>. All Rights Reserved.
                        </span> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- Modal -->
    <div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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