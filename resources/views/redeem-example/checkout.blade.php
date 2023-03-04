@extends('layouts.redeem')
@section('title', 'Checkout Product')
<div class="main-header">
            <div class="logo">
                <img src="{{url('assets/images/send-logo.jpeg')}}" alt="">
            </div>
</div>
<div class="main-content-wrap d-flex flex-column " style="margin-top: 0px;">
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
                      <img class="profile-picture avatar-sm mb-2 img-fluid" src="http://gull-html-laravel.ui-lib.com/assets/images/products/watch-2.jpg"
                        alt="" />
                      
                    </td>
                    <td>Watch</td>
                    
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
            <form action="">
              <div class="card-body">
                <div class="card-title">Delivery Address</div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputtext11" class="ul-form__label">First Name:</label>
                    <input type="text" class="form-control" id="inputtext11" />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail12" class="ul-form__label">Last Name:</label>
                    <input type="text" class="form-control" id="inputEmail12" />
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputtext14" class="ul-form__label">Email Id</label>
                    <input type="email" class="form-control" id="inputtext14" />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail15" class="ul-form__label">Mobile number</label>
                    <div class="input-right-icon">
                      <input type="number" class="form-control" id="inputEmail15" />
                    </div>
                  </div>
                </div>


                

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputtext14" class="ul-form__label">City:</label>
                    <input type="text" class="form-control" id="inputtext14" />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail15" class="ul-form__label">State:</label>
                    <select class="form-control" id="sel1">
                      <option>Select</option>
                      <option>California</option>
                      <option>Ukraine</option>
                      <option>UK</option>
                      <option>Finland</option>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputEmail16" class="ul-form__label">Country:</label>
                    <select class="form-control" id="sel1">
                      <option>Select</option>
                      <option>USA</option>
                      <option>UK</option>
                      <option>Finland</option>
                    </select>
                  </div>
                </div>
              

              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputtext14" class="ul-form__label">Address</label>
                    <textarea type="text" class="form-control" id="inputtext14" ></textarea>
                  </div>
                  
                </div>
                </div>

              
            <div class="row text-right">
              <div class="col-lg-12 ">
                <button type="button" class="btn btn-success m-1">
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

