<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}"> 
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.css') }}">
    <style>
        :root{
            font-size: 15px !important;
        }
    </style>
</head>

<body class="bg-theme">
    <div class="container">
        <div class="row border-bottom pb-4">
            <div class="col-3">
                <img src="{{ public_path('img/logo.png') }}" class="img-fluid rounded-circle"
                    style="max-width: 200px;">
            </div>
            <div class="col-9">
                <div class="row justify-content-end">
                    <h3 class="font-weight-bold">Aloka Pharmacy And Channeling Center</h3>
                </div>
                <div class="row justify-content-end">
                    <h5>No.10, Main Street, Ambalanthota</h5>
                </div>
                <div class="row justify-content-end">
                    <h6>TP : 047 22 65 385 / 047 56 47 852</h6>
                </div>
                <div class="row justify-content-end">
                    <h6>Email : aloka@gmail.com</h6>
                </div>
                <div class="row justify-content-end">
                    <h6>Website : {{ env('APP_URL') }}</h6>
                </div>
            </div>
        </div>
		<br>
    </div>
</body>

</html>