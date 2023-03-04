@extends('layouts.app')
@section('title', 'Send Gift')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1 class="mr-3">Send Gift</h1> |
        <a href="{{ url('export') }}" type="button" class="btn btn-primary btn-sm ml-3 mr-3">Download</a> |
        <a href='{{url("$urlPrefix")}}' type="button" class="btn btn-primary btn-sm ml-3 mr-3">Analytics</a> |
        <a href='{{url("$urlPrefix/order-logs")}}' type="button" class="btn btn-primary btn-sm ml-3">Track Gifts</a>

    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    @if ($urlPrefix != 'super-admin')
                    <a href="{{ url($urlPrefix.'/add-campaign') }}" type="button" class="btn btn-primary"> Send Gift</a>
                    @endif
                    <a href='{{url("$urlPrefix/products")}}' type="button" class="btn btn-primary">View Gift</a>
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
                url: '{{ url("$urlPrefix/campaigns") }}', // need to change here url
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
                    data: 'product_type',
                    name: 'product_type',
                    title: 'Product Type'
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
        var url = "{{$urlPrefix}}";
        if (url != 'super-admin') {
            table.columns([2]).visible(false);
        }

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