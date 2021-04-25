<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel </title>

    <!-- vendor css -->
    <link href="{{ asset('starlight/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('starlight/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('starlight/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('starlight/css/starlight.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="{{ url('home') }}" class="sl-menu-link @yield('dashbord')">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @if (Auth::user()->role==1)
          <a href="{{ url('category') }}" class="sl-menu-link @yield('category')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
        <a href="{{ url('subcategory') }}" class="sl-menu-link @yield('subcategory')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Sub Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ url('product') }}" class="sl-menu-link @yield('product')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Product</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ url('faq') }}" class="sl-menu-link @yield('faq')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Faq question</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
        
          <a href="{{ url('tes') }}" class="sl-menu-link @yield('tes')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Testimonial</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ url('setting') }}" class="sl-menu-link @yield('setting')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Setting</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ url('coupon') }}" class="sl-menu-link @yield('coupon')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">Coupon</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
         
        @endif
        
        
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Pages</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="blank.html" class="nav-link">Blank Page</a></li>
          <li class="nav-item"><a href="page-signin.html" class="nav-link">Signin Page</a></li>
          <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
          <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
        </ul>
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}</span>
              <img src="{{ asset('starlight//img/img5.png') }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        @yield('breadcrumb')
      

      <div class="sl-pagebody">
     @yield('content')
      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('starlight/lib/jquery/jquery.js')}}"></script>
    <script src="{{ asset('starlight/lib/popper.js/popper.js')}}"></script>
    <script src="{{ asset('starlight/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{ asset('starlight/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>

    <script src="{{ asset('starlight/js/starlight.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('footer_scripts')
  </body>
</html>
