<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo text-white" href="javascript:0" style="text-decoration: none;">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="{{ asset('assets/backend/images/faces/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
              <span>Role: {{ Auth::user()->role->name }}</span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
              </div>
            </a>
          </div>
        </div>
      </li>

      {{-- START NAVIGATION --}}
      @if (Request::is('admin*'))
        <li class="nav-item nav-category">
          <span class="nav-link">Admin Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('primary') }}">
            <span class="menu-icon">
              <i class="mdi mdi-home-variant"></i>
            </span>
            <span class="menu-title">Home</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.bed.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-paw"></i>
            </span>
            <span class="menu-title">Bed Category</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.class.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-more"></i>
            </span>
            <span class="menu-title">Class Category</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.room.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-seat-individual-suite"></i>
            </span>
            <span class="menu-title">Room Category</span>
          </a>
        </li>
      @endif

      @if (Request::is('receptionist*'))
        <li class="nav-item nav-category">
          <span class="nav-link">Receptionist Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('primary') }}">
            <span class="menu-icon">
              <i class="mdi mdi-home-variant"></i>
            </span>
            <span class="menu-title">Home</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('receptionist.dashboard') }}">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
      @endif

      @if (Request::is('customer*'))
        <li class="nav-item nav-category">
          <span class="nav-link">Customer Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('primary') }}">
            <span class="menu-icon">
              <i class="mdi mdi-home-variant"></i>
            </span>
            <span class="menu-title">Home</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('customer.dashboard') }}">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
      @endif
      {{-- END NAVIGATION --}}

    </ul>
  </nav>