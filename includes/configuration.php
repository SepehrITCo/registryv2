<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );

class Configuration extends DotNotation{
	
	private static $instance;
	protected $values;
	public function __construct($config = "core"){
		$this->values =  getJSON(PATH_BASE.DS."config".DS.$config.".json" ,true);
	}
	
	public static function getInstance(){
		if(self::$instance == null)
			self::$instance = new Configuration();
		return self::$instance;
		
	}


}


