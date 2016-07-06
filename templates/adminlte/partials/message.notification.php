<?php 
	require_once PATH_BASE.DS."components".DS."message".DS."models".DS."Message.Model".php;
	$uid = Auth::getUserOrFail()->id;
	$count = Messages::find_by_sql('SELECT count(`id`) AS `count` FROM `messages` WHERE `read` = 0 && receipt='.$uid)[0]->count;
	$messages = Messages::find("all", ["conditions"=> ["receipt=? AND `read`=0",$user->id] , "limit"=>5] );
?>
<li class="dropdown messages-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-envelope-o"></i>
  <span class="label label-success"><?php echo $count; ?></span>
</a>
<ul class="dropdown-menu">
  <li class="header"><?php echo T("MESSAGE.YOU_HAVE_N_MESSAGE",$count); ?></li>
  <li>
	<!-- inner menu: contains the actual data -->
	<ul class="menu">
	<?php
	foreach($messages as $message):
	$from = Users::find("first", ["conditions"=> ["id=?",$message->from] ] );
	$date = Date::forge($message->sent_on);
	$sign = "";
	if($message->forwarded) $sign = "<i class=\"fa fa-share\"></i> ";
	if($message->replied) $sign = "<i class=\"fa fa-reply\"></i> ";
	?>
	  <li><!-- start message -->
		<a href="<?php echo route("message/view/".$message->id); ?>">
		  <div class="pull-left">
			<img src="<?php 
			if(file_exists(Files.DS."profile".DS.$message->from.".jpg")){
				echo IW_ROOT.DS."files".DS."profile".DS.$message->from.".jpg";
			}else{
				echo IW_ROOT.DS."files".DS."profile".DS."default.jpg";
			}
			?>" class="img-circle" alt="User Image">
		  </div>
		  <h4>
			<?php echo $sign.str_limit($message->subject,21); ?>
			<small><i class="fa fa-clock-o"></i> <?php echo $date->ago(); ?></small>
		  </h4>
		  <p><?php echo $from->name; ?></p>
		</a>
	  </li>
	  <?php endforeach; ?>
	  <!-- end message -->
	</ul>
  </li>
  <li class="footer"><a href="<?php echo route("message/inbox"); ?>"><?php P("MESSAGE.SEE_ALL_MESSAGES"); ?></a></li>
</ul>
</li>