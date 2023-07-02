{{ app()->setLocale(Auth::user()->lang) }}
@extends('admin.layouts.dashboard')
@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

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

                <div class="page-header">
                    <h1 class="page-title">Edit New User</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit New User </li>
                        </ol>
                    </div>
                </div>
                <!-- ROW-1 -->

                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="card text-left">
                                    <div class="card-body">

                                        <form id="UserForm" name="UserForm" class="form-horizontal" method="post"
                                            action="{{ route('user_control_update', Auth::user()->id) }} ">
                                            @csrf
                                            @method('PUT')
                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label for="dispute_title"
                                                    class="control-label col-sm">{{ __('User Name') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value=" {{ $user->name }}"
                                                        name="name" id="name">
                                                </div>
                                            </div>

                                            {{-- Email --}}
                                            <div class="form-group">
                                                <label for="dispute_title"
                                                    class="control-label col-sm">{{ __('Email') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value=" {{ $user->email }}"name="email" id="email">
                                                </div>
                                            </div>
                                            {{-- Edit button --}}
                                            @if (auth()->user()->can('Roles Edit'))
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </form>

                                    </div>

                                </div>
                                <div class="card text-left">
                                    <div class="card-body">
                                        <strong> User Roles:</strong>
                                        <div class="text-wrap" class="form-control" name="role_name[]" id="role_name"
                                            required>
                                            <div class="example">

                                                <div class="tags">
                                                    {{-- @foreach ($user_roles as $role) --}}
                                                    @if ($user_roles->isEmpty())
                                                        <div class="alert alert-warning" role="alert">
                                                            There are no roles assigned to the user.
                                                        </div>
                                                    @else
                                                        @foreach ($user_roles as $role)
                                                            <span class="tag">
                                                                {{ $role }}
                                                                <a href="{{ url('user_control/' . $user->id . '/remove_role/' . $role) }}"
                                                                    class="tag-addon"><i class="fe fe-x"></i></a>
                                                            </span>
                                                        @endforeach
                                                    @endif
                                                    {{-- @endforeach --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- ADD ROLE --}}
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <strong>Add Role:</strong>
                                <div class="example">
                                    <form method="POST" action="{{ route('add_role', [$user->id]) }}">
                                        @csrf
                                        <select class="form-control form-control-sm" name="role[]" id="role[]" required
                                            multiple>
                                            @if ($unassigned_roles->isEmpty())
                                                <option value="">No More Roles to Add!</option>
                                            @else
                                                @foreach ($unassigned_roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- submit --}}
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary text-center"
                                                value="edit-type">Add</button><a href="{{ route('user_control') }}">
                                                <button class="btn btn-light">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ROW-1 END -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
@endsection
