
@extends('layouts.app1')
@section('title', 'Send Gift')
@section('content')

  <header>
     <div class="container">
      <nav class="navbar-expand-lg navbar-dark scrolling-navbar">
      <ul class="nav justify-content-between">
        <li class="nav-item">
          <a class="navbar-brand" href="#">
            <img src="{{url('backend/img/login/send-logo-removebg-preview 1.png')}}" alt="">
          </a>
        </li>
        <li class="nav-item cont">
          <a id="contact" class="navbar-brand" href="#">
            <strong>Contact</strong>
          </a>
        </li>
        
      </ul>
     </div>
    </nav>

    <section>
      <div class="d-flex align-items-center justify-content-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto ">
              <div class="card">
                <div class="card-body">
                  <div class="loginFormBox">
                    <h3>Sign In</h3>
                    <div class="justify-content-center text-center d-flex socials">
                      <a href="#" class="space"><img src="{{url('backend/img/login/git.png')}}" alt=""></a>
                      <a href="#" class="space"><img src="{{url('backend/img/login/facebook.png')}}" alt=""></a>
                      <a href="#" class="space"><img src="{{url('backend/img/login/Vector.png')}}" alt=""></a>
                    </div>
                  </div>
                  <form class="mt-4 pt-2" id="form" method="POST" action="javascript:void(0)">
                    @csrf
                    <div class="loginForm">

                      <input type="text" class="form-control" required placeholder="Email" name="email" id="email">

                    </div>
                    <div class="loginForm">
                      <input type="password" class="form-control" required placeholder="Current Password" name="password" id="password">
                      <!-- <label>Your Password</label> -->
                    </div>
                    <div class="form-check form-switch">
                      <input type="checkbox" id="toggle-button" class="toggle-button">
                      <label for="toggle-button" class="text">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button class="btn sign" id="btnSubmit">
                        SIGN IN
                      </button>
                 
                    </div>
                  </form>
                  <div class="text-center account">
                    <p>Don't have an account? <span> Sign Up</span></p>
               
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
  <script>
    $(document).on('click', '#btnSubmit', function (e) {
        $('.error').text('');
        e.preventDefault();
        showButtonLoader('btnSubmit', 'Sign In','disable');
        $.ajax({
            url: "{{ url('super-admin/login') }}",
            data: $('#form').serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                if (response.success) {
                    message('success', response.message);
                    setTimeout(function () {
                        window.location = response.url;
                    }, 1000);
                } else {
                    message('error', response.message);
                }
                showButtonLoader('btnSubmit', 'Sign In','enable');
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

                showButtonLoader('btnSubmit', 'Sign In','enable');
            },
        });
    });
   
</script>
@endsection
