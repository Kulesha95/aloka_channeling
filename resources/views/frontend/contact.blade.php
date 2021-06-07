@extends('layouts.front')

@section('content')
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
@endsection