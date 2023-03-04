@extends('layouts.app1')
@section('title', 'Send Gift')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp

 <div class="col-sm-12">
      <img src="{{url('backend/img/dash1.png')}}" class="dash1" alt="">
    </div>
    <br>
    <h1>All listings</h1>
    <nav>
      <div class="row">
        <div class="col-sm-4">
          <!-- <button class="desh_btn"> <a href="#">E-gifts</a></button> -->
          <ul class="nav gap-2">
            <li class="nav-item desh">
              <button class="desh_btn"> <a  class="isEgift" data-gift="0">Physical Gifts</a></button>
            </li>
            <li class="nav-item">
              <a class="nav-link isEgift" data-gift="1">E-gifts</a>
            </li>
        
          </ul>
        </div>
        <div class="col-sm-4">
          <div class="search">
            <span class="fa fa-search"><img src="{{url('backend/img/search.png')}}" alt=""></span>
            <input placeholder="Find Gift" name="searchText" id="searchText">
          </div>

        </div>
        <div class="col-sm-4">
          <ul id="navee" class="nav gap-2">
            <li  class="nav-item vie">
              <a class="nav-link viewAll" href="#">View All</a>
            </li>
            <li  class="nav-item vie">
              <a class="nav-link" href="#"><img src="{{url('backend/img/more.png')}}" alt=""></a>
            </li>
        
          </ul>

        </div>

      </div>



    </nav>
    <section class="mt-4">
      <div class="row">
        <div class="col-sm-12">
          <h5>What's the Occasion?</h5>
        </div>
      </div>
      <ul class="nav gap-2">
        <li id="Nav" class="nav-item">
          <a class="nav-link " aria-current="page" href="#">Any</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link" href="#">Festivals</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link" href="#">Referrals</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link active">Birthday</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link ">Anniversary</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link ">Other Event</a>
        </li>
      </ul>
    </section>
    <section class="mt-4">
      <div class="row">
        <div class="col-sm-12">
          <h5>Select Your Price Range for Gifting :</h5>
        </div>
      </div>
      <ul class="nav  gap-2">
        <li id="Navv" class="nav-item">
          <a class="nav-link active pricelink" aria-current="page" data-min='0' data-max='0'>Any</a>
        </li>
        <li id="Navv" class="nav-item" data-min="500">
          <a class="nav-link pricelink"  data-min="500" data-max="1000">Rs.500 - 1000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link pricelink" href="#" data-min="1000" data-max="2000">Rs.1000 - 2000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link pricelink" data-min="2000" data-max="3000">Rs.2000 - 3000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link pricelink" data-min="3000" data-max="4000">Rs.3000 - 4000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link pricelink" data-min="4000" data-max="5000">Rs.4000 - 5000</a>
        </li>
      </ul>
    </section>

    <!-- End Page Title -->

    <section class="section dashboard mt-3 cardList">
      <!-- vijay -->
      <div class="row">
        @foreach($compproduct as $pro)
          @foreach($pro->product as $value)
          
            <div class="col-sm-4">
              <div class="card p-2" style="width: 18rem;">
                <img src="{{getImage(@$value->productDefaultImage->image, 'product')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$value['name']}} </h5>
                  <p class="card-text">{{$value['description']}}</p>
                  <div class="row">
                    <div class="col-sm-6">
                      <p>Physical Gift</p>
                    </div>
                    <div class="col-sm-6">
                      <p class="pera">Rs.{{$value['price']}} /-</p>
                    </div>
                  </div>
                  <a href="{{ url($urlPrefix.'/add-campaign') }}" id="sendgift" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          @endforeach
        @endforeach

      </div>
      <div class="row">  
        <div class="col-lg-12">
            {!! $compproduct->links() !!}
        </div>
      </div>
    </section>
    <script type="text/javascript">
      let timeoutID = null;
      let max = '';
      let min = '';
      let isEgift = 0;
      let page = 0;
      $('#searchText').keyup(function(e) {
          clearTimeout(timeoutID);
          const value = e.target.value
          page=0;
          if(value.length >= 3){
            timeoutID = setTimeout(() => findProducts(), 200)
          }
      });
      $(".viewAll").click(function(){
        var str = $("#searchText").val('');
        max = '';
        min = '';
        findProducts();
      });
      $(".isEgift").click(function(){
          page = 0;
          isEgift = $(this).data('gift');
          findProducts();
      });
      function findProducts() {
         let str = $("#searchText").val();
          $.ajax({
            url: "{{ url('client-admin/send-gift') }}",
            data: {
              search: str,
              max:max,
              min:min,
              isEgift:isEgift,
              page:page,
            },
            success: function(response) {
              $('.cardList').html('').html(response);
              if ($('.productdiv').children().length == 0){
               $('.cardList').html('').html('<p>No Recored Found</p>');
              }
            }
          });
      }
      $(".pricelink").click(function(){
         max = $(this).data('max');
         min = $(this).data('min');
         timeoutID = setTimeout(() => findProducts(), 200)
      });
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        page=$(this).attr('href').split('page=')[1];
        findProducts();
      });
});      
  
    </script>
@endsection