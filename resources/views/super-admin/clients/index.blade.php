@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>Clients</h1>
        <!-- <ul>
            <li><a href="#">Clients </a></li>
        </ul> -->
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <a href="{{url('super-admin/add-client-admin')}}" type="button" class="btn btn-primary"> Add Client</a>
                    <br><br>
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
   $(function () {
      getTable();
  });

  function getTable(){
       table = $('#table').DataTable({
          searching: true,
          processing: true,
          serverSide: true,
          lengthChange:false,
          ajax: {
             url : "{{ url('super-admin/clients') }}",
             type: "GET",
              // data: function (d) {
              //     return $.extend({}, d, {
              //         search_text : $("#searchTxt").val(),
              //     });
              // }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'name', name: 'name', title:'Company Name'},
            {data: 'gstin', name: 'gstin', title:'Gstin'},
            {data: 'pan', name: 'pan', title:'Pan'},
            {data: 'campaigncounts', name: 'campaigncounts', title:'Campaign Count'},
            {data: 'action', name: 'action', title:'Action', orderable: false, searchable: false},
          ],
      error: function (xhr, error, code)
      {
        // window.location.href = url('super-admin/login');
      },
    });
  }
  
  function statusData(id){
        if(confirm("Are you sure you want to change Status?")){
            $.ajax({
                type: "get",
                url: "{{ url('super-admin/status-client') }}/"+id,
                dataType: "json",
                success: function (response) {
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
