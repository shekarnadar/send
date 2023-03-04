@extends('layouts.app')
@section('title', 'Register')
@section('content')
<main class="bg-white">

    <div class="td flex">

        <!-- Content -->
        <div class="oq qw">

            <div class="oj or flex fh wd">

                <!-- Header -->
                <div class="ac">
                    <div class="flex items-center fg op vd jd tto">
                        <!-- Logo -->
                        <a class="block" href="{{url('')}}">
                            <svg width="32" height="32" viewBox="0 0 32 32">
                                <defs>
                                    <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                                        <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#A5B4FC" offset="100%"></stop>
                                    </linearGradient>
                                    <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                                        <stop stop-color="#38BDF8" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#38BDF8" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <rect fill="#6366F1" width="32" height="32" rx="16"></rect>
                                <path d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z" fill="#4F46E5"></path>
                                <path d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z" fill="url(#logo-a)"></path>
                                <path d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z" fill="url(#logo-b)"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="as ri oq vd vv">
    
                    <h1 class="text-3xl text-slate-800 font-bold rb">Create your Account ✨</h1>
                    <!-- Form -->
                    <form id="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="ln">
                            <div>
                                <label class="block text-sm gk rx" for="email">Email Address <span class="yl">*</span></label>
                                <input id="email" name="email" class="tn oq" type="email">
                            </div>
                            <div>
                                <label class="block text-sm gk rx" for="name">Full Name <span class="yl">*</span></label>
                                <input id="name" name="username" class="tn oq" type="text">
                            </div>
                            <div>
                                <label class="block text-sm gk rx" for="role">Your Role <span class="yl">*</span></label>
                                <select id="role" class="ts oq">
                                    <option>Designer</option>
                                    <option>Developer</option>
                                    <option>Accountant</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm gk rx" for="password">Password</label>
                                <input id="password" name="password" class="tn oq" type="password" autocomplete="on">
                            </div>
                        </div>
                        <div class="flex items-center fg ir">
                            <button id="btnSubmit" class="btn hb xs yo ml-3 co">Sign Up</button>
                        </div>
                    </form>
                    <!-- Footer -->
                    <div class="gn ir ck border-slate-200">
                        <div class="text-sm">
                            Have an account? <a class="gk text-indigo-500 xd" href="{{url('login')}}">Sign In</a>
                        </div>
                    </div>
    
                </div>

            </div>

        </div>

        <!-- Image -->
        <div class="hidden qh tp tk ty tw qw" aria-hidden="true">
            <img class="vr vi oq or" src="{{url('assets/images/auth-image.jpg')}}" width="760" height="1024" alt="Authentication image">
            <img class="tp ns tb fe ag st hidden tea" src="{{url('assets/images/auth-decoration.png')}}" width="218" height="224" alt="Authentication decoration">
        </div>

    </div>

</main>

<script>
    $(document).on('click', '#btnSubmit', function (e) {
        $('.error').text('');
        e.preventDefault();
        showButtonLoader('btnSubmit', 'Sign Up','disable');
        $.ajax({
            url: "{{ route('register') }}",
            data: $('#form').serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                console.log('response',response);
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function () {
                        window.location = response.url;
                    }, 1000);
                } else {
                    message('error', response.message);
                }
                showButtonLoader('btnSubmit', 'Sign Up','enable');
            },
            error: function(response) {
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }
                if (error.errors.email) {
                    $('#email-error').text(error.errors.email[0])
                }
                if (error.errors.password) {
                    $('#password-error').text(error.errors.password[0])
                }

                showButtonLoader('btnSubmit', 'Sign Up','enable');                
            },
        });
    });     
</script>
@endsection