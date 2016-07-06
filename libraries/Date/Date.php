<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
interface DateInterface
{

	public static function forge($str = null);

	public function __construct($str = null);

	public function time();

	public function format($str);

	public function reforge($str);

	public function ago($till = null);
	
	public function until($till = null);
	
	public function toMySQL();
}

class Date{
	
	public static function forge($str = null){
		if(!class_exists("Date_".app("LANG.CLASS")))
			Date::loadDate(app("LANG.CLASS"));
		
		return call_user_func_array(array("Date_".app("LANG.CLASS"),"forge"),["str"=>$str]);
	}
	
	public static function loadDate($lang_code){
		if($lang_code == "en_GB"){
			require "Date.class".php;
		}else{
			$path = PATH_BASE.DS."language".DS.str_replace("_","-",$lang_code).DS."Date.class".php;
			if(file_exists($path)){
				require $path;
			}
			else{
				app("LANG.CLASS","en_GB");
				require "Date.class".php;
			}
		}
	}
}
