@extends('layouts.app')
@section('title', 'Send Options')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
    <link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/quill.bubble.css">
    <link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/quill.snow.css">
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text/html", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text/html");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
    <style>
        input[type="checkbox"][id^="checkEmail"] {
            display: none;
        }

        input[type="checkbox"][id^="checkWhatsApp"] {
            display: none;
        }

        input[type="checkbox"][id^="checkSms"] {
            display: none;
        }

        label {
            border: 1px solid #fff;
            padding: 10px;
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
        }

        label:before {
            background-color: white;
            color: white;
            content: " ";
            display: block;
            border-radius: 50%;
            border: 1px solid grey;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.4s;
            transform: scale(0);
        }

        label img {
            height: 100px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        :checked+label {
            border-color: #ddd;
        }

        :checked+label:before {
            content: "✓";
            background-color: grey;
            transform: scale(1);
        }

        :checked+label img {
            transform: scale(0.9);
            box-shadow: 0 0 5px #333;
            z-index: -1;
        }
    </style>
    {{-- @dd($budget,'jj') --}}
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1></h1>
            <h1> Step 3 : Sending Options (Please Select any options)</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">
                        <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">

                            <input type="hidden" name="campaign_name" value="{{ @$prevFormData['campaign_name'] }}">

                            <input type="hidden" name="min_price" value="{{ @$prevFormData['min_price'] }}">

                            <input type="hidden" name="max_price" value="{{ @$prevFormData['max_price'] }}">
                            
                            <input type="hidden" name="productMaxPrice" value="{{ @$productMaxPrice }}">

                            <input type="hidden" name="recipient_type" value="{{ @$prevFormData['recipient_type'] }}">

                            <input type="hidden" name="recipient_id" value="{{ @$prevFormData['recipient_id'] }}">
                            <input type="hidden" name="video" value="{{ @$prevFormData['video'] }}">
                            <input type="hidden" name="group_id" value="{{ @$prevFormData['group_id'] }}">
                            <input type="hidden" name="product_ids" value="{{ @$prevFormData['product_ids'] }}">
                            <input type="hidden" name="campaign_type" value="{{ @$prevFormData['campaign_type'] }}">
                            <input type="hidden" name="start_date" value="{{ @$prevFormData['start_date'] }}">
                            <input type="hidden" name="end_date" value="{{ @$prevFormData['end_date'] }}">
                            <input type="hidden" name="before_days" value="{{ @$prevFormData['before_days'] }}">
                            <input type="hidden" name="event_type" value="{{ @$prevFormData['event_type'] }}">
                            <input type="hidden" name="campaign_type" value="{{ @$prevFormData['campaign_type'] }}">
                            <input type="hidden" name="budget" value="{{ @$budget }}">

                            @csrf

                            @if (!empty($user))
                                <input name="id" type="hidden" value="{{ @$user->id }}">
                            @endif

                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-check">
                                                    <center>
                                                        {{-- <input type="checkbox" class="form-check-input checkEmailWatsapp" id="checkEmail" onchange="selectWhatsApp()" name="email"><label for="checkEmail"><img src="https://sendgift.online/email.png" style="heigh:50px;width:100px;"/></label> --}}
                                                        <input type="checkbox" class="form-check-input checkEmailWatsapp"
                                                            id="checkEmail" onchange="selectWhatsApp()"
                                                            name="email"><label for="checkEmail"><img
                                                                src="{{ url('assets/images/email.png') }}"
                                                                style="heigh:50px;width:100px;" /></label>
                                                        <label class="form-check-label"
                                                            for="formrow-customCheck">Email</label>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <center>
                                                    <input type="checkbox" class="form-check-input checkEmailWatsapp"
                                                        id="checkWhatsApp" name="whatsapp" onchange="myFunction1()">
                                                    <label for="checkWhatsApp">
                                                        <img src="{{ url('assets/images/whatsapp.png') }}"
                                                            style="heigh:50px;" />
                                                    </label>
                                                    <label class="form-check-label" for="formrow-customCheck">
                                                        Whatsapp</label>
                                                </center>
                                            </div>
                                            <!-- <div class="col-lg-4">
                                         <center>
                                            <input type="checkbox" class="form-check-input" id="checkSms" onclick="myFunction2()" name="sms" disabled="true">
                                            <label for="checkSms">
                                            <img src="https://sendgift.online/sms.png" style="heigh:50px;width:100px;"/>
                                            </label>
                                            <label class="form-check-label" for="formrow-customCheck">SMS</label>
                                         </center>
                                      </div> -->

                                            <div class="card-body" id="whatsapptext" style="display:none">
                                             @if($whatsappData)
                                            
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <select name="template_name" class="form-control" id="template_name">
                                                                    <option value=''>Select Template</option>
                                                                     @foreach($whatsappTemplate as $value)
                                                                     @if(!empty($value['customParams']) && count($value['customParams'] )== 1)
                                                                     @if($value['customParams'][0]['paramName'] == 'tracking_url')
                                                                        <option value="{{$value['elementName']}}" data-id="{{$value['id']}}">{{$value['elementName']}}</option>
                                                                        @endif
                                                                        @endif
                                                                     @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                      <div class="row mt-1">
                                                            <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <p class="whatsapp_preview" style='white-space: pre-wrap;'></p>
                                                                    </div>
                                                            </div>
                                                     </div>
                                                </div>
                                            
                                            @else
                                                 <select name="template_name" class="form-control" id="template_name">
                                                                    <option value=''>Select Template</option>
                                                </select>
                                             @endif  
                                             </div> 
                                            <div class="card-body" id="text" style="display:none">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="col-md-4"> <input class="campaigntype"
                                                                    type="radio" name="template_type" value="1"
                                                                    checked=""
                                                                    onclick="getEmailTemplate(1)">&nbsp;Template1</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="col-md-4"><input class="campaigntype"
                                                                    type="radio" name="template_type" value="2"
                                                                    onclick="getEmailTemplate(2)">&nbsp;Template2</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="col-md-4"><input class="campaigntype"
                                                                    type="radio" name="template_type" value="3"
                                                                    onclick="getEmailTemplate(3)">&nbsp;Template3</div>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                                <div class="row mt-1">
                                               


                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Subject<span class="filed_Mendetory" >*<span></label>
                                                        <input class="form-control" name="subject" type="text" value="" id="subject"
                                                            placeholder="Enter Subject" >
                                                        <span id="subject-error" class="error text-danger"></span>
                                                    </div>
                                                </div>



                                            </div>
                                             <textarea rows="10" class="form-control" name="email_description" id="email_description"
                                                    placeholder="Enter Email Description">{{ $templates['template_text'] }}</textarea>
                                            <div class="container-fluid" id="text2" style="display:none">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <textarea type='text' value='' name='dateA' id='dateF'
                                                                style="width:350px;height:100%;padding:10px;border:1px solid #aaaaaa;"> </textarea>
                                                            <input type='hidden' value='' name='dateA'
                                                                id='dateD'>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div
                                                            style="width:350px;height:100%;padding:10px;border:1px solid #aaaaaa;">
                                                            <div class="checkbox-group required">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="date"
                                                                        data-value='Dear rahu,Please Click Here to redeem the gift. Thank you'
                                                                        data-formatted="Dear rahu,Please Click Here to redeem the gift. Thank you"
                                                                        id='something' name="fooby[1][]" checked> - Dear
                                                                    Rahu,Please Click Here to redeem the gift. Thank you
                                                                </div>
                                                                <br>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="date"
                                                                        data-value='Dear Raju,Please Click Here to redeem the gift. Thank you'
                                                                        data-formatted="Dear Raju,Please Click Here to redeem the gift. Thank you"
                                                                        id='something' name="fooby[1][]"> - Dear
                                                                    Raju,Please Click Here to redeem the gift. Thank you
                                                                </div>
                                                                <br>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="date"
                                                                        data-value='Dear Ravi,Please Click Here to redeem the gift. Thank you'
                                                                        data-formatted="Dear Ravi,Please Click Here to redeem the gift. Thank you"
                                                                        id='something' name="fooby[1][]"> - Dear
                                                                    Ravi,Please Click Here to redeem the gift. Thank you
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-sm-6">
                                    <div>
                                        <center>
                                            <!-- <button type="submit" class="btn btn-primary w-md">Back</button> -->
                                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                            <button id="btnSubmit" type="submit" class="btn btn-success w-md">Send for
                                                approval</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/tagging.min.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/tagging.script.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/common-bundle-script.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/quill.min.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/script.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/sidebar.large.script.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/customizer.script.js"></script>
    <script src="http://gull-html-laravel.ui-lib.com/assets/js/quill.script.js"></script>

    <script>

        $("#template_name").change(function(){
            var value = $(this).find(':selected').attr('data-id');
            showButtonLoader('btnSubmit', 'Send for approval', 'disable');
            $.ajax({
                type: "get",
                url: "{{ url('campPreview') }}"+'/'+value,
               
                success: function(response) {
                    $(".whatsapp_preview").html(response);
                    showButtonLoader('btnSubmit', 'Send for approval', 'enable');
                },
                error: function(response) {
                    let error = response.responseJSON;
                    showButtonLoader('btnSubmit', 'Send for approval', 'disable');
                },
            });
           
        });
        function selectWhatsApp() {
            var checkBox = document.getElementById("checkEmail");
            var text = document.getElementById("text");
            if (checkBox.checked == true) {
                text.style.display = "block";
                $("#whatsapptext").hide();
            } else {
                text.style.display = "none";
                $("#whatsapptext").show();
            }
        }

        function myFunction1() {
            var checkBox = document.getElementById("checkWhatsApp");
             if (checkBox.checked == true) {
                $("#text").hide();
                $("#whatsapptext").show();
            } else {
                $("#text").show();
                $("#whatsapptext").hide();
            }
            
        }

        function myFunction2() {
            var checkBox2 = document.getElementById("checkSms");
            var text2 = document.getElementById("text2");
            if (checkBox2.checked == true) {
                text2.style.display = "block";
            } else {
                text2.style.display = "none";
            }
        }

        $('#form').on('submit', function(e) {
            $('.error').text('');
            e.preventDefault()
            var checkEmailWatsapp = $('.checkEmailWatsapp:checked').length;
            var checkBox = document.getElementById("checkWhatsApp");
            if(checkBox.checked == true){
              var template_name = $("#template_name").val();
              if(template_name === ''){
                    message('error',"Please select Whatsapp Template");
                    return false;
              }

            }
           
            if (checkEmailWatsapp == 0) {
                $('#btnSubmit').prop('disabled', false);
                return false;
            } else {
                showButtonLoader('btnSubmit', 'Send for approval', 'disable');
            }
            let formValue = new FormData(this);
            $.ajax({
                type: "post",
                url: "{{ url($urlPrefix.'/save-ecampaign-final-step') }}",
                data: formValue,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                        message('success', response.message);
                        setTimeout(function() {
                            window.location.href = "{{ url($urlPrefix.'/ecampaigns') }}";
                        }, 2000);
                    } else {
                        message('error', response.message);
                    }
                    showButtonLoader('btnSubmit', 'Send for approval', 'enable');
                },
                error: function(response) {
                    let error = response.responseJSON;
                    console.log(error);
                    if (!error) {
                        error = JSON.parse(response.responseText);
                    }
                   
                    if (error.errors.subject) {
                        message('error', error.errors.subject[0]);
                    }

                    showButtonLoader('btnSubmit', 'Send for approval', 'enable');
                },
            });
        })
    </script>

    <script>
        var date = $('.date');
        var inputD = $('#dateD');
        var inputF = $('#dateF');
        date.on('click', function() {
            var valueD = $(this).data('value');
            var valueF = $(this).data('formatted');
            inputD.val(valueD);
            inputF.val(valueF);
            console.log(valueD);
        });

        // the selector will match all input controls of type :checkbox
        // and attach a click event handler
        $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
               var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>

    <script>
        function getEmailTemplate(id) {
            $.ajax({
                type: "get",
                url: "{{ url('client-admin/get-email-template') }}/" + id,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        $('#email_description').html(response.data.template_text);
                    } else {
                        message('error', response.message);
                    }
                }
            });
        }
    </script>
@endsection
