@include('include.header')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
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
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            <span class="d-block text-dark pt-2 font-size-md">Attendance History</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <table class="employee_table table table-bordered table-bordered">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('include.footer')
