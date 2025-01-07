<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Dashboard</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!--  Favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('dist/images/logos/logo.ico') }}" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <!-- select 2 css   -->
    <link rel="stylesheet" href="{{ asset('dist/libs/select2/dist/css/select2.min.css') }}">

    <!-- magnify popup css   -->
    <link rel="stylesheet" href="{{ asset('dist/libs/magnific-popup/dist/magnific-popup.css') }}">

    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- jQuery Timepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.11.14/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.11.14/jquery.timepicker.min.js"></script>
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img
            src="{{ asset('dist/images/logos/favicon.ico') }}" /> <!-- alt="loader" class="lds-ripple img-fluid' -->
    </div>
    <!-- Preloader -->
    {{-- <div class="preloader">
        <img
            src="{{ asset('dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid') }}" />
    </div> --}}
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{route('dashboard')}}" class="text-nowrap logo-img">
                        <img src="{{ asset('dist/images/logos/logo.png')}}" class="dark-logo" width="180" alt="" />
                        <img src="{{ asset('dist/images/logos/logo.png') }}" class="light-logo" width="180" alt="" />
                    </a>
                    <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8 text-muted"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                    <ul id="sidebarnav">
                        <!-- ============================= -->
                        <!-- Home -->
                        <!-- ============================= -->
                        <li class="nav-small-cap">
                            <i class=" ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <!-- =================== -->
                        <!-- Dashboard -->
                        <!-- =================== -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span>
                                    <i class="fas fa-users"></i>
                                </span>
                                <span class="hide-menu">Clients</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('clients.create')}}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <span class="hide-menu">All Clients</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('clients.index')}}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>

                                        <span class="hide-menu">Add Clients</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file"></i>
                                </span>
                                <span class="hide-menu">Quotation</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('quotes.index')}}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-bars"></i>
                                        </div>
                                        <span class="hide-menu">All Quotation</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('quotes.create')}}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class='fa-solid fa-file-signature ps-1' style='font-size: 16px'></i>
                                        </div>
                                        <span class="hide-menu">Add Quotation</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class='fas fa-file-invoice ps-1' style='font-size: 18px'></i>
                                </span>
                                <span class="hide-menu ps-1">Invoice</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class='fa-solid fa-receipt ps-1' style='font-size: 18px'></i>
                                </span>
                                <span class="hide-menu ps-1">Receipts Voucher</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span>
                                    <i class="ti ti-trash"></i>
                                </span>
                                <span class="hide-menu">Trashed File</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('clients.trashed') }}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <span class="hide-menu">Clients Trashed</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class='fa-solid fa-file-signature ps-1' style='font-size: 16px'></i>
                                        </div>
                                        <span class="hide-menu">Quotation Trashed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- ============================= -->
                        <!-- Apps -->
                        <!-- ============================= -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Course</span>
                        </li>
                        @can('view courses')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-book"></i>
                                    </span>
                                    <span class="hide-menu">Courses</span>
                                </a>
                            </li>
                        @endcan
                        @can('view categories')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-kanban"></i>
                                </span>
                                <span class="hide-menu">Categories</span>
                            </a>
                        </li>
                        @endcan
                        @can('view schedules')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="" aria-expanded="false">
                                <span>
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <span class="hide-menu">Schedule</span>
                            </a>
                        </li>
                        @endcan
                        @canany(['view enrollments', 'view enrollments history'])
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-chart-donut-3"></i>
                                </span>
                                <span class="hide-menu">Enrollment</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                @can('view enrollments')
                                <li class="sidebar-item">
                                    <a href="" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Enrollments</span>
                                    </a>
                                </li>
                                @endcan
                                @can('view enrollments history')
                                <li class="sidebar-item">
                                    <a href="" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">History</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                </nav>
                <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
                    <div class="hstack gap-3">
                        <div class="john-img">
                            <img src="{{ asset('dist/images/profile/user-1.jpg') }}"
                                class="rounded-circle" width="40" height="40" alt="">
                        </div>
                        <div class="john-title">
                            <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                            <span class="fs-2 text-dark">Designer</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent text-primary ms-auto"
                                    tabindex="0" aria-label="logout" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="logout">
                                <i class="ti ti-power fs-6"></i>
                            </button>
                        </form>

                    </div>
                </div>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="ti ti-search"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav quick-links d-none d-lg-flex">
                        <li class="nav-item dropdown-hover d-none d-lg-block">
                            <a class="nav-link" href="">Home</a>
                        </li>
                        <li class="nav-item dropdown hover-dd d-none d-lg-block">
                            <a class="nav-link" href="javascript:void(0)" data-bs-toggle="dropdown">Apps<span
                                    class="mt-1"><i class="ti ti-chevron-down"></i></span></a>
                            <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0">
                                <div class="row">
                                    <div class="col-8">
                                        <div class=" ps-7 pt-7">
                                            <div class="border-bottom">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="position-relative">
                                                            <a href="./app-chat.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-chat.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">Chat
                                                                        Application</h6>
                                                                    <span class="fs-2 d-block text-dark">New messages
                                                                        arrived</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-invoice.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-invoice.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">
                                                                        Invoice App</h6>
                                                                    <span class="fs-2 d-block text-dark">Get latest
                                                                        invoice</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-contact2.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-mobile.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">
                                                                        Contact Application</h6>
                                                                    <span class="fs-2 d-block text-dark">2 Unsaved
                                                                        Contacts</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-email.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-message-box.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">Email
                                                                        App</h6>
                                                                    <span class="fs-2 d-block text-dark">Get new
                                                                        emails</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="position-relative">
                                                            <a href="./page-user-profile.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-cart.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">User
                                                                        Profile</h6>
                                                                    <span class="fs-2 d-block text-dark">learn more
                                                                        information</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-calendar.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-date.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">
                                                                        Calendar App</h6>
                                                                    <span class="fs-2 d-block text-dark">Get
                                                                        dates</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-contact.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-lifebuoy.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">
                                                                        Contact List Table</h6>
                                                                    <span class="fs-2 d-block text-dark">Add new
                                                                        contact</span>
                                                                </div>
                                                            </a>
                                                            <a href="./app-notes.html"
                                                                class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                                <div
                                                                    class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset('dist/images/svgs/icon-dd-application.svg') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="24" height="24">
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-1 fw-semibold bg-hover-primary">Notes
                                                                        Application</h6>
                                                                    <span class="fs-2 d-block text-dark">To-do and
                                                                        Daily tasks</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center py-3">
                                                <div class="col-8">
                                                    <a class="fw-semibold text-dark d-flex align-items-center lh-1 text-decoration-none"
                                                        href="#"><i class="ti ti-help fs-6 me-2"></i>Frequently
                                                        Asked Questions</a>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-flex justify-content-end pe-4">
                                                        <button class="btn btn-primary">Check</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 ms-n4">
                                        <div class="position-relative p-7 border-start h-100">
                                            <h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
                                            <ul class="">
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./page-pricing.html">Pricing Page</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./authentication-login.html">Authentication Design</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./authentication-register.html">Register Now</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="authentication-error.html">404 Error Page</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./app-notes.html">Notes App</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./page-user-profile.html">User Application</a>
                                                </li>
                                                <li class="mb-3">
                                                    <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                                        href="./page-account-settings.html">Account Settings</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown-hover d-none d-lg-block">
                            <a class="nav-link" href="app-chat.html">Chat</a>
                        </li>
                        <li class="nav-item dropdown-hover d-none d-lg-block">
                            <a class="nav-link" href="app-calendar.html">Calendar</a>
                        </li>
                        <li class="nav-item dropdown-hover d-none d-lg-block">
                            <a class="nav-link" href="app-email.html">Email</a>
                        </li>
                        <li class="nav-item dropdown-hover d-none d-lg-block pt-2">
                            <a class="nav-link" href=""><p id="liveTime"></p></a>
                        </li>
                    </ul>
                    <div class="d-block d-lg-none">
                        <img src="{{ asset('dist/images/logos/logo.png') }}" class="dark-logo" width="180"
                            alt="" />
                        <img src="{{ asset('dist/images/logos/light-logo.svg') }}"
                            class="light-logo" width="180" alt="" />
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="p-2">
                            <i class="ti ti-dots fs-7"></i>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <i class="ti ti-align-justified fs-7"></i>
                            </a>
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('dist/images/svgs/icon-flag-en.svg') }}"
                                            alt="" class="rounded-circle object-fit-cover round-20">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop2">
                                        <div class="message-body" data-simplebar>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                <div class="position-relative">
                                                    <img src="{{ asset('dist/images/svgs/icon-flag-en.svg') }}"
                                                        alt=""
                                                        class="rounded-circle object-fit-cover round-20">
                                                </div>
                                                <p class="mb-0 fs-3">English (UK)</p>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                <div class="position-relative">
                                                    <img src="{{ asset('dist/images/svgs/icon-flag-cn.svg') }}"
                                                        alt=""
                                                        class="rounded-circle object-fit-cover round-20">
                                                </div>
                                                <p class="mb-0 fs-3">中国人 (Chinese)</p>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                <div class="position-relative">
                                                    <img src="{{ asset('dist/images/svgs/icon-flag-fr.svg') }}"
                                                        alt=""
                                                        class="rounded-circle object-fit-cover round-20">
                                                </div>
                                                <p class="mb-0 fs-3">français (French)</p>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                <div class="position-relative">
                                                    <img src="{{ asset('dist/images/svgs/icon-flag-sa.svg') }}"
                                                        alt=""
                                                        class="rounded-circle object-fit-cover round-20">
                                                </div>
                                                <p class="mb-0 fs-3">عربي (Arabic)</p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link notify-badge nav-icon-hover" href="javascript:void(0)"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        <i class="ti ti-basket"></i>
                                        <span class="badge rounded-pill bg-danger fs-2">2</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-bell-ringing"></i>
                                        <div class="notification bg-primary rounded-circle"></div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop2">
                                        <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                            <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                            <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                                        </div>
                                        <div class="message-body" data-simplebar>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-1.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                    <span class="d-block">Congratulate him</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-2.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">New message</h6>
                                                    <span class="d-block">Salma sent you new message</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-3.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">Bianca sent payment</h6>
                                                    <span class="d-block">Check your earnings</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-4.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">Jolly completed tasks</h6>
                                                    <span class="d-block">Assign her new tasks</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-5.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">John received payment</h6>
                                                    <span class="d-block">$230 deducted from account</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="py-6 px-7 d-flex align-items-center dropdown-item">
                                                <span class="me-3">
                                                    <img src="{{ asset('dist/images/profile/user-1.jpg') }}"
                                                        alt="user" class="rounded-circle" width="48"
                                                        height="48" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle">
                                                    <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                    <span class="d-block">Congratulate him</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="py-6 px-7 mb-1">
                                            <button class="btn btn-outline-primary w-100"> See All Notifications
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="user-profile-img">
                                                <img src="{{ asset('dist/images/profile/user-1.jpg') }}"
                                                    class="rounded-circle" width="35" height="35"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop1">
                                        <div class="profile-dropdown position-relative" data-simplebar>
                                            <div class="py-3 px-7 pb-0">
                                                <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                            </div>
                                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                <img src="{{ asset('dist/images/profile/user-1.jpg') }}"
                                                    class="rounded-circle" width="80" height="80"
                                                    alt="" />
                                                <div class="ms-3">
                                                    <h5 class="mb-1 fs-3">Mathew Anderson</h5>
                                                    <span class="mb-1 d-block text-dark">Designer</span>
                                                    <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                        <i class="ti ti-mail fs-4"></i> info@modernize.com
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                @can(['view profile'])
                                                {{-- <a href="./page-user-profile.html" --}}
                                                <a href=""
                                                    class="py-8 px-7 mt-8 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                        <img src="{{ asset('dist/images/svgs/icon-account.svg') }}"
                                                            alt="" width="24" height="24">
                                                    </span>


                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                                        <span class="d-block text-dark">Account Settings</span>
                                                    </div>
                                                </a>
                                                @endcan
                                                <a href="./app-email.html"
                                                    class="py-8 px-7 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                        <img src="{{ asset('dist/images/svgs/icon-inbox.svg') }}"
                                                            alt="" width="24" height="24">
                                                    </span>
                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 bg-hover-primary fw-semibold">My Inbox</h6>
                                                        <span class="d-block text-dark">Messages & Emails</span>
                                                    </div>
                                                </a>
                                                <a href="./app-notes.html"
                                                    class="py-8 px-7 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                        <img src="{{ asset('dist/images/svgs/icon-tasks.svg') }}"
                                                            alt="" width="24" height="24">
                                                    </span>
                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 bg-hover-primary fw-semibold">My Task</h6>
                                                        <span class="d-block text-dark">To-do and Daily Tasks</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-grid py-4 px-7 pt-8">
                                                <form action="" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary w-100">Log
                                                        Out</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    @yield('scripts')
    <!--  Customizer -->
    <!--  Import Js Files -->
    <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <!--  core files -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <!--  current page js files -->
    <script src="{{ asset('dist/libs/owl.carousel/dist/owl.carousel.min.js') }}">
    </script>

    <script src="{{ asset('dist/js/plugins/toastr-init.js') }}"></script>

    <script src="{{ asset('dist/libs/tablesaw/dist/tablesaw.jquery.js') }}">
    </script>
    <script src="{{ asset('dist/libs/tablesaw/dist/tablesaw-init.js') }}">
    </script>

    <!-- select 2 java scripts -->
    <script src="{{ asset('dist/libs/select2/dist/js/select2.min.js') }}">
    </script>
    <script src="{{ asset('dist/libs/select2/dist/js/i18n/en.js') }}">
    </script>
    <script src="{{ asset('dist/libs/select2/dist/js/i18n/ar.js') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}">
    </script>
    <script src="{{ asset('dist/js/apex-chart/apex.radial.init.js') }}"> </script>
    <script src="{{ asset('dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"> </script>
    </script>
    </script>




    <!--  magnify popup -->
    <script src="{{ asset('dist/libs/magnific-popup/dist/jquery.magnific-popup.min.js') }}">
    </script>
    <script src="{{ asset('dist/js/plugins/meg.init.js') }}"></script>


    <script>
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12; // Convert 24-hour to 12-hour format
            hours = hours ? hours : 12; // Hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes
            seconds = seconds < 10 ? '0' + seconds : seconds; // Add leading zero to seconds
            var timeString = hours + ":" + minutes + ":" + seconds + " " + ampm;
            document.getElementById("liveTime").innerHTML = timeString;
        }

        setInterval(updateTime, 1000); // Update every second
    </script>

    <script>
        // Initialize SweetAlert mixin for success toasts
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @yield('custom_js')
</body>

</html>
