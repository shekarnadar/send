@extends('layouts.app')
@section('title', 'Redeemed Details')
@section('content')
@if(!empty($err))
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{$err}}</h4>
            </div>
        </div>
    </div>
</div>
@endif
@if(empty($err))
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Recipent Detail</h4>

                
            </div>
        </div>

        <div class="col-12">
            <div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                            <p class="text-primary mb-1"> Name</p>
                            <span>{{ $recipent['first_name'] .' ' .$recipent['last_name']}}</span>
                    </div>

                    <div class="col-md-4">
                            <p class="text-primary mb-1"> State</p>
                            <span>{{ $client['to_state']}}</span>
                    </div>

                    <div class="col-md-4">
                            <p class="text-primary mb-1">City</p>
                            <span>{{ $client['to_city']}}</span>
                    </div>

                     
                   

                   
                </div>
                <hr>
                <div class="row">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Company Details</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-4">
                                <p class="text-primary mb-1"> Name</p>
                                <span>{{ $clientDetail['name']}}</span>
                    </div>
                    <div class="col-md-4 mb-4">
                            <p class="text-primary mb-1"> Product Name</p>
                            <span>{{ $product['item_name']}}</span>
                    </div>
                    <div class="col-md-4 mb-4">
                            <p class="text-primary mb-1"> Courier</p>
                            <span>{{ $courier_used}}</span>
                    </div>
                </div>

               
                <div class="row">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tracking Details</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($track_arr as $value)
                    <div class="col-md-4">
                            <p class="text-primary mb-1"> Status</p>
                            <span>{{ $value['status_name']}}</span>
                    </div>

                    <div class="col-md-4">
                        <p class="text-primary mb-1">Time</p>
                            <span>{{$value['status_array'][0]['status_time']}}</span>
                           
                    </div>
                    <div class="col-md-4">
                        <p class="text-primary mb-1"> Picker Status</p>
                            <span>{{$value['status_array'][0]['pickrr_status']}}</span>
                           
                    </div>
                    <div class="col-md-4 mt-4 mb-4">
                        <p class="text-primary mb-1"> Status Body</p>
                            <span>{{$value['status_array'][0]['status_body']}}</span>
                           
                    </div>
                    @if($value['status_array'][0]['status_location'])
                    <div class="col-md-4 mt-4 mb-4">
                        <p class="text-primary mb-1">Location</p>
                            <span>{{$value['status_array'][0]['status_location']}}</span>
                           
                    </div>
                    @else
                    <div class="col-md-4 mt-4 mb-4">&nbsp;</div>
                    @endif
                    <div class="col-md-4 mt-4 mb-4">&nbsp;</div>
                    <hr/>
                    @endforeach
                </div>
                
                


            </div>
        </div>
    </div>
</div>
</div>
@endif
  
@endsection
