@extends('layouts.app')
@section('title', 'Add User')
@section('content')
@php
   $urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>Add User</h1>
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
                    <a href="{{url('client-admin/add-manager')}}" type="button" class="btn btn-primary"> Add User</a>
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
             url : "{{ url('client-admin/managers') }}",
             type: "GET",
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'first_name', name: 'first_name', title:'First Name'},
            {data: 'last_name', name: 'last_name', title:'Last Name'},
            {data: 'email', name: 'email', title:'Email'},
            {data: 'action', name: 'action', title:'Action', orderable: false, searchable: false},
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
                url: '{{ url("$urlPrefix/delete-manager") }}/'+id,
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
                url: '{{ url("$urlPrefix/status-manager") }}/'+id,
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
