<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo text-white" href="javascript:0" style="text-decoration: none;">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          @if (Request::is('admin*'))
          <a href="{{ route('admin.settings') }}" style="text-decoration: none; color: white;">
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
          </a>
          @endif

          @if (Request::is('receptionist*'))
          <a href="{{ route('receptionist.settings') }}" style="text-decoration: none; color: white;">
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
          </a>
          @endif

          @if (Request::is('customer*'))
          <a href="{{ route('customer.settings') }}" style="text-decoration: none; color: white;">
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
          </a>
          @endif

          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            @if (Request::is('admin*'))
            <a href="{{ route('admin.settings') }}" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Settings</p>
              </div>
            </a>
            @endif
            @if (Request::is('receptionist*'))
            <a href="{{ route('receptionist.settings') }}" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Settings</p>
              </div>
            </a>
            @endif
            @if (Request::is('customer*'))
            <a href="{{ route('customer.settings') }}" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Settings</p>
              </div>
            </a>
            @endif
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
          <a class="nav-link" data-toggle="collapse" href="#bed" aria-expanded="false" aria-controls="bed">
            <span class="menu-icon">
              <i class="mdi mdi-paw"></i>
            </span>
            <span class="menu-title">Bed</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="bed">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.bed.index') }}">Bed Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.bed.request') }}">Bed Category Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#class" aria-expanded="false" aria-controls="class">
            <span class="menu-icon">
              <i class="mdi mdi-more"></i>
            </span>
            <span class="menu-title">Class</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="class">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.class.index') }}">Class Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.class.request') }}">Class Category Request</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.class.image-request') }}">Class Image Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#room" aria-expanded="false" aria-controls="room">
            <span class="menu-icon">
              <i class="mdi mdi-seat-individual-suite"></i>
            </span>
            <span class="menu-title">Room</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="room">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.room.index') }}">Room Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.room.request') }}">Room Category Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.room-number.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-key-plus"></i>
            </span>
            <span class="menu-title">Room Number List</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.user.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-outline"></i>
            </span>
            <span class="menu-title">User Data</span>
          </a>
        </li>
        {{-- <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.booking.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            <span class="menu-title">Booking</span>
          </a>
        </li> --}}
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            <span class="menu-title">Booking</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="booking">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.booking.index') }}">All Booking</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.booking.customer') }}">Customer Booking</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.dynamic-data.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-layers"></i>
            </span>
            <span class="menu-title">Dynamic Data</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('admin.settings') }}">
            <span class="menu-icon">
              <i class="mdi mdi-settings"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"">
            <span class="menu-icon">
              <i class="mdi mdi-logout"></i>
            </span>
            <span class="menu-title">Logout</span>
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
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#bed" aria-expanded="false" aria-controls="bed">
            <span class="menu-icon">
              <i class="mdi mdi-paw"></i>
            </span>
            <span class="menu-title">Bed</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="bed">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.bed.index') }}">Bed Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.bed.request') }}">My Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#class" aria-expanded="false" aria-controls="class">
            <span class="menu-icon">
              <i class="mdi mdi-more"></i>
            </span>
            <span class="menu-title">Class</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="class">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.class.index') }}">Class Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.class.request') }}">My Request</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.class.image-request') }}">My Image Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#room" aria-expanded="false" aria-controls="room">
            <span class="menu-icon">
              <i class="mdi mdi-seat-individual-suite"></i>
            </span>
            <span class="menu-title">Room</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="room">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.room.index') }}">Room Category</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.room.request') }}">My Request</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            <span class="menu-title">Booking</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="booking">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.booking.index') }}">All Booking</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('receptionist.booking.customer') }}">Customer Booking</a> </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('receptionist.settings') }}">
            <span class="menu-icon">
              <i class="mdi mdi-settings"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"">
            <span class="menu-icon">
              <i class="mdi mdi-logout"></i>
            </span>
            <span class="menu-title">Logout</span>
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
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('customer.booking.index') }}">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            <span class="menu-title">Booking</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('customer.settings') }}">
            <span class="menu-icon">
              <i class="mdi mdi-settings"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"">
            <span class="menu-icon">
              <i class="mdi mdi-logout"></i>
            </span>
            <span class="menu-title">Logout</span>
          </a>
        </li>
      @endif
      {{-- END NAVIGATION --}}
      
    </ul>
  </nav>