<?php
    $menu_items = $menu->childs();
    renderMenu($menu_items,0,$menu->title);


    //recursive function
    function renderMenu($items , $level = 0,$input = "") {
        if($level > 0 ) echo '<ul class="treeview-menu">';
        if($level == 0) echo '<ul class="sidebar-menu"><li><li class="header">"'.$input.'"</li></li>';

        foreach ($items as $item) {
            $icon = ($item->icon)?'<i class="fa fa-'.$item->icon.'"></i>':"";
            $badge = ($item->badge)?'<small class="label pull-right bg-'.$item->badge_class.'">'.$item->badge.'</small>':"";
            if($item->hasChild()) {
                $item->setClass("treeview");
                echo '<li class="'.$item->getClass().'">' . $icon . "<span>" .   $item->title ."</span>" . "<i class=\"fa fa-angle-left pull-right\"></i>";
            }else{
                echo '<li class="'.$item->getClass().'"><a href="'.$item->href.'">' . $icon . "<span>" . $item->title . "</span>" . $badge . '</a>';
            }

            if (!empty($item->childs())) {
                echo renderMenu($item->childs() , $level + 1);
            }


            echo '</li>';
        }

        echo '</ul>';
    }
