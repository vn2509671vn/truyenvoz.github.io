<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>templates/img/Truyen-Hay.ico" rel="shortcut icon" type="image/x-icon">
    <title> Login Page </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>templates/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>templates/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>templates/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>templates/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>templates/build/css/custom.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="<?php echo base_url();?>templates/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>templates/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="<?php echo base_url('login');?>">
              <h1>Login Form</h1>
              <div class="form-group">
                <?php if(isset($error)) echo "<span class='error-red'>".$error."</span>";?>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Account" required name="account"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name="password"/>
              </div>
              <div>
                <input type="submit" class="btn btn-primary" value="Login"/>
                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register" id="register_id"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> ThangTGM!</h1>
                  <p>©2016 All Rights Reserved. </p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST" action="<?php echo base_url('register');?>">
              <h1>Create Account</h1>
              <div class='form-group'>
                <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($msg)) echo $msg;?></span>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Full name" required name="name" value="<?php echo set_value('name'); ?>"/>
                <strong class='error-red'><?php echo form_error('name'); ?></strong>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Account" required name="account" value="<?php echo set_value('account'); ?>"/>
                <strong class='error-red'><?php echo form_error('account'); ?></strong>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required name="email" value="<?php echo set_value('email'); ?>"/>
                <strong class='error-red'><?php echo form_error('email'); ?></strong>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name="password" value="<?php echo set_value('password'); ?>"/>
                <strong class='error-red'><?php echo form_error('password'); ?></strong>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Repeat Password" required name="re_password" value="<?php echo set_value('re_password'); ?>"/>
                <strong class='error-red'><?php echo form_error('re_password'); ?></strong>
              </div>
              <div>
                <input type="submit" class="btn btn-primary" value="Submit"/>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_login"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> ThangTGM!</h1>
                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  <script type="text/javascript">
    <?php if(isset($isRegister)){ ?>
      document.getElementById("register_id").click();
    <?php } ?>
  </script>
  </body>
</html>
