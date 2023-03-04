@extends('layouts.app')
@section('title', 'Client Detail')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Client Detail</h4>

        <div class="page-title-right">
        <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{url('super-admin/clients')}}">Clients</a></li>
        <li class="breadcrumb-item active">Client Detail</li>
        </ol>
        </div>

        </div>
    </div>
    <div class="col-12">


    <div >
                           
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Company Name</p>
                                        <span>{{$user->name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Address Line 1</p>
                                        <span>{{$user->address_line_1}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Address Line 2</p>
                                        <span>{{@$user->address_line_2}}</span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> Country</p>
                                        <span>{{@country($user->country)->name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> State</p>
                                        <span>{{@state($user->state)->name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> City</p>
                                        <span>{{@city($user->city)->name}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> GSTin</p>
                                        <span>{{$user->gstin}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Pancard</p>
                                        <span>{{@$user->pan}}</span>
                                    </div>
                                   
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Postal Code</p>
                                        <span>{{$user->postal_code}}</span>
                                    </div>
                                </div>
                            </div>
</div>

    
        
                          
    </div>
</div>

    <div class="separator-breadcrumb border-top"></div>
    @if(!empty($client_admin_logo))
      <div class="row mb-4">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Client Profile</h4>
            </div>
            <?php $logoUrl = 'uploads/client_admin_logo/'.$client_admin_logo; ?>
            <center><img src="{{url($logoUrl)}}" height="200" onerror="this.onerror=null;this.src='https://i.picsum.photos/id/732/200/300.jpg?hmac=mBueuWVJ8LlL-R7Yt9w1ONAFVayQPH5DzVSO-lPyI9w';"></center>
         </div>
      </div>
    @endif
  <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    @if($clientAdminCount == 0) 
                    <a href="{{url('super-admin/add-client-details',$user->id)}}" type="button" class="btn btn-primary"> Add Admin User</a>
                    @endif
                    <div class="table-responsive">
                      <center><h5>Client Admin User</h5></center>
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
  var tableRecipient;
   $(function () {
    getTable();
   });

  function getTable(clientAdminId){
       table = $('#table').DataTable({
          searching: true,
          processing: true,
          serverSide: true,
          lengthChange:false,
          ajax: {
             url : "{{ url('super-admin/client-admins-ajax',$user->id) }}",
             type: "GET",
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', title:'S.No.'},
            {data: 'first_name', name: 'first_name', title:'First Name'},
            {data: 'last_name', name: 'last_name', title:'Last Name'},
            {data: 'email', name: 'email', title:'Email'},
            {data: 'last_login_at', name: 'last_login_at', title:'Last Login'},
            {data: 'recipients', name: 'recipients', title:'Recipients'},
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
                url: "{{ url('super-admin/status-client-admin') }}/"+id,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        message('success', response.message);
                        table.ajax.reload();
                    } else {
                        message('error', response.message);
                    }
                }
            });
        }    
  }
</script>
@endsection