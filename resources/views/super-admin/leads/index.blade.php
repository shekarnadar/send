@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lead</h5>
            <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="leadForm">
            <div class="modal-body">
                <input type="hidden" id="lead_id" name="lead_id" value="">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Comment:</label>
                  <textarea class="form-control" id="comment" name="comment"></textarea>
                  <span class="text-danger" id="comment-error"></span>
                
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
              <button type="button" class="btn btn-secondary closebtn" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>  
    <div class="breadcrumb">
        <h1>Leads</h1>
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
  function comment(id){
    $("#lead_id").val(id);
    $('#exampleModal').modal('show');
  }
  $(".closebtn").click(function(){
    $('#exampleModal').modal('hide');
    $('#submit').attr('disabled',false);
    $("#leadForm").find("input[type=text], textarea").val("");
  });
  function changeStatus(id){
    var val=$("#status"+id).val();
    if(val !=''){
      $.ajax({
            url: "/super-admin/saveStatus",
            type:"POST",
            data:{
              "_token": "{{ csrf_token() }}",
              lead_id:id,
              value:val
            },
            success:function(response){
              if (response) {
                message('success',response.message);
                table.ajax.reload(null, false);
              }
            },
      });
    }
  }
  
  $('#leadForm').on('submit',function(e){
    e.preventDefault();
    let lead_id = $('#lead_id').val();
    let comment = $("#comment").val();
    $('#submit').attr('disabled',true);
    $.ajax({
          url: "/super-admin/saveComment",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            lead_id:lead_id,
            comment:comment
          },
          success:function(response){
            if (response) {
              message('success',response.message);
              $('#exampleModal').modal('hide');
              $('#submit').attr('disabled',false);
              $("#leadForm").find("input[type=text], textarea").val("");
              table.ajax.reload(null, false);
            }
          },
          error: function(response) {
            var erroJson = JSON.parse(response.responseText);
            $('#comment-error').text(erroJson.comment);
             $('#submit').attr('disabled',false);
           }
         });
  });
  function deleteData(id){
     if(confirm("Are you sure you want to delete?")){
            $.ajax({
                type: "delete",
                url: '{{ url("super-admin/leads") }}/'+id,
                 dataType: "json",
                 data:{
                    "_token": "{{ csrf_token() }}",
                 },
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
  function getTable(){
       table = $('#table').DataTable({
          searching: true,
          processing: true,
          serverSide: true,
          lengthChange:false,
          ajax: {
             url : "{{ url('super-admin/leads') }}",
             type: "GET",
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'name', name: 'name', title:'Name'},
            {data: 'company_name', name: 'company_name', title:'Company Name'},
            {data: 'phone', name: 'phone', title:'Phone'},
            {data: 'email', name: 'email', title:'Email'},
            {data:'created_at',name: 'created_at',title:'Date'},
            {
              data:'status',
              name: 'status',
              title:'status',
               render: function ( data, type, row ) {
                var option='';
                var option_assign='';
                if(row.status == 'open'){
                  option='selected'
                }else{
                  option = ''
                }
                if(row.status == 'assign'){
                  option_assign='selected'
                }else{
                  option_assign = ''
                }
                return "<select class=''form-control' name='status' id='status"+row.id+"' onchange='changeStatus("+row.id+")'  ><option value='' >Select Status</option><option value='open' "+option+">Open</option><option value='assign' "+option_assign+"  >Assign</option></select>";
              }
            },
            {data:'action',name: 'action',title:'Action',orderable: false, searchable: false}
            //{data: 'action', name: 'action', title:'Action', orderable: false, searchable: false},
          ],
      error: function (xhr, error, code)
      {
        // window.location.href = url('super-admin/login');
      },
    });

  }

  // function search(){
  //     table.ajax.reload();
  // }
  
  
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