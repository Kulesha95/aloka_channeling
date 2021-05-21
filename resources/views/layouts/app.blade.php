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
        $("select").closest("form").on("reset", function(ev) {
            var targetJQForm = $(ev.target);
            setTimeout((function() {
                this.find("select").trigger("change");
            }).bind(targetJQForm), 0);
        });
        $(document).on('mouseenter', '.select2-selection__rendered', function() {
            $(this).removeAttr('title');
        });

    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('css')
    <meta name="api-token" content="{{ Auth::user()->api_token }}"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection