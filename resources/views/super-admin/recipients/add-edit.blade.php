@extends('layouts.app')
@section('title', 'Add Recipient')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>Add Recipient</h1>
       
    </div>
    <div class="separator-breadcrumb border-top"></div>
    
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                    <div class="card-body p-4">

                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($recipient))
                            <input name="id" type="hidden" value="{{@$recipient->id}}">
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div>


                                    <div class="mb-3">
                                        <label for="example-fname-input" class="form-label">First Name</label>
                                        <input class="form-control" name="first_name" type="text" value="{{@$recipient->first_name}}" id="first_name" placeholder="Enter First Name">
                                        <span id="firstname-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-mail-input" class="form-label">Email</label>
                                        <input class="form-control" name="email" type="email" value="{{@$recipient->email}}" id="email" placeholder="Enter Email">
                                        <span id="email-error" class="error text-danger"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-address1-input" class="form-label">Address Line 1</label>
                                        <textarea class="form-control" name="address_line1" type="text"  id="address_line1" placeholder="Enter Address Line 1">{{@$recipient->address_line_1}}</textarea>
                                        <span id="address1-error" class="error text-danger"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Postal Code</label>
                                        <input class="form-control" name="postalcode" type="number" value="{{@$recipient->postal_code}}" id="postalcode" placeholder="Enter Postal Code">
                                        <span id="postalcode-error" class="error text-danger"></span>
                                    </div>



                                    <div class="mb-3">
                                        <label for="example-state-input" class="form-label">State</label>
                                        <select class="form-control" name="state" id="state">
                                                            <option >Select State Name</option>
                                                            <option value="1" <?php echo @$recipient->state == 1 ? 'selected' : ''?>>Maharashtra</option>
                                                            <option value="2" <?php echo @$recipient->state == 2 ? 'selected' : ''?>>Gujarat</option>
                                                            <option value="3" <?php echo @$recipient->state == 3 ? 'selected' : ''?>>Indore</option>
                                        </select>
                                  
                                    </div>     
                                    
                                    <div class="mb-3">
                                        <label for="example-email-input" class="form-label">Birthday</label>
                                        <input class="form-control dob" name="dob" type="text" value="<?php echo date('d-m-Y',strtotime($recipient->date_of_birth))?>" id="dob" placeholder="Select Date of Birth">
                                        <span id="dob-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">

                                   <div class="mb-3">
                                        <label for="example-lname-input" class="form-label">Last Name</label>
                                        <input class="form-control" name="last_name" type="text" value="{{@$recipient->last_name}}" id="last_name" placeholder="Enter Last Name">
                                        <span id="last-name-error" class="error text-danger"></span>
                                    </div>

                                                      
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Phone</label>
                                        <input class="form-control" name="phone" type="text" value="{{@$recipient->phone}}" id="phone" placeholder="Enter 10 Digit Phone number">
                                        <span id="phone-error" class="error text-danger"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-address2-input" class="form-label">Address Line 2</label>
                                        <textarea class="form-control" name="address_line2" type="text" value="" id="address_line2" placeholder="Enter Address Line 2">{{@$recipient->address_line_2}}</textarea>
                                        <span id="address2-error" class="error text-danger"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-country-input" class="form-label">Country</label>
                                        <select class="form-control" name="country" id="country">
                                                            <option >Select Country Name</option>
                                                            <option value="1" <?php echo @$recipient->country == 1 ? 'selected' : ''?>>India</option>
                                                            
                                                            
                                        </select>
                                  
                                    </div> 

                                    <div class="mb-3">
                                        <label for="example-city-input" class="form-label">City</label>
                                        <select class="form-control" name="city" id="city">
                                                            <option >Select City Name</option>
                                                            <option value="1" <?php echo @$recipient->city == 1 ? 'selected' : ''?>>Mumbai</option>
                                                            <option value="2" <?php echo @$recipient->city == 2 ? 'selected' : ''?>>Chennai</option>
                                                            <option value="3" <?php echo @$recipient->city == 3 ? 'selected' : ''?>>Bangalore</option>
                                                            
                                        </select>
                                  
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email-input" class="form-label">Anniversary</label>
                                        <input class="form-control anniversarydatepicker" name="anniversary" type="text" value="<?php echo date('d-m-Y',strtotime($recipient->date_of_anniversary))?>" id="anniversary" placeholder="Select Date of Anniversary">
                                        <span id="anniversary-error" class="error text-danger"></span>
                                    </div>

                                   
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-2">
                                <div>
                                    <a href="{{url('super-admin/recipients')}}" class="btn btn-primary w-md">Cancel</a>
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
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<script>
    $('#form').on('submit', function(e) {
        $('.error').text('');
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);        
        $.ajax({
            type: "post",
            url: "{{ url('super-admin/save-recipient') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = "{{url('super-admin/recipients')}}";
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
                    $('#firstname-error').text(error.errors.first_name[0])
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
                if (error.errors.address_line1) {
                    $('#address1-error').text(error.errors.address_line1[0])
                }
                if (error.errors.address_line2) {
                    $('#address2-error').text(error.errors.address_line2[0])
                }
                if (error.errors.postalcode) {
                    $('#postalcode-error').text(error.errors.postalcode[0])
                }
                
                
                showButtonLoader('btnSubmit', 'Submit','enable');                
            },
        });
    })  

    $('.anniversarydatepicker').datepicker({
        dateFormat: "dd-mm-yy"
    });
    $('.dob').datepicker({
        dateFormat: "dd-mm-yy"
    });

</script>

 
@endsection