<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory Management - CI</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css')?>">
  <style>
    body.hold-transition.login-page {
        background-image: url('<?php echo base_url("assets/images/background.jpg")?>') !important;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        overflow: hidden;
    }

    body.hold-transition.login-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 0;
    }

    .login-box {
        position: relative;
        z-index: 1;
        width: 430px;
        margin: 0 auto; /* This centers the box horizontally */
        top: 50%;      /* Move down by 50% of viewport height */
        transform: translateY(-50%); /* Move up by 50% of element height */
    }

    .login-box-body {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(255, 255, 255, 0.2);
      }

    .login-logo {
        margin-bottom: 20px;
    }

    .login-logo a {
        color: white !important;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        font-weight: bold;
    }

    .form-control {
        height: 45px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: none;
        padding-left: 15px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .form-control-feedback {
        line-height: 45px;
        color: #ddd;
    }

    .checkbox.icheck label {
        color: white;
        padding-left: 5px;
    }

    .btn-danger {
      box-shadow: 0 4px 6px rgba(255, 255, 255, 0.2);
    }

    .login-box-msg {
        font-size: 16px;
        color: white;
        margin-bottom: 20px;
    }

    img {
        width: 150px;
        height: 110px;
    }
    .white-shadow {
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.6);
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>VENEGAS HARDWARE SALES & INVENTORY MANAGEMENT SYSTEM</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Log in to start your session</p>
    <div style="display: flex; gap: 8px;">
        <img src="<?php echo base_url('assets/images/logo.jpg')?>" alt="Company Logo">
        <form action="<?php echo base_url('auth/login') ?>" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control white-shadow" name="email" id="email" placeholder="Email" autocomplete="off">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control white-shadow" name="password" id="password" placeholder="Password" autocomplete="off">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-danger">Log In</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>
