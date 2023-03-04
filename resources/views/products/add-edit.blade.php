@extends('layouts.app')
@section('title', 'Add Products')
@section('content')
@php
   $urlPrefix = urlPrefix();
@endphp

<link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/quill.bubble.css">
    <link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/quill.snow.css">
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>{{$title}} Prelisted Products</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                    <div class="card-body p-4">

                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($product))
                            <input name="id" type="hidden" value="{{@$product->id}}">
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Product category <span class="filed_Mendetory" >*<span></label>
                                        <select class="form-control" name="category" id="category">
                                            <option >Select Category Name</option>
                                            <?php foreach ($categories as $category) {?>
                                            <option value="<?php echo $category->id?>" <?php echo @$product->category_id == $category->id ? 'selected' :''?>><?php echo $category->name?></option>
                                            <?php foreach($category->children as $child) {?>
                                                <option value="<?php echo $child->id?>" <?php echo @$product->category_id == $child->id ? 'selected' :''?>><?php echo '--'.$child->name?></option>
                                            <?php foreach($child->children as $subchild) {?>
                                                <option value="<?php echo $subchild->id?>" <?php echo @$product->category_id == $subchild->id ? 'selected' :''?>><?php echo '----'.$subchild->name?></option>
                                            <?php }
                                            }
                                            }?>
                                        </select>
                                        <span id="category-error" class="error text-danger"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-email-input" class="form-label">Product Name<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="pname" type="text" value="{{@$product->name}}" id="pname" placeholder="Enter Product name">
                                        <span id="pname-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email-input" class="form-label">Product Visibility</label>
                                        <select class="form-control" multiple name="product_visibility[]" id="product_visibility">
                                        <option>Select Company</option>
                                            @foreach($clients as $client)
                                            @if(in_array($client['id'],$clientProduct))
                                            <option value="{{ $client['id'] }}" selected>{{ $client['name'] }}</option>
                                            @else
                                            <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Price<span class="filed_Mendetory" >*<span></label>
                                        <input class="form-control" name="pprice" type="number" value="{{@$product->price}}" id="price" placeholder="Enter Price">
                                        <span id="pprice-error" class="error text-danger"></span>
                                    </div>

                                    <div class="mb-12">
                                    <div >
                                    </div>
                                        <label for="example-month-input" class="form-label">Description<span class="filed_Mendetory" >*<span></label>
                                        <textarea class="form-control" name="description" type="text" placeholder="Enter Product Description" rows="5" cols="4">{{@$product->description}}</textarea>
                                        <span id="description-error" class="error text-danger"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Product Image</label>
                                        <input class="form-control" name="image" type="file" value="" id="image" >
                                        <span id="address_line_2-error" class="error text-danger"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-2">
                                <div>
                                    <a href='{{ url("$urlPrefix/products") }}' class="btn btn-primary w-md">Cancel</a>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div>
                                    <button type="submit" id="btnSubmit" class="btn btn-success w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<script>
    $('#form').on('submit', function(e) {
        $('.error').text('');
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);
        $.ajax({
            type: "post",
            url: '{{ url("$urlPrefix/save-product") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href ='{{ url("$urlPrefix/products") }}';
                    },2000);
                } else {
                    message('error', response.message);
                }
                showButtonLoader('btnSubmit', 'Submit','enable');
            },
            error: function(response) {
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }
                if (error.errors.pprice) {
                    $('#pprice-error').text(error.errors.pprice[0])
                }
                if (error.errors.pname) {
                    $('#pname-error').text(error.errors.pname[0])
                }
                if (error.errors.description) {
                    $('#description-error').text(error.errors.description[0])
                }
                if (error.errors.category) {
                    $('#category-error').text(error.errors.category[0])
                }

                showButtonLoader('btnSubmit', 'Submit','enable');
            },
        });
    })
</script>
<script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/tagging.min.js"></script>
 <script src="http://gull-html-laravel.ui-lib.com/assets/js/tagging.script.js"></script>

 <script src="http://gull-html-laravel.ui-lib.com/assets/js/common-bundle-script.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
 <script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/quill.min.js"></script>
 <script src="http://gull-html-laravel.ui-lib.com/assets/js/script.js"></script>
   <script src="http://gull-html-laravel.ui-lib.com/assets/js/sidebar.large.script.js"></script>
  <script src="http://gull-html-laravel.ui-lib.com/assets/js/customizer.script.js"></script>
   <script src="http://gull-html-laravel.ui-lib.com/assets/js/quill.script.js"></script>

@endsection
