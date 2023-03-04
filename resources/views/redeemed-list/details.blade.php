@extends('layouts.app')
@section('title', 'Redeemed Details')
@section('content')
 
@php
$urlPrefix = urlPrefix();
$breadcrumHomeAction = $urlPrefix . '/redeemed';
@endphp

<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Recipient Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url($breadcrumHomeAction) }}">Redeemed</a></li>
                        {{-- <li class="breadcrumb-item active">Campaign Details</li> --}}
                    </ol>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div>
                <hr>

                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Recipient Name</p>
                            <span>{{ $redeemedDetail['recipientDetails']['first_name'] .' '. $redeemedDetail['recipientDetails']['last_name'] }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Recipient Email</p>
                            <span>{{ $redeemedDetail['recipientDetails']['email'] }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Recipient Phone</p>
                            <span>{{ $redeemedDetail['recipientDetails']['phone'] }}</span>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Recipient Address</p>
                            <span>{{ $redeemedDetail['recipientDetails']['address_line_1'].' '.$redeemedDetail['recipientDetails']['address_line_2'] }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Recipient PinCode</p>
                            <span>{{ $redeemedDetail['recipientDetails']['postal_code'] }}</span>
                        </div>

                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Approval Status</p>
                            <span>@if($redeemedDetail->approval_status == 0){{ 'Pending'  }} @elseif($redeemedDetail->approval_status == 1){{ 'Dispatch'  }} @else  {{ 'Rejected'  }} @endif </span>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product Details</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Product Name</p>
                            <span>{{ $redeemedDetail['productDetails']['name'] }}</span>
                        </div>

                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Product Description</p>
                            <span>{{ $redeemedDetail['productDetails']['description'] }}</span>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Product Price</p>
                            <span>{{ $redeemedDetail['productDetails']['price'] }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Product Code</p>
                            <span>{{ $redeemedDetail['productDetails']['code']}}</span>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Product Image</p>
                            <div class="ul-product-detail__image">
                                @php
                                $imageUrl = '/assets/images/no-image.jpg';
                                if(!empty($image->image)) 
                                $imageUrl =  getImage($image->image, 'product');
                                @endphp
                                <img src="{{ url($imageUrl) }}" alt="">
                            </div>
                        </div>
                    </div>

                    @if(@$redeemedDetail['clientDetails']['client'])
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Client Details</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Client Name</p>
                                <span>{{ @$redeemedDetail['clientDetails']['client']['name'] }}</span>
                            </div>
    
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Client Pan</p>
                                <span>{{ @$redeemedDetail['clientDetails']['client']['pan'] }}</span>
                            </div>
                        </div>
    
                        <div class="col-md-4 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Client GSTIN</p>
                                <span>{{ @$redeemedDetail['clientDetails']['client']['gstin'] }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Client Postal Code</p>
                                <span>{{ @$redeemedDetail['clientDetails']['client']['postal_code'] }}</span>
                            </div>
                        </div>
                </div>
                @endif

{{-- 
                <div class="separator-breadcrumb border-top"></div>
                <!-- end of row-->
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h3> Campaign Recipients</h3>
                                <div class="table-responsive">
                                    <table id="tablerecipient" class="table table-bordered dt-responsive  nowrap w-100">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h3> Campaign Products</h3>
                                <div class="table-responsive">
                                    <table id="tableproducts" class="table table-bordered dt-responsive  nowrap w-100">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
</div>
  
@endsection
