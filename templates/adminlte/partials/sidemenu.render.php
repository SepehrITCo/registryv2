<?php
    $menu_items = $menu->childs();
	
	echo '<ul class="sidebar-menu">';
	echo '<li><li class="header">'.$menu->title.'</li>';
	$GLOBALS["breadcrumb"] = "";
	sidemenu($menu_items);
	
    //recursive function
    function sidemenu($items , $level = 0 ) {

		if($level > 0)
        echo '<ul class="treeview-menu">';
		
        foreach ($items as $item) {
            $icon = ($item->icon)?'<i class="fa fa-'.$item->icon.'"></i>':"";
            $badge = ($item->badge)?'<small class="label pull-right bg-'.$item->badge_class.'">'.$item->badge.'</small>':"";
            if($item->hasChild()) {
                $item->setClass("treeview");
				if($item->active)
				$GLOBALS["breadcrumb"] .= "<li><a href='".$item->href."'>".$item->title."</a></li>";
                echo '<li class="'.$item->getClass().'"><a href="#">' . $icon . "<span>" .   $item->title ."</span>" . "<i class=\"fa fa-angle-left pull-right\"></i></a>";
            }else{
				if($item->active){
					
				$GLOBALS["breadcrumb"] .= "<li class='active'>".$item->title."</li>";
				
				}
                echo '<li class="'.$item->getClass().'"><a href="'.$item->href.'">' . $icon . "<span>" . $item->title . "</span>" . $badge . '</a>';
            }

            if (!empty($item->childs())) {
                echo sidemenu($item->childs() , $level + 1 );
            }


            echo '</li>';
        }

        echo '</ul>';
	
    }
	app("TEMPLATE.BREADCRUMB",$GLOBALS["breadcrumb"]);
	
