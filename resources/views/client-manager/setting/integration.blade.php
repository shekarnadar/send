@extends('layouts.app')
@section('title',  'Setting')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>Settings</h1>
        
    </div>
    <div class="separator-breadcrumb border-top"></div>
    
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                    <div class="card-body p-4">

                    <div class="breadcrumb">
                           <h2>Integration to your Application </h2>
        
                        </div>

                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($user))
                            <input name="id" type="hidden" value="{{@$user->id}}">
                        @endif
                        
                        
                        <div class="breadcrumb">
                           <h2>Whatsapp</h2>
        
                        </div>
                            <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Whatssapp Number</label>
                                                <input class="form-control" name="whatsappnumber" type="number" value="" id="whatsappnumber" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Email Id</label>
                                                <input class="form-control" name="email" type="email" value="{{@$user->email}}" id="email" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>
                          

                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Link</label>
                                                <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Password</label>
                                                <input class="form-control" name="phone" type="tel" value="{{@$user->phone}}" id="phone" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>

                        </div><hr>
                            <div class="breadcrumb">
                               <h2>Email</h2>
        
                             </div>

                             <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Whatssapp Number</label>
                                                <input class="form-control" name="whatsappnumber" type="number" value="" id="whatsappnumber" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Email Id</label>
                                                <input class="form-control" name="email" type="email" value="{{@$user->email}}" id="email" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>
                          

                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Link</label>
                                                <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Password</label>
                                                <input class="form-control" name="phone" type="tel" value="{{@$user->phone}}" id="phone" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div><hr>

                                    <div class="breadcrumb">
                               <h2>SMS</h2>
        
                             </div>

                                    <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Whatssapp Number</label>
                                                <input class="form-control" name="whatsappnumber" type="number" value="" id="whatsappnumber" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Email Id</label>
                                                <input class="form-control" name="email" type="email" value="{{@$user->email}}" id="email" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>
                          

                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Link</label>
                                                <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Password</label>
                                                <input class="form-control" name="phone" type="tel" value="{{@$user->phone}}" id="phone" >
                                                <span id="address_line_1-error" class="error text-danger"></span>
                                            </div>

                                        </div>
                                    </div>

                            
                           </div>



                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-2">
                                <div>
                                    <a href="{{url('client-admin')}}" class="btn btn-primary w-md">Cancel</a>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div>
                                    <button type="submit" id="btnSubmit" class="btn btn-success w-md">Update</button>
                                </div>
                            </div>
                        </div>
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
            url: "{{ url('client-admin/save-client') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = "{{url('client-admin/clients')}}";
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