@include('include.header')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
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
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ url('create/emp') }}" class="btn text-light font-weight-bolder"
                            style="background-color: #fcaf17;">
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
        </div>
    </div>
</div>




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
                <a type="button" class="btn text-light" style="background-color: #fcaf17;" id="delete-user">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--end::Delete Model-->






@include('include.footer')
<script>
    $(document).ready(function() {
        $('.employees_tab').addClass("active")
    });

    $(document).ready(function() {

        var table = $('.user_table').DataTable({
            processing: true,
            serverSide: false,
            order: [],
            ajax: {
                url: "{{ url('employees') }}",
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
                        return data;
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
                    data: 'designation',
                    title: 'Designation '
                },
                {
                    data: 'address',
                    title: 'Address '
                },
                {
                    data: 'dob',
                    title: 'Date of Birth',
                    render: function(data) {
                        // Create a new Date object from the 'dob' string
                        var date = new Date(data);

                        // Format the date to 'dd MMM' (e.g., '08 Aug')
                        var options = {
                            day: '2-digit',
                            month: 'short'
                        };
                        return date.toLocaleDateString('en-GB',
                        options); // Use 'en-GB' for a dd MMM format
                    }
                },
                {
                    data: 'joining_date',
                    title: 'Joining Date'
                },
                {
                    data: 'slug',
                    title: 'action ',
                    render: function(data, type, row) {
                        let html = '';
                        let url = "{{ url('edit/emp') }}" + "/" + data
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
                        html += `<button class="btn btn-clean btn-icon delete" title="Delete" user-id="${row.slug}" data-toggle="modal" data-target="#deleteModal">
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
            $('#delete-user').attr('href', "{{ url('delete/emp') }}" + "/" + user_id);
        });
    })
</script>
