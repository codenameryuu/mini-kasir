<!DOCTYPE html>
<html class="">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="/assets/css/preloader.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="/assets/modules/materialize/materialize.css" type="text/css" rel="stylesheet"
        media="screen,projection" />
    <link href="/assets/modules/fonts/mdi/materialdesignicons.min.css" type="text/css" rel="stylesheet"
        media="screen,projection" />
    <link href="/assets/modules/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet"
        media="screen,projection" />
    <link href="/assets/modules/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" media="screen" />

    <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" id="main-style" />
    <link href="/assets/css/style-custom.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('custom_head')

</head>

@yield('custom_css')

<body class="html" data-header="light" data-footer="dark" data-header_align="center" data-menu_type="left"
    data-menu="light" data-menu_icons="on" data-footer_type="left" data-site_mode="light" data-footer_menu="show"
    data-footer_menu_style="light">

    @include('partials.header')

    <div class="container">
        @include('partials.notification')

        @yield('content')
    </div>

    @include('partials.menu')

    <script>
        function confirmLogout() {
            Swal.fire({
                icon: 'question',
                text: 'Apakah anda yakin ingin keluar ?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("formLogout").submit();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="/assets/modules/materialize/materialize.js"></script>
    <script src="/assets/modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/variables.js"></script>
    <script src="/assets/modules/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
    <script>
        $("[data-fancybox=images]").fancybox({
            buttons: ["slideShow", "share", "zoom", "fullScreen", "close", "thumbs"],
            thumbs: {
                autoStart: false
            }
        });
    </script>

    <script src="/assets/modules/app/settings.js"></script>
    <script src="/assets/modules/app/scripts.js"></script>

    @yield('custom_js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.preloader-background').delay(10).fadeOut('slow');
        });
    </script>

</body>

</html>
