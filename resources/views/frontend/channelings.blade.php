@extends('layouts.front')

@section('content')
    <div class="container mt-5 pt-5">
        <h1 class="mx-auto text-center" class="mx-auto text-center">Channeing Schedule</h1>
        <hr>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            @include('components.schedule')
        </div>
    </div>
@endsection