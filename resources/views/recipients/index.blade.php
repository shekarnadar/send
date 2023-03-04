@extends('layouts.app1')
@section('title', 'Send Gift')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp

<div class="row m-3">
    <div class="col-sm-6 listing"> All listings</div>
    <div class="col-sm-6 text-end back">
        <a href=""><img src="/assets/images/left-arrow (2).png" alt=""> Back</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="search">
            <span class="fa fa-search"><img src="/assets/images/search.png" alt=""></span>
            <input type="text" id="search" name="search" placeholder="Search term">
        </div>
    </div>
    <div class="col-sm-6 d-flex justify-content-between">

        <button type="button" class="btn1 btn-outline-danger active ">Add Recepients</button>

        <button type="button" class="btn2 btn-outline-danger">Bulk Upload</button>

        <button type="button" class="btn2 btn-outline-danger">Download Sample</button>

    </div>
</div>


<section class="mt-4">


    <div class="container mt-5 px-2">

        <div class="table-responsive">
            <div class="recep">
                Recepient’s Details
            </div>
            <table class="table table-responsive table-borderless">

                <thead>
                    <tr class="bg-light">
                        <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                        <th scope="col" width="20%">First Name <img src="/assets/images/top aerow.png" alt=""></th>
                        <th scope="col" width="20%">Address</th>
                        <th scope="col" width="20%"> Phone</th>
                        <th scope="col" width="20%"> Email</th>
                        <th scope="col" width="20%"> Group Name</th>
                        <th scope="col" class="text-end" width="20%"><span>Status</span></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $value) 
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox" value="{{ $value->id }}"></th>
                        <td> <img src="/assets/images/table.png" alt=""> {{ $value->first_name }}</td>
                        <td>{{ city($value->country)->name }}, {{ $value->postal_code }}</td>


                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ groupsNames($value->recipientGroups) }}</td>
                        <td class="text-end">...</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</section>


<!-- End Page Title -->

 
@endsection