@extends('layouts.app')
@section('title', empty($user) ? 'Add client admin user' : 'Add client admin user')
@section('content')
    @php
    $urlPrefix = urlPrefix();
    @endphp
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1>{{ empty($user) ? 'Add' : 'Edit' }} Client Admin User</h1>
            <ul>
                <li><a href="#">Clients</a></li>
                <li>{{ empty($user) ? 'Add' : 'Edit' }}</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        {{-- @dd($state); --}}

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">
                        <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($user))
                                <input name="id" type="hidden" value="{{ @$user->id }}">
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Company Name<span class="filed_Mendetory" >*<span></label>
                                            
                                            <input class="form-control" name="company_name" type="text"
                                                value="{{ @$user->name }}" id="company_name" placeholder="Enter Name">
                                            <span id="company_name-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">Address Line 1
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <input class="form-control" name="address_line_1" type="text"
                                                value="{{ @$user->address_line_1 }}" id="address_line_1"
                                                placeholder="Enter address line 1">
                                            <span id="address_line_1-error" class="error text-danger"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">Postal Code
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <input class="form-control" name="postal_code" type="text"
                                                value="{{ @$user->postal_code }}" id="postal_code"
                                                placeholder="Enter postal code">
                                            <span id="postal_code-error" class="error text-danger"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">State
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <select class="form-control" name="state" id="state-dd">
                                                <option value="">Select state</option>
                                                @foreach ($state as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ $stateId == $value->id ? 'selected' : '' }}>{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input class="form-control" name="state" type="text" value="{{@$user->state}}" id="state" placeholder="Enter State"> --}}
                                            <span id="state-error" class="error text-danger"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">GSTIN
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <input class="form-control" name="gstin" type="text"
                                                value="{{ @$user->gstin }}" id="gstin" placeholder="Enter Gstin">
                                            <span id="gstin-error" class="error text-danger"></span>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">Address line 2
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <input class="form-control" name="address_line_2" type="text"
                                                value="{{ @$user->address_line_2 }}" id="address_line_2"
                                                placeholder="Enter Address line 2">
                                            <span id="address_line_2-error" class="error text-danger"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">Country
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <select class="form-control" name="country" id="country-dd">
                                                <option value="">Select Country</option>

                                                @foreach ($country as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ @$countryId == $data->id ? 'selected' : ($data->id == 104 ? 'selected' : '') }}>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>

                                            {{-- <input class="form-control" name="country" type="text" value="{{@$user->country}}" id="country" placeholder="Enter Country"> --}}
                                            <span id="country-error" class="error text-danger"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">City
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <select class="form-control" name="city" id="city-dd">
                                                <option value="">Select City</option>
                                                @foreach ($city as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ @$cityId == $value->id ? 'selected' : '' }}>{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="city-error" class="error text-danger"></span>
                                            {{-- <input class="form-control" name="city" type="text" value="{{@$user->city}}" id="city" placeholder="Enter City">
                                        <span id="city-error" class="error text-danger"></span> --}}
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-month-input" class="form-label">Pan
                                                <!-- <span class="filed_Mendetory" >*<span></label> -->
                                            <input class="form-control" name="pan" type="text"
                                                value="{{ @$user->pan }}" id="pan" placeholder="Enter Pan">
                                            <span id="pan-error" class="error text-danger"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5 mb-3">
                                <div class="col-sm-2">
                                    <div>
                                        <a href="{{ url('super-admin/clients') }}"
                                            class="btn btn-primary w-md">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div>
                                        <button type="submit" id="btnSubmit"
                                            class="btn btn-success w-md">Submit</button>
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
        $('#form').on('submit', function(e) {
            $('.error').text('');
            e.preventDefault()
            showButtonLoader('btnSubmit', 'Submit', 'disable');
            let formValue = new FormData(this);
            $.ajax({
                type: "post",
                url: "{{ url('super-admin/save-client') }}",
                data: formValue,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                        message('success', response.message);
                        setTimeout(function() {
                            window.location.href = "{{ url('super-admin/clients') }}";
                        }, 2000);
                    } else {
                        message('error', response.message);
                    }
                    showButtonLoader('btnSubmit', 'Submit', 'enable');
                },
                error: function(response) {
                    let error = response.responseJSON;
                    if (!error) {
                        error = JSON.parse(response.responseText);
                    }
                    if (error.errors.first_name) {
                        $('#first-name-error').text(error.errors.first_name[0])
                    }
                    if (error.errors.address_line_2) {
                        $('#address_line_2-error').text(error.errors.address_line_2[0])
                    }
                    if (error.errors.address_line_1) {
                        $('#address_line_1-error').text(error.errors.address_line_1[0])
                    }
                    if (error.errors.postal_code) {
                        $('#postal_code-error').text(error.errors.postal_code[0])
                    }
                    if (error.errors.company_name) {
                        $('#company_name-error').text(error.errors.company_name[0])
                    }
                    if (error.errors.gstin) {
                        $('#gstin-error').text(error.errors.gstin[0])
                    }
                    if (error.errors.pan) {
                        $('#pan-error').text(error.errors.pan[0])
                    }


                    showButtonLoader('btnSubmit', 'Submit', 'enable');
                },
            });
        })
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#country-dd').on('change', function() {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: '{{ url('super-admin/api/fetch-states') }}',
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function() {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: '{{ url('super-admin/api/fetch-cities') }}',
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function(key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script> --}}

@endsection
