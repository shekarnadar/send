@extends('layouts.redeem')
@section('title', 'Redeem Product Details')
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
                <!-- <img src='{{url("uploads/product/$proImg")}}' alt=""> -->
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
                                <h5 class="heading">{{$productDetails->name}}</h5>
                            </div>

                            <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                <h3 class="font-weight-700 text-primary mb-0 mr-2"></h3>
                               
                            </div>

                           
                            <div class="ul-product-detail__features mt-3">
                                <h6 class=" font-weight-700">Description:</h6>
                                <ul class="m-0 p-0">
                                    <li>
                                        <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                        <span class="align-middle">{{$productDetails->description}}</span>
                                    </li>
                                </ul>
                            </div>
                            <a href='{{url("redeem-checkout/$link/$productDetails->id")}}' class="btn btn-primary m-1">
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

