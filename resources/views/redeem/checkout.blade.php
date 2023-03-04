@extends('layouts.redeem')
@section('title', 'Checkout Product')
<style>
  .main-header .logo img{
    width: 60px; 
    height: 60px;
    margin: 0 auto;
    display: block;
  }
</style>
<div class="main-header"  style="justify-content:center">
    <div class="logo">
        <img src="{{$client_admin_logo}}" alt="">
    </div>
</div>
<div class="main-content-wrap d-flex flex-column" style="margin-top: 0px;">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box ">
               <h1 class="mb-sm-0 font-size-18"><center>Product Checkout</center><br></h1>
           </div>
        </div>
        <div class="col-12">
      
        <section class="chekout-page"> 
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="card">
                <div class="card-body">
                  
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Image</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="">
                          <td scope="row">
                            <img class="profile-picture avatar-sm mb-2 img-fluid" src="{{getImage(@$productDetails->productDefaultImage->image, 'product')}}" onerror="this.onerror=null;this.src={{url('uploads/product/no-image.png')}};"/>
                          </td>
                          <td>{{$productDetails->name}}</td>
                          
                          <td>1</td>
                          
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                    <form class="mt-4 pt-2" id="form" method="POST" action="javascript:void(0)">
                    @csrf

                    <input type="hidden" name="recipient_id" value="{{$campaignRecipient->recipient_id}}">
                    <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                    <input type="hidden" name="link" value="{{$link}}">
                    <input type="hidden" name="campaign_recipient_id" value="{{$campaignRecipient->id}}">
                    <input type="hidden" name="postal_code" value="{{$recipient->postal_code}}">

                    <div class="card-body">
                      <div class="card-title">Delivery Address</div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputtext11" class="ul-form__label">First Name:</label>
                          <input type="text" class="form-control" id="first-name" name="first_name" value="{{$recipient->first_name}}" />
                           <div id="first-name-error" class="error text-danger mt-2"></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail12" class="ul-form__label">Last Name:</label>
                          <input type="text" class="form-control" id="last-name" name="last_name" value="{{$recipient->last_name}}"/>
                           <div id="last-name-error" class="error text-danger mt-2"></div>
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputtext14" class="ul-form__label">Email Id</label>
                          <input type="email" class="form-control" id="email-name" name="email" value="{{$recipient->email}}"/>
                           <div id="email-error" class="error text-danger mt-2"></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail15" class="ul-form__label">Phone number</label>
                          <div class="input-right-icon">
                            <input type="number" class="form-control" id="phone" name="phone" value="{{$recipient->phone}}"/>
                            <div id="phone-error" class="error text-danger mt-2"></div>
                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                       
                        

                        <div class="form-group col-md-4">
                          <label for="inputEmail16" class="ul-form__label">Country:</label>
                          <select class="form-control" id="country" name="country">
                              <option value="">Select</option>
                              @foreach($country as $data)
                                <option value="{{$data->id}}" selected>{{$data->name}}</option>
                              @endforeach
                          </select>
                           <div id="country-error" class="error text-danger mt-2"></div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputEmail15" class="ul-form__label">State:</label>
                          <select class="form-control" id="state-dd" name="state">
                              <option value="">Select</option>
                              @foreach($state as $data)
                                <option value="{{$data->id}}" {{@$recipient->state ==  $data->id ? 'selected' : '' }}>{{$data->name}}</option>
                              @endforeach
                          </select>
                           <div id="state-error" class="error text-danger mt-2"></div>
                        </div>

                         <div class="form-group col-md-4">
                            <label for="inputtext14" class="ul-form__label">City:</label>
                            <!-- <input type="text" class="form-control" id="inputtext14" /> -->

                             <select class="form-control" id="city-dd" name="city">
                                <option value="">Select</option>
                                @foreach($city as $data)
                                  <option value="{{$data->id}}" {{@$recipient->city ==  $data->id ? 'selected' : '' }}>{{$data->name}}</option>
                                @endforeach
                              </select>
                             <div id="city-error" class="error text-danger mt-2"></div>
                         </div>
                      </div>

                      <div class="form-row">
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Postal Code</label>
                            <input class="form-control" name="postal_code" type="text"
                                value="{{ @$recipient->postal_code }}" id="postalcode"
                                placeholder="Enter Postal Code">
                            <span id="postalcode-error" class="error text-danger"></span>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputtext14" class="ul-form__label">Address</label>
                          <textarea type="text" class="form-control" id="address" name="address">{{@$recipient->address_line_1 ." ".@$recipient->address_line_2}}</textarea>
                           <div id="address-error" class="error text-danger mt-2"></div>                          
                        </div>
                      </div>
                    </div>
                    
                    <div class="row text-right">
                      <div class="col-lg-12 ">
                        <button type="button" id="btnSubmit" class="btn btn-success m-1">
                          Submit
                        </button>
                      </div>
                    </div>
                
                  </form>
                </div>
              </div>

            </div>
          </div>
        </section>

        </div>
    </div>
</div>

<link rel="stylesheet" href="{{url('assets/css/plugins/toastr.css')}}">
<script src="{{url('assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('assets/js/plugins/toastr.min.js')}}"></script>

<script>
    $(document).on('click', '#btnSubmit', function (e) {
        $('.error').text('');
        e.preventDefault();
        showButtonLoader('btnSubmit', 'Submit','disable');
        $.ajax({
            url: "{{ url('save-redeem-checkout') }}",
            data: $('#form').serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function () {
                       // window.location = "{{ url('redeem',$link) }}";
                        window.location = "{{ url('redeem-thankyou') }}";
                    }, 1000);
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
                if (error.errors.email) {
                    $('#email-error').text(error.errors.email[0])
                }
                if (error.errors.phone) {
                    $('#phone-error').text(error.errors.phone[0])
                }
                if (error.errors.address) {
                    $('#address-error').text(error.errors.address[0])
                }
                if (error.errors.city) {
                    $('#city-error').text(error.errors.city[0])
                }
                if (error.errors.state) {
                    $('#state-error').text(error.errors.state[0])
                }
                if (error.errors.country) {
                    $('#country-error').text(error.errors.country[0])
                }          
                if(error.errors.postal_code){
                  $('#postalcode-error').text(error.errors.postal_code[0])
                }      
                showButtonLoader('btnSubmit', 'Submit','enable');                
            },
        });
    });     
</script>
