<?php 
	if(!isset($box)) $box = "";
?>
<div class="box box-solid">
<div class="box-header with-border">
  <h3 class="box-title"><?php P("MESSAGE.FOLDERS"); ?></h3>

  <div class="box-tools">
	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	</button>
  </div>
</div>
<div class="box-body no-padding">
  <ul class="nav nav-pills nav-stacked">
	<li class="<?php if($box == "inbox") echo "active"; ?>"><a href="<?php echo route("message/inbox"); ?>"><i class="fa fa-inbox"></i> <?php P("MESSAGE.INBOX"); ?>

	  <?php
		echo action("MessageController.inbox","message");
	  ?>
	</a></li>
	<li class="<?php if($box == "sent") echo "active"; ?>"><a href="<?php echo route("message/sent"); ?>"><i class="fa fa-envelope-o"></i> <?php P("MESSAGE.SENT"); ?></a></li>
	<li class="<?php if($box == "drafts") echo "active"; ?>"><a href="<?php echo route("message/drafts"); ?>"><i class="fa fa-file-text-o"></i> <?php P("MESSAGE.DRAFTS"); ?></a></li>
	<li class="<?php if($box == "trash") echo "active"; ?>"><a href="<?php echo route("message/trash"); ?>"><i class="fa fa-trash-o"></i> <?php P("MESSAGE.TRASH"); ?></a></li>
  </ul>
</div>
</div>