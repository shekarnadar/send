@extends('layouts.redeem')
@section('title', 'Redeem Products list')

<style>
    .main-header .logo img {
        width: 600px !important;
        height: 60px;
        margin: 0 auto;
        display: block;
    }

    @media screen and (max-width: 750px) {
        iframe {
            max-width: 100% !important;
            width: auto !important;
            height: auto !important;
        }
    }
</style>

<div class="main-header" style="justify-content:center">
    <div class="logo">
        <img src="{{$client_admin_logo}}" alt="">
    </div>
</div>
<div class="product-div main-content-wrap d-flex flex-column">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box ">
                <h1 class="mb-sm-0 font-size-18">
                    <center>{{$camp['name']}}</center><br>
                </h1>
            </div>
            @if(!empty($camp['video']))
            <div class=" mb-5" style="margin: auto;width: 100%;">
                <center>{!! Embed::make($camp['video'])->parseUrl()->getIframe() !!}</center>
            </div>
            @endif

        </div>





        <section class="product-cart">
            <div class="row text-center mb-4">
                <h2> Kindly choose and confirm your address </h2>
                <br />
                <span class="eye-wrapper">
                    <i class="fa fa-arrow-down" style="font-size: 38px;"></i>
                </span>

            </div>
            <div class="row list-grid justify-content-center">
                @foreach($products as $data)
                <div class="list-item  col-md-3 " style="justify-content:center">
                    <div class="card o-hidden mb-4 d-flex flex-column justify-content-start">
                        @if($data->is_egift_campaign == 1)
                        <a href="{{$link}}/{{ $data->e_product_id }}">
                            @else
                            <a href="{{$link}}/{{ $data->product_id }}">
                                @endif
                                <div class="list-thumb d-flex">
                                    @if($data->is_egift_campaign == 1)
                                    <img alt="" src="{{ json_decode($data->eproduct->json_response)->images->base }}" />
                                    @else
                                    <img alt="" src="{{getImage(@$data->product->productDefaultImage->image, 'product')}}"/>
                                    @endif
                                </div>
                            </a>
                            <div class="flex-grow-1 d-bock">
                                <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                    <a href="{{$link}}/{{$data->product_id}}">
                                        <div class="item-title">
                                            @if($data->is_egift_campaign == 1)
                                            {{ $data->eproduct->name }}
                                            @else
                                            {{$data->product->name}}
                                            @endif
                                        </div>
                                    </a>


                                </div>
                            </div>
                    </div>
                </div>
                @endforeach

            </div>
        </section>