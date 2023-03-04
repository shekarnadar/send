@extends('layouts.app')
@section('title', 'Client Details')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="row">
        <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Admin Details</h4>

        <div class="page-title-right">
        <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{url('super-admin/clients')}}">Clients</a></li>
        <li class="breadcrumb-item active">Admin Details</li>
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
                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Full Name</p>
                <span>{{$user->first_name}} {{$user->last_name}}</span>
            </div>
            <div class="mb-4">
                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Email</p>
                <span>{{$user->email}}</span>
            </div>
            <div class="mb-4">
                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Phone</p>
                <span>{{@$user->phone}}</span>
            </div>
            
        </div>
    </div>
</div>
@endsection