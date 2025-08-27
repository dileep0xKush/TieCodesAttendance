@include('include.header')

<style>
    .half-width-column {
        width: 50% !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <div class="card card-custom gutter-b ">
                @if (session('success'))
                    <script>
                        toastr.success("{{ session('success') }}");
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        toastr.error("{{ session('error') }}");
                    </script>
                @endif
                <div class="card-body p-5">

                    {{-- Attendance Table  --}}
                    <div class="card card-custom gutter-b p-5 mb-5" style="overflow:auto">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">
                                    <span class="d-block text-dark pt-2 font-size-md">Attendance</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ url('create/emp') }}" class="btn text-light font-weight-bolder"
                                    style="background-color: #fcaf17;">
                                    <span class="svg-icon svg-icon-light svg-icon-md text-light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                                <path
                                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="text-light">Add New</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-5">
                            <table class="employee_table table table-bordered table-bordered">
                            </table>
                        </div>
                    </div>

                    {{-- <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g id="User / User_Close">
                                <path id="Vector"
                                    d="M15 19C15 16.7909 12.3137 15 9 15C5.68629 15 3 16.7909 3 19M17 14L19 12M19 12L21 10M19 12L17 10M19 12L21 14M9 12C6.79086 12 5 10.2091 5 8C5 5.79086 6.79086 4 9 4C11.2091 4 13 5.79086 13 8C13 10.2091 11.2091 12 9 12Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </g>
                    </svg> --}}
                </div>
            </div>
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@include('include.footer')
<script>
    $(document).ready(function() {
        $('.attendance_tab').addClass("active")
    });


    var table = $('.employee_table').DataTable({
        processing: true,
        serverSide: false,
        order: [],
        ajax: {
            url: "{{ url('attendance/employees') }}",
        },
        columns: [{
                data: 'full_name',
                title: 'Name',
                className: 'half-width-column', // Custom class
                render: function(data, type, row) {
                    let result = '<div style="width:100%">';
                    result += `<span class="mb-2">` + data.toUpperCase() + '</span><br>';
                    result += '</div>';
                    return result;
                }
            },
            {
                data: 'attendance.status',
                title: 'Status',
                render: function(data, type, row) {
                    let result = '<div class="">';

                    // Handle null or undefined data
                    if (!data) {
                        data = 'Unknown'; // Default value if data is null or undefined
                    }

                    // Convert data to uppercase and set the badge color
                    let badgeClass = 'badge-secondary'; // Default color
                    switch (data) {
                        case 'Acceptable':
                            badgeClass = 'badge-success';
                            break;
                        case 'Late':
                            badgeClass = 'badge-danger';
                            break;
                        case 'Toooo Late':
                            badgeClass = 'badge-warning';
                            break;
                            // Add more cases as needed
                        default:
                            badgeClass = 'badge-secondary'; // Default color for unknown statuses
                    }

                    result += `<span class="badge ${badgeClass} mb-2">` + data.toUpperCase() +
                        '</span><br>';
                    result += '</div>';

                    return result;
                }
            },
            {
                data: 'attendance.inn_time',
                title: 'Inn Time',
                render: function(data, type, row) {
                    // Handle null or undefined data
                    if (data === null || data === undefined) {
                        return '00:00:00'; // Default value if data is null or undefined
                    }

                    return data; // Return the actual data if it's not null
                }
            },
            {
                data: 'attendance.out_time',
                title: 'Out Time',
                render: function(data, type, row) {
                    // Handle null or undefined data
                    if (data === null || data === undefined) {
                        return '00:00:00'; // Default value if data is null or undefined
                    }

                    return data; // Return the actual data if it's not null
                }
            },
            {
                data: 'id',
                title: 'Action',
                className: 'half-width-column', // Custom class
                render: function(data, type, row) {
                    let html = '<div style="width:100%">';
                    let innUrl = "{{ url('inn') }}" + "/" + data;
                    let outUrl = "{{ url('out') }}" + "/" + data;
                    let wfhUrl = "{{ url('wfh') }}" + "/" + data;
                    let leaveUrl = "{{ url('leave') }}" + "/" + data;

                    html += `<a href="${innUrl}" class="btn btn-icon btn-clean" title="Inn">
                                <span class="svg-icon svg-icon-primary svg-icon-3x">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(9.000000, 12.000000) rotate(-270.000000) translate(-9.000000, -12.000000) " x="8" y="6" width="2" height="12" rx="1"/>
                                            <path d="M20,7.00607258 C19.4477153,7.00607258 19,6.55855153 19,6.00650634 C19,5.45446114 19.4477153,5.00694009 20,5.00694009 L21,5.00694009 C23.209139,5.00694009 25,6.7970243 25,9.00520507 L25,15.001735 C25,17.2099158 23.209139,19 21,19 L9,19 C6.790861,19 5,17.2099158 5,15.001735 L5,8.99826498 C5,6.7900842 6.790861,5 9,5 L10.0000048,5 C10.5522896,5 11.0000048,5.44752105 11.0000048,5.99956624 C11.0000048,6.55161144 10.5522896,6.99913249 10.0000048,6.99913249 L9,6.99913249 C7.8954305,6.99913249 7,7.89417459 7,8.99826498 L7,15.001735 C7,16.1058254 7.8954305,17.0008675 9,17.0008675 L21,17.0008675 C22.1045695,17.0008675 23,16.1058254 23,15.001735 L23,9.00520507 C23,7.90111468 22.1045695,7.00607258 21,7.00607258 L20,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.000000, 12.000000) rotate(-90.000000) translate(-15.000000, -12.000000) "/>
                                            <path d="M16.7928932,9.79289322 C17.1834175,9.40236893 17.8165825,9.40236893 18.2071068,9.79289322 C18.5976311,10.1834175 18.5976311,10.8165825 18.2071068,11.2071068 L15.2071068,14.2071068 C14.8165825,14.5976311 14.1834175,14.5976311 13.7928932,14.2071068 L10.7928932,11.2071068 C10.4023689,10.8165825 10.4023689,10.1834175 10.7928932,9.79289322 C11.1834175,9.40236893 11.8165825,9.40236893 12.2071068,9.79289322 L14.5,12.0857864 L16.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.500000, 12.000000) rotate(-90.000000) translate(-14.500000, -12.000000) "/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`;

                    html += `<a href="${outUrl}" class="btn btn-icon btn-clean"  title="Out">
                                <span class="svg-icon svg-icon-danger svg-icon-3x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Sign-out.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                            <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`;
                    html += `<a href="${wfhUrl}" class="btn btn-icon btn-clean"  title="Work From Home">
                                <span class="svg-icon svg-icon-success svg-icon-3x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`;
                    html += `<a href="${leaveUrl}" class="btn btn-icon btn-clean" title="Leave">
                                <span class="svg-icon svg-icon-3x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#f64e60" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g id="User / User_Close">
                                                <path id="Vector"
                                                    d="M15 19C15 16.7909 12.3137 15 9 15C5.68629 15 3 16.7909 3 19M17 14L19 12M19 12L21 10M19 12L17 10M19 12L21 14M9 12C6.79086 12 5 10.2091 5 8C5 5.79086 6.79086 4 9 4C11.2091 4 13 5.79086 13 8C13 10.2091 11.2091 12 9 12Z"
                                                    stroke="#f64e60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </a>`;


                    html += '</div>';
                    return html;
                }
            }
        ]
    });
</script>
