<?php 
	$sign = "";
	if($message->forwarded) $sign = "<i class=\"fa fa-share\"></i> ";
	if($message->replied) $sign = "<i class=\"fa fa-reply\"></i> ";
?>
<div class="row">
	<div class="col-md-3">
	  <a href="<?php echo route("message/compose"); ?>" class="btn btn-primary btn-block margin-bottom"><?php P("MESSAGE.COMPOSE"); ?></a>

	 <?php require "left.php"; ?>

	  <!-- /.box -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $sign.$message->subject; ?></h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
            
                <h5><?php P("MESSAGE.FROM"); ?>: <a href="#"><?php echo $from->name;  ?></a>   
				<span class="mailbox-read-time pull-right"><?php echo T("MESSAGE.SENT_ON")." ".$date->ago(); ?> - <?php echo $date->format("%d %b %Y %I:%M %p"); ?> </span>
				
				</h5>
				<h5><?php P("MESSAGE.TO"); ?>: <a href="#"><?php echo $receipt->name;  ?></a>
				<span class="mailbox-read-time pull-right">
				<?php 

				if($message->read_on != null && $message->read == 1){
					$seen = Date::forge($message->read_on);	
					echo T("MESSAGE.SEEN_ON")." ".$seen->ago(); 
					echo " - ". $seen->format("%d %b %Y %I:%M %p"); 
				}else{
					P("MESSAGE.NOT_SEEN_YET");
				}
				
				?> 
				</span>
                </h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" title="<?php P("MESSAGE.TRASH"); ?>" onclick="window.location = '<?php echo route("message/trash/".$message->id); ?>'">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" title="<?php P("MESSAGE.REPLY"); ?>" onclick="window.location = '<?php echo route("message/reply/".$message->id); ?>'">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" title="<?php P("MESSAGE.FORWARD"); ?>" onclick="window.location = '<?php echo route("message/forward/".$message->id); ?>'">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" title="<?php P("MESSAGE.PRINT"); ?>">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
               <?php echo $message->body; ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
			<?php require "attachment.php"; ?>
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default" onclick="window.location = '<?php echo route("message/reply/".$message->id); ?>'"><i class="fa fa-reply"></i> <?php P("MESSAGE.REPLY"); ?></button>
                <button type="button" class="btn btn-default" onclick="window.location = '<?php echo route("message/forward/".$message->id); ?>'"><i class="fa fa-share"></i> <?php P("MESSAGE.FORWARD"); ?></button>
              </div>
              <button type="button" class="btn btn-default" onclick="window.location = '<?php echo route("message/trash/".$message->id); ?>'"><i class="fa fa-trash-o"></i> <?php P("MESSAGE.TRASH"); ?></button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> <?php P("MESSAGE.PRINT"); ?></button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
</div>