@include('include.header')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <div class="card card-custom gutter-b ">
                @if (session('success'))
                    <div class="alert m-2 text-light" style="background-color: #fcaf17">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger m-2">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{-- <span class="d-block text-dark pt-2 font-size-sm">Total vehicles types</span> --}}
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ url('create/user') }}" class="btn text-light font-weight-bolder" style="background-color: #fcaf17;">
                            <span class="svg-icon svg-icon-light svg-icon-md text-light">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                <div class="card-body p-5" style="overflow:auto">
                    <table class="user_table table table-bordered table-bordered">
                    </table>
                </div>
            </div>
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->




<!--Begin::Delete Model-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Delete Administration User</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <p>Do You Want To Delete This Administration User</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn text-light" style="background-color: #fcaf17;"
                    id="delete-user">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--end::Delete Model-->

<!--Begin::changePassword Model-->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModel">Change_password</h5>
            </div>
            <div class="modal-body">
                <form id="form" action="{{ url('change/user/password') }}" method="POST">
                    @csrf
                    <label for="">Password</label>
                    <input class="form-control" minlength="8" type="text" required
                        placeholder="Password" name="password" />
                    <input type="hidden" id="change-user-password" name="user_id" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn text-light" style="background-color:#fcaf17;"
                    form="form">Change</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--end::changePassword Model-->





@include('include.footer')
<script>
    $(document).ready(function() {
        $('.admin_user_tab').addClass("active")
    });

    $(document).on('click', '.delete', function() {
        let user = $(this).attr('user-id')

        let url = "{{ url('delete/contractor') }}" + "/" + user
        $("#delete-user").attr('href', url)
    })

    $(document).ready(function() {

        var table = $('.user_table').DataTable({
            processing: true,
            serverSide: false,
            order: [],
            ajax: {
                url: "{{ url('users') }}",
            },
            columns: [{
                    data: 'avatar',
                    title: 'Avatar',
                    render: function(data, type, row) {
                        if (data) {
                            // Since 'data' contains the full URL, no need to append anything to it
                            return `<div class="text-center"><img width="50" height="50" style="border-radius:50%" src="${data}" /></div>`;
                        } else {
                            return '-';
                        }
                    }
                },
                {
                    data: 'full_name',
                    title: 'Name ',
                    render: function(data, type, row) {
                        return data ;
                    }
                },
                {
                    data: 'phone',
                    title: 'Phone '
                },
                {
                    data: 'email',
                    title: 'Email '
                },
                {
                    data: 'id',
                    title: 'action ',
                    render: function(data, type, row) {
                        let html = '';
                        let url = "{{ url('edit/user') }}" + "/" + data
                        html += `<a href="${url}" class="btn btn-icon btn-clean  title="Edit-detail">
                                <span class="svg-icon  svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#aaaaaa" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409)"/>
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                </span>
                            </a>`;
                        html += `<a class="btn btn-icon btn-clean password" title="change-password" user-id="${row.id}" data-toggle="modal" data-target="#passwordModal">
                                <span class="svg-icon  svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Lock-overturning.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                    </g>
                                    </svg>
                                </span>
                            </a>`
                        html += `<button class="btn btn-clean btn-icon delete" title="Delete" user-id="${row.id}" data-toggle="modal" data-target="#deleteModal">
                                <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#aaaaaa" fill-rule="nonzero"/>
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>`
                        return html;
                    }
                }
            ]
        });


    });


    $(document).ready(function() {
        $(document).on('click', '.delete', function() {
            let user_id = $(this).attr('user-id');
            console.log(user_id);
            $('#delete-user').attr('href', "{{ url('delete/user') }}" + "/" + user_id);
        });
        $(document).on('click', '.password', function() {
            let user_id = $(this).attr('user-id');
            $('#change-user-password').val(user_id);
        });
    })
</script>
