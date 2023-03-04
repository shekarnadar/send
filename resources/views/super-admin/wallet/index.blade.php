@extends('layouts.app')
@section('title', 'Wallet')
@section('content')
    <div class="main-content-wrap d-flex flex-column sidenav-open">

        <div class="breadcrumb">
            <h1>Wallet</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!-- end of row-->
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <a href="{{ url('super-admin/add-wallet') }}" type="button" class="btn btn-primary"> Add Wallet </a>
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered dt-responsive  nowrap w-100">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var table;
        $(function() {
            getTable();
        });

        function getTable() {
            table = $('#table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ajax: {
                    url: "{{ url('super-admin/wallet') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: 'S.No.'
                    },
                    {
                        data: 'userName',
                        name: 'userName',
                        title: 'Admin Name'
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        title: 'Amount'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Date'
                    },
                    {data: 'action', name: 'action', title:'Action',
                       orderable: false, searchable: false},
                ],
                error: function(xhr, error, code) {
                    // window.location.href = url('super-admin/login');
                },
            });
        }
    </script>
@endsection
