<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet" />
    <script src="/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="/assets/css/header-colors.css" />

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        select option[value="pending"] {
            background-color: #fff3cd;
            color: #856404;
        }
        select option[value="processing"] {
            background-color: #cce5ff;
            color: #004085;
        }
        select option[value="completed"] {
            background-color: #d4edda;
            color: #155724;
        }
        select option[value="cancelled"] {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>

    <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        @include('layouts.master.sidebar')





        @include('layouts.master.header')





        @yield('main-content')





        @include('layouts.master.footer')


        <!-- search modal -->
        <div class="modal" id="SearchModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header gap-2">
                        <div class="position-relative popup-search w-100">
                            <input class="form-control form-control-lg ps-5 border border-3 border-primary"
                                type="search" placeholder="Search">
                            <span
                                class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
                                    class='bx bx-search'></i></span>
                        </div>
                        <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="search-list">
                            <p class="mb-1">Html Templates</p>
                            <div class="list-group">
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-angular fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Web Design Company</p>
                            <div class="list-group">
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-windows fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Software Development</p>
                            <div class="list-group">
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Online Shoping Portals</p>
                            <div class="list-group">
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-slack fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-skype fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                        class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end search modal -->




        {{--  --}}
        <!-- Bootstrap JS -->
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="/assets/plugins/chartjs/js/chart.js"></script>
        <script src="/assets/js/index.js"></script>

        <!--app JS-->
        <script src="/assets/js/app.js"></script>
        <script>
            new PerfectScrollbar(".app-container")
        </script>

        


</body>

</html>
