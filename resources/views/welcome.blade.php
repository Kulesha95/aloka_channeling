@extends('layouts.front')
@section('css')
    <style>
        .main-hero-section {
            background-image: url("{{ asset('img/Frontend/bg_3.jpg') }}");
            background-size: cover;
            background-position: 50% 0px;
            background-repeat: no-repeat;
            height: 90vh;
        }
        .logo-footer {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
        .rounded-button {
            border-radius: 40px;
            padding: 10px 20px;
        }
        .main-heading {
            font-size: 70px;
            line-height: 80%;
        }
        .rounded-input {
            border-radius: 40px;
            padding: 10px 20px;
            height: 50px;
        }
        .footer-image {
            background-image: url(img/Frontend/footer-bg.jpg);
            background-size: cover;
            background-position: 50% 0px;
            background-repeat: no-repeat;
        }
        .list-unstyled>li {
            line-height: 250%;
        }
    </style>



@endsection

@section('content')
    <div class=" container-fluid bg-primary">
        <div class="container">
            <div class=row>
                <span class="mr-5">
                    <i class="fas fa-phone">&nbsp;&nbsp;&nbsp;+94472223111</i>
                </span>
                <span>
                    <i class="fas fa-at">&nbsp;&nbsp;&nbsp;aloka@gmail.com</i>
                </span>

            </div>


        </div>
        <!--nav bar start-->

    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
        <a class="navbar-brand font-weight-bold" href="#">Aloka Pharmacy and Channelling Center</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#aboutus">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Channellings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

            </ul>
            @if (Auth::user())
                <a class="btn btn-outline-success my-2 my-sm-0 mr-1" href="{{ route('dashboard') }}"> My Account </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf()
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0"> Log Out</button>
                </form>
            @else
                <a class="btn btn-outline-success my-2 my-sm-0 mr-2 " href="{{ route('register') }}"> Register</a>
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}"> Login </a>
            @endif

        </div>
    </nav>

    <!--nav bar end-->

    <!--main banner-->
    <div class="main-hero-section container-fluid">
        <div class="container h-100">

            <div class="row h-100">
                <div class="col-6 d-flex">
                    <div class="my-auto d-block">
                        <p class="text-primary font-weight-bold">Welcome to Aloka Channeling Center And Pharmacy</p>
                        <h1 class="main-heading font-weight-bold">We are here for your care</h1>
                        <p class="pt-4 text-secondary">Professional health care services provider. Now we are at your finger
                            tips...!</p>
                        <a href="" class="btn btn-primary rounded-button">Make An Appointment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--about us start-->
    <section class="about-section container d-flex" id="aboutus">
        <div class="row my-auto">
            <div class="col-lg-6">
                <img src="img/Frontend/about.jpg" class="img-fluid">
            </div>
            <div class="col-lg-6 pl-5">
                <h1 class="py-5 text-center text-dark">About Us</h1>
                <p class="text-center"> Aloka pharmacy and channelling center is a well-known medical service provider which
                    is situated in Ambalantota area in Hambantota district.
                    We have become the top in many aspects in the healthcare industry in Southern Province.
                    We are committed in providing high quality medical care that is extensive and convenient to our valued
                    customers.
                    What differentiates us from other health caa premium quality healthcare service to our patients.
                    We are a leading provider of patient care and diagnostic services in the Southern Province.
                </p>
                <div class="row">
                    <button class="btn btn-danger mt-5 mx-auto rounded-button">Make an Appointment</button>
                </div>

            </div>
        </div>
    </section>
    <!--about us end-->
    <!--Mission Vision start-->
    <section class="about-section container">
        <div class="row">
            <div class="col-lg-6 pr-5">
                <h1 class="py-5 text-center text-dark">Our Vision</h1>
                <p class="text-center pl-5">What differentiates us from other health caa premium quality healthcare service
                    to our patients.
                    We are a leading provider of patient care and diagnostic services in the Southern Province.</p>
                <h1 class="py-5 text-center text-dark">Our Mission</h1>
                <p class="text-center pl-5">What differentiates us from other health caa premium quality healthcare service
                    to our patients.
                    We are a leading provider of patient care and diagnostic services in the Southern Province.</p>
            </div>
            <div class="col-lg-6">
                <img src="img/Frontend/about.jpg" class="img-fluid">
            </div>
        </div>
    </section>
    <!--Our services Begining-->
    <section class="service">
        <div class="container p-0 jumbotron">
            <div class="row">
                <div class="col-6 p-5">
                    <div class="row">
                        <h2>Our Services</h2>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-3 text-danger d-flex">
                                    <i class="fas fa-ambulance fa-2x ml-auto"></i>
                                </div>
                                <div class="col-9 text-left">
                                    <h5 class="font-weight-bold text-danger">Channelling Services</h5>
                                    <p>All kind of consultant channeling services</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-3 text-danger d-flex">
                                    <i class="fas fa-stethoscope fa-2x ml-auto"></i>
                                </div>
                                <div class="col-9 text-left">
                                    <h5 class="font-weight-bold text-danger">Qualified Doctors</h5>
                                    <p>Qualified and well experienced docotors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-3 text-danger d-flex">
                                    <i class="fas fa-tablet fa-2x ml-auto"></i>
                                </div>
                                <div class="col-9 text-left">
                                    <h5 class="font-weight-bold text-danger">e-Channelling</h5>
                                    <p>24 hours accessible e-channeling facility</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-3 text-danger d-flex">
                                    <i class="fas fa-briefcase-medical fa-2x ml-auto"></i>
                                </div>
                                <div class="col-9 text-left">
                                    <h5 class="font-weight-bold text-danger">Pharmacy Services</h5>
                                    <p>All kind of medicines and medical equipment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-5 bg-white">
                    <div class="row mb-5">
                        <h3 class="text-primary">Search doctor</h3>
                    </div>
                    <div class="row mb-3">
                        <input type="text" name="name" id="name" class="form-control rounded-input"
                            placeholder="Doctor Name">
                    </div>
                    <div class="row mb-3">
                        <select type="text" name="name" id="name" class="form-control rounded-input">
                            <option value="" disabled selected>Select Doctor</option>
                            <option value="">VOG</option>
                            <option value="">Dentist</option>
                            <option value="">Physician</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <input type="date" name="date" id="date" class="form-control rounded-input" placeholder="Date">
                    </div>
                    <div class="row mb-3">
                        <button class="btn btn-danger rounded-button w-100">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--today coming doctors begin-->
    <section class="doctor">
        <div class="container text-center">
            <h1 class="pt-5">Today Visiting Doctors</h1>
            <p class="pt-2 pb-3 text-secondary">Appointments can be made by online or visiting pharmacy</p>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card shadow">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-1.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Nishantha Muthumala <br></h5>
                            <p class="text-primary font-weight-bold">Physician</p>
                            <button class="btn btn-sm btn-primary rounded-button mb-3">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card shadow">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-4.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Samya Wijethunga<br></h5>
                            <p class="text-primary font-weight-bold">Cardiologist</p>
                            <button class="btn btn-sm btn-primary rounded-button mb-3">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card shadow">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-3.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Pasan Ekanayake <br></h5>
                            <p class="text-primary font-weight-bold">Endocrinologist</p>
                            <button class="btn btn-sm btn-primary rounded-button mb-3">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card shadow">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-2.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Nishanthi Kumarasinghe <br></h5>
                            <p class="text-primary font-weight-bold">Dermatologist</p>
                            <button class="btn btn-sm btn-primary rounded-button mb-3">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <!--Channeling schedule calender- begining-->
    <div class="container mt-5 pt-5">
        <h1 class="mx-auto text-center" class="mx-auto text-center">Channeing Schedule</h1>
        <hr>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            @include('components.schedule')
        </div>
    </div>
    <!--Channeling Schedule end-->
    <!--Contact us-->
    <section class="mt-5 pt-3">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center">
                    <h1>Contact Us</h1>
                    <p class="text-secondary">24 x 7 contact suport by Live Chat</p>
                </div>
            </div>
            <div class="row d-flex contact-info mb-5">
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="p-4 text-center bg-light">
                        <div class="icon d-flex align-items-center justify-content-center text-primary">
                            <i class="fas fa-map-pin fa-2x"></i>
                        </div>
                        <h3 class="my-4">Address</h3>
                        <p>No 46, Hospital Road, Wanduruppa, Ambalantota</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="p-4 text-center bg-light">
                        <div class="icon d-flex align-items-center justify-content-center text-primary">
                            <i class="fas fa-phone fa-2x"></i>
                        </div>
                        <h3 class="my-4">Contact Number</h3>
                        <p><a href="tel://1234567920">+94 47 22 23 111</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="p-4 text-center bg-light">
                        <div class="icon d-flex align-items-center justify-content-center text-primary">
                            <i class="fas fa-at fa-2x"></i>
                        </div>
                        <h3 class="my-4">Email Address</h3>
                        <p><a>aloka@gmail.com</span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="p-4 text-center bg-light">
                        <div class="icon d-flex align-items-center justify-content-center text-primary">
                            <i class="fas fa-globe fa-2x"></i>
                        </div>
                        <h3 class="my-4">Website</h3>
                        <p><a href="#">https://www.aloka.lk</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 order-md-last d-flex">
                    <form action="#" class="bg-light p-5 contact-form w-100">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-secondary py-3 px-5">
                        </div>
                    </form>
                </div>
                <div class="col-md-6 d-flex">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1014325.5253120373!2d79.93005460857687!3d6.744333413668414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6baf88d01f29d%3A0xdf432cf603af601!2sAloka%20Pharmacy!5e0!3m2!1sen!2slk!4v1609576240572!5m2!1sen!2slk"
                        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!--Contact page end-->
    <!--Footer begin-->
    <footer class="footer-image">
        <div class="container-fluid p-5">
            <div class="row mb-5">
                <div class="col-md">
                    <h5 class="ftco-heading-2">Aloka Channeling Center & Pharmacy</h5>
                    <p>Your Health is Our Priority</p>
                    <div class="row text-primary">
                        <i class="fab fa-facebook fa-2x mx-1"></i>
                        <i class="fab fa-twitter fa-2x mx-1"></i>
                        <i class="fab fa-instagram fa-2x mx-1"></i>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h5 class="ftco-heading-2">Channelings</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Physician</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Surgeon</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Dermatologist</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Othopedic Surgeon</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Endocrinicalogist</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Psychiatrist</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Neurologist</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Cardiologist</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Radiologist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h5 class="ftco-heading-2">Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Home</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>About</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Channelings</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Doctors</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h5 class="ftco-heading-2">Services</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Channeling Services</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Professional Staff</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>Qualified Doctors</a></li>
                            <li><a href="#"><i class="fas fa-long-arrow-alt-right mr-2"></i>24 Hours Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h5 class="ftco-heading-2">Have a Questions?</h5>
                        <ul class="list-unstyled text-primary">
                            <li><i class="fas fa-map-pin mr-2"></i><span class="text">No 46, Hospital Road,
                                    Wanduruppa, Ambalantota</span></li>
                            <li><a href="#"><i class="fas fa-phone mr-2"></i><span class="text">+94 47 22 23
                                        111</span></a></li>
                            <li><a href="#"><i class="fas fa-at mr-2"></i><span class="text"><span
                                            class="__cf_email__">mmddush@gmail.com</span></span></a>
                            </li>
                        </ul>
                        <div class="row justify-content-center">
                            <img class="logo-footer" src="{{ asset('img/Frontend/logo.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer end-->
@endsection