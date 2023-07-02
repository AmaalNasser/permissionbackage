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
                    <h1 class="page-title">User Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit New User</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Create New User</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('user_control') }}"> Back</a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body pt-2">
                        <form method="POST" action="{{ route('store') }}">
                            @csrf
                            <div class="row">
                                {{-- name --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Full Name:</strong>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Contact Number:</strong>
                                        <input type="phone" class="form-control" name="phone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Date of Birth:</strong>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date_of_birth" id="date-of-birth-picker">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Designation:</strong>
                                        <input type="text" class="form-control" name="designation">
                                    </div>
                                </div>
                                {{-- Roles  --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Role:</strong>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="role_name[]" id="role_name" required multiple>
                                                @foreach ($all_roles_in_database as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- submit --}}
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ROW-1 END -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

    <!-- JavaScript code for Roles-->
    <script>
        let selectedOptions = [];
        let select = document.getElementById('role_name');
        select.addEventListener('change', function() {
            selectedOptions = [];
            let options = select.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].selected) {
                    selectedOptions.push(options[i].value);
                }
            }
        });
    </script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
   
   <!-- Initialize Datepicker -->
   <script>
       $(document).ready(function() {
           // Initialize the date picker
           $('#date-of-birth-picker').datepicker({
               format: 'yyyy-mm-dd',
               autoclose: true
           });
       });
   </script>

    {{-- @if ($roles_view_any || $roles_view)
    <a href="{{ url('user_control/' . $row->id . '/') }}">
        <i class="fa fa-eye class="center"></i>
    </a> --}}
@endsection
