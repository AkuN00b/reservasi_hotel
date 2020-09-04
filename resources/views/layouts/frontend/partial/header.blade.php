
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="index.html">home</a></li>
                                        <li><a href="rooms.html">rooms</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="{{ route('primary') }}">
                                    <p class="text-white mt-1" style="font-weight: bold">{{ config('app.name', 'Laravel') }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                            <div class="book_room">
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            @guest
                                                <a href="{{ route('login') }}" data-toggle="tooltip" data-placement="bottom" title="Login" style="color: rgb(69, 149, 241);">
                                                    <i class="fa fa-sign-in fa-2x"></i>
                                                </a>
                                            @else
                                                @if (Auth::user()->role->id == 1)
                                                    <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="Dashboard" style="color: rgb(69, 149, 241);">
                                                        <i class="fa fa-tachometer fa-2x"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::user()->role->id == 2)
                                                    <a href="{{ route('receptionist.dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="Dashboard" style="color: rgb(69, 149, 241);">
                                                        <i class="fa fa-tachometer fa-2x"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::user()->role->id == 3)
                                                    <a href="{{ route('customer.dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="Dashboard" style="color: rgb(69, 149, 241);">
                                                        <i class="fa fa-tachometer fa-2x"></i>
                                                    </a>
                                                @endif
                                            @endguest                                            
                                        </li>
                                    </ul>
                                </div>
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="#test-form">Book A Room</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->