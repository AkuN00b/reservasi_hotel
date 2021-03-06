
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="{{ route('primary') }}">home</a></li>
                                        @guest
                                            <li><a href="{{ route('login') }}">login</a></li>
                                        @else
                                            @if (Auth::user()->role->id == 1)
                                                <li><a href="{{ route('admin.dashboard') }}">dashboard</a></li>
                                            @elseif (Auth::user()->role->id == 2)
                                                <li><a href="{{ route('receptionist.dashboard') }}">dashboard</a></li>
                                            @elseif (Auth::user()->role->id == 3)
                                                <li><a href="{{ route('customer.dashboard') }}">dashboard</a></li>
                                            @endif
                                        @endguest
                                        {{-- <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li> --}}
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