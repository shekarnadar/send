@extends('layouts.app')
@section('title', 'Recipient Group')
@section('content')

<style>
  .custom-form-field {
    border: none;
    background: #eee;
    border-radius: 6px;
    padding: 4px 12px;
  }

  .width-90 {
    width: 90% !important;
  }

  #snackbar, #snackbar1 {
    max-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 4px 16px;
    position: relative;
    z-index: 1;
    left: 50%;
    /* bottom: 30px; */
    font-size: 17px;
    border-radius: 6px;
  }


  /* @-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
} */
</style>
<div class="main-content-wrap d-flex flex-column sidenav-open">

  <div class="breadcrumb">
    <h1>Recipient Group</h1>
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
          <a href="{{url('client-admin/add-recipient-group')}}" type="button" class="btn btn-primary"> Add Group</a>
          <a href="#" type="button" class="btn btn-primary" onClick="multiplegroup()
                    ">Onboarding Link</a>
          <div class="table-responsive">
            <table id="table" class="table table-bordered dt-responsive  nowrap w-100">
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="text-center pb-4">
        <h4>Share Group Link</h4>
        <p>Copy this link and share with your friends and family, you want them to join this group</p>
       
        </div>

       <input type="hidden" value="" name="group_id" id="group_id">
        <div style="display: none;" id="singlelink">
          <input type="text" class="custom-form-field width-90" id="link" value="">
          <button class="custom-form-field" onclick="copy_link()"><i class="fa fa-copy"></i></button>
        </div>
        <br>
        <span style="display: none;" id="snackbar">Copied Group Link</span>
      </div>

    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="multipleModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Multiple Group</h5>
        <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-control" name="group_id[]" id="grouprec" multiple>
          @foreach ($recipientGroup as $rec)
          <option value="{{ $rec['id']}}">{{ $rec['group_name']  }}</option>
          @endforeach


        </select>
        <br />
        <!-- <span style="display:none" id="grplink"></span> -->
        <div style="display: none;" id="grouplink">
          <input type="text" class="custom-form-field width-90" id="grplink" value="">
          <button class="custom-form-field" onclick="copy_link_grp()"><i class="fa fa-copy"></i></button>
          <br>
        </div>
        <span style="display: none;" id="snackbar1">Copied Group Link</span>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-primary" onClick="selectGroupId()" id="submit" name="copylink" value="Get Link" />
        <button type="button" class="btn btn-secondary closebtn" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  function multiplegroup() {
    $("#grouprec").val('');
    $("#grplink").val('');
    $('#multipleModal').modal('show');
  }

  function selectGroupId() {
    if ($("#grouprec").val() == '') {
      $("#grplink").show();
      $("#grplink").val("Please select Group");
      return false;
    }
    $.ajax({
      url: "/client-admin/shareLink",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "group_id": $("#grouprec").val()
      },
      success: function(response) {
        var x = document.getElementById("grouplink");
        x.style.display = 'block';
        $("#grplink").show();
        $("#grplink").val(response);
        $("#grouprec").val('');
        $("#grplink").val();
      },
    });
  }

  function shareLink(id) {
    $("#group_id").val(id);
    $('#exampleModal').modal('show');

  }
  $('#exampleModal').on('shown.bs.modal', function(e) {

    $.ajax({
      url: "/client-admin/shareLink",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "group_id": $("#group_id").val()
      },
      success: function(response) {
        var x = document.getElementById("singlelink");
        x.style.display = 'block';
        $("#link").val(response);
      },
    });

  })
  var table;
  $(function() {
    getTable();
  });

  function getTable() {
    table = $('#table').DataTable({
      searching: true,
      processing: true,
      serverSide: true,
      lengthChange: false,
      ajax: {
        url: "{{ url('client-admin/groups') }}",
        type: "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          title: 'S.No.'
        },
        {
          data: 'group_name',
          name: 'group_name',
          title: 'Group Name'
        },
        {
          data: 'recipient_count',
          name: 'recipient_count',
          title: 'Recipient Count'
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

  function statusData(id) {
    if (confirm("Are you sure you want to change Status?")) {
      $.ajax({
        type: "get",
        url: "{{ url('client-admin/status-group') }}/" + id,
        dataType: "json",
        success: function(response) {
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


  ////copy link
  // document.getElementById("cp_btn").addEventListener("click", copy_link);

  function copy_link() {
    var copyText = document.getElementById("link");

    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    //message('success', 'Copied Successfully');

    var x = document.getElementById("snackbar");
    x.style.display = 'block';
    setTimeout(function() {
      x.style.display = 'none';;
    }, 3000);

  }


  function copy_link_grp() {
    var copyText = document.getElementById("grplink");

    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    //message('success', 'Copied Successfully');

    var x = document.getElementById("snackbar1");
    x.style.display = 'block';
    setTimeout(function() {
      x.className = x.className.replace("show", "");
    }, 3000);

  }
</script>
@endsection