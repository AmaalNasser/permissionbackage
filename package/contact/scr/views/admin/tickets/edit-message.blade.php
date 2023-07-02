@extends('admin.layouts.dashboard')
@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    <title>Edit Message</title>
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
                    <h1 class="page-title">Editing Message</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Message</li>
                        </ol>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Edit Message') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('update.message', ['id' => $response->id]) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="respond_txt">{{ __('Message') }}</label>
                                            <textarea id="respond_txt" class="form-control" name="respond_txt" rows="4" required>{{ $response->respond_txt }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary"
                                            action="#">{{ __('Update Message') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Cancel') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
@endsection
