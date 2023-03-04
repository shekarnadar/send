@extends('layouts.app')
@section('title', 'Add Recipient')
@section('content')
@php
   $urlPrefix = urlPrefix();
@endphp
<div class="main-content-wrap d-flex flex-column sidenav-open">
   <div class="breadcrumb">
      <h1>Bulk Upload Recipient</h1>
   </div>
   <div class="separator-breadcrumb border-top"></div>
   <div class="row mb-4">
      <div class="col-md-12 mb-4">
         <div class="card text-left">
            <div class="card-body p-4">
               <form method="post" id="form" action="{{ url('$urlPrefix/importRecipient') }}" enctype="multipart/form-data">
                  @csrf
                  <div id="error_message"></div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div>
                           <div class="mb-3">
                              <label for="example-fname-input" class="form-label">Upload File</label>
                              <input class="form-control" name="bulk_import" type="file">
                              <span id="firstname-error" class="error text-danger"></span>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  <div class="row justify-content-center mt-5">
                     <div class="col-sm-2">
                        <div>
                           <a href='{{ url("$urlPrefix/recipients") }}' class="btn btn-primary w-md">Cancel</a>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div>
                           <button type="submit" id="btnSubmit" class="btn btn-success w-md">Submit</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<!-- container-fluid -->
</div>

<script>
    $('#form').on('submit', function(e) {
        $('.error').text('');
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);    

        $.ajax({
            type: "post",
            url: '{{ url("$urlPrefix/importRecipient") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
             xhrFields: {
                    responseType: 'blob',
                },
            success: function(response) {
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = '{{url("$urlPrefix/recipients")}}';
                    },2000);
                } else {
                     var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "log-error.pdf";
                link.click();
                }
                showButtonLoader('btnSubmit', 'Submit','enable');
            },
            error: function(response) {
              console.log(response);
               var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "log-error.pdf";
                link.click();
                // var errors = response.responseJSON;
                // errorsHtml = '<div class="alert alert-danger"><ul>';
                //       var ItemArray = [];

                // $.each(errors.errors,function (k,v) {
                //   let unquie=k.split('.');
                //    ItemArray.push({
                //       key : unquie[1], 
                //       value : v
                //    });
                // });
                //  var dupes = [];
                // var unique = [];
                // $.each(ItemArray, function (index, entry) {
                //   if (!dupes[entry.key]) {
                //       dupes[entry.key] = true;
                //       unique.push(entry);
                //   }
                // });
                // $.each(unique,function (k,v) {
                //  errorsHtml += '<li>'+ v.value + '</li>';
                // });

                // errorsHtml += '</ul></di>';
                // $( '#error_message' ).html( errorsHtml );
                // showButtonLoader('btnSubmit', 'Submit','enable'); 
                // $('#form')[0].reset();
               
            },
        });
    })  

    $('.anniversarydatepicker').datepicker({
        dateFormat: "dd-mm-yy"
    });
    $('.dob').datepicker({
        dateFormat: "dd-mm-yy"
    });

    

   $('#grouprec option').mousedown(function(e) {
      e.preventDefault();
      $(this).prop('selected', !$(this).prop('selected'));
      return false;
   });

</script>

 
@endsection