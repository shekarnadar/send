@extends('layouts.app')
@section('title', 'Wallet')
@section('content')

    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="row">
            <div class="breadcrumb">
                <h1>Wallet</h1>
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Amount</p>
                            <span>{{ $walletAmount }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Pending Amount</p>
                            <span>{{ $pendingAmount }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Spent Amount</p>
                            <span>{{ $spentAmount }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Available Amount</p>
                            <span>{{ $availableBalance }}</span>
                        </div>
                    </div>
                </div>
                <div class="separator-breadcrumb border-top"></div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h3> Campaign List</h3>
                                <div class="table-responsive">
                                    <table id="table" class="table table-bordered dt-responsive  nowrap w-100">
                                    </table>
                                </div>
                            </div>
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
                    url: "{{ url('client-admin/wallet-campaign') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: 'S.No.'
                    },
                    {
                        data: 'recipient_name',
                        name: 'recipient_name',
                        title: 'Recipient Name'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Campaign Name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Date'
                    },
                    // {data: 'action', name: 'action', title:'Action',
                    //    orderable: false, searchable: false},
                ],
                error: function(xhr, error, code) {
                    // window.location.href = url('super-admin/login');
                },
            });
        }
    </script>
@endsection
