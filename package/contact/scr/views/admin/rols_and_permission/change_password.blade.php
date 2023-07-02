@extends('admin.layouts.dashboard')
@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    <title>Tickets</title>
    <style>
        table tbody tr {
            background-color: transparent !important;
            border-collapse: collapse;
        }
    </style>
@endsection

@section('content')
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <div class="container">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title"></h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active text-center" aria-current="page">change password</li>
                        </ol>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <form id="update_password_Form"
                                    action="{{ route('updatepassword', ['id' => Auth::user()->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="containar">
                                            <h3>{{ __('Change Password') }}</h3>
                                            @if ($data->change_password == 0)
                                                <div class="alert alert-warning" role="alert">
                                                    <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                                    <span class="alert-inner--text"><strong>warning!</strong> You should
                                                        change the password to proceed</span>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="form-label">{{ __('Current Password') }}</label>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted"
                                                        onclick="togglePasswordVisibility('current-password')">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 form-control" type="password"
                                                        placeholder="{{ __('Current Password') }}" name="password"
                                                        id="current-password" value="{{ old('password') }}">
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">{{ __('New Password') }}</label>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted"
                                                        onclick="togglePasswordVisibility('new-password')">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 form-control" type="password"
                                                        placeholder="{{ __('New Password') }}" name="new_password"
                                                        id="new-password" value="{{ old('new_password') }}">
                                                    @error('new_password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted"
                                                        onclick="togglePasswordVisibility('confirm-password')">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 form-control" type="password"
                                                        placeholder="{{ __('Confirm Password') }}"
                                                        name="new_password_confirmation" id="confirm-password"
                                                        value="{{ old('new_password_confirmation') }}">
                                                    @error('password_confirmation')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="card-footer text-end">
                                                <button onclick="update_password()" type="button"
                                                    class="btn btn-primary">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- Update password --}}
    <script>
        //for confirmation update password button click
        update_password = () => {
            var new_password_l = $("#new-password").val().length;
            var confirm_password_l = $("#confirm-password").val().length;

            if (new_password_l < 8 || confirm_password_l <
                8) { // the new password and its confirmation should not be less than 8 characters
                alert("New password should be at least 8 characters");
                return false;
            }

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-1',
                    cancelButton: 'btn btn-danger m-1',
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'هل أنت متأكد من موافقة على حفظ التغييرات؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، أوافق',
                cancelButtonText: 'لا، خروج',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('updatepassword', Auth::user()->id) }}",
                        data: $('#update_password_Form').serialize(),
                        type: "post",
                        dataType: "json",
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'تم التعديل بنجاح'

                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('user.complaint') }}";
                                }
                            });
                        },

                        error: function(data) {
                            swalWithBootstrapButtons.fire(
                                data.responseJSON.message
                            );
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'تم التراجع بنجاح'
                    );
                }
            });
        }
    </script>
@endsection
