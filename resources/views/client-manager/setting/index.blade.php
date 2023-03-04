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
                           <h2>Admin </h2>
        
                        </div>

                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($user))
                            <input name="id" type="hidden" value="{{@$user->id}}">
                        @endif
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Company Name</label>
                                        <input class="form-control" name="company_name" type="text" value="{{@$user->name}}" id="company_name" placeholder="Enter Name">
                                        <span id="company_name-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Address Line 1</label>
                                        <input class="form-control" name="address_line_1" type="text" value="{{@$user->address_line_1}}" id="address_line_1" placeholder="Enter address line 1">
                                        <span id="address_line_1-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Postal Code</label>
                                        <input class="form-control" name="postal_code" type="text" value="{{@$user->postal_code}}" id="postal_code" placeholder="Enter postal code">
                                        <span id="postal_code-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">State</label>
                                        <select class="form-control" name="state" id="state">
                                            <option value="">Select state</option>
                                           
                                         
                                        </select>
                                        {{-- <input class="form-control" name="state" type="text" value="{{@$user->state}}" id="state" placeholder="Enter State"> --}}
                                        <span id="state-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Gstin</label>
                                        <input class="form-control" name="gstin" type="text" value="{{@$user->gstin}}" id="gstin" placeholder="Enter Gstin">
                                        <span id="gstin-error" class="error text-danger"></span>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">                                   
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Address line 2</label>
                                        <input class="form-control" name="address_line_2" type="text" value="{{@$user->address_line_2}}" id="address_line_2" placeholder="Enter Address line 2">
                                        <span id="address_line_2-error" class="error text-danger"></span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Country</label>
                                        <select class="form-control" name="country" id="country">
                                           
                                        </select>
                                        
                                        {{-- <input class="form-control" name="country" type="text" value="{{@$user->country}}" id="country" placeholder="Enter Country">--}}
                                        <span id="country-error" class="error text-danger"></span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">City</label>
                                        <select class="form-control" name="city" id="city">
                                            <option value="">Select City</option>
                                           
                                        </select>
                                        <span id="city-error" class="error text-danger"></span>
                                        {{-- <input class="form-control" name="city" type="text" value="{{@$user->city}}" id="city" placeholder="Enter City">
                                        <span id="city-error" class="error text-danger"></span> --}}
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Pan</label>
                                        <input class="form-control" name="pan" type="text" value="{{@$user->pan}}" id="pan" placeholder="Enter Pan">
                                        <span id="pan-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Logo</label>
                                        <input class="form-control" name="logo" type="file" value="" id="logo" >
                                        <span id="pan-error" class="error text-danger"></span>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="breadcrumb">
                           <h2>Admin User</h2>
        
                        </div>
                            <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">First Name</label>
                                        <input class="form-control" name="first_name" type="text" value="{{@$user->first_name}}" id="first_name" >
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
                                        <label for="example-month-input" class="form-label">Last Name</label>
                                        <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" >
                                        <span id="address_line_1-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Mobile</label>
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
            url: "{{ url('super-admin/save-client') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = "{{url('super-admin/clients')}}";
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