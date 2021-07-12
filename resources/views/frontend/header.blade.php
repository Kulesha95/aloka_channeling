<div class=" container-fluid bg-primary">
    <div class="container">
        <div class=row>
            <span class="mr-5">
                <i
                    class="fas fa-phone">&nbsp;&nbsp;&nbsp;{{ $webContent->where('key', 'contact_number')->first()->value ?? '+94 47 22 23 111' }}</i>
            </span>
            <span>
                <i
                    class="fas fa-at">&nbsp;&nbsp;&nbsp;{{ $webContent->where('key', 'contact_email')->first()->value ?? 'aloka@gmail.com' }}</i>
            </span>

        </div>


    </div>

</div>
<!--nav bar start-->
<div class="container-fluid bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
        <a class="navbar-brand font-weight-bold"
            href="#">{{ env('APP_NAME', 'Aloka Pharmacy and Channelling Center') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.channelings') }}">Channellings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.contact') }}">Contact</a>
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
</div>

<!--nav bar end-->

<!--main banner-->
<div class="main-hero-section container-fluid">
    <div class="container h-100">

        <div class="row h-100">
            <div class="col-6 d-flex">
                <div class="my-auto d-block">
                    <p class="text-primary font-weight-bold">
                        {{ $webContent->where('key', 'general_main_banner_sub_heading')->first()->value ?? 'Welcome to Aloka Channeling Center And Pharmacy' }}
                    </p>
                    <h1 class="main-heading font-weight-bold">
                        {{ $webContent->where('key', 'general_main_banner_main_heading')->first()->value ?? 'We are here for your care' }}
                    </h1>
                    <p class="pt-4 text-secondary">
                        {{ $webContent->where('key', 'general_main_banner_description')->first()->value ?? 'Professional health care services provider. Now we are at your finger tips...!' }}
                    </p>
                    <a href="{{ route('frontend.channelings') }}" class="btn btn-primary rounded-button">Make An
                        Appointment</a>
                </div>
            </div>
        </div>
    </div>

</div>