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
                        <li><a href="{{ route('frontend.index') }}"><i
                                    class="fas fa-long-arrow-alt-right mr-2"></i>Home</a></li>
                        <li><a href="{{ route('frontend.about') }}"><i
                                    class="fas fa-long-arrow-alt-right mr-2"></i>About</a></li>
                        <li><a href="{{ route('frontend.channelings') }}"><i
                                    class="fas fa-long-arrow-alt-right mr-2"></i>Channelings</a></li>
                        <li><a href="{{ route('frontend.contact') }}"><i
                                    class="fas fa-long-arrow-alt-right mr-2"></i>Contact</a></li>
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
                        <li><i class="fas fa-map-pin mr-2"></i><span
                                class="text">{{ $webContent->where('key', 'contact_address')->first()->value ?? 'No 46, Hospital Road, Wanduruppa, Ambalantota' }}</span>
                        </li>
                        <li><a href="#"><i class="fas fa-phone mr-2"></i><span
                                    class="text">{{ $webContent->where('key', 'contact_number')->first()->value ?? '+94 47 22 23 111' }}</span></a>
                        </li>
                        <li><a href="#"><i class="fas fa-at mr-2"></i><span class="text"><span
                                        class="__cf_email__">{{ $webContent->where('key', 'contact_email')->first()->value ?? 'aloka@gmail.com' }}</span></span></a>
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