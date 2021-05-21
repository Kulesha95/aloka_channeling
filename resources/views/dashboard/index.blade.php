@extends('layouts.app')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
    </ol>
@stop

@section('content')
    @include('components.schedule')
@endsection

@section('js')
    <script>
        const handleScheduleClick = (info) => {
            window.location =
                `/appointments?date=${moment(info.event.start).format("YYYY-MM-DD")}&id=${info.event.extendedProps.id}`;
        }
    </script>
@endsection