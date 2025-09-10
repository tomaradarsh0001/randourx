
<!doctype html>
<html lang="en">
<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="generator" content="">
<title>randour-x | Panel</title>

<!-- manifest meta -->
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="manifest" href="manifest.json" />

<!-- Favicons -->

<link rel="icon" href="member/assets/img/favicon.ico" type="image/icon">
<!-- Google fonts-->

<link rel="preconnect" href="https://fonts.googleapis.com/">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

<!-- bootstrap icons -->
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="{{ asset('member/assets/css/bootstrap-icons.css') }}">

<!-- Swiper carousel css -->
<link rel="stylesheet" href="{{ asset('member/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

<!-- Style css for this template -->
<link href="{{ asset('member/assets/css/style.css') }}" rel="stylesheet" id="style">

<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<!-- Favicon -->
<link rel="icon" href="{{ asset('member/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon">

<!-- WebFont Loader -->
<script src="{{ asset('member/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
      families: [
        "Font Awesome 5 Solid",
        "Font Awesome 5 Regular",
        "Font Awesome 5 Brands",
        "simple-line-icons",
      ],
      urls: ["{{ asset('member/assets/css/fonts.min.css') }}"],
    },
    active: function () {
      sessionStorage.fonts = true;
    },
  });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('member/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('member/assets/css/plugins.min.css') }}">
<link rel="stylesheet" href="{{ asset('member/assets/css/kaiadmin.min.css') }}">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('member/assets/css/demo.css') }}">

