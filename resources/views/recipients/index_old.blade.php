@extends('layouts.app')
@section('title', 'Recipient')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">

  <div class="breadcrumb">
    <h1>Recipient</h1>

  </div>
  <div class="separator-breadcrumb border-top"></div>
  <!-- end of row-->
  <div class="row mb-4">
    <div class="col-md-12 mb-4">
      <div class="card text-left">
        <div class="card-body">
          @if($urlPrefix == 'client-admin' || $urlPrefix == 'manager')
          <a href="{{url('client-admin/add-recipient')}}" type="button" class="btn btn-primary"> Add Recipient</a>
          <a href="{{url('client-admin/groups')}}" type="button" class="btn btn-primary">Onboarding Link</a>
          <a href="{{url('client-admin/importExcelView')}}" type="button" class="btn btn-primary"> Bulk Upload</a>
          <a href="{{url('client-admin/recipients-sample')}}" type="button" class="btn btn-primary"> Download Sample</a>
          @endif
          <br>
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
<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Share Link</h5>
        <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="link"></span>
      </div>

    </div>
  </div>
</div>



<script type="text/javascript">
  var table;
  $(function() {
    getTable();
  });

  function shareLink() {
    $('#exampleModal').modal('show');
  }
  $('#exampleModal').on('shown.bs.modal', function(e) {
    $.ajax({
      url: "/client-admin/groups",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
      },
      success: function(response) {
        $("#link").text('Genrated Link: ' + response);
      },
    });

  })


  ///On key up for search
  $('#search_query').on('keyup', function() {
    // console.log('great');
    table.draw();
    //search = $('input[type="search"]').val()
  });



  function getTable() {
    table = $('#table').DataTable({
      searching: false,
      processing: true,
      serverSide: true,
      lengthChange: false,
      searchDelay: 550,

      ajax: {
        url: "{{ url('client-admin/recipients') }}",
        type: "GET",
        data: function(d) {
          d.search = $('input[type="search"]').val()
        }
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          title: 'S.No.'
        },
        {
          data: 'first_name',
          name: 'first_name',
          title: 'First Name'
        },
        {
          data: 'last_name',
          name: 'last_name',
          title: 'Last Name'
        },
        {
          data: 'phone',
          name: 'phone',
          title: 'Phone'
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

  function deleteData(id) {
    if (confirm("Are you sure you want to delete?")) {
      $.ajax({
        type: "get",
        url: '{{ url("$urlPrefix/delete-recipient") }}/' + id,
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


  function statusData(id) {
    if (confirm("Are you sure you want to change Status?")) {
      $.ajax({
        type: "get",
        url: '{{ url("$urlPrefix/status-recipient") }}/' + id,
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
</script>
@endsection