@extends('layouts.front')

@section('content')    
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
                        <h3 class="text-primary">Search Doctor</h3>
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
@endsection