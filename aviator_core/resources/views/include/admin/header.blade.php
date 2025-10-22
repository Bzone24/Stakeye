<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}" style="width: max-content;"><img src="{{url('/images/logo.png')}}" alt="logo" style="    width: 190px;

        padding: 1.1px;
        height: max-content;
        border-radius: 8px;" /></a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}"><img src="{{url('/images/logo.png')}}" alt="logo" style="    width: 190px;

        padding: 1.1px;
        height: max-content;
        border-radius: 8px;"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-img">
              <img src="{{url('/aviatoradmin/assets/images/faces/face1.jpg')}}" alt="image">
              <span class="availability-status online"></span>
            </div>
            <div class="nav-profile-text">
              <p class="mb-1">{{admin('name')}}</p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="change-password">
              <i class="mdi mdi-cached me-2 text-success"></i> Change Password </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('admin/logout') }}">
              <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
          </div>
        </li>
        <li class="nav-item d-none d-lg-block full-screen-link">
          <a class="nav-link">
            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
          </a>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
