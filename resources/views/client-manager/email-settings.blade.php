@extends('layouts.app')
@section('title', 'Email Settings')
@section('content')
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1>Account Settings</h1>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li>Email Settings</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">
                        <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($group))
                                <input name="id" type="hidden" value="{{ @$group->id }}">
                            @endif
                            {{-- <input id="btnSubmit" name="btnSubmit" type="hidden" value="btnSubmit">
                        <input id="btnTest" name="btnTest" type="hidden" value="btnTest"> --}}

                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input class="form-control" name="clientadmin_email" type="text"
                                                id="clientadmin_email">
                                            <span id="clientadmin-email-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Password</label>
                                            <input class="form-control" name="clientadmin_password" type="text"
                                                id="clientadmin_password">
                                            <span id="clientadmin-password-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-sm-2">
                                    <div>
                                        <button type="submit" name="btnsubmit" value="submit" id="btnsubmit"
                                            class="btn btn-success w-md">Submit</button>
                                        <button type="submit" name="btnsubmit" value="test" id="btntest"
                                            class="btn btn-primary w-md">Test</button>
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
        var btnvalue = '';
        $("#btnsubmit").click(function() {
            btnvalue = 'submit';
        });
        $("#btntest").click(function() {
            btnvalue = 'test';
        });

        $('#form').on('submit', function(e) {
            e.preventDefault()
            showButtonLoader('btnSubmit', 'Submit', 'disable');
            let formValue = new FormData(this);
            //const value =$('#btnSubmit').val()
            // formValue.append('btnValue', btnvalue);
            $.ajax({
                type: "post",
                url: "{{ url('client-admin/email-account-setting') }}",
                data: formValue,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                        message('success', response.message);
                        // setTimeout(function(){
                        //     window.location.href = "{{ url('client-admin/dashboard') }}";
                        // },2000);
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
                    if (error.errors.clientadmin_email) {
                        $('#clientadmin-email-error').text(error.errors.clientadmin_email[0])
                    }
                    if (error.errors.clientadmin_password) {
                        $('#clientadmin-password-error').text(error.errors.clientadmin_password[0])
                    }

                    showButtonLoader('btnSubmit', 'Submit', 'disable');
                },
            });
        })
    </script>
@endsection
