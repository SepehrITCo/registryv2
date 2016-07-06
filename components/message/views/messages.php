<script language="javascript">
	jQuery(document).ready(function($){
		var toggle = false;
		$(".checkbox-toggle").click(function(){
			toggle = !toggle;
			if(toggle)
				$(".checkbox[type=checkbox]").iCheck('check');
			else
				$(".checkbox[type=checkbox]").iCheck('uncheck');
		})
	})

	function trash(){
		jQuery("#trash-id").submit();
	}

	function messageReply(){
		item = jQuery(".checkbox:checked").eq(0)
		if(item.length == 1){
			window.location = "<?php echo route("message/reply/"); ?>"+item.val()
		}
	}
	function messageForward(){
		item = jQuery(".checkbox:checked").eq(0)
		if(item.length > 0){
			window.location = "<?php echo route("message/forward/"); ?>"+item.val()
		}		
	}
	
	function toggleRead(id,element){
		alert(id)
		return false;
	}
</script>
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
              <h3 class="box-title"><?php P("MESSAGE.".strtoupper($box)); ?></h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="<?php P("MESSAGE.SEARCH_MAIL"); ?>">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" title="<?php P("MESSAGE.TOGGLE_CHECK"); ?>"  class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> </button>
                <div class="btn-group">
                  <button type="button" title="<?php P("MESSAGE.TRASH"); ?>" class="btn btn-default btn-sm" onclick="trash()"><i class="fa fa-trash-o"></i></button>
                  <button type="button" title="<?php P("MESSAGE.REPLY"); ?>" class="btn btn-default btn-sm" onclick="messageReply()"><i class="fa fa-reply"></i></button>
                  <button type="button" title="<?php P("MESSAGE.FORWARD"); ?>" class="btn btn-default btn-sm" onclick="messageForward()"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onclick="window.location.reload()"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" title="<?php P("MESSAGE.BACK"); ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" title="<?php P("MESSAGE.NEXT"); ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
				<?php 
					IW::Lib("Form");
					echo Form::create("trash")->action(route("message/trash"))->method("POST"); 
					
				?>
				<input type="hidden" value="message/<?php echo $box; ?>" name="form[redirect]" />
                <table class="table table-hover table-striped">
                  <tbody>
				  
				 <?php 
					
					  withModel();
					  $user = Auth::getUser();
					  $type = ($box == "sent")?"`from`":"`receipt`";
					  $draft = $trash = 0;
					  if($box == "drafts") $draft = 1;
					  if($box == "trash") $trash = [1,2];
					  $messages = Messages::find("all", ["conditions"=> [$type."=? AND draft=? AND trash IN (?)",$user->id,$draft,$trash] ] );
					  
					  foreach($messages as $message):
						$from = Users::find("first", ["conditions"=> ["id=?",$message->from] ] );
						$date = Date::forge($message->sent_on);
						$attachment = @json_decode($message->attachment);
						$sign = "";
						if($message->forwarded) $sign = "<i class=\"fa fa-share\"></i> ";
						if($message->replied) $sign = "<i class=\"fa fa-reply\"></i> ";
				 ?>
					  <tr class="mailbox-item" onclick="window.location = '<?php echo route("message/view/".$message->id); ?>'">
						<td width=45><input type="checkbox" class="checkbox" name="form[id][]" value=<?php echo $message->id; ?>  ></td>
						<td class="mailbox-star" width=45 onclick="toggleRead(<?php echo $message->id; ?>,this)">
						<?php if($message->read == 0) : ?>
							<i class="fa fa-star text-yellow"></i>
						<?php else: ?>
							<i class="fa fa-star"></i>
						<?php endif; ?>
						</td>
						<td class="mailbox-name" width=20%><?php
						if($message->read == 0){
							echo "<b>".$from->name."</b>";
						}else{
							echo $from->name;
						}
						
						?></td>
						<td class="mailbox-subject" width=20%>
						<?php
						if($message->read == 0){
							echo "<b>".$sign.str_limit($message->subject,30)."</b>";
						}else{
							echo $sign.str_limit($message->subject,30);
						}
						
						?></td>
						<td class="mailbox-preview" width=30%><?php echo str_limit(strip_tags($message->body),30); ?></td>
						<td class="mailbox-attachment"><?php if(count($attachment) > 0) echo "<i class=\"fa fa-paperclip\"></i>";?></td>
						<td class="mailbox-date" width=180><?php echo $date->ago();  ?></td>
					  </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
				<?php echo Form::close(); ?>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" title="<?php P("MESSAGE.TOGGLE_CHECK"); ?>" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" title="<?php P("MESSAGE.TRASH"); ?>" class="btn btn-default btn-sm" onclick="trash()"><i class="fa fa-trash-o"></i></button>
                  <button type="button" title="<?php P("MESSAGE.REPLY"); ?>" class="btn btn-default btn-sm" onclick="messageReply()"><i class="fa fa-reply"></i></button>
                  <button type="button" title="<?php P("MESSAGE.FORWARD"); ?>" class="btn btn-default btn-sm" onclick="messageForward()"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onclick="window.location.reload()"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button title="<?php P("MESSAGE.BACK"); ?>" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button title="<?php P("MESSAGE.NEXT"); ?>" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
