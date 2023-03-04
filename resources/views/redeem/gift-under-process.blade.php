@extends('layouts.redeem')
@section('title', 'Checkout Product')
<div class="main-header"  style="justify-content:center">
    <div class="logo">
         <img src="{{url('assets/images/send-logo.jpeg')}}" alt="">
    </div>
</div>
<div class="main-content-wrap d-flex flex-column " style="margin-top: 0px;">
    <div class="row">
        <div class="col-12">
        <section class="chekout-page">
          <div class="row justify-content-center text-center mt-5">
                <h2>Your gift is under process.</h2>
          </div>
        </section>

        </div>
    </div>
</div>

<link rel="stylesheet" href="{{url('assets/css/plugins/toastr.css')}}">
<script src="{{url('assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('assets/js/plugins/toastr.min.js')}}"></script>
