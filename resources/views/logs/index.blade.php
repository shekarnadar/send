@extends('layouts.app')
@section('title', 'Activity')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>Activity</h1>

    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    {{-- @if ($urlPrefix != 'super-admin')
                            <a href="{{ url('client-admin/add-campaign') }}" type="button" class="btn btn-primary"> Add
                    Campaign</a>
                    @endif --}}
                    <input type="search" id="search_query" class="float-right form control" placeholder="Search...">
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
    var table, search;
    $(function() {
        var urlPrefix = "{{$urlPrefix}}";
        if (urlPrefix == 'super-admin') {
            getTable();
        } else {
            getTableforClient();
        }
    });

    $('#search_query').on('keyup', function() {
        // console.log('great');
        table.draw();
        //search = $('input[type="search"]').val()
    });

    function getTable() {
        console.log(search);
        table = $('#table').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            lengthChange: false,
            // searchDelay: 650,

            ajax: {
                url: '{{ url("$urlPrefix/logs") }}', // need to change here url
                type: "GET",
                data: function(d) {
                    d.category = $('#category').val(),
                        d.price_order = $('#price').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: 'S.No.'
                },

                {
                    data: 'recipientDetail',
                    name: 'recipientDetail',
                    title: 'Recipient Name'
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone'
                },
                {
                    data: 'group_name',
                    name: 'group_name',
                    title: 'Group'
                },
                {
                    data: 'campaign',
                    name: 'campaign',
                    title: 'Campaign'
                },
                {
                    data: 'clientName',
                    name: 'clientName',
                    title: 'Client Name'
                },
                {
                    data: 'medium',
                    name: 'medium',
                    title: 'Medium'
                },
                {
                    data: 'description',
                    name: 'description',
                    title: 'Description'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status'
                },
                {
                    data: 'link_count',
                    name: 'link_count',
                    title: 'Link Click Count'
                },
                {
                    data: 'open_count',
                    name: 'open_count',
                    title: 'Mail Open Count'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created At'
                },

            ],
            error: function(xhr, error, code) {},
        });
    }

    function getTableforClient() {
        table = $('#table').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            lengthChange: false,
            ajax: {
                url: '{{ url("$urlPrefix/logs") }}', // need to change here url
                type: "GET",
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: 'S.No.'
                },

                {
                    data: 'recipientDetail',
                    name: 'recipientDetail',
                    title: 'Recipient Name'
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone'
                },
                {
                    data: 'group_name',
                    name: 'group_name',
                    title: 'Group'
                },
                {
                    data: 'campaign',
                    name: 'campaign',
                    title: 'Campaign'
                },
                {
                    data: 'medium',
                    name: 'medium',
                    title: 'Medium'
                },
                {
                    data: 'link_count',
                    name: 'link_count',
                    title: 'Link Click Count'
                },
                {
                    data: 'open_count',
                    name: 'open_count',
                    title: 'Mail Open Count'
                },
                {
                    data: 'description',
                    name: 'description',
                    title: 'Description'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created At'
                },

            ],
            error: function(xhr, error, code) {},
        });
    }
</script>
@endsection