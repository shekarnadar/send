
@extends('layouts.app')
@section('title', 'Add Recipient')
@section('content')
    @php
    $urlPrefix = urlPrefix();
    @endphp

    {{-- @dd($data) --}}
<div class="main-header">
    <div class="logo">
        @php
        $defult =url('assets/images/send-logo.jpeg');
       @endphp
        <a href=""><img src="{{$logo}}" alt="" onerror="this.onerror=null;this.src='{{$defult}}'"></a>
    </div>
</div>
    <div class="main-content-wrap d-flex flex-column sidenav-open" style="margin-top:10px;">
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
                                @if(isset($group_id))
                                <input name="group_id" type="hidden" value="{{ @$group_id }}" >
                                @endif
                                <input name="userid" type="hidden" value="{{ @$userid }}" >
                            <div class="row">
                                
                                    
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-fname-input" class="form-label">First Name<span class="filed_Mendetory" >*<span></label>
                                            <input class="form-control" name="first_name" type="text"
                                                value="" id="first_name"
                                                placeholder="Enter First Name" tabindex="1">
                                            <span id="firstname-error" class="error text-danger"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-lname-input" class="form-label">Last Name<span class="filed_Mendetory" >*<span></label>
                                            <input class="form-control" name="last_name" type="text"
                                                value="{{ @$recipient->last_name }}" id="last_name"
                                                placeholder="Enter Last Name" tabindex="2">
                                            <span id="last-name-error" class="error text-danger"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-mail-input" class="form-label">Email<span class="filed_Mendetory" >*<span></label>
                                            <input class="form-control" name="email" type="text"
                                                value="" id="email" placeholder="Enter Email" tabindex="3">
                                            <span id="email-error" class="error text-danger"></span>
                                        </div>
                                          <div class="col-lg-6 mb-3">
                                            <label for="example-text-input" class="form-label">Phone<span class="filed_Mendetory" >*<span></label>
                                            <input class="form-control" name="phone" type="text"
                                                value="{{ @$recipient->phone }}" id="phone"
                                                placeholder="Enter 10 Digit Phone number" tabindex="4">
                                            <span id="phone-error" class="error text-danger"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-address1-input" class="form-label">Address Line 1</label>
                                            <textarea class="form-control" name="address_line1" type="text" id="address_line1"
                                                placeholder="Enter Address Line 1" tabindex="5"></textarea>
                                            <span id="address1-error" class="error text-danger"></span>
                                        </div>
                                         <div class="col-lg-6 mb-3">
                                            <label for="example-address2-input" class="form-label">Address Line 2</label>
                                            <textarea class="form-control" name="address_line2" type="text" value="" id="address_line2" tabindex="6"
                                                placeholder="Enter Address Line 2" tabindex="6">{{ @$recipient->address_line_2 }}</textarea>
                                            <span id="address2-error" class="error text-danger"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-text-input" class="form-label">Postal Code</label>
                                            <input class="form-control" name="postalcode" type="number"
                                                value="" id="postalcode"
                                                placeholder="Enter Postal Code" tabindex="7">
                                            <span id="postalcode-error" class="error text-danger"></span>
                                        </div>
                                         <div class="col-lg-6 mb-3">
                                            <label for="example-country-input" class="form-label">Country</label>
                                            <select class="form-control" name="country" id="country-dd" tabindex="8">
                                                <option value="">Select Country</option>
                                                @foreach ($country as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        {{-- state --}}
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-state-input" class="form-label">State</label>
                                            <select class="form-control" name="state" id="state-dd" tabindex="9">
                                                <option value="">Select State Name</option>
                                                @foreach ($state as $data)
                                                    <option value="{{ $data->id }}">
                                                        
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-city-input" class="form-label">City</label>
                                            <select class="form-control" name="city" id="city-dd" tabindex="10">
                                                <option value="">Select City Name</option>
                                                @foreach ($city as $data)
                                                    <option value="{{ $data->id }}">
                                                        
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="example-email-input" class="form-label">Birthday</label>
                                            <input class="form-control dob" name="dob" type="text" tabindex="11"
                                                value="{{ !empty($recipient->date_of_birth) ? getFormatedDate($recipient->date_of_birth, 'd-m-Y') : '' }}"
                                                id="dob" placeholder="Select Date of Birth">
                                            <span id="dob-error" class="error text-danger"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="example-email-input" class="form-label">Anniversary</label>
                                            <input class="form-control anniversarydatepicker" name="anniversary" tabindex="12"
                                                type="text" value="<?php echo !empty($recipient->date_of_anniversary) ? date('d-m-Y', strtotime($recipient->date_of_anniversary)) : ''; ?>" id="anniversary"
                                                placeholder="Select Date of Anniversary">
                                            <span id="anniversary-error" class="error text-danger"></span>
                                        </div>


                                         <div class="col-lg-6 mb-3">
                                            <label for="onboarding-emdateail-input" class="form-label">Onboarding Date</label>
                                            <input class="form-control onboarding_date" name="onboarding_date" tabindex="13"
                                                type="text" value="" id="onboarding_date"
                                                placeholder="Select Date of Onboarding">
                                            <span id="onboarding-error" class="error text-danger"></span>
                                        </div>

                                        

                                        
                                    
                                
                               
                                   
                                        
                                      
                                       
                                      
                                        
                                        

                                        

                                    
                            </div>
                            <div class="row justify-content-center mt-5">
                                
                                <div class="col-sm-2">
                                    <div>
                                        <button type="submit" id="btnSubmit"
                                            class="btn btn-primary w-md">Submit</button>
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

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <script>
        function IsEmail(email) {
            var regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            }
            else {
                return true;
            }
        }
        $('#form').on('submit', function(e) {
                $('.error').text('');
                var email = $('#email').val();
                e.preventDefault()
                
                let formValue = new FormData(this);
                if (IsEmail(email) == false) {
                     message('error','Invalid Email');
                    return false;
                }
                showButtonLoader('btnSubmit', 'Submit', 'disable');
                $.ajax({
                    type: "post",
                    url: '{{ url("/add-client-recipient") }}',
                    data: formValue,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('response', response);
                        if (response.success) {
                            message('success', response.message);
                            setTimeout(function() {
                                window.location.href = '{{ url("thanks") }}';
                            }, 2000);
                        } else {
                            message('error', response.message);
                        }
                        showButtonLoader('btnSubmit', 'Submit', 'enable');
                    },
                    error: function(response) {
                        let error = response.responseJSON;
                        if (!error) {
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
                        showButtonLoader('btnSubmit', 'Submit', 'enable');
                    },
                });
                     })

        $('.anniversarydatepicker').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy"
        });
        $('.dob').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy"
        });
         $('.onboarding_date').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy"
        });
        



      

        function redirectToList() {
            window.location.href = '{{ url("thanks") }}';
        }






    </script>


@endsection
