<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - randour-x.com</title>
    
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
                             
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-primary ms-4">Register</a>
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
            <h1 class="text-white">FAQ's</h1>
            <p class="text-white fw-medium">Suspendisse dolor justo, congue at porttitor eget, convallis
                nec augue. In hac habitasse <br> platea dictumst. Phasellus so
                dales dolor ut mollis eleifend. Ut commodo, purus in viverra
                tempor, <br> nisl mauris semper libero, ut aliquam orci ex non
                lectus. </p>
        </div>
    </div>

</div>

</div>
</div>
<!-- banner end -->
<!-- faq start-->
<div class="abt-bg pt-lg-5 position-relative ">
    <div class="container">
        
        <div class="row">
            <div class="col-xl-10 offset-xl-1 col-lg-12">
                
                
                <div class="accordion">
            <h5>How can I invest with randour-x.com ?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>To make a investment you must first become a member of randour-x.com . Once you are signed up, you can make your first deposit. All deposits must be made through the Members Area. You can login using the member username and password you receive when signup.</p>
        </div>

        <div class="accordion">
            <h5>How do I open my randour-x  Account?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>It's quite easy and convenient. Follow this link, fill in the registration form and then press "Register".</p>
        </div>

        <div class="accordion">
            <h5>Which e-currencies do you accept?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>We support USDT (BEP20 protocols), All transactions are processed in USDT Bep20, with cryptocurrency values converted based on the prevailing exchange rate during deposits or withdrawals.</p>
        </div>

        <div class="accordion">
            <h5>How can I withdraw funds?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Login to your account using your username and password and check the Withdraw section.</p>
        </div>
        
        <!-- -->
        <div class="accordion">
            <h5>How long does it take for my deposit to be added to my account?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Your account will be updated as fast, as you deposit.</p>
        </div>
        
        <div class="accordion">
            <h5>How can I change my e-mail address or password?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Log into your randour-x.com account and click on the "Account Information". You can change your e-mail address and password there.</p>
        </div>
        
        <div class="accordion">
            <h5>What if I can't log into my account because I forgot my password?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Click forgot password link, type your username or e-mail and you'll receive your account information.</p>
        </div>
        
        <div class="accordion">
            <h5>Does a daily profit paid directly to my currency account?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>No, profits are gathered on your randour-x.com account and you can withdraw them anytime.</p>
        </div>
        
        <!-- -->
        <div class="accordion">
            <h5>How do you calculate the interest on my account?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Depending on each plan. </p>
        </div>
        
        <div class="accordion">
            <h5>Can I do a direct deposit from my account balance?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Yes! To make a deposit from your randour-x.com  account balance. Simply login into your members account and click on Make Deposit ans select the Deposit from Account Balance.</p>
        </div>
        
        <div class="accordion">
            <h5>Can I make an additional deposit to randour-x.com account once? </h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>Yes, you can but all transactions are handled separately.</p>
        </div>
        
        <div class="accordion">
            <h5>After I make a withdrawal request, when will the funds be available?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>All payouts are instant.</p>
        </div>
        
        <div class="accordion">
            <h5>What is the Minimum Amount and Maximum Amount of Deposit and Withdrawal ?</h5>
            <i class="fas fa-minus"></i>
            <i class="fas fa-plus"></i>
        </div>
        <div class="panal">
            <p>The Minimum Amount of Deposit is $10. The Minimum Amount of Withdrawal is $5.<br>
			Withdrawal fees: 10%
			
			</p>
        </div>

        
    </div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&amp;display=swap');





.container h2::after{
position: absolute;
content: '';
width: 67px;
height: 2px;
right: 5px;
background-color: hotpink;
bottom: 0;
}

.accordion {
width: 100%;
padding: 0 5px;
border: 2px solid #4c47e9;
cursor: pointer;
display: flex;
margin: 10px 0;
justify-content: space-between;
align-items: center;
padding: 10px;
border-radius: 30px;

}

.accordion i {
color: #4c47e9;
transition: all .5s ease-in;
}
.accordion .fa-minus{
display: none;
}
.accordion .active, .accordion:hover{
background-color: #21333e;
color: white;
transition: all .5s ease-in;
border: 2px solid #dddddd;
}
.active .fa-minus{
display: block;
}
.active .fa-plus{
display: none;
}
.accordion h5{
font-size: 20px;
margin: 0;
color: #fff;
padding-left: 5px;
}
.active i, .active h5 , .accordion:hover i , .accordion:hover h5{
color: white;
}
.panal{
padding: 0 15px;
border-left: 1px solid #21333e;
margin-left: 25px;
font-size: 14px;
text-align: justify;
overflow: hidden;
transition: all .5s ease-in;
max-height: 0;
color: #fff;
}

</style>
<script>
    var acordion = document.getElementsByClassName('accordion');

    var i;
    var len = acordion.length;
    for (i = 0; i < len; i++) {
        acordion[i].addEventListener('click', function() {
            this.classList.toggle('active');
            var panal = this.nextElementSibling;
            if (panal.style.maxHeight) {
                panal.style.maxHeight = null;
            } else {
                panal.style.maxHeight = panal.scrollHeight + 'px';
            }
        })
    }

</script>
                
            </div>
        
    </div>
</div>
<!-- faq end-->

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


</html>