<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo app("PAGE.TITLE"); ?></title>
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
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?php require "partials/header".php;	?>
	<?php require "partials/aside".php;	?>

	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	<?php if(app("PAGE.H1")) echo "<h1>".app("PAGE.H1")."</h1>"; ?>
	  <ol class="breadcrumb">
			<li><a href="<?php route("dashboard"); ?>"><i class="fa fa-dashboard"></i> <?php P("TEMPLATE.DASHBOARD"); ?></a></li>
			<?php echo app("TEMPLATE.BREADCRUMB");  ?>
	  </ol>
    </section>
	
	<?php 
		if(!ends_with(app("REQUEST.URI"),"/error"))
			require "partials/messages".php;
	?>
    <!-- Main content -->
    <section class="content">

		<module name="component" />

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  
</div>


</body>
</html>

