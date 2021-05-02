@extends('layouts.frontend.app')

@section('title')
    Buy {{ $rooms->class->name }} Room {{ $rooms->bed->name }} Bed
@endsection

@push('css')
   
@endpush

@section('content')

@guest
    <div class="bradcam_area breadcam_bg_1">
        <h3 style="margin-top: -70px;">This Page Does Not Know You</h3>
    </div>

    <section class="blog_area single-post-area section-padding">
        <h3 class="text-center"><a href="{{ route('login') }}">Login Here</a></h3>
    </section>
@else
    <div class="bradcam_area breadcam_bg_1">
        <h3 style="margin-top: -70px;">Buy {{ $rooms->class->name }} Room ({{ $rooms->bed->name }}) Bed</h3>
    </div>

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    @if (Auth::user()->role->id == 3)
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf

                            <h3>Customer Form</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 mt-2">Name <sup><i class="fa fa-star-o"></i></sup></div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="text" value="{{ Auth::user()->name }}" name="name" placeholder="Full Name" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <input type="text" value="{{ Auth::user()->id }}" name="user_id" placeholder="Full Name" required class="single-input text-black" readonly hidden>
                                <input type="text" value="{{ Auth::user()->role->id }}" name="role_id" placeholder="Full Name" required class="single-input text-black" readonly hidden>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Email <sup><i class="fa fa-star-o"></i></sup></div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="email" value="{{ Auth::user()->email }}" name="email" placeholder="Input Email" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2" style="margin-top: 9px;">
                                        Identity <sup><i class="fa fa-star-o"></i></sup>
                                    </div>
                                    <div class="col-lg-10 input-group-icon">
                                        <div class="icon"><i class="fa fa-address-card" aria-hidden="true"></i></div>
                                        <div class="form-select border" id="default-select">
                                            <input type="text" name="identitas" value="{{ Auth::user()->identitas }}" placeholder="Input Address" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Identity Number <sup><i class="fa fa-star-o"></i></sup></div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="number" name="no_identitas" value="{{ Auth::user()->no_identitas }}" placeholder="Identity Number" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Address <sup><i class="fa fa-star-o"></i></sup></div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="text" name="alamat" value="{{ Auth::user()->alamat }}" placeholder="Input Address" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2" style="margin-top: 9px;">
                                        Gender <sup><i class="fa fa-star-o"></i></sup>
                                    </div>
                                    <div class="col-lg-10 input-group-icon">
                                        <div class="icon"><i class="fa fa-transgender" aria-hidden="true"></i></div>
                                        <div class="form-select border" id="default-select">
                                            <input type="text" name="jenis_kelamin" value="{{ Auth::user()->jenis_kelamin }}" placeholder="Input Address" required class="single-input text-black" readonly>
                                        </div>
                                    </div>
                                </div>

                                <input type="number" name="status" value="0" hidden>

                                <br>
                                
                                <sup><i class="fa fa-star-o"></i></sup> Those datas is from your <b><a href="{{ route('customer.settings') }}" style="text-decoration: underline;">Settings</a></b>
                                <input type="text" name="transaction_id" hidden value="{{ rand(11111111111, 99999999999) }}">
                                                        
                            <br><br>

                            <h3>Room want to Reserve Detail</h3>
                            <hr>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Bed Name</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->name }}" class="single-input text-black">
                                        <input type="text" name="bed_id" placeholder="First Name" required hidden value="{{ $beds->id }}" class="single-input text-black">
                                    </div>                                
                                </div>
                            </div>

                            <br>
                    
                            <div class="row">
                                <div class="col-lg-2 mt-2">Person Quantity</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->person }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Class Name</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $classes->name }}" class="single-input text-black">
                                        <input type="text" name="class_id" placeholder="First Name" required hidden value="{{ $classes->id }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Room Price</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $rooms->price }}" class="single-input text-black" id="price">
                                        <input type="text" name="room_id" placeholder="First Name" required hidden value="{{ $rooms->id }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Start Date
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Input Start Date" type="text" autocomplete="off" class="form-control datepicker startdate single-input text-black" name="tgl_awal" id="tgl_mulai">
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            End Date
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Input End Date" type="text" autocomplete="off" class="form-control datepicker enddate single-input text-black" name="tgl_akhir" id="tgl_akhir">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Duration
                                        </div>
                                        <div class="input-group border">
                                            <input placeholder="Duration" type="number" readonly required autocomplete="off" class="form-control single-input text-black" name="durasi" id="durasi">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Total Price
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Grand Price" type="number" readonly required autocomplete="off" class="form-control single-input text-black" name="total" id="total">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br><br>

                            <button type="submit" class="genric-btn primary-border btn-block">Booking</button>
                        </form>
                    @else
                        <form action="{{ route('booking.store.admin') }}" method="POST">
                            @csrf

                            <h3>Admin / Receptionist Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 mt-2">Name</div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ Auth::user()->name }}" class="single-input text-black">
                                        </div>
                                    </div>
                                </div>

                                <input type="text" name="transaction_id" hidden value="-">
                                <input type="text" name="user_id" placeholder="First Name" required hidden value="{{ Auth::user()->id }}" class="single-input text-black">
                                <input type="text" value="{{ Auth::user()->role->id }}" name="role_id" placeholder="Full Name" required class="single-input text-black" readonly hidden>

                                <br><br>

                                <h3>Customer Form</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 mt-2">Name</div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="text" name="name" placeholder="Full Name" required class="single-input text-black">
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Email</div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="email" name="email" placeholder="Input Email" required class="single-input text-black">
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2" style="margin-top: 9px;">
                                        Identity
                                    </div>
                                    <div class="col-lg-10 input-group-icon">
                                        <div class="icon"><i class="fa fa-address-card" aria-hidden="true"></i></div>
                                        <div class="form-select border" id="default-select">
                                            <select name="identitas">
                                                <option value="" holder>Select Identity Card</option>
                                                <option value="KTP">KTP</option>
                                                <option value="SIM">SIM</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Identity Number</div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="number" name="no_identitas" placeholder="Identity Number" required class="single-input text-black">
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2 mt-2">Address</div>
                                    <div class="col-lg-10">
                                        <div class="border">
                                            <input type="text" name="alamat" placeholder="Input Address" required class="single-input text-black">
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-2" style="margin-top: 9px;">
                                        Gender
                                    </div>
                                    <div class="col-lg-10 input-group-icon">
                                        <div class="icon"><i class="fa fa-transgender" aria-hidden="true"></i></div>
                                        <div class="form-select border" id="default-select">
                                            <select name="jenis_kelamin">
                                                <option value="" holder>Select Gender</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="number" name="status" value="3" hidden>
                            
                            <br><br>

                            <h3>Room want to Reserve Detail</h3>
                            <hr>

                            <div class="row">
                                <div class="col-lg-2" style="margin-top: 9px;">
                                    Room Number
                                </div>
                                <div class="col-lg-10 input-group-icon">
                                    <div class="icon"><i class="fa fa-bed" aria-hidden="true"></i></div>
                                    <div class="form-select border" id="default-select">
                                        <select name="room_number_id">
                                            <option value="" holder>Select Room Number</option>
                                            @foreach ($roomnumber as $rm)
                                                <option value="{{ $rm->id }}">{{ $rm->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Bed Name</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->name }}" class="single-input text-black">
                                        <input type="text" name="bed_id" placeholder="First Name" required hidden value="{{ $beds->id }}" class="single-input text-black">
                                    </div>                                
                                </div>
                            </div>

                            <br>
                    
                            <div class="row">
                                <div class="col-lg-2 mt-2">Person Quantity</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->person }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Class Name</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $classes->name }}" class="single-input text-black">
                                        <input type="text" name="class_id" placeholder="First Name" required hidden value="{{ $classes->id }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-2 mt-2">Room Price</div>
                                <div class="col-lg-10">
                                    <div class="border">
                                        <input type="text" name="first_name" placeholder="First Name" required readonly value="{{ $rooms->price }}" class="single-input text-black" id="price">
                                        <input type="text" name="room_id" placeholder="First Name" required hidden value="{{ $rooms->id }}" class="single-input text-black">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Start Date
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Input Start Date" type="text" autocomplete="off" class="form-control datepicker startdate single-input text-black" name="tgl_awal" id="tgl_mulai">
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            End Date
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Input End Date" type="text" autocomplete="off" class="form-control datepicker enddate single-input text-black" name="tgl_akhir" id="tgl_akhir">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Duration
                                        </div>
                                        <div class="input-group border">
                                            <input placeholder="Duration" type="number" readonly required autocomplete="off" class="form-control single-input text-black" name="durasi" id="durasi">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="mb-1">
                                            Total Price
                                        </div>
                                        <div class="input-group date border">
                                            <input placeholder="Grand Price" type="number" readonly required autocomplete="off" class="form-control single-input text-black" name="total" id="total">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br><br>

                            <button type="submit" class="genric-btn primary-border btn-block">Booking</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endguest

@endsection

@push('js')
    
@endpush