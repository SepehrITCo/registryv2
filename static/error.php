<div class="error-page">
	<h2 class="headline text-red"><?php P("TEMPLATE.ERROR"); ?></h2>

	<div class="error-content">
	  <h3><i class="fa fa-warning text-red"></i><?php P("TEMPLATE.SOMETHING_GOES_WRONG"); ?></h3>

	  <p>
		<?php 
		$error =  Message::get("error"); 
		if(!$error){
			$error = sprintf(T("TEMPLATE.DEFAULT_ERROR"),route("dashboard"));
		}
		echo $error;
		?>
	  </p>

	</div>
</div>