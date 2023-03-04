@extends('layouts.app')
@section('title', 'Company Products')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">

    <div class="breadcrumb">
        <h1>Company</h1>
        <ul>
            <li><a href="#">Products</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
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
             url : "{{ url('super-admin/products') }}",
             type: "GET",
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'code', name: 'product_code', title:'Product code'},
            {data: 'name', name: 'name', title:'Product Name'},
            {data: 'description', name: 'description', title:'Description'},            
            {data: 'category', name: 'category', title:'Category'},
            {data: 'price', name: 'price', title:'Price'},            
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
                url: "{{ url('super-admin/delete-products') }}/"+id,
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