@extends('layouts.app')
@section('title', empty($user) ? 'Add Manager' : 'Edit Manager')
@section('content')
@php
    $urlPrefix = urlPrefix();
    if(empty($user)){
        $prefix = 'Add ';
    }else{
         $prefix = 'Edit ';
    }
@endphp

<div class="main-content-wrap d-flex flex-column sidenav-open">
    @include('layouts.back',['title'=>$prefix.'Manager','url'=>$urlPrefix.'/managers'])
    <div class="separator-breadcrumb border-top"></div>

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left"> 
                    <div class="card-body p-4">
                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($user))
                        <input name="user_id" type="hidden" value="{{@$user->id}}">
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-6">
                                        <label for="example-text-input" class="form-label">First Name<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="first_name" type="text" value="{{@$user->first_name}}" id="first_name" placeholder="Enter First Name">
                                        <span id="first-name-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-6">
                                        <label for="example-text-input" class="form-label">Last Name<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" placeholder="Enter Last Name">
                                        <span id="last-name-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Email<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="email" type="text" value="{{@$user->email}}" id="email" placeholder="Enter email">
                                        <span id="email-error" class="error text-danger"></span>
                                    </div>

<!--                                     <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Password</label>
                                        <input class="form-control" name="password" type="password" value="" id="password" placeholder="Enter password">
                                        <span id="postal_code-error" class="error text-danger"></span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Phone<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="phone" type="text" value="{{@$user->phone}}" id="phone" placeholder="Enter Phone">
                                        <span id="phone-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-2">
                                <div>
                                    <a href="{{url('client-admin/managers')}}" class="btn btn-primary w-md">Cancel</a>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div>
                                    <button type="submit" id="btnSubmit" class="btn btn-success w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
</div>

<script>
    $('#form').on('submit', function(e) {
        $('.error').text('');
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{ url('client-admin/save-manager') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = '{{url("client-admin/managers")}}';
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