</head>
<body>
    <div class="wrapper">
      <!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/member/" class="logo">
              <img
                src="imagess/logorandour.png"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="member/">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>My Downline</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="my-sponsored">
                        <span class="sub-item">Sponsored Members</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>My Bonus</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="daily-income">
                        <span class="sub-item">ROI Bonus</span>
                      </a>
                    </li>
                    <li>
                      <a href="rank-income">
                        <span class="sub-item">Royalty Income</span>
                      </a>
                    </li>
                    <li>
                      <a href="level-income">
                        <span class="sub-item">Level Bonus</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Financials</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="topup-online">
                        <span class="sub-item">Wallet Recharge</span>
                      </a>
                    </li>
                    <li>
                      <a href="fund-transfer">
                        <span class="sub-item">Fund Transfer</span>
                      </a>
                    </li>
                   
                    <li>
                      <a href="withdrawal">
                        <span class="sub-item">Withdrawal Request</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#tables">
                  <i class="fas fa-table"></i>
                  <p>Reports</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="tables">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="purchase">
                        <span class="sub-item">Investment History</span>
                      </a>
                    </li>
                    <li>
                      <a href="topup-online-report">
                        <span class="sub-item">Wallet Recharge Report</span>
                      </a>
                    </li>
                    <li>
                      <a href="fund-transfer-report">
                        <span class="sub-item">Fund Transfer Report</span>
                      </a>
                    </li>
                    <li>
                      <a href="self-transfer-report">
                        <span class="sub-item">Self Transfer Report</span>
                      </a>
                    </li>
                    <li>
                      <a href="withdrawal-report">
                        <span class="sub-item">Fund Withdrawal Report</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-map-marker-alt"></i>
                  <p>Settings</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="my-profile">
                        <span class="sub-item">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="my-account">
                        <span class="sub-item">My Account</span>
                      </a>
                    </li>
                    <li>
                      <a href="change-password">
                        <span class="sub-item">Change Password</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Support</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="add-ticket">
                        <span class="sub-item">New Ticket</span>
                      </a>
                    </li>
                    <li>
                      <a href="contact-us">
                        <span class="sub-item">Ticket List</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="logout">
                  <i class="fas fa-desktop"></i>
                  <p>Logout</p>
                  <span class="badge badge-danger">></span>
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->
       <style>
         .pb-4{
                  padding-bottom: 0.5rem !important;
                }
                .page-inner{
                  padding-top: 19px !important;
                }
                .sidebar .nav>.nav-item a p, .sidebar[data-background-color=white] .nav>.nav-item a p{
                  font-size: 18px !important;
                }
                .sidebar .nav>.nav-item a, .sidebar[data-background-color=white] .nav>.nav-item a {
                  padding-top: 25px !important;
                }
       </style>      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="/member/" class="logo">
                <img
                  src="member/assets/img/kaiadmin/logo_dark.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="0"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
               
                
               

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="member/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Adarsh</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="member/assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Adarsh Tomar</h4>
                            <p class="text-muted">tomaradarsh0001@gmail.com</p>
                            <a
                              href="my-profile"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="my-profile">My Profile</a>
                                      
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3"><span class="fw-bold">Hi</span>, Adarsh Tomar RX43324</h3>
              
                 <h6 class="op-7 mb-2">Status: <span class="badge bg-success">Active</span></h6>
              </div>
              <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
              </div> -->
            </div>
            <div class="row">
            <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                  <div class="card-body skew-shadow">
                    <img
                      src="member/assets/img/visa.svg"
                      height="35"
                      alt="Visa Logo"
                    />
                    <h2 class="py-4 mb-0"> 500 USD</h2>
                    <div class="row">
                      <div class="col-8 pe-0">
                        <h3 class="fw-bold mb-1">My Wallet</h3>
                        <div class="text-small text-uppercase fw-bold op-8">
                        <a href="wallet-statements?wid=<?php echo base64_encode(3);?>" class="text-white size-12">View all Transaction</a>
                        </div>
                      </div>
                      <div class="col-4 ps-0 text-end">
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                  <div class="card-body bubble-shadow">
                    <img
                      src="member/assets/img/visa.svg"
                      height="35"
                      alt="Visa Logo"
                    />
                    <h2 class="py-4 mb-0">564 USD</h2>
                    <div class="row">
                      <div class="col-8 pe-0">
                        <h3 class="fw-bold mb-1">Income Wallet</h3>
                        <div class="text-small text-uppercase fw-bold op-8">
                        <a href="wallet-statements?wid=<?php echo base64_encode(2);?>" class="text-white size-12">View all Transaction</a>
                        </div>
                      </div>
                      <div class="col-4 ps-0 text-end">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                  <div class="card-body curves-shadow">
                    <img
                      src="member/assets/img/visa.svg"
                      height="35"
                      alt="Visa Logo"
                    />
                    <h2 class="py-4 mb-0">343 USD</h2>
                    <div class="row">
                      <div class="col-8 pe-0">
                        <h3 class="fw-bold mb-1">Investment</h3>
                        <div class="text-small text-uppercase fw-bold op-8">
                        <a href="purchase" class="text-white size-12">View all Transaction</a>
                        </div>
                      </div>
                      <div class="col-4 ps-0 text-end">
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-secondary bg-secondary-gradient">
                  <div class="card-body skew-shadow">
                    <img
                      src="member/assets/img/visa.svg"
                      height="35"
                      alt="Visa Logo"
                    />
                    <h2 class="py-4 mb-0">433 USD</h2>
                    <div class="row">
                      <div class="col-8 pe-0">
                        <h3 class="fw-bold mb-1">Withdrawen</h3>
                        <div class="text-small text-uppercase fw-bold op-8">
                        <a href="withdrawal-report" class="text-white size-12">View all Transaction</a>
                        </div>
                      </div>
                      <div class="col-4 ps-0 text-end">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-sm-6 col-md-4">
            <a href="daily-income" class="animated-card-link card-link">
              <div class="animated-card card card-stats card-round">
                <div class="animated-card-body card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-secondary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="animated-category card-category">ROI Bonus</p>
                        <h4 class="animated-title card-title">$43</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

             <style>
              .card-link {
                  display: block;
                  text-decoration: none;
                }

                .card-link:hover {
                  text-decoration: none; /* Removes underline on hover */
                }

                .card {
                  transition: transform 0.3s ease;
                }
               
                .card:hover {
                  transform: scale(1.02); /* Zoom in on hover */
                }
                 /* Outer Wrapper */
                .animated-card-link {
                  display: block;
                  text-decoration: none;
                  border-radius: 1px;
                  position: relative;
                }

                /* Card Container */
                .animated-card {
                  position: relative;
                  border-radius: 12px;
                  background: white;
                  overflow: hidden;
                  padding: 2px;
                  z-index: 1;
                }

                /* Animated Gradie2t Border */
                .animated-card::before {
                  content: "";
                  position: absolute;
                  top: -2px;
                  left: -2px;
                  right: -2px;
                  bottom: -2px;
                  border-radius: 1px;
                  border: 1px solid transparent;
                  background: linear-gradient(90deg, #ff416c, #ff4b2b, #1fa2ff, #12d8fa, #06ff99);
                  background-size: 300% 300%;
                  animation: gradientWave 5s infinite linear;
                  z-index: -1;
                }

                /* Keyframe for Gradient Animation */
                @keyframes gradientWave {
                  0% { background-position: 0% 50%; }
                  50% { background-position: 100% 50%; }
                  100% { background-position: 0% 50%; }
                }

                /* Inner Card */
                .animated-card-body {
                  position: relative;
                  z-index: 2;
                  border-radius: 10px;
                  background: white;
                  padding: 20px;
                }

                /* Icon Styling */
                .animated-icon {
                  font-size: 2rem;
                  color: #ff4b2b;
                }

                /* Text Styling */
                .animated-category {
                  font-weight: bold;
                  color: #555;
                }

                .animated-title {
                  font-size: 1.5rem;
                  font-weight: bold;
                  color: #333;
                }
                .pb-4{
                  padding-bottom: 0.5rem !important;
                }
                .page-inner{
                  padding-top: 19px !important;
                }
                .sidebar .nav>.nav-item a p, .sidebar[data-background-color=white] .nav>.nav-item a p{
                  font-size: 18px !important;
                }
                .sidebar .nav>.nav-item a, .sidebar[data-background-color=white] .nav>.nav-item a {
                  padding-top: 25px !important;
                }
             </style>
              <div class="col-sm-6 col-md-4">
              <a href="level-income" class="animated-card-link card-link">
                <div class="animated-card card card-stats card-round">
                  <div class="animated-card-body card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        >
                          <i class="far fa-check-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="animated-category card-category">Level Bonus</p>
                          <h4 class="animated-title card-title">$43</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-sm-6 col-md-4">
              <a href="rank-income" class="animated-card-link card-link">
                <div class="animated-card card card-stats card-round">
                  <div class="animated-card-body card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="animated-category card-category">Royalty Income</p>
                          <h4 class="animated-title card-title">$43</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="row" style="margin-bottom: 50px;">
                        <!-- Referral Link Card -->
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 align-self-stretch  pb-5" >
                            <div class="card text-center p-4 card-secondary bg-info-gradient h-100">
                                <div class="card-body skew-shadow d-flex flex-column justify-content-between">
                                    <div class="row align-items-center">
                                        <div class="col-8 col-md-6 col-xl-6">
                                            <div class="form-group form-floating is-valid mb-1 mt-4">
                                                <input type="text" class="form-control" id="url" placeholder="Referral Link" 
                                                    value="https://randour-x.com?username" readonly>
                                                <label class="form-control-label text-dark" for="url">Referral Link</label>
                                                <button type="button" class="text-color-theme tooltip-btn" onclick="geturl()">
                                                    <i class="bi bi-files p-3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-3 col-xl-3 ps-0">
                                            <img src="member/assets/img/linkcopy.png" height="70" alt="Copy Link" class="mw-100">
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <p class="text-white fw-bold mb-3">
                                            Invite your friends and earn rewards! Share your referral link and let them join 
                                            Randour-x. The more you refer, the more you earn!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Info Card -->
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 align-self-stretch  pb-5" >
                            <div class="card text-center p-4 card-secondary bg-info-gradient h-100">
                                <div class="card-body skew-shadow d-flex flex-column justify-content-between">
                                    <!-- User Info Row -->
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <div class="me-2">
                                            <img src="imagess/logorandour.png" class="img-fluid" style="width: 150px; height: 50px;" alt="User Logo">
                                        </div>
                                        <div class="text-start">
                                            <h6 class="mb-0 text-white"><b>UserID : </b> &apos;u sername &apos;</h6>
                                            <small class="text-white"><b>SponsorID : </b> &apos; sponsername &apos;</small>
                                        </div>
                                    </div>

                                    <!-- Stats Section -->
                                    <div class="row text-center mt-3">
                                        <div class="col-md-6">
                                            <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                                <h6>Total Sponsored <i class="bi bi-person"></i></h6>
                                                <p class="fw-bold">4</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                                <h6>Active Sponsored <i class="bi bi-person"></i></h6>
                                                <p class="fw-bold">7</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row text-center mt-3">
                                        <div class="col-md-6">
                                            <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                                <h6>Total Downline BV <i class="bi bi-bar-chart"></i></h6>
                                                <p class="fw-bold">54 ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tile bg-lightblue text-dark p-2 rounded shadow-sm">
                                                <h6>Total Downline <i class="bi bi-people"></i></h6>
                                                <p class="fw-bold">
                                                  
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <style>
                  .tile {
                        transition: transform 0.3s ease-in-out;
                    }

                    .tile:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    }

                    .col-md-6 {
                        margin-bottom: 10px;
                    }

                    .bg-lightblue {
                        background-color: #ADD8E6; /* Light blue color */
                    }

                    .row {
                        margin-top: 0px;
                    }

                    .tile {
                        padding: 3px !important; /* Smaller padding */
                        margin-bottom: 1px !important; /* Less space between tiles */
                    }
                    .sidebar .nav-collapse, .sidebar[data-background-color=white] .nav-collapse{
                        background:rgb(216, 187, 57) !important;
                        
                    }
                  
                    .sidebar .nav-collapse li a .sub-item, .sidebar[data-background-color=white] .nav-collapse li a .sub-item{
                      color: rgb(0, 0, 0) !important;
                    }
                    .sidebar .nav-collapse li a .sub-item:before, .sidebar[data-background-color=white] .nav-collapse li a .sub-item:before {
                      background: rgb(0, 0, 0) !important;
                    }
                  </style>

                      
                      </div>

                      <script>
                          function geturl() {
                              var copyText = document.getElementById("url");
                              copyText.select();
                              copyText.setSelectionRange(0, 99999); 
                              document.execCommand("copy");
                              alert("Referral link copied: " + copyText.value);
                          }
                      </script>


