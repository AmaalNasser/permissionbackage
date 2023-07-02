{{ app()->setLocale(Auth::user()->lang) }}
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
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Control</li>
                        </ol>
                    </div>
                </div>
                @if (auth()->user()->can('Roles Create'))
                    <div class="left">
                        <a class="btn btn-success" href="{{ route('new_user') }}"> Create New User</a>
                    </div>
                @endif
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="card">
                    <div class="card-body">

                        <table class="table  table-sm data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>

                                    <th width="100px">action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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

    {{-- datatable --}}
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user_control') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>

    {{-- delete  --}}
    <script>
        DeleteRep = (id) => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger m-1',
                    cancelButton: 'btn btn-success m-1',
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({

                title: '{{ __('Are you sure?') }}',
                text: '{{ __('You will not be able to revert this details!') }}',
                icon: '{{ __('warning') }}',
                showCancelButton: true,
                confirmButtonText: '{{ __('Yes, delete it!') }}',
                cancelButtonText: '{{ __('No, cancel!') }}',
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/user_control/delete') }}/" + id,
                        type: "delete",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'delete'
                        },
                        success: function(data) {
                            $('.data-table').DataTable().ajax.reload(null, false);
                            swalWithBootstrapButtons.fire(
                                '{{ __('Deleted!') }}',
                                '{{ __('details has been deleted.') }}',
                                '{{ __('success') }}'
                            )
                        },
                    });

                } else if (

                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '{{ __('Cancelled') }}',
                        '{{ __('details is safe') }}',
                        '{{ __('error') }}'
                    )
                }
            })
        }
    </script>

    {{-- show  --}}
    {{-- <script>
        $('body').on('click', '.ShowUserRequest', function() {
            var userRequest_id = $(this).data('id');
            $.get("{{ url('user_control/show') }}" + '/' + userRequest_id,
                function(data) {
                    $('#ajaxModel1').modal('show');
                    $('#user_id').val(data.id);
                    $('#name_show').val(data.name);
                    $('#email_show').val(data.email);
                    $('#role_show').val(data.role_name);
                    console.log(data)
                })
        });
    </script> --}}
@endsection
