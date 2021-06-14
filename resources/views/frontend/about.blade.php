@extends('layouts.front')

@section('content')    
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
                    <a href="{{ route('frontend.channelings') }}" class="btn btn-danger mt-5 mx-auto rounded-button">Make an Appointment</a>
                </div>

            </div>
        </div>
    </section>
	 <!-- Mission Vision -->
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
@endsection