<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DECLUTTER | Login </title>

    <link href="<?php echo base_url('assets'); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
          <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                <div role="alert" class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                    <?=$this->session->flashdata('SUCCESSMSG')?>
                </div>
            <?php } ?>
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo base_url('Login/index') ?>">
              <h1>DECLUTTER</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"  />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                  <span style="color: red;"><?php if (form_error('password')) {
                    echo form_error('password');
                  } ?></span>
               
                <div class="clearfix"></div>
                <br />

              
              </div>
            </form>
          </section>
        </div>
    
      </div>
    </div>
  </body>
</html>
