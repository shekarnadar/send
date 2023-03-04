@extends('layouts.redeem')
@section('title', 'Redeem Products list')
<div class="main-header">
            <div class="logo">
                <img src="{{url('assets/images/send-logo.jpeg')}}" alt="">
            </div>
</div>
<div class="main-content-wrap d-flex flex-column " style="margin-top: 0px;">
    <div class="row">
        <div class="col-12">
        <div class="page-title-box ">
       <h1 class="mb-sm-0 font-size-18"><center>Chose your Gift</center><br></h1>
        </div>
    </div>
    <div class="col-12">
    <section class="product-cart">
    <div class="row list-grid">

        
        
        @foreach($productsList as $pro)
        <div class="list-item  col-md-3   ">
            <div class="card o-hidden mb-4 d-flex flex-column">
            <a href="{{$link}}/details" >
                <div class="list-thumb d-flex mt-2">
                
                    <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/watch-2.jpg" />

                </div>
            </a>
                <div class="flex-grow-1 d-bock">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                        <a href="{{url('redeem-details')}}" >
                            <div class="item-title">
                            {{$pro->product->name}}
                            </div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                        {{$pro->product->code}}
                        </p>
                        <!-- <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $38.00 <del class="text-secondary">$50.00</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-info">4% off</span>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        
        
        
    </div>
</section>

