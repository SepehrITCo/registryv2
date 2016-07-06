<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
/**
	@Base class of IW
**/
class IW{
	private static $root;
	public static $URI;
	
	/**
		@description
			initialize necessary variables 
		@return void
	**/		
	public static function init(){
		IW::Lib("DotNotation");
		require "configuration.php";
		require "plugins.php";
		IW::Lib("App");
		Plugins::getInstance()->init();
		Plugins::onPrepare();
		IW::Lib("Router","Controller","Helper","Session","Notification","Cookie","Kint","Log","Input","Language");
		Session::getInstance();
		ob_start("Plugins::onBeforeRender");
		Plugins::onInit();
		self::$URI = trim(app("REQUEST.URI"),"/");
		$lang = Language::getLang();
		Language::getInstance( $lang );

		
	}
	

	
	
	
	/**
		@return root url of requested url 
	**/
	public static function root($url = null){
		if($url != null){
			self::$root = $url;
		}
		if(self::$root === null){
			
			$script_relative_url = explode("/",@$_SERVER["SCRIPT_NAME"]);
			$script_absolute_url =  explode("/",@$_SERVER["SCRIPT_URI"]);
			array_pop($script_relative_url);
			self::$root = trim("//".@$_SERVER["HTTP_HOST"].join("/",$script_relative_url),"/")."/";
			if(!empty($script_absolute_url[0])){
				self::$root = $script_absolute_url[0].self::$root;
			}
			else{

				self::$root = "//:".IW::$root;
			}
			
			
		}
		return self::$root;
	}
	
	/**
		@description
			flush ob cache after onRender
		@return null
	**/
	public static function render(){
		
		ob_end_flush();
	
	}
	
	public static function Lib(){
		$args = func_get_args();
		for ($i = 0; $i < count($args); $i++){
			$lib_dir = PATH_BASE.DS."libraries".DS.$args[$i].DS;
			$autoloader = $lib_dir . "autoload".php;
			if(file_exists($autoloader)){
				require_once $autoloader;
			}else{
				require_once($lib_dir.$args[$i].php);
			}
		}
	}
	
}