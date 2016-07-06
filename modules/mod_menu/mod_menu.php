<?php 
	class Module_menu extends Modules{
        private $stack = array();

		public function render(){
            IW::Lib("Menu");
            withModel();

            $menu_items = MenuItem::find( "all",
            [
                "conditions"=>["menu_id=? AND published=?",$this->get("menu_id"),1],
                "order"=>"`order` asc"
            ]);
            $menu_items_array = array();
            foreach($menu_items as $item){
                $menu_items_array[] =  $item->to_array();
            }


            $menu_object= new Menu(T("TEMPLATE.MAIN_MENU"));
            $tree = $this->treeBuilder($menu_items_array ,"id","parent_id",$menu_object);

            echo $menu_object->render($this->get("render"));

		}


        function treeBuilder($raw, $id_key = 'id', $parent_key = 'parent_id',&$object) {
            // First, transform $raw to $rows so that array key == id
            $rows = array();
            foreach ($raw as $row) {
                $rows[$row[$id_key]] = $row;
            }
            $tree = array();
            $tree_index = array(); // Storing the reference to each node

            while (count($rows)) {
                foreach ($rows as $id => $row) {
                    if ($row[$parent_key]) { // If it has parent
                        // Abnormal case: has parent id but no such id exists
                        if (!array_key_exists($row[$parent_key], $rows) AND !array_key_exists($row[$parent_key], $tree_index)) {
                            unset($rows[$id]);
                        }
                        // If the parent id exists in $tree_index, insert itself
                        else if (array_key_exists($row[$parent_key], $tree_index)) {
                            $parent = &$tree_index[$row[$parent_key]];
                            $obj = $this->addMenu($row,$parent["object"]);

                            $parent['children'][$id] = array('node' => $row, 'children' => array() , 'object'=>$obj);
                            $tree_index[$id] = &$parent['children'][$id];
                            unset($rows[$id]);
                        }
                    } else { // Top parent
                        $obj = $this->addMenu($row,$object);
                        $tree[$id] = array('node' => $row, 'children' => array() , 'object'=>$obj);
                        $tree_index[$id] = &$tree[$id];
                        unset($rows[$id]);
                    }
                }
            }
            return $tree;
        }

        protected function addMenu($menu,$object){
            if($menu["permission"] != "") {
                if(!Auth::getUser()->hasPerm($menu["permission"])) return $object;
            }

            if($menu["title"] == "SPACER"){
                //$object->space();
            }if($menu["type"] == 2){
                //$object->add($menu["title"])->divider();
            }
            else{
                $object = $object->add($menu["title"], route($menu["url"]) );

                if(!empty($menu["active"])) $object->activeOn($menu["active"]);
                if(!empty($menu["icon"])) $object->icon($menu["icon"]);
                if(!empty($menu["proc"])){
                    list($component,$controller,$action) = explode(".",$menu["proc"]);

                    action($controller.".".$action,$component,["menu"=>$menu,"menu_object"=>$object]);

                }
            }

            return $object;
        }
	}