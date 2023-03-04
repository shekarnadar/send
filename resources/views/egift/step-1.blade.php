@extends('layouts.app')
@section('title', 'Add Campaign')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1>Add Campaign</h1>
            <h1> : Step 1 : Select Price Range</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">

                        <form method="post" id="form" action="{{ url($urlPrefix.'/estep-2') }}">
                            @csrf
                            @if (!empty($user))
                                <input name="id" type="hidden" value="{{ @$user->id }}">
                            @endif
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="col-md-4"> <input class="campaigntype" type="radio" name="campaign_type" value="instant" checked> &nbsp;&nbsp;Instant 
                                            <i class="fa fa-info-circle" aria-hidden="true"
                                            data-toggle="tooltip" data-placement="top" title="If you want to send gifts immediately after approval"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-md-5"><input class="campaigntype" type="radio"name="campaign_type" value="individual"> &nbsp;&nbsp;Individual 

                                            <i class="fa fa-info-circle" aria-hidden="true"
                                            data-toggle="tooltip" data-placement="top" title="If you want to Schedule Birthdays ,Anniversary etc. in mass"></i>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-md-3"><input class="campaigntype" type="radio" name="campaign_type" value="bulk">&nbsp;&nbsp;Bulk
                                            <i class="fa fa-info-circle" aria-hidden="true"
                                            data-toggle="tooltip" data-placement="top" title="If you want to Schedule Gifts in bulk at a later date"></i>
                                                                                        
<!--                                            <span class="fa fa-question ml-2" data-toggle="tooltip" data-placement="top" title="If you want to Schedule Gifts in bulk at a later date">
                                            ?
                                            </span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

