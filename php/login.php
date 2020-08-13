<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/favicon.ico">

  <title>Login</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/login-bg.jpg)">
  <div class="container h-100">
    <div class="row align-items-center justify-content-md-center h-100">

      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="login-wrap bg-white shadow-lg">
              <div class="content-top-agile">
                <h2 class="text-primary">Let's Get Started</h2>
                <p class="mb-0">Login to continue to Power BI.</p>
              </div>
              <div class="p-5">
                <form action="index.php" method="post">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" placeholder="Username/Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text  bg-transparent">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control pl-15 bg-transparent" placeholder="Password">
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-6">
                      <div class="checkbox">
                      <input type="checkbox" id="basic_checkbox_1">
                      <label for="basic_checkbox_1">Remember Me</label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                     <div class="fog-pwd text-right">
                      <a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i>Forgot password?</a><br>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center p-2">
                      <button type="submit" class="btn btn-danger mt-1">LOGIN</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
                <div class="text-center">
                  <p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-1">Sign Up</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body></html>
