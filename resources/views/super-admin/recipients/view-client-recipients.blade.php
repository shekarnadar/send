@extends('layouts.app')
@section('title', 'Client Recipients')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>Client Recipients</h1>
        
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <!-- <a href="{{url('super-admin/add-recipient')}}" type="button" class="btn btn-primary"> Add Recipient</a>
                    <a href="{{url('super-admin/upload-recipient')}}" type="button" class="btn btn-success"> Upload Recipient</a>
                    <a href="#" type="button" class="btn btn-danger"> Download Sample Sheet</a> -->
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
             url : "{{ url('super-admin/recipients') }}",
             type: "GET",
              // data: function (d) {
              //     return $.extend({}, d, {
              //         search_text : $("#searchTxt").val(),
              //     });
              // }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'clientname', name: 'clientname', title:'Client Name'},
            {data: 'first_name', name: 'first_name', title:'First Name'},
            {data: 'last_name', name: 'last_name', title:'Last Name'},
            {data: 'phone', name: 'phone', title:'Phone'},     
            {data: 'email', name: 'email', title:'Email'},        
          {data: 'action', name: 'action', title:'Action',
           orderable: false, searchable: false},
          ],
      error: function (xhr, error, code)
      {
        // window.location.href = url('super-admin/login');
      },
    });
  }

  function deleteData(id){
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                type: "get",
                url: "{{ url('super-admin/delete-recipient') }}/"+id,
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

  
  function statusData(id){
        if(confirm("Are you sure you want to change Status?")){
            $.ajax({
                type: "get",
                url: "{{ url('super-admin/status-recipient') }}/"+id,
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