<!--                     <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                Avilable:{{$availableBalance}}
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12">
                        <div class="row"> 
                            <div class="col-lg-3">
                                <div>
                                    <input type="hidden" name="product_ids" id="proids">
                                    <div class="mb-3">
                                        <label for="example-name-input" class="form-label">Campaign Name<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control formField" name="name" type="text" value=""
                                            id="name" placeholder="Eg. Diwali Gifting">
                                        <!--onkeyup="validate(this)"-->
                                            <span id="name-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Min.price<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control" name="minprice" type="number" value="" id="minprice"
                                        placeholder="Enter Minimum Price" onkeyup="minPricevalidate(this)">
                                    <span id="first-postal-error" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-3">






                                <div class="mb-3" id="maxpricesection">
                                    <label for="example-text-input" class="form-label">Max.price<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control" name="maxprice" type="number" value="" id="maxprice"
                                        placeholder="Enter Maximum Price" onkeyup="maxPricevalidate(this)">
                                    <span id="first-postal-error" class="error text-danger"></span>
                                </div>
                            </div>

                                 <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Video</label>
                                        <input class="form-control" name="video" type="text" value="" id="video"
                                            placeholder="Enter Embed Video Code">
                                    </div>
                                </div>






                            <div class="col-lg-3">


                                <div class="mb-3" style="display:none" id="selectoccasionsection">
                                    <label for="example-text-input" class="form-label">Select Type<span class="filed_Mendetory" >*<span></label>
                                    <select class="form-control formField" name="event_type" value="selectoccasion"
                                        id="selectoccasion">
                                        <option value="">Select</option>
                                        <option value="anniversary">Anniversary Date</option>
                                        <option value="birthday">Birthday</option>
                                        <option value="date1">Date1</option>
                                        <option value="date2">Date2</option>
                                        <option value="date3">Date3</option>
                                        <!-- <option value="diwali">Diwali</option> -->
                                    </select>
                                    <span id="first-postal-error" class="error text-danger"></span>
                                </div>


                                <div class="col-mb-3" id="startdate" style="display:none">
                                    <label for="example-email-input" class="form-label">Campaign Date<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control startdate formField" name="start_date" type="text"
                                        value="" placeholder="Select start date" readonly>
                                    <span id="anniversary-error" class="error text-danger"></span>
                                </div>

                            </div>


                            <div class="col-lg-3">




                                <div class="col-mb-3" id="enddate" style="display:none">
                                    <label for="example-email-input" class="form-label">End Date<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control enddate formField" name="end_date" type="text"
                                        value="" placeholder="Select end date" readonly>
                                    <span id="anniversary-error" class="error text-danger"></span>
                                </div>
                            </div>
 
                            <div class="col-lg-3" style="display:none" id="beforeday">

                                <div class="col-mb-3">
                                    <label for="example-email-input" class="form-label">Before Days</label>
                                    <input class="form-control formField" name="before_days" type="number"
                                        value="" id="beforedays" placeholder="Select Number Of Days">
                                    <span id="anniversary-error" class="error text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-2">
                                <div>
                                    <a href="" class="btn btn-primary w-md showproducts">Show Products</a>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div>
                                    <button type="submit" class="btn btn-success w-md" disabled="disabled"
                                        id="firstStep">Next Step</button><br><br>

                                    <!-- <button type="submit" id="btnSubmit" class="btn btn-success w-md"></button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>



                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->






        <!-- container-fluid -->


        <div class="breadcrumb">
            <h1 id="serachmsg" style="display:none">Search Result of </h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>


        <section class="product-cart">
            <div class="row list-grid">
                <!-- <div class="list-item col-md-3">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/speaker-1.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Wireless Bluetooth V4.0 Portable Speaker with HD Sound
                                    and Bass
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $32.00 <del class="text-secondary">$54.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-info">20% off</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/speaker-2.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Portable Speaker with HD Sound
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $25.00 <del class="text-secondary">$43.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">Sale</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-2.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Lightweight On-Ear Headphones - Black
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $29.00 <del class="text-secondary">$55.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-info">-40%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/watch-1.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Automatic-self-wind mens Watch 5102PR-001 (Certified
                                    Pre-owned)
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $33.00 <del class="text-secondary">$58.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-info">10% off</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/watch-2.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Automatic-self-wind mens Watch 5102PR-001
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $38.00 <del class="text-secondary">$50.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-info">4% off</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-3.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    On-Ear Headphones - Black
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $38.00 <del class="text-secondary">$54.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-success">$4 off</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-4.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">In-Ear Headphone</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $31.00 <del class="text-secondary">$58.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">$5 off</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-item  col-md-3   ">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/iphone-2.jpg" />
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="">
                                <div class="item-title">
                                    Duis exercitation nostrud anim
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                Gadget
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $22.00 <del class="text-secondary">$44.00</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-red"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3  ">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div> -->
            </div>
        </section>
    </div>
    </div>
    
    <script src="https://use.fontawesome.com/2edfbebfe6.js"></script>
    <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

        // $('#form').on('submit', function(e) {
        //     $('.error').text('');
        //     e.preventDefault()
        //     showButtonLoader('btnSubmit', 'Submit','disable');
        //     $.ajax({
        //         type: "post",
        //         url: "{{ url('client-admin/step-2') }}",
        //         data: {data: $('#form').serialize(), '_token' : "{{ csrf_token() }}"},
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             console.log('response',response);
        //             if (response.success) {
        //                 message('success', response.message);
        //                 setTimeout(function(){
        //                     window.location.href = "{{ url('client-admin/step-2') }}";
        //                 },2000);
        //             } else {
        //                 message('error', response.message);
        //             }
        //             showButtonLoader('btnSubmit', 'Submit','enable');
        //         },
        //         error: function(response) {
        //             let error = response.responseJSON;
        //             if(!error){
        //                 error = JSON.parse(response.responseText);
        //             }
        //             if (error.errors.first_name) {
        //                 $('#first-name-error').text(error.errors.first_name[0])
        //             }
        //             if (error.errors.last_name) {
        //                 $('#last-name-error').text(error.errors.last_name[0])
        //             }
        //             showButtonLoader('btnSubmit', 'Submit','enable');
        //         },
        //     });
        // })

        $('.showproducts').on('click', function(e) {
            e.preventDefault();
            let minPrice = $('#minprice').val();
            let maxPrice = $('#maxprice').val();
            console.log(minPrice);
            $.ajax({
                url: "{{ url('client-admin/show-eproducts-list') }}",
                data: {
                    minPrice: minPrice,
                    maxPrice: maxPrice
                },
                success: function(response) {
                    if (response) {
                        $('.list-grid').html('').html(response);
                        $('#serachmsg').css('display', 'block');
                        $('#serachmsg').html('').html('Search results');
                    } else {
                        $('.list-grid').html('');
                        $('#serachmsg').css('display', 'block');
                        $('#serachmsg').html('').html('No results found');
                    }

                }
            });
        })

        // Add Product
        var proArr = [];

        function addProduct(pro, ds) {
            var name = $('#name').val();
            if ($(ds).is(':checked')) {
                proArr.push(pro);
                $('#proids').val(proArr.join());
            } else {
                const index = proArr.indexOf(pro);
                if (index > -1) {
                    proArr.splice(index, 1);
                    $('#proids').val(proArr.join());
                }
            }

            let campaign_type = $('input[name="campaign_type"]:checked').val();
            if (campaign_type == 'instant') {
                if ($('#proids').val() != '' && name != '') {
                    $('#firstStep').prop('disabled', false);
                } else {
                    $('#firstStep').prop('disabled', true);
                }
            } else if (campaign_type == 'individual') {
                let selectoccasion = $('#selectoccasion').val();
                let end_date = $('input[name="end_date"]').val();
                // alert(selectoccasion+end_date);
                if ($('#proids').val() != '' && name != '' && $('#beforedays').val() != '' && end_date != '' &&
                    selectoccasion != '') {
                    $('#firstStep').prop('disabled', false);
                } else {
                    $('#firstStep').prop('disabled', true);
                }
            } else {

                let start_date = $('input[name="start_date"]').val();
                //alert(selectoccasion+end_date);
                if ($('#proids').val() != '' && name != '' && start_date != '') {
                    $('#firstStep').prop('disabled', false);
                } else {
                    $('#firstStep').prop('disabled', true);
                }
            }
        }

        // $('form#form').on('submit',function(event) {
        //     event.preventDefault();
        //     var name = $('#name').val();
        //     if($('#proids').val() != '' && name !='') {
        //         $('#firstStep').prop('disabled',false);
        //     } else {
        //         $('#firstStep').prop('disabled',true);
        //     }
        // });

        // validate forms
        $('.formField').on('keyup change', function() {
            //alert($(this).val());
            let campaign_type = $('input[name="campaign_type"]:checked').val();
            let campaign_name = $('#name').val();
            // if(campaign_name == '') {
            //     $('#firstStep').prop('disabled',true);
            // }
            if (campaign_type == 'instant') {
                if (campaign_name == '' || $('#proids').val() == '') {
                    $('#firstStep').prop('disabled', true);
                } else {
                    $('#firstStep').prop('disabled', false);
                }
            } else if (campaign_type == 'individual') {
                let end_date = $('input[name="end_date"]').val();
                let selectoccasion = $('#selectoccasion').val();
                if (campaign_name == '' || $('#proids').val() == '' || selectoccasion == '' || $('#beforedays')
                    .val() == '' || end_date == '') {
                    $('#firstStep').prop('disabled', true);
                } else {
                    $('#firstStep').prop('disabled', false);
                }
            } else {
                let selectoccasion = $('#selectoccasion').val();
                let start_date = $('input[name="start_date"]').val();
                //    alert(selectoccasion+start_date);
                if ($('#proids').val() != '' && campaign_name != '' && start_date != '') {
                    $('#firstStep').prop('disabled', false);
                } else {
                    $('#firstStep').prop('disabled', true);
                }
            }
        })

        function validate(ds) {
            var name = $(ds).val();
            if ($('#proids').val() != '' && name != '') {
                $('#firstStep').prop('disabled', false);
            } else {
                $('#firstStep').prop('disabled', true);
            }
        }

        function minPricevalidate(ds) {
            var minprice = $(ds).val();
            var maxprice = $('#maxprice').val();
            if ($('#proids').val() != '' && minprice != '' && maxprice != '') {
                $('#firstStep').prop('disabled', false);
            } else {
                $('#firstStep').prop('disabled', true);
            }
        }


        function maxPricevalidate(ds) {
            var maxprice = $(ds).val();
            var minprice = $('#minprice').val();
            if ($('#proids').val() != '' && minprice != '' && maxprice != '') {
                $('#firstStep').prop('disabled', false);
            } else {
                $('#firstStep').prop('disabled', true);
            }
        }

        $('.startdate').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-80:+00",
            dateFormat: "dd-mm-yy",
            minDate: 0
        });
        $('.enddate').datepicker({
            changeMonth: true,
            changeYear: true,
            //yearRange: "-80:+00",
            dateFormat: "dd-mm-yy",
            minDate: 0
        });

        $('#selectoccasion').on('change', function() {
            let occ = $(this).val();
            if (occ != '') {
                if (occ == 'anniversary' || occ == 'birthday') {
                    $('#enddate').css('display', 'block');
                    $('#beforedays').css('display', 'block');
                    $('#startdate').css('display', 'none');
                } //else {
                //     $('#enddate').css('display','none');
                //     $('#beforedays').css('display','none');
                // }
                let campaign_name = $('#name').val();
                let end_date = $('input[name="end_date"]').val();
                let selectoccasion = $('#selectoccasion').val();
                if (campaign_name == '' || $('#proids').val() == '' || selectoccasion == '' || $('#beforedays')
                    .val() == '' || end_date == '') {
                    $('#firstStep').prop('disabled', true);
                } else {
                    $('#firstStep').prop('disabled', false);
                } 

            } else {
                $('#enddate').css('display', 'block');
                $('#beforedays').css('display', 'block');
                //$('#beforedays').css('display','none');
                //$('#enddate').css('display','block');
                //$('#startdate').css('display','block');
            }
        })

        // show hide form UI
        $('.campaigntype').on('change', function() {
            let campaignOption = $(this).val();
            let campaign_name = $('#name').val();
            if (campaignOption == 'individual') {
                $('#beforeday').css('display', 'block');
                $('#enddate').css('display', 'block');
                $('#startdate').css('display', 'none');
                $('#selectoccasionsection').css('display', 'block');
                $('.startdate').datepicker('destroy').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0
                });
                let selectoccasion = $('#selectoccasion').val();
                //alert(selectoccasion);
                if ($('#beforedays').val() == '' || $('#enddate').val() == '' || campaign_name == '' ||
                    selectoccasion == '' || $('#proids').val() == '') {
                    $('#firstStep').prop('disabled', true);
                } else {
                    $('#firstStep').prop('disabled', false);
                }
            } else if (campaignOption == 'instant') {
                $('#beforeday').css('display', 'none');
                $('#enddate').css('display', 'none');
                $('#startdate').css('display', 'none');
                $('#selectoccasionsection').css('display', 'none');
                //let campaign_name = $('#name').val();
                if (campaign_name == '' || $('#proids').val() == '') {
                    $('#firstStep').prop('disabled', true);
                } else {
                    $('#firstStep').prop('disabled', false);
                }

            } else {
                $('#enddate').css('display', 'none');
                $('#selectoccasionsection').css('display', 'none');
                $('#beforeday').css('display', 'none');
                $('#startdate').css('display', 'block');
                $('#beforedays').val('');

                $('.startdate').datepicker('destroy').datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: "7d"
                });
                let start_date = $('input[name="start_date"]').val();
                //alert(selectoccasion+end_date);
                if ($('#proids').val() != '' && name != '' && start_date != '') {
                    $('#firstStep').prop('disabled', false);
                } else {
                    $('#firstStep').prop('disabled', true);
                }

            }
        });
    </script>


@endsection
