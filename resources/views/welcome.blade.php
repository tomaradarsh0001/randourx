<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to randour-x</title>

    <meta name="designer" href="https://uniquehyips.com/">

    <!--Basic Bootstrap-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!--Font icons-->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" />

    <!--Carousel Slider-->
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet">
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
                        <div class="head-logo"> <a href="{{ url('/') }}" class=""><img
                                    src="{{ asset('imagess/logorandour.png') }}" width="300px"></a> </div>
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
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                                    </button>
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

                                        <!-- Bootstrap CSS -->

                                        <!-- <li>
                                            <div class="menu-ico text-center"> <a class="nav-link active"
                                                    aria-current="page"> <img src="{{ asset('imagess/menu-ico3.png') }}"> <br>
                                                    <span class="text-white"> Upcoming Project</span></a> </div>
                                        </li> -->
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
                                            <div class="menu-ico text-center"> <a href="{{ route('rules') }}" class="nav-link active"
                                                    aria-current="page"> <img src="{{ asset('imagess/menu-ico4.png') }}"><br>
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
                <div class="col-lg-6">
                    <div class="banner-sec mt-lg-5">
                        <h1 class="text-white">Artificial Intelligence <br>
                            Deep Learning<br>
                            Collateralized</h1>
                        <p class="text-white fw-medium">Our company specializes in Ether Collateralized services,
                            leveraging the potential of Ethereum's blockchain technology. By utilizing Ether as
                            collateral, we offer innovative financial solutions that enable investors to access
                            liquidity without selling their cryptocurrency holdings. </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-img"> <img src="{{ asset('imagess/Robot Image.png') }}" width="600px"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="statistics-list text-center position-relative">
                        <h2 class="text-white fw-semibold mb-lg-4">Randor-X</h2>
                        
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner-btn ms-lg-4 position-relative"> <a href="{{ url('register') }}" class="btn btn-primary">Borrow
                            Now <img src="{{ asset('imagess/btn-arrow.png') }}" class="ms-1"></a> <a href="{{ url('about') }}"
                            class="text-white fw-normal ms-5 link-learn">Learn More</a>
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
                            <div class="abt-btn mt-lg-3"> <a href="{{ url('about') }}"
                                    class="btn btn-secondary">About Us<img src="{{ asset('imagess/btn-arrow.png') }}"
                                        class="ms-3"></a> </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="abt-content">
                            <p class="text-white-50">We ensure
                                transparency, security, and efficiency in collateralized transactions. Our platform
                                provides flexible borrowing options, allowing clients to unlock the value of their Ether
                                assets while retaining exposure to potential price appreciation. </p>
                            <p class="text-white-50">With robust risk management measures and personalized support, we
                                empower investors to optimize their financial strategies and capitalize on the
                                opportunities presented by the evolving crypto landscape.</p>
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
                        <p class="text-white-50 fw-light mb-o mt-lg-3">We Implement HTTPS, robust firewalls, regular
                            security audits,strong password policies, encrypted data storage for our website. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir1.png') }}"> </div>
                            <div class="fea-link-page"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="how-it-bg position-relative fea-number2">
                        <div class="how-it-ico mb-3 position-relative"> <img src="{{ asset('imagess/how-it-ico2.png') }}"> </div>
                        <h4 class="text-white fw-bold mb-0">Excellence Coverage</h4>
                        <p class="text-white-50 fw-light mb-o mt-lg-3">Our company conducting through market research
                            and prioritizing risk management to achieve excellence for our investors. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir2.png') }}"> </div>
                            <div class="fea-link-page"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="how-it-bg position-relative fea-number3">
                        <div class="how-it-ico mb-3 position-relative"> <img src="{{ asset('imagess/how-it-ico3.png') }}"> </div>
                        <h4 class="text-white fw-bold mb-0">Stable Funds</h4>
                        <p class="text-white-50 fw-light mb-o mt-lg-3">Our company offers stable funds through
                            diversified portfolios and prudent asset allocation, ensuring consistent returns for
                            investors. </p>
                        <div class="fea-link-service mt-5">
                            <div class="how-it-circle"> <img src="{{ asset('imagess/how-it-cir3.png') }}"> </div>
                            <div class="fea-link-page"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How to end-->
    <!-- investment plan start -->
    <div class="plan-details pt-lg-4 head-pad">
        <div class="container">
            <div class="row mb-lg-4">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h2 class="text-white fw-normal">Investment Plan</h2>
                        <p class="text-white fw-normal"> Explore our investment offer for lucrative opportunities backed
                            by thorough market <br> analysis, diverse portfolio options, expert guidance, and a
                            commitment <br> to maximizing returns while managing risk effectively. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="plan-carousel owl-carousel">
                        <div class="plan-sec plan-bg1">
                            <div class="plan-head mb-4">
                                <h6 class="text-white fw-semibold text-uppercase mb-0">PLAN A</h6>
                            </div>
                            <div class="plan-percentage">
                                <h3 class="text-white fw-semibold">2% <span class="text-white"> - for 100 Days</span>
                                </h3>
                            </div>
                            <div class="table-height">
                                <table class="plan-detail text-center ">
                                    <thead>
                                        <tr>
                                            <th>Min - Inv</th>
                                            <th>Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$10</td>
                                            <td>$20</td>
                                        </tr>
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="plan-btn mt-4"> <a href="javascript:openCalculator('1')"
                                    class="btn btn-primary">Calculate</a> </div>
                        </div>
                        <div class="plan-sec plan-bg2">
                            <div class="plan-head mb-4">
                                <h6 class="text-white fw-semibold text-uppercase mb-0">PLAN B</h6>
                            </div>
                            <div class="plan-percentage">
                                <h3 class="text-white fw-semibold">Level Income <span class="text-white"> </span>
                                </h3>
                            </div>
                            <div class="table-height">
                                <table class="plan-detail text-center ">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 </td>
                                            <td>10% </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>3% </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2% </td>
                                        </tr>
                                        <tr>
                                            <td>4-5</td>
                                            <td>1%</td>
                                        </tr>
                                          <tr>
                                            <td>6-10</td>
                                            <td>0.5%</td>
                                        </tr>
                                          <tr>
                                            <td>11-15</td>
                                            <td>1%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="plan-btn mt-4"> <a href="javascript:openCalculator('2')"
                                    class="btn btn-primary">Calculate</a> </div>
                        </div>
                        <div class="plan-sec plan-bg3">
                            <div class="plan-head mb-4">
                                <h6 class="text-white fw-semibold text-uppercase mb-0">PLAN C</h6>
                            </div>

                            <div class="plan-percentage">
                                <h3 class="text-white fw-semibold">Royalty Income<span class="text-white"> </span> </h3>
                            </div>
                            <div class="table-height">
                                <table class="plan-detail text-center ">
                                    <thead>
                                        <tr>
                                            <th>Min - Max</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$2500</td>
                                            <td>5% </td>
                                        </tr>
                                        <tr>
                                            <td>$7500</td>
                                            <td>10% </td>
                                        </tr>
                                        <tr>
                                            <td>$17500</td>
                                            <td>20% </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="plan-btn mt-4"> <a href="javascript:openCalculator('3')"
                                    class="btn btn-primary">Calculate</a> </div>
                        </div>
                        
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- investment plan end  -->
    <!-- affiliate start -->
    <div class="py-lg-5 affiliate-aft position-relative head-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="title text-center">
                        <h3 class="text-white fw-semibold">Affiliate programs</h3>
                        <p class="text-white fw-medium">Join our affiliate program. Share your unique referal link and
                            enjoy unlimited commission.</p>
                    </div>
                    <div class="affiliate-arrow text-center mt-lg-2"> <img src="{{ asset('imagess/affiliate-arrow.png') }}"> </div>
                </div>
                <div class="col-lg-3 offset-lg-1 order-3 order-lg-3 col-md-6">
                    <div class="title">
                        <h3 class="text-white fw-normal">Referral Program:</h3>
                    </div>
                    <div class="ref-program mt-4">
                        <div class="ref-img"> <img src="{{ asset('imagess/ref-ico.png') }}"> </div>
                        <div class="ref-value ms-3">
                            <h5 class="text-white fw-semibold mb-0">Level 1</h5>
                            <span class="text-white fw-medium">10%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- affiliate end -->
    <!-- transaction history start -->
    <div class="transaction-bg py-3 head-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h3 class="text-white fw-semibold mb-0">1st Referrl income opne by default</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="pb-lg-5 pt-lg-4 history-bg head-pad">
    <div class="container">
        <div class="row justify-content-center mt-lg-4">
            <div class="col-xl-6 col-lg-8">
                <div class="tra-pad-left">
                    <div class="title text-center mb-3">
                        <h4 class="text-white fw-semibold">Top 10 Future Crypto</h4>
                    </div>
                    <div class="table-responsive text-center">
                        <table class="table table-bordered table-hover table-striped last-withdraw mx-auto">
                            <tbody>
                                <tr>
                                    <td class="align-middle">Bitcoin</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/deposit-ico1.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Ethreum</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/deposit-ico2.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Usdt Tether</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/usdt.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">BNB</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/bnb.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Ripple</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/ripple.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Cardano</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/cardano.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Solana</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/Solana.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Polkadot</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/Polkadot.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">BNB USD</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/bnb usd.png') }}" alt="icon">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">RX Token</td>
                                    <td class="text-center">
                                        <img src="{{ asset('imagess/RX Token.png') }}" alt="icon">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
 .table td {
    vertical-align: middle;
    padding: 12px;
}

