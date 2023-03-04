@extends('layouts.app')
@section('title', 'Product Details')
@section('content')
<div class="main-content-wrap sidenav-open d-flex flex-column">
                <div class="main-content">
                    
<div class="breadcrumb">
    <h1>Product Details</h1>
   
</div>
<div class="separator-breadcrumb border-top"></div>    <div class="col-12">


    <section class="ul-product-detail">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ul-product-detail__image">
                                @php

                                $imageUrl = '/assets/images/no-image.jpg';
                                if(!empty($image->image)) 
                                $imageUrl =  getImage($image->image, 'product'); 
                                else
                                $imageUrl = json_decode($product->json_response)->images->base;
                                @endphp
                                <img src="{{ url($imageUrl) }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ul-product-detail__brand-name mb-4">
                                <h5 class="heading">{{$product->name}}</h5>
                            </div>

                            <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                <h3 class="font-weight-700 text-primary mb-0 mr-2">₹{{$product->price}}</h3>
                               
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
                                        <span class="align-middle">{{$product->description}}</span>
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
                            <a href="javascript:history.back()" class="btn btn-primary">Back</a> 
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    
        
                          
    </div>
</div>

    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
</div>
@endsection