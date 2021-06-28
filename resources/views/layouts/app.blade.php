@extends('adminlte::page')

@section('js')
    <script type="text/javascript">
        const editActionContent =
            "<button class='btn btn-sm btn-outline-success mr-1 edit-button'><i class='fas fa-pencil-alt fa-fw'></i></button>";
        const deleteActionContent =
            "<button class='btn btn-sm btn-outline-danger delete-button'><i class='fas fa-trash-alt fa-fw'></i></button>";
        const viewActionContent =
            "<button class='btn btn-sm btn-outline-info mr-1 view-button'><i class='fas fa-eye fa-fw'></i></button>";
        const defaultActionContent = editActionContent + deleteActionContent;
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
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = "{{ env('TAWK_TO_DIRECT_CHAT_LINK') }}";
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endsection

@section('css')
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection