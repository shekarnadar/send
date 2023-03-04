@extends('layouts.app')
@section('title', "Whatsapp Settings")
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>Whatsapp Settings</h1>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li>Whatsapp Settings</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                    <div class="card-body p-4">
                      <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                       
                      
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">


                                        <label for="example-text-input" class="form-label">Url&nbsp;<a  data-toggle="tooltip" title="WATI_API_ENDPOINT!" class="form-label"><i class="i-Information"></i></a></label>
                                        <input class="form-control" name="url" type="text"  id="url" value="{{(!empty($client['url']))?$client['url']:''}}">
                                        <span id="url_error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Token&nbsp;<a  data-toggle="tooltip" title="This is WATI Access Token. Enter Your Token in the text below without Bearer.Example:'123456'" class="form-label"><i class="i-Information"></i></a></label>
                                        <input class="form-control" name="token" type="text"  id="token" value="{{(!empty($client['token']))?$client['token']:''}}">
                                        <span id="token_error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="row justify-content-center mt-5">
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
</div>

<script>
   // $(document).ready(function(){

 // Add new element
 // $(".add").click(function(){

 //  // Finding total number of elements added
 //  var total_element = $(".element").length;
 
 //  // last <div> with element class id
 //  var lastid = $(".element:last").attr("id");
 //  var split_id = lastid.split("_");
 //  var nextindex = Number(split_id[1]) + 1;

 //  var max = 10;
 //  // Check total number elements
 //  if(total_element < max ){
 //   // Adding new div container after last occurance of element class
 //   $(".element:last").after("<div class='element row mb-3' id='div_"+ nextindex +"'></div>");
 
 //   // Adding element to <div>
 //   $("#div_" + nextindex).append("<div class='col-lg-6'><input type='text' placeholder='Enter Template' id='txt_"+ nextindex +"' class='form-control' name='template_name[]'></div><div class='col-lg-6'><span id='remove_" + nextindex + "' class='remove'>Remove</span></div>");
 
 //  }
 
 // });
 //  $('.content_div').on('click','.remove',function(){
 //   var id = this.id;
 //   var split_id = id.split("_");
 //   var deleteindex = split_id[1];
 //   $("#div_" + deleteindex).remove();

 // }); 
//});
   

    $('#form').on('submit', function(e) {
        e.preventDefault()
        showButtonLoader('btnSubmit', 'Submit','disable');
        let formValue = new FormData(this);        
        $.ajax({
            type: "post",
            url: "{{ url('client-admin/save-whatsapp-setting') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function(){
                        window.location.href = "{{url('client-admin/dashboard')}}";
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
                if (error.errors.template_name) {
                    $('#template_name_error').text(error.errors.template_name[0])
                }
                if (error.errors.broadcast_name) {
                    $('#broadcast_name_error').text(error.errors.broadcast_name[0])
                }                
                if (error.errors.url) {
                    $('#url_error').text(error.errors.url[0])
                }
                if (error.errors.token) {
                    $('#token_error').text(error.errors.token[0])
                }
                
                showButtonLoader('btnSubmit', 'Submit','enable');                
            },
        });
    })  
</script>
@endsection