@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('app.headers.channelingCalendar') }}</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-calendar-alt mr-2"></i>{{ __('app.headers.channelingCalendar') }}</h4>
            </div>
        </div>

        <div class="card-body">
            @include('components.schedule')
        </div>
    </div>
@endsection

@section('js')
@parent
    <script>
        const handleScheduleClick = (info) => {
            window.location =
                `/appointments?date=${moment(info.event.start).format("YYYY-MM-DD")}&id=${info.event.extendedProps.id}`;
        }
    </script>
@stack('js-stack')
@endsection