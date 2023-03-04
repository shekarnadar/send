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
                            <h1 class="mb-3 text-18">Forgot Password</h1>
                            
                            <form class="mt-4 pt-2" id="form" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email"
                                        class="form-control form-control-rounded">
                                    @if($errors->any())
                                        <p class="error text-danger mt-2">{{$errors->first()}}</p>
                            @endif
                                </div>
                                
                                <button type="button"  class="btn btn-rounded btn-primary btn-block mt-2"
                                    id="btnSubmit">{{ __('Email Password Reset Link') }}</button>

                            </form>

                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
   <script type="text/javascript">
        $(document).on('click', '#btnSubmit', function(e) {
            showButtonLoader('btnSubmit', 'Sign In', 'disable');
            $.ajax({
                url: "{{ url('forgot-password') }}",
                data: $('#form').serialize(),
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if (response.success) {
                        message('success', response.message);
                        setTimeout(function() {
                            window.location = 'login';
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
                    if (error) {
                        $('#email-error').text(error)
                    }
                   

                    showButtonLoader('btnSubmit', 'Sign In', 'enable');
                },
            });
        });
   </script>
@endsection
