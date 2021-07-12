@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.contentManagementSystem') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-tools mr-2"></i>{{ __('app.headers.contentManagementSystem') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('cms.store') }}" id="cms-form" method="POST">
                <h6 class="font-weight-bold mx-auto text-center"><u>{{ __('app.headers.general') }}</u></h6>
                <div class="row">
                    <label for="name">Main Banner Sub Hedding</label>
                    <input class="form-control" type="text" name="general_main_banner_sub_heading"
                        id="general_main_banner_sub_heading" placeholder="Main Banner Sub Hedding">
                </div>
                <div class="row">
                    <label for="name">Main Banner Main Hedding</label>
                    <input class="form-control" type="text" name="general_main_banner_main_heading"
                        id="general_main_banner_main_heading" placeholder="Main Banner Main Hedding">
                </div>
                <div class="row">
                    <label for="name">Main Banner Description</label>
                    <input class="form-control" type="text" name="general_main_banner_description"
                        id="general_main_banner_description" placeholder="Main Banner Description">
                </div>
                <hr>
                <h6 class="font-weight-bold mx-auto text-center"><u>{{ __('app.headers.home') }}</u></h6>
                <div class="row">
                    <div class="col-4">
                        <label for="name">Service Title 1</label>
                        <input class="form-control" type="text" name="home_service_title_1" id="home_service_title_1"
                            placeholder="Service Title 1">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Description 1</label>
                        <input class="form-control" type="text" name="home_service_description_1"
                            id="home_service_description_1" placeholder="Service Description 1">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Icon 1</label>
                        <input class="form-control" type="text" name="home_service_icon_1" id="home_service_icon_1"
                            placeholder="Service Icon 1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="name">Service Title 2</label>
                        <input class="form-control" type="text" name="home_service_title_2" id="home_service_title_2"
                            placeholder="Service Title 2">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Description 2</label>
                        <input class="form-control" type="text" name="home_service_description_2"
                            id="home_service_description_2" placeholder="Service Description 2">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Icon 2</label>
                        <input class="form-control" type="text" name="home_service_icon_2" id="home_service_icon_2"
                            placeholder="Service Icon 2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="name">Service Title 3</label>
                        <input class="form-control" type="text" name="home_service_title_3" id="home_service_title_3"
                            placeholder="Service Title 3">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Description 3</label>
                        <input class="form-control" type="text" name="home_service_description_3"
                            id="home_service_description_3" placeholder="Service Description 3">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Icon 3</label>
                        <input class="form-control" type="text" name="home_service_icon_3" id="home_service_icon_3"
                            placeholder="Service Icon 3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="name">Service Title 4</label>
                        <input class="form-control" type="text" name="home_service_title_4" id="home_service_title_4"
                            placeholder="Service Title 4">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Description 4</label>
                        <input class="form-control" type="text" name="home_service_description_4"
                            id="home_service_description_4" placeholder="Service Description 4">
                    </div>
                    <div class="col-4">
                        <label for="name">Service Icon 4</label>
                        <input class="form-control" type="text" name="home_service_icon_4" id="home_service_icon_4"
                            placeholder="Service Icon 4">
                    </div>
                </div>
                <hr>
                <h6 class="font-weight-bold mx-auto text-center"><u>{{ __('app.headers.contact') }}</u></h6>
                <div class="row">
                    <label for="name">Address</label>
                    <input class="form-control" type="text" name="contact_address" id="contact_address"
                        placeholder="Address">
                </div>
                <div class="row">
                    <label for="name">Number</label>
                    <input class="form-control" type="text" name="contact_number" id="contact_number" placeholder="Number">
                </div>
                <div class="row">
                    <label for="name">E mail</label>
                    <input class="form-control" type="text" name="contact_email" id="contact_email" placeholder="E mail">
                </div>
                <div class="row">
                    <label for="name">Location</label>
                    <input class="form-control" type="text" name="contact_location" id="contact_location"
                        placeholder="location">
                </div>
                <hr>
                <h6 class="font-weight-bold mx-auto text-center"><u>{{ __('app.headers.about') }}</u></h6>
                <div class="row">
                    <label for="name">About Us</label>
                    <input class="form-control" type="text" name="about_about_us" id="about_about_us"
                        placeholder="About Us">
                </div>
                <div class="row">
                    <label for="name">Vision</label>
                    <input class="form-control" type="text" name="about_vision" id="about_vision" placeholder="Vision">
                </div>
                <div class="row">
                    <label for="name">Mission</label>
                    <input class="form-control" type="text" name="about_mission" id="about_mission" placeholder="Mission">
                </div>
                <div class="row mt-2">
                    <button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-save mr-1"
                            aria-hidden="true"></i>{{ __('app.buttons.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        const loadData = () => {
            httpService.get("{{ route('cms.index') }}").then(response => {
                response.data.forEach(cmsData => {
                    $(`#${cmsData.key}`).val(cmsData.value);
                });
            });
        }
        $(`#cms-form`).on("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            httpService
                .post($(`#cms-form`).attr("action"), formData)
                .then((response) => {
                    messageHandler.successMessage(response.message);
                    loadData();
                });
        });
        loadData();
    </script>
@endsection