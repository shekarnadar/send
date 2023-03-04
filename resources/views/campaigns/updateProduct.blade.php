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
        <div class="separator-b     readcrumb border-top"></div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">

                        <form method="post" id="form" action="{{ url($urlPrefix.'/saveCampagianProduct') }}">
                            @csrf
                           <input type="hidden" name="id" value="{{$id}}" id="camp_id">
                           <input type="hidden" name="product_ids" id="proids">
                           <input name="checkedData" value="{{implode(',',$camp_ids)}}" type="hidden" id="checkedData">
                           
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Min.price<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control" name="minprice" type="number" value="" id="minprice"
                                        placeholder="Enter Minimum Price">
                                    <span id="first-postal-error" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3" id="maxpricesection">
                                    <label for="example-text-input" class="form-label">Max.price<span class="filed_Mendetory" >*<span></label>
                                    <input class="form-control" name="maxprice" type="number" value="" id="maxprice"
                                        placeholder="Enter Maximum Price">
                                    <span id="first-postal-error" class="error text-danger"></span>
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
                                        id="firstStep">Save</button><br><br>

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
               
            </div>
        </section>
    </div>
    </div>

    <script>
        var proArr = [];
        var checkval = $("#checkedData").val();
        strx   = checkval.split(',');
        proArr = proArr.concat(strx);
        $('#proids').val(proArr.join());
        $('.showproducts').on('click', function(e) {
            e.preventDefault();
            if (proArr.length > 0) {
                    $('#firstStep').prop('disabled', false);
            } else {
                $('#firstStep').prop('disabled', true);
            }
            let minPrice = $('#minprice').val();
            let maxPrice = $('#maxprice').val();
            let camp_id = $("#camp_id").val();
             
            $.ajax({
                url: '{{ url("$urlPrefix/show-products-update-list") }}',
                data: {
                    camp_id: camp_id,
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
       

        function addProduct(pro, ds) {
            var name = $('#name').val();
            if ($(ds).is(':checked')) {
                 $('#firstStep').prop('disabled', false);
                proArr.push(pro);
 
                $('#proids').val(proArr.join());
            } else {
                const index = proArr.indexOf(pro);
                proArr.pop(pro);
                    $('#proids').val(proArr.join());
                if (index > -1) {
                    
                }
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

        
        
        
    </script>


@endsection
