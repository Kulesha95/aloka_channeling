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

        .text-black {
            style="color: black;

        }
        .logo-footer{
          width:200px;
          height:200px;
          border-radius:50%;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    <div class="main-hero-section" class="container-fluid">
        <div class="row ">
            <div class="col-6">
                <p>Welcome to</p>
                <p>Aloka Pharmacy and Channelling</p>

            </div>
        </div>

    </div>
    <!--about us start-->
    <section class="about-section" class="container py-5" class="d-flex" id="aboutus">
        <div class="row my-auto">
            <div class="col-lg-6">
                <img src="img/Frontend/about.jpg" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <h1 class="py-5 text-center" class="text-black">About Us</h1>
                <p class="text-center"> Aloka pharmacy and channelling center is a well-known medical service provider which
                    is situated in Ambalantota area in Hambantota district.
                    We have become the top in many aspects in the healthcare industry in Southern Province.
                    We are committed in providing high quality medical care that is extensive and convenient to our valued
                    customers.
                    What differentiates us from other health caa premium quality healthcare service to our patients.
                    We are a leading provider of patient care and diagnostic services in the Southern Province.
                </p>
                <button class="btn btn-danger " class="mt-5">Make an Appointment</button>

            </div>
        </div>
    </section>
    <!--about us end-->
    <!--Mission Vision start-->
    <section class="about-section" class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="py-5 text-center" style="color: black;">Our Vision</h1>
                <p class="text-center pl-5">What differentiates us from other health caa premium quality healthcare service
                    to our patients.
                    We are a leading provider of patient care and diagnostic services in the Southern Province.</p>
                <h1 class="py-5 text-center" style="color: black;">Our Mission</h1>
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
        <div class="container text-center pt-5">
            <h1>Our Services</h1>
            <hr>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-2 pr-5 text-danger d-flex">
                            <i class="fas fa-ambulance fa-2x my-auto ml-auto"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="font-weight-light text-danger">Channelling Services</h3>
                            <p>All kind of consultant channeling services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-2 pr-5 text-danger d-flex">
                            <i class="fas fa-stethoscope fa-2x my-auto ml-auto"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="font-weight-light text-danger">Qualified Doctors</h3>
                            <p>Qualified and well experienced docotors</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-2 pr-5 text-danger d-flex">
                            <i class="fas fa-tablet  fa-2x my-auto ml-auto"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="font-weight-light text-danger">e-Channelling</h3>
                            <p>24 hours accessible e-channeling facility</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-2 pr-5 text-danger d-flex">
                            <i class="fas fa-briefcase-medical fa-2x my-auto ml-auto"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="font-weight-light text-danger">Pharmacy Services</h3>
                            <p>All kind of medicines and medical equipment</p>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        </div>


    </section>
    <!--today coming doctors begin-->
    <section class="doctor">
        <div class="container text-center">
            <h1 class="pt-5">Today Visiting Doctors</h1>
            <h6 class="pt-2 pb-3">Appointments can be made by online or visiting pharmacy</h6>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-1.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Nishantha Muthumala <br></h5>
                            <p class="text-primary font-weight-bold">Physician</p>
                            <button class="btn btn-sm btn-primary rounded">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-4.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Samya Wijethunga<br></h5>
                            <p class="text-primary font-weight-bold">Cardiologist</p>
                            <button class="btn btn-sm btn-primary rounded">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-3.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Pasan Ekanayake <br></h5>
                            <p class="text-primary font-weight-bold">Endocrinologist</p>
                            <button class="btn btn-sm btn-primary rounded">Book Now</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-head">
                            <img src="{{ asset('img/Frontend/doc-2.jpg') }}" class="img-fluid" alt="">
                            <h5 class="font-weight-bold">Dr.Nishanthi Kumarasinghe <br></h5>
                            <p class="text-primary font-weight-bold">Dermatologist</p>
                            <button class="btn btn-sm btn-primary rounded">Book Now</button>
                        </div>
                    </div>

                </div>
            </div>

    </section>


    <!--Channeling schedule calender- begining-->
    <div class="container mt-3" class="row d-flex">
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
    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
          <div class="row justify-content-center mb-5 pb-3">
              <div class="col-md-7 heading-section text-center ftco-animate">
                  <h2 class="mb-4">Contact Us</h2>
                  <p>24 x 7 contact suport by Live Chat</p>
              </div>
          </div>
          <div class="row d-flex contact-info mb-5">
              <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                  <div class="align-self-stretch box p-4 text-center bg-light">
                      <div class="icon d-flex align-items-center justify-content-center">
                          <span class="icon-map-signs"></span>
                      </div>
                      <h3 class="mb-4">Address</h3>
                      <p>No 46, Hospital Road, Wanduruppa, Ambalantota</p>
                  </div>
              </div>
              <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                  <div class="align-self-stretch box p-4 text-center bg-light">
                      <div class="icon d-flex align-items-center justify-content-center">
                          <span class="icon-phone2"></span>
                      </div>
                      <h3 class="mb-4">Contact Number</h3>
                      <p><a href="tel://1234567920">+94 47 22 23 111</a></p>
                  </div>
              </div>
              <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                  <div class="align-self-stretch box p-4 text-center bg-light">
                      <div class="icon d-flex align-items-center justify-content-center">
                          <span class="icon-paper-plane"></span>
                      </div>
                      <h3 class="mb-4">Email Address</h3>
                      <p><a>aloka@gmail.com</span></a>
                      </p>
                  </div>
              </div>
              <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                  <div class="align-self-stretch box p-4 text-center bg-light">
                      <div class="icon d-flex align-items-center justify-content-center">
                          <span class="icon-globe"></span>
                      </div>
                      <h3 class="mb-4">Website</h3>
                      <p><a href="#">https://www.aloka.lk</a></p>
                  </div>
              </div>
          </div>
          <div class="row no-gutters block-9">
              <div class="col-md-6 order-md-last d-flex">
                  <form action="#" class="bg-light p-5 contact-form">
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
                      width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                      aria-hidden="false" tabindex="0"></iframe>
              </div>
          </div>
      </div>
  </section>
  <!--Contact page end-->
  <!--Footer begin-->
  <footer class="ftco-footer ftco-section img" style="background-image: url(img/Frontend/footer-bg.jpg);">
      <div class="overlay"></div>
      <div class="container-fluid px-md-5">
          <div class="row mb-5">
              <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                      <h2 class="ftco-heading-2">Aloka Channeling Center & Pharmacy</h2>
                      <p>Your Health is Our Priority</p>
                      <ul class="ftco-footer-social list-unstyled mt-5">
                          <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                          <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                          <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-md">
                  <div class="ftco-footer-widget mb-4 ml-md-4">
                      <h2 class="ftco-heading-2">Channelings</h2>
                      <ul class="list-unstyled">
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Physician</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Surgeon</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Dermatologist</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Othopedic Surgeon</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Endocrinicalogist</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Psychiatrist</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Neurologist</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Cardiologist</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Radiologist</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-md">
                  <div class="ftco-footer-widget mb-4 ml-md-4">
                      <h2 class="ftco-heading-2">Links</h2>
                      <ul class="list-unstyled">
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Channelings</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Doctors</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                      <h2 class="ftco-heading-2">Services</h2>
                      <ul class="list-unstyled">
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Channeling Services</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Professional Staff</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Qualified Doctors</a></li>
                          <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>24 Hours Services</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                      <h2 class="ftco-heading-2">Have a Questions?</h2>
                      <div class="block-23 mb-3">
                          <ul>
                              <li><span class="icon icon-map-marker"></span><span class="text">No 46, Hospital Road,
                                      Wanduruppa, Ambalantota</span></li>
                              <li><a href="#"><span class="icon icon-phone"></span><span class="text">+94 47 22 23
                                          111</span></a></li>
                              <li><a href="#"><span class="icon icon-envelope pr-4"></span><span class="text"><span
                                              class="__cf_email__">mmddush@gmail.com</span></span></a>
                              </li>
                          </ul>
                      </div>
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
