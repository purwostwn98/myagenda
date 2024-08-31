<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="horizontal">
<?php
$ss = \Config\Services::session();
$session = $ss->get("userdata");
$n = explode(" ", $session["nama_gelar"]);
$nama_depan = $n[0];
?>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/pro/assets/images/logos/favicon.png" />

    <!-- Core Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/css/styles.css" />

    <!-- CSS fullcalendar -->
    <script src='<?= base_url(); ?>/node_modules/fullcalendar/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.3.0/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.3.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.3.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.3.0/main.min.js"></script>

    <?= $this->renderSection('css') ?>

    <title>My Agenda UMS</title>
    <style>
        .text-primer {
            color: #2f3184;
        }

        .bg-primer {
            background-color: #2f3184;
        }

        .text-primer {
            color: #2f3184;
        }

        .border-kuning {
            border-bottom: 5px solid #fec14f;
        }
    </style>

    <title>My Agenda UMS</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="<?= base_url(); ?>/pro/assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <!-- Sidebar Start -->
        <aside class="left-sidebar with-vertical">
            <div><!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="<?= base_url(); ?>/pro/horizontal/index.html" class="text-nowrap logo-img">
                        <img src="<?= base_url(); ?>/pro/assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                        <img src="<?= base_url(); ?>/pro/assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
                    </a>
                    <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                        <i class="ti ti-x"></i>
                    </a>
                </div>


                <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                    <ul id="sidebarnav">
                        <!-- ---------------------------------- -->
                        <!-- Home -->
                        <!-- ---------------------------------- -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <!-- ---------------------------------- -->
                        <!-- Dashboard -->
                        <!-- ---------------------------------- -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="" id="get-url" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Modern</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?= base_url(); ?>/pro/horizontal/index2.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <span class="hide-menu">eCommerce</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
                    <div class="hstack gap-3">
                        <div class="john-img">
                            <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="modernize-img" />
                        </div>
                        <div class="john-title">
                            <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                            <span class="fs-2">Designer</span>
                        </div>
                        <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                            <i class="ti ti-power fs-6"></i>
                        </button>
                    </div>
                </div>

                <!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
            </div>
        </aside>
        <!--  Sidebar End -->
        <div id="main-wrapper">
            <!-- Sidebar Start -->
            <aside class="left-sidebar with-vertical">
                <div><!-- ---------------------------------- -->
                    <!-- Start Vertical Layout Sidebar -->
                    <!-- ---------------------------------- -->
                    <div class="brand-logo d-flex align-items-center justify-content-between">
                        <a href="<?= base_url(); ?>/pro/horizontal/index.html" class="text-nowrap logo-img">
                            <img src="<?= base_url(); ?>/pro/assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                            <img src="<?= base_url(); ?>/pro/assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
                        </a>
                        <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                            <i class="ti ti-x"></i>
                        </a>
                    </div>


                    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                        <ul id="sidebarnav">
                            <!-- ---------------------------------- -->
                            <!-- Home -->
                            <!-- ---------------------------------- -->
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Home</span>
                            </li>
                            <!-- ---------------------------------- -->
                            <!-- Dashboard -->
                            <!-- ---------------------------------- -->
                            <li class="sidebar-item">
                                <a class="sidebar-link <?= $menu == 'Dashboard' ? 'active' : ''; ?>" href="/kepala/dashboard" id="get-url" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-aperture"></i>
                                    </span>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link <?= $menu == 'Daftar-Agenda' ? 'active' : ''; ?>" href="/daftar-agenda" id="get-url" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-archive"></i>
                                    </span>
                                    <span class="hide-menu">Daftar Agenda</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
                        <div class="hstack gap-3">
                            <div class="john-img">
                                <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="modernize-img" />
                            </div>
                            <div class="john-title">
                                <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                                <span class="fs-2">Designer</span>
                            </div>
                            <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                                <i class="ti ti-power fs-6"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ---------------------------------- -->
                    <!-- Start Vertical Layout Sidebar -->
                    <!-- ---------------------------------- -->
                </div>
            </aside>
            <!--  Sidebar End -->
            <div class="page-wrapper">
                <!--  Header Start -->
                <header class="topbar">
                    <div class="with-vertical"><!-- ---------------------------------- -->
                        <!-- Start Vertical Layout Header -->
                        <!-- ---------------------------------- -->
                        <nav class="navbar navbar-expand-lg p-0">
                            <ul class="navbar-nav">
                                <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
                                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                        <i class="ti ti-menu-2"></i>
                                    </a>
                                </li>
                                <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-lg-flex">
                                    <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="ti ti-search"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">
                            </ul>
                            <div class="d-block d-lg-none py-4">
                                <a href="<?= base_url(); ?>/pro/horizontal/index.html" class="text-nowrap logo-img">
                                    <img src="<?= base_url(); ?>/pro/assets/images/logos/dark-logo.png" class="dark-logo" width="150" alt="Logo-Dark" />
                                    <img src="<?= base_url(); ?>/pro/assets/images/logos/light-logo.png" class="light-logo" width="150" alt="Logo-light" />
                                </a>
                            </div>
                            <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="ti ti-dots fs-7"></i>
                            </a>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle mx-0 ms-n1 d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                                        <i class="ti ti-align-justified fs-7"></i>
                                    </a>
                                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                        <!-- ------------------------------- -->
                                        <!-- start profile Dropdown -->
                                        <!-- ------------------------------- -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-profile-img">
                                                        <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="35" height="35" alt="modernize-img" />
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                                <div class="profile-dropdown position-relative" data-simplebar>
                                                    <div class="py-3 px-7 pb-0">
                                                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                                    </div>
                                                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                        <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="80" height="80" alt="modernize-img" />
                                                        <div class="ms-3">
                                                            <h5 class="mb-1 fs-3">Mathew Anderson</h5>
                                                            <span class="mb-1 d-block">Designer</span>
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i> info@modernize.com
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="message-body">
                                                        <a href="<?= base_url(); ?>/pro/horizontal/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                                <img src="<?= base_url(); ?>/pro/assets/images/svgs/icon-account.svg" alt="modernize-img" width="24" height="24" />
                                                            </span>
                                                            <div class="w-100 ps-3">
                                                                <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                                                <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="d-grid py-4 px-7 pt-8">
                                                        <a href="/logout" class="btn btn-outline-primary">Log Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ------------------------------- -->
                                        <!-- end profile Dropdown -->
                                        <!-- ------------------------------- -->
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!-- ---------------------------------- -->
                        <!-- End Vertical Layout Header -->
                        <!-- ---------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- apps Dropdown in Small screen -->
                        <!-- ------------------------------- -->
                        <!--  Mobilenavbar -->
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <nav class="sidebar-nav scroll-sidebar">
                                <div class="offcanvas-header justify-content-between">
                                    <img src="<?= base_url(); ?>/pro/assets/images/logos/favicon.ico" alt="modernize-img" class="img-fluid" />
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body h-n80" data-simplebar="" data-simplebar>
                                    <ul id="sidebarnav">

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="app-header with-horizontal">
                        <nav class="navbar navbar-expand-xl container-fluid p-0">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item nav-icon-hover-bg rounded-circle d-flex d-xl-none ms-n2">
                                    <a class="nav-link sidebartoggler" id="sidebarCollapse" href="javascript:void(0)">
                                        <i class="ti ti-menu-2"></i>
                                    </a>
                                </li>
                                <li class="nav-item d-none d-xl-block">
                                    <a href="<?= base_url(); ?>/pro/horizontal/index.html" class="text-nowrap nav-link">
                                        <img src="<?= base_url(); ?>/pro/assets/images/logos/dark-logo.png" class="dark-logo" width="180" alt="modernize-img" />
                                        <img src="<?= base_url(); ?>/pro/assets/images/logos/light-logo.png" class="light-logo" width="180" alt="modernize-img" />
                                    </a>
                                </li>

                            </ul>
                            <ul class="navbar-nav quick-links d-none d-xl-flex align-items-center">

                            </ul>
                            <div class="d-block d-xl-none">
                                <a href="<?= base_url(); ?>/pro/horizontal/index.html" class="text-nowrap nav-link">
                                    <img src="<?= base_url(); ?>/pro/assets/images/logos/dark-logo.svg" width="180" alt="modernize-img" />
                                </a>
                            </div>
                            <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="p-2">
                                    <i class="ti ti-dots fs-7"></i>
                                </span>
                            </a>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                                    <a href="javascript:void(0)" class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                                        <i class="ti ti-align-justified fs-7"></i>
                                    </a>
                                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                        <!-- ------------------------------- -->
                                        <!-- start profile Dropdown -->
                                        <!-- ------------------------------- -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-profile-img">
                                                        <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="35" height="35" alt="modernize-img" />
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                                <div class="profile-dropdown position-relative" data-simplebar>
                                                    <div class="py-3 px-7 pb-0">
                                                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                                    </div>
                                                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                        <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle" width="80" height="80" alt="modernize-img" />
                                                        <div class="ms-3">
                                                            <h5 class="mb-1 fs-3">Mathew Anderson</h5>
                                                            <span class="mb-1 d-block">Designer</span>
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i> info@modernize.com
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="message-body">
                                                        <a href="<?= base_url(); ?>/pro/horizontal/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                                <img src="<?= base_url(); ?>/pro/assets/images/svgs/icon-account.svg" alt="modernize-img" width="24" height="24" />
                                                            </span>
                                                            <div class="w-100 ps-3">
                                                                <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                                                <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="d-grid py-4 px-7 pt-8">
                                                        <a href="/logout" class="btn btn-outline-primary">Log Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ------------------------------- -->
                                        <!-- end profile Dropdown -->
                                        <!-- ------------------------------- -->
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>
                <!--  Header End -->

                <aside class="left-sidebar with-horizontal">
                    <!-- Sidebar scroll-->
                    <div>
                        <!-- Sidebar navigation-->
                        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
                            <ul id="sidebarnav">
                                <!-- ============================= -->
                                <!-- Home -->
                                <!-- ============================= -->
                                <li class="nav-small-cap">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                    <span class="hide-menu">Home</span>
                                </li>
                                <!-- =================== -->
                                <!-- Dashboard -->
                                <!-- =================== -->
                                <li class="sidebar-item">
                                    <a class="sidebar-link <?= $menu == 'Dashboard' ? 'active' : ''; ?>" href="/kepala/dashboard" aria-expanded=" false">
                                        <span>
                                            <i class="ti ti-home-2"></i>
                                        </span>
                                        <span class="hide-menu">Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link <?= $menu == 'Daftar-Agenda' ? 'active' : ''; ?>" href="/daftar-agenda" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-archive"></i>
                                        </span>
                                        <span class="hide-menu">Daftar Agenda</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- End Sidebar navigation -->
                    </div>
                    <!-- End Sidebar scroll-->

                </aside>


                <div class="body-wrapper">
                    <div class="container-fluid">
                        <!-- //isiii -->
                        <?= $this->renderSection("konten"); ?>
                    </div>
                </div>
                <script>
                    function handleColorTheme(e) {
                        document.documentElement.setAttribute("data-color-theme", e);
                    }
                </script>
                <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="icon ti ti-settings fs-7"></i>
                </button>

                <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                            Settings
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body h-n80" data-simplebar>
                        <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary rounded-2" for="light-layout">
                                <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
                            </label>

                            <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary rounded-2" for="dark-layout">
                                <i class="icon ti ti-moon fs-7 me-2"></i>Dark
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="ltr-layout">
                                <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
                            </label>

                            <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="rtl-layout">
                                <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                        <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                            <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <div>
                                <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                                    <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="boxed-layout">
                                <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
                            </label>

                            <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="full-layout">
                                <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
                            </label>
                        </div>

                        <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <a href="javascript:void(0)" class="fullsidebar">
                                <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
                                </label>
                            </a>
                            <div>
                                <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                                    <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="card-with-border">
                                <i class="icon ti ti-border-outer fs-7 me-2"></i>Border
                            </label>

                            <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="card-without-border">
                                <i class="icon ti ti-border-none fs-7 me-2"></i>Shadow
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!--  Search Bar -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content rounded-1">
                        <div class="modal-header border-bottom">
                            <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                            <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                                <i class="ti ti-x fs-5 ms-3"></i>
                            </a>
                        </div>
                        <div class="modal-body message-body" data-simplebar="">
                            <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                            <ul class="list mb-0 py-2">
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Modern</span>
                                        <span class="text-muted d-block">/dashboards/dashboard1</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Dashboard</span>
                                        <span class="text-muted d-block">/dashboards/dashboard2</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Contacts</span>
                                        <span class="text-muted d-block">/apps/contacts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Posts</span>
                                        <span class="text-muted d-block">/apps/blog/posts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Detail</span>
                                        <span class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Shop</span>
                                        <span class="text-muted d-block">/apps/ecommerce/shop</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Modern</span>
                                        <span class="text-muted d-block">/dashboards/dashboard1</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Dashboard</span>
                                        <span class="text-muted d-block">/dashboards/dashboard2</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Contacts</span>
                                        <span class="text-muted d-block">/apps/contacts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Posts</span>
                                        <span class="text-muted d-block">/apps/blog/posts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Detail</span>
                                        <span class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Shop</span>
                                        <span class="text-muted d-block">/apps/ecommerce/shop</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Shopping Cart -->
            <div class="offcanvas offcanvas-end shopping-cart" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header justify-content-between py-4">
                    <h5 class="offcanvas-title fs-5 fw-semibold" id="offcanvasRightLabel">
                        Shopping Cart
                    </h5>
                    <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                </div>
                <div class="offcanvas-body h-100 px-4 pt-0" data-simplebar>
                    <ul class="mb-0">
                        <li class="pb-7">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url(); ?>/pro/assets/images/products/product-1.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="modernize-img" />
                                <div>
                                    <h6 class="mb-1">Supreme toys cooker</h6>
                                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                                        <div class="input-group input-group-sm w-50">
                                            <button class="btn border-0 round-20 minus p-0 bg-success-subtle text-success" type="button" id="add1">
                                                -
                                            </button>
                                            <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add1" value="1" />
                                            <button class="btn text-success bg-success-subtle p-0 round-20 border-0 add" type="button" id="addo2">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pb-7">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url(); ?>/pro/assets/images/products/product-2.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="modernize-img" />
                                <div>
                                    <h6 class="mb-1">Supreme toys cooker</h6>
                                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                                        <div class="input-group input-group-sm w-50">
                                            <button class="btn border-0 round-20 minus p-0 bg-success-subtle text-success" type="button" id="add2">
                                                -
                                            </button>
                                            <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add2" value="1" />
                                            <button class="btn text-success bg-success-subtle p-0 round-20 border-0 add" type="button" id="addon34">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pb-7">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url(); ?>/pro/assets/images/products/product-3.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="modernize-img" />
                                <div>
                                    <h6 class="mb-1">Supreme toys cooker</h6>
                                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                                        <div class="input-group input-group-sm w-50">
                                            <button class="btn border-0 round-20 minus p-0 bg-success-subtle text-success" type="button" id="add3">
                                                -
                                            </button>
                                            <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add3" value="1" />
                                            <button class="btn text-success bg-success-subtle p-0 round-20 border-0 add" type="button" id="addon3">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="align-bottom">
                        <div class="d-flex align-items-center pb-7">
                            <span class="text-dark fs-3">Sub Total</span>
                            <div class="ms-auto">
                                <span class="text-dark fw-semibold fs-3">$2530</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pb-7">
                            <span class="text-dark fs-3">Total</span>
                            <div class="ms-auto">
                                <span class="text-dark fw-semibold fs-3">$6830</span>
                            </div>
                        </div>
                        <a href="<?= base_url(); ?>/pro/horizontal/eco-checkout.html" class="btn btn-outline-primary w-100">Go to shopping cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <script src="<?= base_url(); ?>/pro/assets/js/vendor.min.js"></script>
        <!-- Import Js Files -->
        <script src="<?= base_url(); ?>/pro/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/libs/simplebar/dist/simplebar.min.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/js/theme/app.horizontal.init.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/js/theme/theme.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/js/theme/app.min.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/js/theme/sidebarmenu.js"></script>

        <!-- solar icons -->
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="<?= base_url(); ?>/pro/assets/js/dashboards/dashboard5.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/e1dbca68b6.js" crossorigin="anonymous"></script>

        <script>
            function btnCloseModal() {
                $(".modal").modal("hide");
            }
        </script>

        <!-- JS custome -->
        <?= $this->renderSection("js_section"); ?>
</body>

</html>