@extends('layouts.redeem')
@section('title', 'Redeem Product Details')
<div class="main-header">
            <div class="logo">
                <img src="{{url('assets/images/send-logo.jpeg')}}" alt="">
            </div>
</div>
<div class="main-content-wrap d-flex flex-column " style="margin-top: 0px;">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box ">
               <h1 class="mb-sm-0 font-size-18"><center>Product Details</center><br></h1>
           </div>
        </div>
        <div class="col-12">
        <section class="ul-product-detail">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- <div class="ul-product-detail__image">
                                @php
                                $imageUrl = '/uploads/product/no-image.png';
                                if(!empty($image->image)) 
                                $imageUrl =  '/uploads/product/'.$image->image;
                                @endphp
                                <img src="{{ url($imageUrl) }}" alt="">
                            </div> -->
                        </div>
                        <div class="col-lg-6">
                            <div class="ul-product-detail__brand-name mb-4">
                                <h5 class="heading"></h5>
                            </div>

                            <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                <h3 class="font-weight-700 text-primary mb-0 mr-2"></h3>
                               
                            </div>

                            <!-- <div class="ul-product-detail__rating">
                                <ul>
                                    <li></li>
                                </ul>
                            </div> -->
                            <div class="ul-product-detail__features mt-3">
                                <h6 class=" font-weight-700">Description:</h6>
                                <ul class="m-0 p-0">
                                    <li>
                                        <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                        <span class="align-middle"></span>
                                    </li>
                                    <!-- <li>
                                        <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                        <span class="align-middle">2.6GHz Intel Core i5 4th Gen processor</span>
                                    </li>
                                    <li>
                                        <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                        <span class="align-middle">8GB DDR3 RAM</span>
                                    </li>
                                    <li>
                                        <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                        <span class="align-middle">13.3-inch screen, Intel Iris 5100 1.5GB
                                            Graphics</span>
                                    </li> -->
                                </ul>
                            </div>
                            <a href="checkout" class="btn btn-primary m-1">
                                    <i class="i-Full-Cart text-15"> </i>
                                    Checkout</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
    </div>
</div>

