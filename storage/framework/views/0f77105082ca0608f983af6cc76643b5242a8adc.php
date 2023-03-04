<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register Page</title>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
    integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  <!-- Custom styles -->
  <link rel="stylesheet" href="<?php echo e(url('backend/css/login.css')); ?>">
  <!-- Bootstrap -->
    <link href="<?php echo e(url('backend/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

  <!-- Open Sans -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>

<body>
  <header>
     <div class="container">
      <nav class="navbar-expand-lg navbar-dark scrolling-navbar">
      <ul class="nav justify-content-between">
        <li class="nav-item">
          <a class="navbar-brand" href="#">
            <img src="<?php echo e(url('backend/img/login/send-logo-removebg-preview 1.png')); ?>" alt="">
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
                      <a href="#" class="space"><img src="<?php echo e(url('backend/img/login/git.png')); ?>" alt=""></a>
                      <a href="#" class="space"><img src="<?php echo e(url('backend/img/login/facebook.png')); ?>" alt=""></a>
                      <a href="#" class="space"><img src="<?php echo e(url('backend/img/login/Vector.png')); ?>" alt=""></a>
                    </div>
                  </div>
                  <form class="mt-4 pt-2" id="form" method="POST" action="javascript:void(0)">
                    <?php echo csrf_field(); ?>
                      <div class="loginForm">

                        <input type="text" class="form-control" required placeholder="Email"  name="email" id="email">

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
                    <p>Don't have an account? <span> Sign Up</ospan></p>
               
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
</body>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

 <script>
        $(document).on('click', '#btnSubmit', function(e) {
            $('.error').text('');
            e.preventDefault();
            
            ('btnSubmit', 'Sign In', 'disable');
            $.ajax({
                url: "<?php echo e(url('login')); ?>",
                data: $('#form').serialize(),
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                       // message('success', response.message);
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
         function showButtonLoader(id, text, action) {
        /*parameters : button id , text on button  , button property (disable/enable)*/
        var icon = `<span class="fa fa-spin fa-spinner" style="display: inline-block;"></span>`
        if (action === 'disable') {
            $('#' + id).html(`${text} &nbsp ${icon}`);
            $('#' + id).prop('disabled', true);
        } else {
            $('#' + id).html(text);
            $('#' + id).prop('disabled', false);
        }
    }
    </script>
</html><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/auth/login.blade.php ENDPATH**/ ?>