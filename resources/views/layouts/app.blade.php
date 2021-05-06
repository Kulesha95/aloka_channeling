@extends('adminlte::page')

@section('js')
    <script type="text/javascript">
        const defaultActionContent =
            "<button class='btn btn-sm btn-outline-success mr-1 edit-button'><i class='fas fa-pencil-alt fa-fw' ></i></button><button button class='btn btn-sm btn-outline-danger delete-button' > <i class='fas fa-trash-alt fa-fw' ></i></button > ";
        $('.custom-file input').change(function(e) {
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection