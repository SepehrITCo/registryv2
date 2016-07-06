<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php P("USERS.LOGIN"); ?></title>
	<meta name="description" content="<?php echo app("META.DESCRIPTION"); ?>" />
	<meta name="keywords" content="<?php echo app("META.KEYWORDS"); ?>"  />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require "partials/head".php;	?>
	 <module name="css" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<module name="script" />
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	  $.get("<?php echo route("bing"); ?>")
	</script>
</head>
<body class="hold-transition login-page">

<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
	  <div class="login-logo">
		<a href="<?php echo IW_ROOT; ?>"><b><?php echo config("IW.GLOBAL_NAME"); ?></b></a>
	  </div>
    <p class="login-box-msg"><?php P("USERS.ENTER_USERNAME_PASSWORD"); ?></p>
	<?php require "partials/messages.php"; ?>
    <form action="<?php echo route("login"); ?>" method="post">
	<?php 
		IW::Lib("Form");
		echo Form::createToken();
	?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="form[username]" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="form[password]" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="form[remember]" value=true> <?php P("USERS.REMEMBER_ME"); ?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php P("USERS.SIGN_IN"); ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="<?php echo route("forgot"); ?>"><?php P("USERS.FORGOT_PASSWORD"); ?></a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php 
	$image_credit = PATH_BASE.DS."media".DS."images".DS."bing.txt";
	if(file_exists($image_credit)){
		$image_credit = file_get_contents($image_credit);
		echo "<div class=\"bing_credits\">".$image_credit."</div>";
	}
	
?>
<style>
	.login-page, .register-page{
		#d2d6de url(../images/bing.jpg?<?php echo filemtime(PATH_BASE.DS."media".DS."images".DS."bing.jpg"); ?>);
	}
</style>
</body>
</html>

