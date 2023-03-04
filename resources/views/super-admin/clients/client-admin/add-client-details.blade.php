@extends('layouts.app')
@section('title', empty($user) ? 'Add Admin' : 'Edit Admin')
@section('content')
<div class="main-content-wrap d-flex flex-column sidenav-open">
    <div class="breadcrumb">
        <h1>{{empty($user) ? 'Add' : 'Edit' }} Admin</h1>
        <ul>
            <li><a href="{{url('super-admin/view-client',$client_id)}}">Client Details</a></li>
            <li>{{empty($user) ? 'Add' : 'Edit' }}</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body p-4">
                    <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($user))
                        <input name="id" type="hidden" value="{{@$client_id}}">
                        <input name="company_id" type="hidden" value="{{@$company_id}}">
                        @else
                        <input name="company_id" type="hidden" value="{{@$client_id}}">
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-6">
                                        <label for="example-text-input" class="form-label">First Name</label>
                                        <input class="form-control" name="first_name" type="text" value="{{@$user->first_name}}" id="first_name" placeholder="Enter First Name">
                                        <span id="first_name-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-6">
                                        <label for="example-text-input" class="form-label">Last Name</label>
                                        <input class="form-control" name="last_name" type="text" value="{{@$user->last_name}}" id="last_name" placeholder="Enter Last Name">
                                        <span id="last_name-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Email</label>
                                        <input class="form-control" name="email" type="text" value="{{@$user->email}}" id="email" placeholder="Enter email">
                                        <span id="email-error" class="error text-danger"></span>
                                    </div>

                                    <!--                                     <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Password</label>
                                        <input class="form-control" name="password" type="password" value="" id="password" placeholder="Enter password">
                                        <span id="postal_code-error" class="error text-danger"></span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-month-input" class="form-label">Phone</label>
                                    <input class="form-control" name="phone" type="number" value="{{@$user->phone}}" id="phone" placeholder="Enter Phone" oninput="this.value = this.value.replace(/[^0-9]{10}/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off" maxlength="10">
                                    <span id="phone-error" class="error text-danger"></span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-2">
                        <div>
                            <a href="{{url('super-admin/clients')}}" class="btn btn-primary w-md">Cancel</a>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div>
                            <button type="submit" id="btnSubmit" class="btn btn-success w-md">Submit</button>
                        </div>
                    </div>

                </div>
                <br>
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
            url: "{{ url('super-admin/save-client-admin') }}",
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('response', response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function() {
                        window.location.href = "{{url('super-admin/view-client',@$company_id)}}";
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
                    $('#first_name-error').text(error.errors.first_name[0])
                }
                if (error.errors.last_name) {
                    $('#last_name-error').text(error.errors.last_name[0])
                }
                if (error.errors.phone) {
                    $('#phone-error').text(error.errors.phone[0])
                }
                if (error.errors.email) {
                    $('#email-error').text(error.errors.email[0])
                }

                showButtonLoader('btnSubmit', 'Submit', 'enable');
            },
        });
    })
</script>
@endsection