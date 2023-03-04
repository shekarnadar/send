@extends('layouts.app')
@section('title', 'Campaign Details')
@section('content')
    @php
    $urlPrefix = urlPrefix();
    $breadcrumHomeAction = $urlPrefix . '/campaigns'; 
    $url = 'exportDetail/'.$campaign->id;

    @endphp
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Campaign Details</h4>
                    <a href="{{url($url)}}" type="button" class="btn btn-primary">Download</a>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Campaign Details</li>
                            <li class="breadcrumb-item active"><a href="{{url($breadcrumHomeAction)}}">Back</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Campaign Type</p>
                                <span>{{ $campaign->type }}</span>
                            </div>

                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Campaign Name</p>
                                <span>{{ $campaign->name }}</span>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Added By</p>
                                <span>{{ $campaign->user->first_name  }} {{ $campaign->user->last_name  }}</span>
                            </div>

                           
                           
                       

                        </div>

                        <div class="col-md-4 col-6">
                            @if (!empty($campaign->end_date))
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign End Date
                                    </p>
                                    <span>{{ !empty($campaign->end_date) ? date('d-m-Y', strtotime($campaign->end_date)) : '' }}</span>
                                </div>
                            @endif

                          @if (!empty($campaign->budget))
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign Maximum Budget
                                </p>
                                <span>{{ $campaign->budget }}</span>
                            </div>
                            @endif

                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign Redeemed Amount
                                </p>
                                <span>{{ $reedemedBudget }}</span>
                            </div>

                            @if ($campaign->type == 'individual')
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Select Type</p>
                                    <span>{{ $campaign->event_type }}</span>
                                </div>
                            @endif
                            @if (!empty($campRecipent))
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Recipient Count</p>
                                    <span>{{ $campRecipent }}</span>
                                </div>
                            @endif
                            {{-- <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign date</p>
                                <span>{{ !empty($campaign->start_date) ? date('d-m-Y', strtotime($campaign->start_date)) : '' }}</span>
                            </div> --}}
                        </div>

                        <div class="col-md-4 col-6">
                            @if (!empty($campaign->before_days))
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Before Days</p>
                                    <span>{{ $campaign->before_days }}</span>
                                </div>
                            @endif
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign date</p>
                                <span>{{ date('d-m-Y', strtotime($campaign->created_at)) }}</span>
                            </div>

                            <!-- status manage -->
                            @if($campaign->type == 'instant')
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign Status</p>
                                <span> @if($campaign->approval_status == 1) Expired @elseif($campaign->approval_status == 0) Pending @endif </span>
                            </div>
                            @endif

                            @if($campaign->type == 'individual')
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign Status</p>
                                <span> @if($carbon > date('Y-m-d',strtotime($campaign->end_date))) Expired @elseif($campaign->approval_status == 0) Pending Approval @elseif($campaign->approval_status == 1) Active @elseif($campaign->approval_status == 2) Rejected @endif </span>
                            </div>
                            @endif

                            @if($campaign->type == 'bulk')
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Campaign Status</p>
                                <span> @if($carbon > date('Y-m-d',strtotime($campaign->start_date))) Expired @elseif($campaign->approval_status == 0) Pending Approval @elseif($campaign->approval_status == 1) Active @elseif($campaign->approval_status == 2) Rejected @endif </span>
                            </div>
                            @endif
                            
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Redeem Count</p>
                                    <span>{{ $read_me }}</span>
                                </div>
                            
                            <!-- status manage -->

                        </div>
                        
                    </div>
                    <div class="separator-breadcrumb border-top"></div>
                    <!-- end of row-->
                    <div class="row mb-4">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="row">
                                        <h3 class="col-10"> Campaign Recipients</h3>
                                        @if($campaign->approval_status == 0)
                                            <h6 class="col-2"><a href="{{url($urlPrefix.'/update-campaign-recipent/'.$campaign->id)}}">Edit Recipents</a></h6>
                                        @endif
                                </div>
                                    <div class="table-responsive">
                                        <table id="tablerecipient" class="table table-bordered dt-responsive  nowrap w-100">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="row">
                                        <h3 class="col-10"> Campaign Products</h3>
                                        @if($campaign->approval_status == 0)
                                                <h6 class="col-2"><a href="{{url($urlPrefix.'/update-campaign-product/'.$campaign->id)}}">Edit Products</a></h6>
                                        @endif
                                    </div>
                                    <div class="table-responsive">
                                        <table id="tableproducts" class="table table-bordered dt-responsive  nowrap w-100">
                                        </table>
                                    </div>
                                </div>
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
        var tableRecipient;
        $(function() {
            getTableRecipient();
            getTableProducts();
        });

        function getTableRecipient() {
            table = $('#tablerecipient').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ajax: {
                    url: '{{ url("$urlPrefix/campaign-recipients-list") }}',
                    type: "GET",
                    data: function(d) {
                        return $.extend({}, d, {
                            id: "{{ $campaign->id }}",
                        });
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: 'S.No.'
                    },
                    {
                        data: 'created_by_user',
                        name: 'created_by_user',
                        title: 'Name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'group_name',
                        name: 'group_name',
                        title: 'Group Name'
                    },
                    {
                        data: 'redeem_links',
                        name: 'redeem_links',
                        title: 'Gift Link'
                    },
                    {
                        data: 'redeem_status',
                        name: 'redeem_status',
                        title: 'Redeemed Status'
                    },
                    {
                        data: 'log_status',
                        name: 'log_status',
                        title: 'Email Status'
                    },{
                        data: 'is_sent_whatsapp',
                        name: 'is_sent_whatsapp',
                        title: 'Whatsapp Status'
                    },
                    {data: 'action', name: 'action', title:'Action', orderable: false, searchable: false},
                ],
                error: function(xhr, error, code) {
                    // window.location.href = url('super-admin/login');
                },
            });
        }
        function resend(id,recipent_id){
            if (confirm("Do you want to resend")) {
                $('table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child').css({'cursor':'none'});

                 $('.page-link:not(:disabled):not(.disabled)').css({'cursor':'none'});
                 $('#recid_'+recipent_id).prop('disabled', true);
                 $("#tablerecipient_processing").show();
                 $.ajax({ 
                        type: "post",
                        url: '{{ url("$urlPrefix/campaign-resend") }}',
                        dataType: "json",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            'id':id,
                            'recipent_id':recipent_id
                        },
                        success: function(response) {
                            if (response.success) {
                                message('success', response.message);
                                $('#tablerecipient').DataTable().ajax.reload()


                            } else {
                                message('error', response.message);
                            }
                             $('#recid_'+recipent_id).prop('disabled', false);
                        }
                    });
            }
        }
        function getTableProducts() {
            table = $('#tableproducts').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ajax: {
                    url: '{{ url("$urlPrefix/campaign-recipients-products-list") }}',
                    type: "GET",
                    data: function(d) {
                        return $.extend({}, d, {
                            id: "{{ $campaign->id }}",
                        });
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: 'S.No.'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name',
                        title: 'Product Name'
                    },
                    {
                        data: 'product_price',
                        name: 'product_price',
                        title: 'Price'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code',
                        title: 'Code'
                    },
                    {
                        data: 'product_description',
                        name: 'product_description',
                        title: 'Product Description'
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


    </script>
@endsection
