@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="auth-layout-wrap">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img src="{{ url('assets/images/send-logo.jpeg') }}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">Sign In</h1>
                            <form class="mt-4 pt-2" id="form" method="POST" action="javascript:void(0)">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email"
                                        class="form-control form-control-rounded">
                                    <div id="email-error" class="error text-danger mt-2"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control form-control-rounded" name="password" type="password"
                                        id="password" placeholder="Enter Password">
                                    <div id="password-error" class="error text-danger mt-2"></div>
                                </div>
                                <button type="button" class="btn btn-rounded btn-primary btn-block mt-2"
                                    id="btnSubmit">Sign In</button>

                            </form>

                            <div class="mt-3 text-center">
                                <a href="{{url('forgot-password')}}" class="text-muted"><u>Forgot Password?</u></a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 text-center " style="background-size: cover;background-image: url(http://gull-html-laravel.ui-lib.com/assets/images/photo-long-3.jpg"> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '#btnSubmit', function(e) {
            $('.error').text('');
            e.preventDefault();
            showButtonLoader('btnSubmit', 'Sign In', 'disable');
            $.ajax({
                url: "{{ url('login') }}",
                data: $('#form').serialize(),
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                        message('success', response.message);
                        setTimeout(function() {
                            window.location = response.url;
                        }, 1000);
                    } else {
                        message('error', response.message);
                    }
                    showButtonLoader('btnSubmit', 'Sign In', 'enable');
                },
                error: function(response) {
                    let error = response.responseJSON;
                    if (!error) {
                        error = JSON.parse(response.responseText);
                    }
                    if (error.errors.email) {
                        $('#email-error').text(error.errors.email[0])
                    }
                    if (error.errors.password) {
                        $('#password-error').text(error.errors.password[0])
                    }

                    showButtonLoader('btnSubmit', 'Sign In', 'enable');
                },
            });
        });
    </script>
@endsection
