<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>TieCodes | Attendance</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https:/    /fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/sm-logo.svg') }}" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5') }}" rel="stylesheet"
        type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<style>
    .modal-body {
        h1 {
            font-weight: 900;
            font-size: 2.3em;
            text-transform: uppercase;
        }

        a.pre-order-btn {
            color: #000;
            background-color: gold;
            border-radius: 1em;
            padding: 1em;
            display: block;
            margin: 2em auto;
            width: 50%;
            font-size: 1.25em;
            font-weight: 6600;

            &:hover {
                background-color: #000;
                text-decoration: none;
                color: gold;
            }
        }


    }
</style>

<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
    <div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
        <a href="index.html">
            <img alt="Logo" src="assets/media/logos/logo-letter-9.png" class="max-h-30px" />
        </a>
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header flex-column header-fixed">
                    <div class="header-top" style="background-color:#fcaf17">
                        <div class="container">
                            <div class="d-none d-lg-flex align-items-center mr-3">
                                <a href="dashboard" class="mr-20">
                                    <h2 class="" style="color:#ffffff;">
                                        <svg width="38" height="35" viewBox="0 0 38 35" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M29.3396 7.18538C24.3126 2.50104 17.6264 3.07194 12.0909 6.78536C12.0217 6.86346 11.5921 7.08307 12.071 6.39975C22.6978 -5.11115 42.2432 10.606 31.3252 23.703C33.7695 18.5013 34.382 11.8844 29.3399 7.18549L29.3396 7.18538Z"
                                                fill="#ffffff" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M24.8473 1.7599C7.57842 -3.34896 -7.25565 23.1232 11.9783 35C-9.60605 25.7821 0.996118 -2.21233 19.9979 0.139727C21.5486 0.329935 23.9238 1.05709 24.8472 1.75968L24.8473 1.7599Z"
                                                fill="#ffffff" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M29.4039 18.7608C29.4039 24.4699 24.7471 29.1104 19.0137 29.1104C13.2755 29.1104 8.61914 24.4699 8.61914 18.7608C8.61914 13.0516 13.276 8.41113 19.0137 8.41113C24.7471 8.41113 29.4039 13.0516 29.4039 18.7608ZM11.3944 20.132C10.6191 21.3081 11.5277 24.2944 14.219 26.0608C16.8856 27.8271 20.3029 27.6954 21.098 26.5147C21.8732 25.3631 20.219 26.1048 17.1968 24.9921C12.2092 23.1575 12.1649 18.9513 11.3944 20.132Z"
                                                fill="#ffffff" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M35.6625 12.1391C42.729 25.5919 23.1146 42.8663 9.4408 30.6376C7.69264 29.0859 6.92242 27.5879 5.64844 25.6408C16.2805 40.1869 39.6777 28.6953 35.4801 12.3533C35.327 11.753 35.4259 11.6994 35.6627 12.1386L35.6625 12.1391Z"
                                                fill="#ffffff" />
                                        </svg>
                                        Tiecodes
                                    </h2>
                                </a>
                                <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{ url('dashboard') }}"
                                            class="nav-link dashboard_tab py-4 px-6">Home</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    {{-- <li class="nav-item mr-3">
                                        <a href="{{ url('users') }}"
                                            class="nav-link admin_user_tab py-4 px-6">Administration Users</a>
                                    </li> --}}
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a href="{{ url('employees') }}"
                                            class="nav-link py-4 px-6 employees_tab">Employees</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a href="{{ url('attendance') }}"
                                            class="nav-link attendance_tab py-4 px-6">Attendance</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a href="{{ url('attendance/history') }}"
                                            class="nav-link attendance_tab py-4 px-6">Attendance History</a>
                                    </li>
                                    <!--end::Item-->
                                </ul>
                                <!--begin::Tab Navs-->
                            </div>
                            <!--end::Left-->
                        </div>
                        <!--end::Container-->

                        <!--begin::Topbar-->
                        <div class="topbar mr-5">
                            <!--begin::User-->
                            <a href="{{ url('/logout') }}" class="btn btn-light m-auto font-weight-bold"
                                style="color: #fcaf17;">Sign Out</a>

                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Top-->
                </div>
                <!--end::Header-->
