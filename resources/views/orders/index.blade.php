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
    <div class="col-sm-12 track p-3">
        <p><img src="/assets/images/track.png" alt=""> Track Status</p>
        <div class="w-50 input-group">
            <input type="text" class="form-control user" placeholder="Tracking ID" id="pickrr-tracking-input" aria-label="Recipient's username" aria-describedby="button-addon2">

        </div>
    </div>
</div>


<section class="mt-4">
    <div class="row">
        <div class="col-sm-3 d-flex">

            <div class="bart1">
                <p>Gift Redeemed</p>
                <span>{{ $totalGiftRedeemedCount }}</span>
            </div>
            <div class="bart2">
                <div class="circles-small">
                    <div class="circle-small">
                        <div class="text"><img src="/assets/images/green.png" alt=""></div>
                        <svg>
                            <circle class="bg" cx="40" cy="40" r="37"></circle>
                            <circle class="progress one" cx="40" cy="40" r="37"></circle>
                        </svg>
                    </div>
                </div>

            </div>
            <div class="col-sm-3 d-flex">

                <div class="bart1">
                    <p>Gift Redeemed</p>
                    <span>{{ $totalGiftRedeemedCount }}</span>
                </div>
                <div class="bart2">
                    <div class="circles-small">
                        <div class="circle-small">
                            <div class="text"><img src="/assets/images/blue.png" alt=""></div>
                            <svg>
                                <circle class="bg" cx="40" cy="40" r="37"></circle>
                                <circle class="progress two" cx="40" cy="40" r="37"></circle>
                            </svg>
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 d-flex">

                    <div class="bart1">
                        <p>Gift Redeemed</p>
                        <span>{{ $totalGiftRedeemedCount }}</span>
                    </div>
                    <div class="bart2">
                        <div class="circles-small">
                            <div class="circle-small">
                                <div class="text"><img src="/assets/images/yellow.png" alt=""></div>
                                <svg>
                                    <circle class="bg" cx="40" cy="40" r="37"></circle>
                                    <circle class="progress three" cx="40" cy="40" r="37"></circle>
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3 bart1">
                        <p>Gift Redeemed</p>
                        <span>{{ $totalGiftRedeemedCount }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5 px-2">

            <div class="table-responsive">
                <table class="table table-responsive table-borderless">

                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col" width="20%">Campaign Name <img src="/assets/images/top aerow.png" alt=""></th>
                            <th scope="col" width="20%">Recepient Name</th>
                            <th scope="col" width="20%">Tracking ID</th>
                            <th scope="col" width="20%"> Address</th>
                            <th scope="col" width="20%"><span>Status</span></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $value)
                        <tr>
                            <th scope="row"><input class="form-check-input" type="checkbox" value="{{ $value->id }}"></th>
                            <td><img src="/assets/images/table.png" alt=""> {{ $value->recipientReedme->campaignDetails->name }}</td>
                            <td>{{ $value->recipientReedme->recipientDetails->first_name }} {{ $value->recipientReedme->recipientDetails->last_name }}</td>
                            <td>{{ $value->tracking_id }}</td>
                            <td>Indore,MP</td>
                            <td class="text-end"><button type="button" class="btn btn-warning">{{ $value->recipientReedme->pickrr_order_status }}</button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>

</section>


<script>
    var input = document.getElementById("pickrr-tracking-input");

    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            var id = $("#pickrr-tracking-input").val();
            window.open('trackorder/' + id, '_blank');
        }
    });
</script>

<!-- End Page -->
@endsection