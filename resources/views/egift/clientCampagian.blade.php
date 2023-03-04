@extends('layouts.app')
@section('title', 'Campaigns')
@section('content')
    @php
        $urlPrefix = urlPrefix();
    @endphp
    <div class="main-content-wrap d-flex flex-column sidenav-open">

        <div class="breadcrumb">
            <h1>Campaigns</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!-- end of row-->
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        @if ($urlPrefix != 'super-admin')
                            <a href="{{ url($urlPrefix.'/add-campaign') }}" type="button" class="btn btn-primary"> Add
                                Campaign</a>
                        @endif
                        <a href="{{ url('super-admin/exportClientCampgian/'.$client_id) }}" type="button" class="btn btn-primary">Download</a>
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
                    url: '{{ url("$urlPrefix/clientcampaigns/$client_id") }}', // need to change here url
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: 'S.No.'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Campaign Name'
                    },
                    {
                        data: 'client_admin',
                        name: 'client_admin',
                        title: 'Client Name',
                    },
                    {
                        data: 'type',
                        name: 'type',
                        title: 'Campaign Type'
                    },
                    {
                        data: 'created_by_user',
                        name: 'created_by_user',
                        title: 'Created By'
                    },
                    {
                        data: 'group_name',
                        name: 'group_name',
                        title: 'Group Name'
                    },
                    {
                        data: 'recipent_count',
                        name: 'recipent_count',
                        title: 'Recipent Count',
                    },
                    {
                        data: 'total_readme',
                        name: 'total_readme',
                        title: 'Total Redeemed',
                    },
                    // {
                    //     data: 'reedemedBudget',
                    //     name: 'reedemedBudget',
                    //     title: 'Redeemed'
                    // },
                    {
                        data: 'status',
                        name: 'status',
                        title: 'Status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Action',
                        orderable: false,
                        searchable: false
                    },
                ],
                error: function(xhr, error, code) {
                    // window.location.href = url('super-admin/login');
                },
            });
        }

       

        function deleteData(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: "get",
                    url: "{{ url('super-admin/delete-campaign') }}/" + id,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            message('success', response.message);
                            table.ajax.reload(null, false);
                        } else {
                            message('error', response.message);
                        }
                    }
                });
            }
        }

        function changeStatus(id, status) {
            let status_label = status == 1 ? 'Approve' : 'Reject';
            if (confirm("Do you want to " + status_label + " the campaign?")) {
                $.ajax({
                    type: "get",
                    url: '{{ url("$urlPrefix/change-campaign-status") }}/' + id + '/' + status,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            message('success', response.message);
                            table.ajax.reload(null, false);
                        } else {
                            message('error', response.message);
                        }
                    }
                });
            }
        }
    </script>
@endsection