</div>
<style>
            
 .footer .nav .nav-item.centerbutton .nav-link{
    margin-top: -20px !important;
    margin-right: 10px !important;
    
 }

.footer .nav-link {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    text-decoration: none !important;
    color: #333 !important;
    font-size: 14px !important;
    padding: 10px !important;
    transition: all 0.3s ease-in-out !important;
}


.footer .nav-icon {
    font-size: 20px !important;
    margin-bottom: 5px !important;
}


.nav-pills>li>.nav-link{
    border: none !important;
}


.footer .nav .nav-item .nav-link span{
    margin-right: 0px !important;
    color: white;
}
.footer .nav .nav-item .nav-link i{
    margin-right: 0px !important;
    color: white;

}

.footer{
        position: fixed !important;
        background-color: #1a2035!important;
    }
.footer .nav .nav-item.centerbutton .nav-link .nav-menu-popover {
  width: 400px !important;
  left: -200px !important;
  background-color: #2b276aed !important;

}
.btn-lg {
    font-size: 15px !important;
    border-radius: 6px !important;
    padding: 5.5px 11.5px !important;
    font-weight: 400 !important;
}
.footer .nav .nav-item.centerbutton .nav-link.active {
    background-color: transparent !important;
}
.footer .nav .nav-item.centerbutton .nav-link.active::before {
    content: "";
    position: absolute;
    left: 100%;
    top: 0;
    width: 20px;
    height: 20px;
    background-image: radial-gradient(ellipse at 100% 100%, transparent 0%, transparent 70%, #1a2035 72%) !important;
}
.footer .nav .nav-item.centerbutton .nav-link.active::after {
    content: "";
    position: absolute;
    right: 100%;
    top: 0;
    width: 20px;
    height: 20px;
    background-image: radial-gradient(ellipse at 0% 100%, transparent 0%, transparent 70%, #1a2035 72%) !important;
}
.bi-x::before {
    color: white !important;
}
.btn-icon-text i {
    height: 60px;
    line-height: 58px;
    width: 60px;
    display: inline-block;
    vertical-align: middle;
    font-size: 32px;
    border-radius: var(--fimobile-rounded);
    background-color: rgb(31 152 255 / 53%) !important;
    color: #ffffff;
    margin-bottom: 5px;
}
.theme-radial-gradient{
    background: radial-gradient(ellipse at 30% 30%, #3e7ddb 0%, #3a5ed1 50%, #2f0abb 100%) !important;
}
.footer .container, .footer .container-fluid {
    display: block;
    align-items: right !important; 
}
.nav-pills>li>.nav-link {
    margin-top: 0px !important;
}
        </style>

<footer class="footer">
    <div class="container-fluid">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link " href="member/">
                    <span>
                    <img src="member/assets/img/home_icon.png" alt="Buy Package" style="width: 35px; height: 35px;">
                        <span class="nav-text">Home</span>
                    </span>
                </a>
            </li>
           
            <!-- .footer .container, .footer .container-fluid  -->
            <li class="nav-item">
                <a class="nav-link  " href="plans">
                    <span>
                    <img src="member/assets/img/buy_package.png" alt="Buy Package" style="width: 35px; height: 35px;">
                    <span class="nav-text">Buy Package</span>
                    </span>
                </a>
            </li>
            
        </ul>
    </div>
</footer>
      <!-- Custom template | don't include it in your project! -->
      
      <!-- End Custom template -->
    <!-- </div> -->
    <!--   Core JS Files   -->
    <script src="member/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="member/assets/js/core/popper.min.js"></script>
    <!-- <script src="member/assets/js/core/bootstrap.min.js"></script> -->

    <!-- jQuery Scrollbar -->
    <script src="member/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="member/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="member/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="member/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="member/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="member/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="member/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="member/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="member/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="member/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="member/assets/js/setting-demo.js"></script>
    <script src="member/assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
<script>
  function geturl() {

/* Get the text field */

var copyText = document.getElementById("url");

/* Select the text field */

copyText.select();

/* Copy the text inside the text field */

document.execCommand("copy");

/* Alert the copied text */

  Swal.fire(

    'Link Copied!',

    '',

    'success'

  );

}
</script>
    <script src="member/assets/js/popper.min.js"></script>
    <script src="member/assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="member/assets/js/jquery.cookie.js"></script>
    <script src="member/assets/js/main.js"></script>
    <script src="member/assets/js/color-scheme.js"></script>
    <script src="member/assets/vendor/chart-js-3.3.1/chart.min.js"></script>
    <script src="member/assets/vendor/progressbar-js/progressbar.min.js"></script>
    <script src="member/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>
    <script src="member/assets/js/app.js"></script>
  </body>
</html>