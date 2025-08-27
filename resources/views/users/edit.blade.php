@include('include.header')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->

            <div class="p-10">
                @if (session('success'))
                    <div class="alert text-light" style="background-color: #fcaf17">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger  ">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                @endif
                <!--begin::Dashboard-->
                <!--begin::Example-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">update_administration_user</h3>
                        </div>
                        <div class="card-title card-toolbar">
                            <a href="{{ url('users') }}" class="btn btn-secondary text-sm">
                                <span class="">
                                    <img src="{{ asset('assets/media/svg/icons/Communication/Reply.svg') }}" />
                                    back</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Table-->
                        <div>
                            <form action="{{ url('update/user') }}" enctype="multipart/form-data" id="myForm"
                                method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" id="lat" name="lat" value="{{ $user->lat }}">
                                <input type="hidden" id="long" name="long" value="{{ $user->long }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName">Full Name</label>
                                            <input type="text" required name="full_name" class="form-control"
                                                id="firstName" value="{{ $user->full_name }}" placeholder="Full Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" required name="email" class="form-control"
                                                id="email" value="{{ $user->email }}" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                value="{{ $user->phone }}" placeholder="Phone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 p-5">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="image-input image-input-outline" id="kt_profile_avatar"
                                                    style="background-image: url({{ asset('assets/media/users/default.jpg') }})">
                                                    <div class="image-input-wrapper"
                                                        style="background-image: url({{ $user->avatar }})">
                                                    </div>
                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="Change avatar">
                                                        <i class="fas fa-pencil-alt  icon-sm text-muted"></i>
                                                        <input type="file" name="profile_avatar"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="profile_avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel" data-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="remove" data-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                                <span class="form-text text-muted">Allowed File Types:
                                                    png, jpg,
                                                    jpeg.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            {{-- <button type="submit" form="form" class="btn text-light" style="background-color: #3699FF !important;">Submit</button> --}}
                            <button type="submit" form="form" id="formSubmitButton"
                                class="btn text-light"style="background-color: #08a89d;"
                                save-button="true">Save</button>
                            <button type="reset" form="myForm" class="ml-3 btn btn-secondary">Reset</button>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
                <!--end::Example-->
                <!--end::Dashboard-->
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
        $('.admin_user_tab').addClass("active")
    });

    $(document).ready(function() {
        $('#formSubmitButton').on('click', function(event) {
            $(this).attr('save-button', 'false');
            $(this).prop('disabled', true); // Disable the button

            $('#myForm').submit();
        });

    });



    var KTProfile = function() {
        // Elements
        var avatar;
        var offcanvas;

        // Private functions
        var _initAside = function() {
            // Mobile offcanvas for mobile mode
            offcanvas = new KTOffcanvas('kt_profile_aside', {
                overlay: true,
                baseClass: 'offcanvas-mobile',
                //closeBy: 'kt_user_profile_aside_close',
                toggleBy: 'kt_subheader_mobile_toggle'
            });
        }

        var _initForm = function() {
            avatar = new KTImageInput('kt_profile_avatar');
        }

        return {
            // public functions
            init: function() {
                _initAside();
                _initForm();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTProfile.init();
    });
</script>
