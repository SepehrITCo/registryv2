<?php

class Menu{
    private $parent;
    private $childs = array();

    public $title = "";
    public $icon = false;
    public $badge = false;
    public $badge_class = false;
    public $href = "#";
    public $attribute = array();
    public $li_class = array();
    public $active_path = false;
	public $active = false;
	public static $late_active = false;

    public function __construct($title,$parent = null)
    {
        $this->parent = $parent;
        $this->title = $title;
    }

    public function add($title,$href = "#"){
        $menu =  new Menu(T($title),$this);
        $menu->href = $href;
        $this->childs[] = $menu;
        $menu->isActive();
        return $menu;
    }

    public function badge($badge = false,$class = false){
        if($badge) {
            $this->badge= $badge;
            $this->badge_class = $class;
            return $this;
        }
        return $this->badge;
    }

    public function icon($icon = false){
        if($icon) {
            $this->icon = $icon;
            return $this;
        }
        return $this->icon;
    }
    public function attribute($attribute,$value = false){
        if($value) {
            $this->attribute[$attribute] = $value;
            return $this;
        }
        return $this->attribute[$attribute];
    }

    public function setClass($class){
        $this->li_class[] = $class;
    }

    public function getClass(){
        $result = "";
        foreach($this->li_class as $item)
            $result .= " ".$item;
        return trim($result);
    }

    public function childs(){
        return $this->childs;
    }

    public function activeOn($path){
        
        $this->active_path = $path;

    }

    public function activate(){
        $this->setClass("active");
		$this->active = true;
        if($this->parent != null)
            $this->parent->activate();
        return $this;
    }

    public function isActive($active = false){
	
        if($active != false){

            if(starts_with(IW::$URI,$active) && strlen(IW::$URI)-strlen($active) < 3){
					self::$late_active = $this;
            }

        }

        if($this->active_path){
            $chunks = explode("|",$this->active_path);
		
            foreach($chunks as $active_path){
                $this->isActive($active_path);
            }
            return $this;
        }else{

            $url = trim(str_replace(IW_ROOT,"",$this->href),"/");

            if($url == IW::$URI){
					self::$late_active = $this;
				
            }
            if(strlen($url) > 3 && starts_with(IW::$URI,$url)){
				self::$late_active = $this;
   
            }
        }
        return $this;
    }

    public  function hasChild(){
        if(count($this->childs) > 0){
            return true;
        }
        return false;
    }
    public function render($renderer = false){
		if(self::$late_active)	self::$late_active->activate();
        if(!$renderer){
            return require_ob( __DIR__.DS."render".php , ["menu"=>$this] );
        }else{
            return require_ob( $renderer , ["menu"=>$this] );
        }

    }

}