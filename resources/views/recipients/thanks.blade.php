@extends('layouts.app')
@section('title', 'Checkout Product')
<div class="main-header">
            <div class="logo">
                 <img src="{{url('assets/images/send-logo.jpeg')}}" alt="">
            </div>
</div>
<div class="main-content-wrap d-flex flex-column " style="margin-top: 0px;">
    <div class="row">
        <div class="col-12">
        <section class="chekout-page">
          <div class="row justify-content-center">
            <!-- <div class="col-lg-4 mb-4"> -->
              <div class="card">
                <div class="card-body">
                    <h3>Thank You! recipent has been created successfully.</h3>
                    <br>
                    <a href="{{url('/')}}">Back to home</a>
                </div>
              </div>
            <!-- </div> -->
          </div>
        </section>

        </div>
    </div>
</div>

