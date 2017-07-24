<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControTik @yield('title') </title>
    {{ Html::style('/css/vendor.css') }}
    {{ Html::style('/css/app.css') }}
    {{ Html::style('/css/plugins/switchery/switchery.css') }}
    {{ Html::style('/css/plugins/toastr/toastr.min.css') }}

    {{ Html::style('/css/control.css') }}
    <script>
        window.control = {!! json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
        ]) !!};
    </script>

</head>
<body>
<!-- Wrapper-->
<div id="wrapper">

    <!-- Navigation -->
@include('layouts.navigation')

<!-- Page wraper -->
    <div id="page-wrapper" class="gray-bg">

        <!-- Page wrapper -->
    @include('layouts.topnavbar')

    @include('layouts.breadcrumbs')


    <!-- Main view  -->
        <div class="wrapper wrapper-content animated fadeIn">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.footer')

    </div>
    <!-- End page wrapper-->

</div>
<!-- End wrapper-->

@stack('extra')


{{ Html::script('js/app.js') }}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{!! csrf_token() !!}"
        }
    });
</script>

{{ Html::script('js/control.js') }}
{{ Html::script('js/plugins/toastr/toastr.min.js') }}
{{ Html::script('js/plugins/switchery/switchery.js') }}

{{ Html::script('js/control/deviceAction.js') }}
{{ Html::script('js/control/dummyUnice.js') }}


@yield('scripts')


@show

</body>
</html>
