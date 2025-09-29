<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('member/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon">
    
    <!-- CSS Styles -->
    <style>
      .card-link {
        display: block;
        text-decoration: none;
      }
      .card-link:hover {
        text-decoration: none; 
      }
      .card {
        transition: transform 0.3s ease;
      }
      .card:hover {
        transform: scale(1.02); 
      }
      .animated-card-link {
        display: block;
        text-decoration: none;
        border-radius: 1px;
        position: relative;
      }
      .animated-card {
        position: relative;
        border-radius: 12px;
        background: white;
        overflow: hidden;
        padding: 2px;
        z-index: 1;
      }
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
        bottom: 0;
        width: 100%;
        background-color: #1a2035!important;
        z-index: 1000;
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
      .main-panel {
        padding-bottom: 70px; /* Add padding to prevent content from being hidden behind fixed footer */
      }
    </style>
    
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('member/assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('member/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">
    <link href="{{ asset('member/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('member/assets/css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('member/assets/css/kaiadmin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('member/assets/css/style.css') }}" rel="stylesheet" id="style">
    <link href="{{ asset('member/assets/css/demo.css') }}" rel="stylesheet">
    
    <!-- Webfont Loader -->
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
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="{{ asset('member/assets/img/kaiadmin/logo_light.svg') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
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
                      <a href="{{ route('dashboard')}}">
                        <span class="sub-item">Dashboard</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">MENU OPTIONS</h4>
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
                      <a href="{{ route('downlines.index')}}">
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
                      <a href="{{ route('member.transactions.deposit')}}">
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
                      <a href="{{ route('member.transactions.index')}}">
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
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-desktop"></i>
        <p>Logout</p>
        <span class="badge badge-danger">></span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
  
              
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="{{ asset('member/assets/img/kaiadmin/logo_light.svg') }}"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
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
                        src="{{ asset('assets/img/profile.jpg') }}"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Hizrian</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="{{ asset('assets/img/profile.jpg') }}"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        @yield('content')

        <footer class="footer">
          <div class="container-fluid">
            <ul class="nav nav-pills ">
              <li class="nav-item">
                <a class="nav-link " href="{{('dashboard')}}">
                  <span>
                    <img src="{{ asset('member/assets/img/home_icon.png') }}" alt="Home" style="width: 35px; height: 35px;">
                    <span class="nav-text">Home</span>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#buyPackageModal">
                      <span>
                          <img src="{{ asset('member/assets/img/buy_package.png') }}" alt="Buy Package" style="width: 35px; height: 35px;">
                          <span class="nav-text">Buy Package</span>
                      </span>
                  </a>
              </li>

            </ul>
          </div>
        </footer>
      </div>
    </div>
    <!-- Buy Package Modal -->
<!-- Buy Package Modal -->
<!-- Buy Package Modal -->
<div class="modal fade" id="buyPackageModal" tabindex="-1" aria-labelledby="buyPackageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="buyPackageModalLabel">Buy Package</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <p class="fw-bold">
            Available Balance: 
            <span class="text-success">{{ $user->wallet1 }} USD</span>
        </p>

        <form id="buyPackageForm" method="POST" action="{{ route('member.buyPackage') }}">
        @csrf
        <div class="mb-3">
            <label for="investAmount" class="form-label">Enter Amount (in multiples of 10)</label>
            <input type="number" class="form-control" id="investAmount" name="amount" placeholder="e.g. 50" required>
            <div id="errorMsg" class="text-danger fw-bold mt-2 d-none"></div>
        </div>
    </form>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="confirmBtn" disabled>Confirm</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let available = {{ $user->wallet1 }};
    let input = document.getElementById("investAmount");
    let errorBox = document.getElementById("errorMsg");
    let confirmBtn = document.getElementById("confirmBtn");

    function validateAmount() {
        let amount = parseInt(input.value);

        if (isNaN(amount)) {
            errorBox.innerText = "Please enter an amount.";
            errorBox.classList.remove("d-none");
            confirmBtn.disabled = true;
            return false;
        }

        if (amount < 10) {
            errorBox.innerText = "Amount must be at least 10 USD.";
            errorBox.classList.remove("d-none");
            confirmBtn.disabled = true;
            return false;
        }

        if (amount % 10 !== 0) {
            errorBox.innerText = "Amount must be in multiples of 10.";
            errorBox.classList.remove("d-none");
            confirmBtn.disabled = true;
            return false;
        }

        if (amount > available) {
            errorBox.innerText = "Amount cannot exceed available balance (" + available + " USD).";
            errorBox.classList.remove("d-none");
            confirmBtn.disabled = true;
            return false;
        }

        // ✅ Passed all validations
        errorBox.classList.add("d-none");
        confirmBtn.disabled = false;
        return true;
    }

    input.addEventListener("input", validateAmount);

    confirmBtn.addEventListener("click", function () {
    if (validateAmount()) {
        document.getElementById("buyPackageForm").submit();
    }
});

});
</script>



    <!-- Core JS -->
    <script src="{{ asset('member/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('member/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('member/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('member/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('member/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('member/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('member/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('member/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('member/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('member/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('member/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('member/assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods (don't include in production) -->
    <script src="{{ asset('member/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('member/assets/js/demo.js') }}"></script>

    <!-- Copy URL Function -->
    <script>
      function geturl() {
        var copyText = document.getElementById("url");
        copyText.select();
        copyText.setSelectionRange(0, 99999); 
        document.execCommand("copy");
        alert("Referral link copied: " + copyText.value);
      }
    </script>
  </body>
</html>