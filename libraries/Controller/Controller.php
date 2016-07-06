<?php 

	class Controller{
		private static $instance = array();
		
		public static function getInstance($controller = "Controller",$component = false){
			$back_trace = debug_backtrace();
			$path = "";
			foreach($back_trace as $trace){
				if(isset($trace["file"])){
					if(dirname($trace["file"]) == __DIR__) continue;
					$controller_dir = dirname($trace["file"]).DS."controller".php;
					if(file_exists($controller_dir)){
						$path = $controller_dir;
						break;
					}
				}
			}

			if($component != false){
				$path = PATH_BASE.DS."components".DS.$component.DS."controller".php;
			}

			require_once $path;
			if(!isset(self::$instance[$controller])){
				self::$instance[$controller] = new $controller;
			}
			return self::$instance[$controller];
		}
		
		public static function callAction($controller_action,$component = false,$params = array()){

			list($controller,$action) = explode(".",$controller_action);
			$instance = self::getInstance($controller,$component);
	

			return call_user_func_array(array($instance,$action),$params);
		}

		public static function getView($view,$params = array(),$component = null){
			$back_trace = debug_backtrace();
			$path = "";
			foreach($back_trace as $trace){
				if(isset($trace["file"])){
					$view_dir = dirname($trace["file"]).DS."views";
					if(file_exists($view_dir)){
						$path = $view_dir;
						break;
					}
				}
			}

			if(!file_exists($path) && $component != null)
				$path = PATH_BASE.DS."components".DS.$component.DS."views";
			return require_ob( $path.DS.$view.php , $params );

		}
		
	
	}