.table img {
    width: 30px; /* Adjust size as needed */
    height: auto;
    display: inline-block; /* Ensures proper centering */
}


</style>
    <!-- transaction history end -->

    <script language="javascript">
        <!--
        function openCalculator(id) {

            w = 500;
            h = 400;
            t = (screen.height - h - 30) / 2;
            l = (screen.width - w - 30) / 2;
            window.open('?a=calendar&type=' + id, 'calculator' + id, "top=" + t + ",left=" + l + ",width=" + w +
                ",height=" + h + ",resizable=1,scrollbars=0");



            for (i = 0; i < document.spendform.h_id.length; i++) {
                if (document.spendform.h_id[i].value == id) {
                    document.spendform.h_id[i].checked = true;
                }
            }



        }

        function updateCompound() {
            var id = 0;
            var tt = document.spendform.h_id.type;
            if (tt && tt.toLowerCase() == 'hidden') {
                id = document.spendform.h_id.value;
            } else {
                for (i = 0; i < document.spendform.h_id.length; i++) {
                    if (document.spendform.h_id[i].checked) {
                        id = document.spendform.h_id[i].value;
                    }
                }
            }

            var cpObj = document.getElementById('compound_percents');
            if (cpObj) {
                while (cpObj.options.length != 0) {
                    cpObj.options[0] = null;
                }
            }

            if (cps[id] && cps[id].length > 0) {
                document.getElementById('coumpond_block').style.display = '';

                for (i in cps[id]) {
                    cpObj.options[cpObj.options.length] = new Option(cps[id][i]);
                }
            } else {
                document.getElementById('coumpond_block').style.display = 'none';
            }
        }
        var cps = {};
        -->
    </script>

    <!-- footer start -->
    <div class="footer-bg py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-logo">
                        <div class="footer-img mb-lg-4"> <img src="{{ asset('imagess/logorandour.png') }}" width="200px" height="66px"></div>
                        <p class="text-white fw-semibold">By utilizing Ether as collateral, we offer innovative
                            financial solutions that enable investors to access liquidity without selling their
                            cryptocurrency holdings. </p>
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
                                <li><a href="{{ url('partners') }}"
                                        class="text-decoration-none text-white fw-medium">
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
                                <li><a href="{{ url('contact-us') }}"
                                        class="text-decoration-none text-white fw-medium">
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
                            <a href="{{ url('login') }}"
                                class="text-white text-decoration-none fw-medium ms-2">Login</a>
                        </div>
                        <div class="reg-page ms-5">
                            <div class="reg-img"> <img src="{{ asset('imagess/reg-img.png') }}"> </div>
                            <a href="{{ url('register') }}"
                                class="text-white text-decoration-none fw-medium ms-2">Register</a>
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
                    <div class="copy-rights "> <span class="text-white fw-normal"><a href="#"
                                class="text-white text-decoration-none">randour-x.com</a> | @ Copyright <script>
                                document.write(new Date().getFullYear())
                            </script>. All Rights Reserved.</span> </div>
                </div>
                <div class="col-lg-4 offset-lg-2 order-1 order-lg-2">
                    <div class="company-rules">
                        <a href="{{ route('rules') }}" class="text-decoration-none text-white">Terms and
                            Conditions</a>
                        <a href="{{ route('rules') }}" class="text-decoration-none text-white">Privacy and Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer end -->
    <!-- Modal -->
    <div class="modal fade  modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                            allowfullscreen></iframe>
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


<!-- Mirrored from randour-x.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2024 11:13:15 GMT -->

</html>


<script>
    function randomInteger(min, max) {

        let rand = min - 0.5 + Math.random() * (max - min + 1);
        return Math.round(rand);
    }


    function Intbl() {
        $.ajax({
            url: '/random_table/?table=in',
            type: "POST",
            dataType: "html",
            data: '',
            success: function (response) {
                $('#in-table').html(response);
            },
            error: function (response) {
                //alert("Ошибка при отправке формы");
            }
        });
        setTimeout(Intbl, randomInteger(1500, 3000));
    }

    function Outtbl() {
        $.ajax({
            url: '/random_table/?table=out',
            type: "POST",
            dataType: "html",
            data: '',
            success: function (response) {
                $('#out-table').html(response);
            },
            error: function (response) {
                //alert("Ошибка при отправке формы");
            }
        });
        setTimeout(Outtbl, randomInteger(1000, 3000));
    }
    Outtbl();
    Intbl();
</script>