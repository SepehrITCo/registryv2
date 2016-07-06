<?php 
	$notifications = Notification::get();
	$count = count($notifications);
?>
<li class="dropdown notifications-menu" onclick="App.seen(this)">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php printf(T("TEMPLATE.YOU_HAVE_N_NOTIF"),$count); ?></li>
             
                <!-- inner menu: contains the actual data -->
               
					<?php 
					if($count > 0){
						echo '<li><ul class="menu notifications">';
					foreach($notifications as $notify){
						echo "<li notify-id=".$notify->id." title='".$notify->title."'>";
					
						$url = ($notify->url != "")?$notify->url:"#";
							echo "<a href='".$url."'>";
							echo "<small class='pull-right notify-time'><i class='fa fa-clock-o'></i> ".Date::forge($notify->date)->ago()."</small>";
						if($notify->icon != "")
							echo icon($notify->icon,$notify->color);
						echo $notify->title;
						echo "</a>";
						echo "</li>";
					}
					echo "</ul></li>";
					}

					?>
              
              <li class="footer"><a href="<?php echo route("notifications"); ?>"><?php P("TEMPLATE.VIEW_ALL"); ?></a></li>
            </ul>
</li>