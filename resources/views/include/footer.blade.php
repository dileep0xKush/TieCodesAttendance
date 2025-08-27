<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2024©</span>
            <a href="https://tiecodes.com/" target="_blank" class="text-dark-75 text-hover-primary">TieCodes Attendance</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark order-1 order-md-2">
            {{-- <a href="https://tiecodes.com/" target="_blank" class="nav-link pr-3 pl-0">Contact</a> --}}
            <button id="contactModal" class="btn  pr-3 pl-0">Contact</button>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!--end::Demo Panel-->


{{-- Contact Modal  --}}
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--         <h4 class="modal-title">Modal Header</h4> -->
            </div>
            <div class="modal-body text-center">
                <h1>Full screen Transparent Bootstrap Modal</h1>
                <p>FEEL FRREE TO GET YOUR MODAL CODE HERE FOLKS.</p>
                <a class="pre-order-btn" href="#">GET THE MODAL CODE</a>
            </div>
            <div class="modal-footer">
                <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>
<script>
    var HOST_URL = "https://keenthemes.com/metronic/tools/preview";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    $('#contactModal').on('click',function() {
        $('#myModal').modal('show');
    });
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js?v=7.0.5') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5') }}"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/widgets.js?v=7.0.5') }}"></script>
<!--end::Page Scripts-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.5') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
</body>
<!--end::Body-->

</html>
