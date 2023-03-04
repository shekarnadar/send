@extends('layouts.app')
@section('title', 'Admin Details')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Client  Details</h4>

        <div class="page-title-right">
        <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{url('super-admin/clients')}}">Clients</a></li>
        <li class="breadcrumb-item active">Client  Details</li>
        </ol>
        </div>

        </div>
    </div>
    <div class="col-12">


    <div >
                           
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Company Name</p>
                                        <span>{{$user->name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Address Line 1</p>
                                        <span>{{$user->address_line_1}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Address Line 2</p>
                                        <span>{{@$user->address_line_2}}</span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> Country</p>
                                        <span>{{$user->country}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> State</p>
                                        <span>{{@$user->state}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Flag text-16 mr-1"></i> City</p>
                                        <span>{{@$user->city}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> GSTin</p>
                                        <span>{{$user->gstin}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Pancard</p>
                                        <span>{{@$user->pan}}</span>
                                    </div>
                                   
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Postal Code</p>
                                        <span>{{$user->postal_code}}</span>
                                    </div>
                                </div>
                            </div>
</div>

    
        
                           <!-- <div class="profile-content mt-4">
                               <div class="row align-items-end">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-end mt-3 mt-sm-0">
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1">{{$user->name}}</h5>
                                                    <p class="text-muted font-size-13 mb-2 pb-2">{{$user->postal_code}}</p>
                                                    <p class="text-muted font-size-13 mb-2 pb-2">{{$user->gstin}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           </div> -->
    </div>
</div>

</div>
@endsection