<!-- footer -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            address
                        </h3>
                        <p class="footer_text">
                            @foreach ($dynamicdatas1 as $dd1)
                                {{ $dd1->value }} <br>
                            @endforeach 
                        </p>
                        {{-- <a href="#" class="line-button">Get Direction</a> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Reservation
                        </h3>
                        <p class="footer_text">
                            @foreach ($dynamicdatas2 as $dd2)
                                {{ $dd2->value }} <br>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Navigation
                        </h3>
                        <ul>
                            <li><a href="/">Home</a></li>
                            
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                @if (Auth::user()->role->id == 1)
                                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @elseif (Auth::user()->role->id == 2)
                                    <li><a href="{{ route('receptionist.dashboard') }}">Dashboard</a></li>
                                @elseif (Auth::user()->role->id == 3)
                                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                @endif
                            @endguest

                            @foreach ($classs as $cl)
                                <li><a href="{{ route('class.details',$cl->id.'/'.$cl->slug) }}">{{ $cl->name }} Room</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-8 col-md-7 col-lg-9">
                    <p class="copy_right">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;2020 - <script>document.write(new Date().getFullYear());</script> All rights reserved | This Program is Made With <i class="fa fa-heart-o" aria-hidden="true"></i> by Gerlando & Zildan</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
                <div class="col-xl-4 col-md-5 col-lg-3">
                    <div class="socail_links">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- link that opens popup -->