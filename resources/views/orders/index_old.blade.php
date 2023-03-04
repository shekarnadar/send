@extends('layouts.app')
@section('title', 'Track Gifts')
@section('content')
    @php
    $urlPrefix = urlPrefix();
    @endphp
    <div class="main-content-wrap d-flex flex-column sidenav-open">

        <div class="breadcrumb">
            <h1>Track Gifts</h1>

        </div>
        <div class="row">  
            <div class="col-2">
                <input class="form-control startDate" name="startDate" type="text" value=""id="startDate" placeholder="Select Start Date">
                <span id="startDate-error" class="error text-danger"></span>
            </div>
            <div class="col-2">
                <input class="form-control endDate" name="endDate" type="text" value=""id="endDate" placeholder="Select End Date">
                <span id="endDate-error" class="error text-danger"></span>
            </div>
            <div class="col-1 mr-4">
                    <button onclick="downloadExcel()" id="btn-download-payroll" class="btn btn-primary btn-md" ><i aria-hidden="true" class="fa fa-cog mr-10"></i>Download</button>
            </div>
            <div class="col-2 mr-5 mt-1">
                        <select id='staus_code' class="form-control" style="width: 200px; height : 27px; padding : 3px 0px 0px 5px">
                         <option value="">Select Order Status</option>
                          @foreach($status_code as $key=>$code)
                                <option value="{{$key}}">{{$code}}</option>
                          @endforeach
                        </select>
            </div>
            <div class="col-4">
               <div id="pickrr-tracking-container"> <div id="pickrr-tracking-radio-group">  </div><input id="pickrr-tracking-input" data-id="823982" /> <button id="pickrr-tracking-btn" style="height: 32px; width: 110px; font-size: 15px; padding: 4px 36px; border-radius: 5px; color: #272727; border: 1px solid #fdaf23; background: #fdaf23;" class="trackOrder">Track</button></a> </div><script src="https://widget.pickrr.com/script.js%22%3E"></script>
            </div>
            
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
       $('.startDate').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy"
        });
        $('.endDate').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy"
        });
       function downloadExcel() {
            var startDate = $(".startDate").val();
            var endDate = $(".endDate").val();
            if(startDate === ''){
                $("#startDate-error").text("Select Start Date");
                return false;
            }
            if(endDate === ''){
                $("#endDate-error").text("Select End Date");
                return false;
            }
            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type: 'POST',
                url: '/exportOrder',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    "_token": "{{ csrf_token() }}",
                },
                
                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : 'Orders.xlsx');

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                }
            });
       }
        $(".trackOrder").click(function(){
            var id =$("#pickrr-tracking-input").val();
            window.open('trackorder/'+id, '_blank');
        });


        ///On key up for search
        $('#search_query').on('keyup', function() {
        // console.log('great');
        table.draw();
        //search = $('input[type="search"]').val()
    });

        var table;
        $(function() {
            getTable();
        });

        function getTable() {
            table = $('#table').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                lengthChange: false,
                // searchDelay: 350,
                
                ajax: {
                    url: '{{ url("$urlPrefix/order-logs") }}', // need to change here url
                    type: "GET",
                     data: function (d) {
                d.client = $('#clientId').val(),
                d.staus_code = $("#staus_code").val(),
                    d.search = $('input[type="search"]').val()
                
            }},
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
                        data: 'product_name',
                        name: 'product_name',
                        title: 'Product Name'
                    },
                    {
                        data: 'group_name',
                        name: 'group_name',
                        title: 'Group'
                    },
                    
                    {
                        data: 'clientName',
                        name: 'clientName',
                        title: 'Client Name'
                    },
                    {
                        data: 'tracking_id',
                        name: 'tracking_id',
                        title: 'Tracking ID'
                    },
                    {
                        data: 'order_id',
                        name: 'order_id',
                        title: 'Order ID'
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
                    {
                        data: 'courier',
                        name: 'courier',
                        title: 'Courier'
                    },
                    {
                        data: 'tracklink',
                        name: 'tracklink',
                        title: 'Track'
                    }
                  
                ],
                error: function(xhr, error, code) {
                },
            });
        }
        $('#staus_code').change(function(){
                table.draw();
        });
    </script>
@endsection
