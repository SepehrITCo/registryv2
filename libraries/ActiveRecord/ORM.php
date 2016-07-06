<?php 
	
	class ORM{
		function __construct(){
			self::getModel();
		}
		public static $init = false;
		public static function getModel($component = false){
			
			if(!self::$init){
				IW::Lib("ActiveRecord");
				$cfg = ActiveRecord\Config::instance();
				$cfg->set_connections(
				  array('development' => config("DB.DRIVER") )
				);
				self::$init = true;
			}
			
			$back_trace = debug_backtrace();
			$path = "";
			if($component !== false)
				$path = PATH_BASE.DS."components".DS.$component.DS."models";
			else
			foreach($back_trace as $trace){
				if(isset($trace["file"])){
					$model_dir = dirname($trace["file"]).DS."models";
					if(file_exists($model_dir)){
						$path = $model_dir;
						break;
					}
				}
			}
		
			
			$models =  File::scanDir($path);
			foreach($models as $model){
				require_once	$path.DS.$model;
			}
			
		}
	}