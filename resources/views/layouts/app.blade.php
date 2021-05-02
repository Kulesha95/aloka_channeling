@extends('adminlte::page')

@section('js')
    <script>
        const defaultActionContent =
            "<button class='btn btn-sm btn-outline-success mr-1 edit-button'><i class='fas fa-pencil-alt fa-fw' ></i></button><button button class='btn btn-sm btn-outline-danger delete-button' > <i class='fas fa-trash-alt fa-fw' ></i></button > ";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection