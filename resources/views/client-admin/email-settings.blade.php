@extends('layouts.app')
@section('title', 'Email Settings')
@section('content')
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1>Account Settings</h1>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li>Email Settings</li>
                <li><a href="{{url('helpVideo')}}" target="_blank">Help Video</a></li>

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
                                        <button type="submit" name="btnValue" value="submit" id="btnsubmit"
                                            class="btn btn-success w-md">Submit</button>
                                        <button type="submit" name="btnValue" value="test" id="btntest"
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
        $('#btnsubmit').prop('disabled', true);
        var btnvalue = '';
        $("#btnsubmit").click(function() {
            btnvalue = 'submit';
        });
        $("#btntest").click(function() {
            btnvalue = 'test';
        });

        $('#form').on('submit', function(e) {
            e.preventDefault()
            $('#btnsubmit').prop('disabled', true);
            let formValue = new FormData(this);
             formValue.append('btnValue', btnvalue);
            $.ajax({
                type: "post",
                url: "{{ url('client-admin/email-account-setting') }}",
                data: formValue,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        if(btnvalue == 'submit'){
                            $("input[type=text]").val("");
                            $("#clientadmin_password").removeAttr('readonly');
                            $("#clientadmin_email").removeAttr('readonly');

                        }else{
                            $("#clientadmin_password").attr('readonly', 'readonly');
                            $("#clientadmin_email").attr('readonly', 'readonly');

                        }
                        message('success', response.message);
                    } else {
                        message('error', response.message);
                    }
                     $('#btnsubmit').prop('disabled', false);
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

                     $('#btnsubmit').prop('disabled', true);
                },
            });
        })
    </script>
@endsection
