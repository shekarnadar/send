@extends('layouts.app')
@section('title', 'Redeemed')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">

  <div class="breadcrumb">
    <h1>Redeemed</h1>
  </div>
  <div class="separator-breadcrumb border-top"></div>

  <div class="row mb-4">
    <div class="col-md-12 mb-4">
      <div class="card text-left">
        <div class="card-body  position-relative">
          @if($urlPrefix == 'super-admin')
          <div class="select-catory-container" style=" display : flex; align-items : center; position : absolute; left : calc(100% - 780px); z-index : 9999999;margin-bottom: 20px;">
            <label class="mr-3 mb-0"><b>Filters</b></label>
            <label class="mr-2 mb-0">Client :</label>
            <select id='clientId' class="form-control" style="width: 200px; height : 27px; padding : 3px 0px 0px 5px">
              <option value="">select Client</option>
              @foreach($clients as $client)
              @if(@$client->user)
              <option value="{{$client->user->id}}">{{$client['name']}}</option>
              @endif
              @endforeach
            </select>
            <label class="mr-3 mb-0">&nbsp;&nbsp;&nbsp;Pickrr Status :</label>
            <select id='staus_code' class="form-control" style="width: 200px; height : 27px; padding : 3px 0px 0px 5px">
              <option value="">Select Order Status</option>
              @foreach($status_code as $key=>$code)
              <option value="{{$key}}">{{$code}}</option>
              @endforeach
            </select>

          </div>
          <label> &nbsp;<b>Bulck Action</b></label>
          <button id="dispatchBtn" type="button" class="btn btn-primary dispatch">Dispatch</button>
          <button id="rejectBtn" type="button" class="btn btn-primary reject">&nbsp;Reject</button>
          @endif
          <br><br>
          <input type="search" id="search_query" class="float-right form control" placeholder="Search...">
                  
          <div class="table-responsive">
            <table id="table" class="table table-bordered dt-responsive nowrap w-100">
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var table;
  $(function() {
    var urlPrefix = "{{$urlPrefix}}";
    if (urlPrefix == 'super-admin') {
      getTable();
    } else {
      getTableforClient();
    }
  });

  $(".reject").click(function() {
    event.preventDefault();
    var IDS = $(".readme_entry_cb").map(function() {
      return $(this).val();
    }).get(); // <----
    return false;
    if (IDS.length == 0) {
      alert("please select at least 1 order");
      return false;
    }
    if (confirm("Do you want to reject the Redeem?")) {

      $('#dispatchBtn').prop('disabled', true);
      $('#rejectBtn').prop('disabled', true);


      $('table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child').css({
        'cursor': 'none'
      });

      $('.page-link:not(:disabled):not(.disabled)').css({
        'cursor': 'none'
      });

      $("#table_processing").show();
      $.ajax({
        type: "post",
        url: '{{ url("$urlPrefix/multipleDispatch") }}',
        dataType: "json",
        data: {
          "_token": "{{ csrf_token() }}",
          "ids": IDS,
          'status': 2,
        },
        success: function(response) {
          if (response.success) {
            message('success', response.message);
            table.ajax.reload(null, false);
          } else {
            message('error', response.message);
          }
          $('#dispatchBtn').prop('disabled', false);
          $('#rejectBtn').prop('disabled', false);
        }
      });

    }
  });
  $(".dispatch").click(function() {
    event.preventDefault();
    var IDS = $(".readme_entry_cb").map(function() {
      if ($(this).prop('checked')) {
        return $(this).val();
      }
    }).get();

    if (IDS.length == 0) {
      alert("please select at least 1 order");
      return false;
    }
    if (confirm("Do you want to dispatch the Redeem?")) {

      $('#dispatchBtn').prop('disabled', true);
      $('#rejectBtn').prop('disabled', true);

      $('table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child').css({
        'cursor': 'none'
      });

      $('.page-link:not(:disabled):not(.disabled)').css({
        'cursor': 'none'
      });

      $("#table_processing").show();
      $.ajax({
        type: "post",
        url: '{{ url("$urlPrefix/multipleDispatch") }}',
        dataType: "json",
        data: {
          "_token": "{{ csrf_token() }}",
          "ids": IDS,
          'status': 1,
        },
        success: function(response) {
          if (response.success) {
            message('success', response.message);
            table.ajax.reload(null, false);
          } else {
            message('error', response.message);
          }
          $('#dispatchBtn').prop('disabled', false);
          $('#rejectBtn').prop('disabled', false);
        }
      });

    }
  });



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

      ajax: {
        url: '{{ url("$urlPrefix/redeemed") }}',
        type: "GET",
        data: function(d) {
          d.client = $('#clientId').val(),
            d.staus_code = $("#staus_code").val(),
            d.search = $('input[type="search"]').val()
        }
        // console.log()
      },

      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          title: 'S.No.'
        },
        {
          data: 'checkbox',
          name: 'checkbox',
          title: '<input type="checkbox" id="selectAll"/>',
          orderable: false,
          searchable: false
        },
        {
          data: 'checkbox',
          name: 'checkbox',
          title: '<button class="downloadcheck btn btn-sm btn-white" title="Download Checkbox">DC</button>',
          orderable: false,
          searchable: false
        },
        {
          data: 'recipientName',
          name: 'recipientName',
          title: 'Recipient Name'
        },
        {
          data: 'recipientEmail',
          name: 'recipientEmail',
          title: 'Recipient Email'
        },
        {
          data: 'clientName',
          name: 'clientName',
          title: 'Client Name'
        },
        {
          data: 'productName',
          name: 'productName',
          title: 'Product Name'
        },
        {
          data: 'pickrr_order_staus',
          name: 'pickrr_order_staus',
          title: 'Pickrr Order Status'
        },
        {
          data: 'productPrice',
          name: 'productPrice',
          title: 'Product Price'
        },
        {
          data: 'approval_status',
          name: 'approval_status',
          title: 'Dispatch Status'
        },
        {
          data: 'created_at',
          name: 'created_at',
          title: 'Created At'
        },
        {
          data: 'action',
          name: 'action',
          title: 'Action',
          orderable: false,
          searchable: false
        },
      ],
      error: function(xhr, error, code) {},
    });
  }



  function getTableforClient() {
    table = $('#table').DataTable({
      searching: false,
      processing: true,
      serverSide: true,
      lengthChange: false,
      ajax: {
        url: '{{ url("$urlPrefix/redeemed/".\Auth::guard(getAuthGaurd())->user()->client_id) }}',
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
          data: 'recipientName',
          name: 'recipientName',
          title: 'Recipient Name'
        },
        {
          data: 'recipientEmail',
          name: 'recipientEmail',
          title: 'Recipient Email'
        },
        {
          data: 'productName',
          name: 'productName',
          title: 'Product Name'
        },
        {
          data: 'pickrr_order_staus',
          name: 'pickrr_order_staus',
          title: 'Pickrr Order Status'
        },
        {
          data: 'productPrice',
          name: 'productPrice',
          title: 'Product Price'
        },
        {
          data: 'approval_status',
          name: 'approval_status',
          title: 'Dispatch Status'
        },
        {
          data: 'created_at',
          name: 'created_at',
          title: 'Created At'
        }
      ],
      error: function(xhr, error, code) {},
    });
  }

  $('#clientId').change(function() {
    table.draw();
  });

  $('#staus_code').change(function() {
    table.draw();
  });

  $(document).ready(function() {
    $('#selectAll').on('click', function() {
      if (this.checked) {
        $('.readme_entry_cb').each(function() {
          this.checked = true;
        });
      } else {
        $('.readme_entry_cb').each(function() {
          this.checked = false;
        });
      }
    });

    $('.checkbox').on('click', function() {
      if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#selectAll').prop('checked', true);
      } else {
        $('#selectAll').prop('checked', false);
      }
    });
  });
  $('#table').on('page.dt', function() {
    $('#selectAll').prop('checked', false);
  });

  function changeStatus(id, status) {
    let status_label = status == 1 ? 'Dispatch' : 'Reject';
    if (confirm("Do you want to " + status_label + " the Redeem?")) {
      $('#firstStep').prop('disabled', true);

      $('table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child').css({
        'cursor': 'none'
      });

      $('.page-link:not(:disabled):not(.disabled)').css({
        'cursor': 'none'
      });

      $("#table_processing").show();
      $.ajax({
        type: "get",
        url: '{{ url("$urlPrefix/change-redeemed-status") }}/' + id + '/' + status,
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