@extends('adminlte::page')

@section('css')
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('app.headers.home') }}</a></li>
        <li class="breadcrumb-item active">@yield('reportTitle')</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4><i class="fas fa-fw fa-@yield('icon') mr-2"></i>@yield('reportTitle')</h4>
            </div>
        </div>
        <div class="card-body">
            @if (trim($__env->yieldContent('filters')))
                <div class="row">
                    <div class="form-group col-5">
                        <label for="date_from">{{ __('app.fields.dateFrom') }}</label>
                        <input id="date_from" class="form-control" type="date" name="date_from"
                            placeholder="{{ __('app.fields.dateFrom') }}"
                            value="{{ now()->startOfMonth()->toDateString() }}">
                    </div>
                    <div class="form-group col-5">
                        <label for="date_to">{{ __('app.fields.dateTo') }}</label>
                        <input id="date_to" class="form-control" type="date" name="date_to"
                            placeholder="{{ __('app.fields.dateTo') }}"
                            value="{{ now()->endOfMonth()->toDateString() }}">
                    </div>
                    <div class="form-group col-2">
                        <label for="quantity">&nbsp;</label>
                        <button type="submit" class="btn btn-success d-block w-100" onclick="generateReport()"><i
                                class="fa fa-search mr-1" aria-hidden="true"></i>{{ __('app.buttons.search') }}</button>
                    </div>
                </div>
                <hr>
            @endif
            <iframe frameborder="0" style="width:100%; height:90vh;" id="report-viewer"></iframe>
        </div>
    </div>
@endSection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const type = '@yield("reportType")';
        const id = '@yield("id")' == '' ? 0 : '@yield("id")';
        const generateReport = () => {
            const fromDate = $('#date_from').val();
            const toDate = $('#date_to').val();
            const reportUrl =
                "{{ route('documents.getPdf', ['type' => ':type', 'id' => ':id', 'action' => 'view']) }}";
            $('#report-viewer').attr(
                'src',
                reportUrl.replace(':type', type).replace(':id', id) + `?fromDate=${fromDate}&toDate=${toDate}`
            );
        }
        $(document).ready(() => {
            generateReport();
        });
    </script>
@endsection