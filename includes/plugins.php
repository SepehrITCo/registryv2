<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
class Plugins{
	private static $instance;
	private static $plugins = array();
	public static function onBeforeRender(&$context){
			$context = self::invokePlugins("onBeforeRender",$context);
			return $context;
	}

	public static function onPrepare(){
			$context = self::invokePlugins("onPrepare");
			return $context;
	}
	
	public static function onInit($context = ""){

			$context = self::invokePlugins("onInit",$context);
			return $context;
	}
	
	public static function onBeforeRoute(){
		
	}
	
	public static function onRoute(){
		
	}
	

	public static function onEvent(){
		
	}
	
	
	public static function onComponent(){
		self::invokePlugins("onComponent");
	}
	
	
	public static function getInstance(){
		if(self::$instance == null)
			self::$instance = new Plugins;
		return self::$instance;
	}
	
	public static function registerPlugin($plugin,$methods,$self_methods){
		
		foreach($methods as $method){
			if(in_array($method,$self_methods)){
				self::$plugins[$method][] = new $plugin;
			}
		}

		
	}
	
	public function init(){
		IW::Lib("File","Text");
		$instance = self::getInstance();
		
		$self_methods = get_class_methods("Plugins");
		for($i = 0; $i < count($self_methods); $i++){
			if(!Text::startsWith($self_methods[$i],"on")){ 
				unset($self_methods[$i]); 
				continue;
			}
			self::$plugins[$self_methods[$i]] = array();
		}
		
		$list = File::scanDir(PATH_BASE.DS."plugins");

		foreach($list as $plugin){
			$plg_path = PATH_BASE.DS."plugins".DS.$plugin.DS."$plugin".php;
	
			
			if(file_exists($plg_path)){
				require $plg_path;
	
				if(class_exists("Plugin_".$plugin))
					self::registerPlugin("Plugin_".$plugin,get_class_methods("Plugin_".$plugin),$self_methods);
			}
		}
	}
	
	public static function invokePlugins(){
	
		
		$args = func_get_args();
		$params = array();
		
		if(!isset($args[1])) $args[1] = "";

		if(count($args) > 1)
			for ($i = 1; $i < count($args); $i++) 
				$params[] = $args[$i];
		if(isset(self::$plugins[$args[0]]))
		foreach(self::$plugins[$args[0]] as $object)
			$args[1] = call_user_func_array(array($object,$args[0]),$params);

		return $args[1];
			
	}
}