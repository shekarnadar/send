@extends('layouts.app')
@section('title', "Account Settings")
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>Help Video</h1>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li>Help Video</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                    <div class="card-body p-4">
                     <video width="1000" height="300" controls>
      <source src="{{URL::asset("/videos/Helper.webm")}}" type="video/webm">
    Your browser does not support the video tag.
</video>                  
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
</div>

<script>
    $('#form').on('submit', function(e) {
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);        
        $.ajax({
            type: "post",
            url: "{{ url('client-admin/save-account-setting') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = "{{url('client-admin/dashboard')}}";
                    },2000);
                } else {
                    message('error', response.message);
                }
                showButtonLoader('btnSubmit', 'Submit','enable');
            },
            error: function(response) {
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }                
                if (error.errors.first_name) {
                    $('#first-name-error').text(error.errors.first_name[0])
                }
                if (error.errors.last_name) {
                    $('#last-name-error').text(error.errors.last_name[0])
                }                
                if (error.errors.phone) {
                    $('#phone-error').text(error.errors.phone[0])
                }
                if (error.errors.email) {
                    $('#email-error').text(error.errors.email[0])
                }
                
                showButtonLoader('btnSubmit', 'Submit','enable');                
            },
        });
    })  
</script>
@endsection