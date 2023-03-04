@extends('layouts.app')
@section('title', 'List Name')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>List Name</h1>
        
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <a href="{{url('super-admin/add-list-name')}}" type="button" class="btn btn-primary"> Add List Name</a>
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
             url : "{{ url('super-admin/recipientlist') }}",
             type: "GET",
              // data: function (d) {
              //     return $.extend({}, d, {
              //         search_text : $("#searchTxt").val(),
              //     });
              // }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'companyname', name: 'companyname', title:'Company Name'},
            {data: 'listname', name: 'listname', title:'List Name'},
            {data: 'count', name: 'count', title:'Recipient Count'},
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
</script>
@endsection