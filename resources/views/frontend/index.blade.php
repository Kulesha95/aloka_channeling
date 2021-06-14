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
                    <div class="row mb-3">
                        <h3 class="text-primary">Search doctor</h3>
                    </div>
                    <form action="{{ route('doctors.search') }}" method="GET" id="searchForm">
                        <div class="row mb-3">
                            <input type="text" name="name" id="name" class="form-control rounded-input"
                                placeholder="Doctor Name">
                        </div>
                        <div class="row mb-3">
                            <select type="text" name="type" id="doctor_type" class="form-control rounded-input">
                                <option value="" disabled selected>Select Doctor Type</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <input type="date" name="from_date" id="date" class="form-control rounded-input"
                                placeholder="Date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="row mb-3">
                            <input type="date" name="to_date" id="date" class="form-control rounded-input"
                                placeholder="Date" value="{{ Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}">
                        </div>
                        <div class="row mb-3">
                            <button class="btn btn-danger rounded-button w-100">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--search doctors begin-->
    <section class="doctor d-none" id="searchDoctorSection">
        <div class="container text-center">
            <h1 class="pt-5">Search Doctors</h1>
            <p class="pt-2 pb-3 text-secondary">Following doctors are visiting on the given date range</p>
            <hr>
            <div class="row" id="searchDoctorContainer"></div>
    </section>
    <!--today coming doctors begin-->
    <section class="doctor d-none" id="todayDoctorSection">
        <div class="container text-center">
            <h1 class="pt-5">Today Visiting Doctors</h1>
            <p class="pt-2 pb-3 text-secondary">Appointments can be made by online or visiting pharmacy</p>
            <hr>
            <div class="row" id="todayDoctorContainer"></div>
    </section>
@endsection

@section('js')
    <script>
        httpService.get("{{ route('doctors.todayDoctorsList') }}").then(response => {
            if (response.data.length) {
                $('#todayDoctorSection').removeClass('d-none');
                $('#todayDoctorSection').addClass('d-block');
                $('#todayDoctorContainer').html("");
                response.data.forEach(doctorSchedule => {
                    $('#todayDoctorContainer').append(
                        `<div class="col-lg-3">
                            <div class="card shadow">
                                <div class="card-head">
                                    <img src="${doctorSchedule.doctor.image}" class="img-fluid" alt="">
                                    <h5 class="font-weight-bold">${doctorSchedule.doctor.name}<br></h5>
                                    <p class="text-primary font-weight-bold">${doctorSchedule.doctor.channel_type}</p>
                                    <p class="text-muted">${doctorSchedule.schedule.time_text}</p>
                                    <a href="/appointments?date=${moment().format("YYYY-MM-DD")}&id=${doctorSchedule.schedule.id}" class="btn btn-sm btn-primary rounded-button mb-3 text-light">Book Now</a>
                                </div>
                            </div>
                        </div>`
                    );
                });
            } else {
                $('#todayDoctorSection').removeClass('d-block');
                $('#todayDoctorSection').addClass('d-none');
            }
        })
        httpService.get("{{ route('channelTypes.index') }}").then(response => {
            response.data.forEach(channelType => {
                $('#doctor_type').append(new Option(channelType.channel_type, channelType.id));
            });
        });
        $('#searchForm').on('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            httpService
                .post($(`#searchForm`).attr("action"), formData)
                .then((response) => {
                    console.log(response.data)
                    if (response.data.length) {
                        $('#searchDoctorSection').removeClass('d-none');
                        $('#searchDoctorSection').addClass('d-block');
                        $('#searchDoctorContainer').html("");
                        response.data.forEach(doctorSchedule => {
                            console.log(doctorSchedule);
                            $('#searchDoctorContainer').append(
                                `<div class="col-lg-3">
                                    <div class="card shadow">
                                        <div class="card-head">
                                            <img src="${doctorSchedule.doctor.image}" class="img-fluid" alt="">
                                            <h5 class="font-weight-bold">${doctorSchedule.doctor.name}<br></h5>
                                            <p class="text-primary font-weight-bold">${doctorSchedule.doctor.channel_type}</p>
                                            <p class="text-muted">${doctorSchedule.schedule.repeat_text} ${doctorSchedule.schedule.time_text}</p>
                                            <a href="/appointments?date=${moment().format("YYYY-MM-DD")}&id=${doctorSchedule.schedule.id}" class="btn btn-sm btn-primary rounded-button mb-3 text-light">Book Now</a>
                                        </div>
                                    </div>
                                </div>`
                            );
                        });
                    } else {
                        $('#searchDoctorSection').removeClass('d-block');
                        $('#searchDoctorSection').addClass('d-none');
                    }
                    
                })
        });
    </script>

@endsection