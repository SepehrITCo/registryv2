	<?php
	
		$notify = Message::get( "notify" );
		if(is_string($notify)):
	?>
	<section class="notify">
	
	<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $notify; ?>
    </div>
	</section>
	<?php endif; ?>
	
	<?php
		$notify = Message::get( SUCCESS );
		if(is_string($notify)):
	?>
	<section class="notify">
	
	<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $notify; ?>
    </div>
	</section>
	<?php endif; ?>
	
	<?php
		$notify = Message::get( WARNING );
		if(is_string($notify)):
	?>
	<section class="notify">
	
	<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $notify; ?>
    </div>
	</section>
	<?php endif; ?>
	
	<?php
		$notify = Message::get( ERROR );
		if(is_string($notify)):
	?>
	<section class="notify">
	
	<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $notify; ?>
    </div>
	</section>
	<?php endif; ?>