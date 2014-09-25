<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="javier varón saavedra">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?php echo $this->settings->site_name; ?> - <?php echo lang('login_title');?></title>
    <base href="<?php echo base_url(); ?>"/>
    <meta name="robots" content="noindex, nofollow"/>

    <!--Core CSS -->
    <?php Asset::css('bs3/css/bootstrap.min.css'); ?>
    <?php Asset::css('bootstrap-reset.css'); ?>
    <?php Asset::css('assets/font-awesome/css/font-awesome.css'); ?>

    <!-- Custom styles for this template -->
    <?php Asset::css('style.css'); ?>
    <?php Asset::css('style-responsive.css'); ?>

    <?php echo Asset::render() ?>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-body">

    <div class="container">
    <?php $this->load->view('admin/partials/notices') ?>
      <?php echo form_open(site_url('admin/login'), 'class="form-signin"'); ?>
        <h2 class="form-signin-heading">KuboCMS</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" name="email" class="form-control" placeholder="<?php echo lang('global:email'); ?>" autofocus>
                <input type="password" name="password" class="form-control" placeholder="<?php echo lang('global:password'); ?>">
            </div>
            <label class="checkbox">
                <input type="checkbox" id="login-remember" value="remember-me" checked> <?php echo lang('user:remember'); ?>
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Olvidáste la contraseña?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="submit"><?php echo lang('login_label'); ?></button>
            <div class="registration">
                Copyright &copy; 2013 - <?php echo date('Y'); ?>
                <a class="" href="javiervaron.co">
                    kubocms.com
                </a>
            </div>
        </div>
      <?php echo form_close(); ?>
      <!-- Modal -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Olvidáste la contraseña?</h4>
                  </div>
                  <div class="modal-body">
                      <p>Ingresa tu e-mail para reestablecer tu contraseña.</p>
                      <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                  </div>
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                      <button class="btn btn-success" type="button">Submit</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- modal -->
    </div>

    <!--Core js-->
    <?php Asset::js('lib/jquery-1.8.3.min.js'); ?>
    <?php Asset::js('bs3/js/bootstrap.min.js'); ?>
    <?php echo Asset::render_js() ?>

</body>
<!-- 
<body id="login-body">
</body> -->
</html>