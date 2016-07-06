<?php 

	function app($key,$v1 = null,$v2 = null){
		$app = App::getInstance();
		

		
		if($v1 != null){
			if($v2 != null){
				$value = (isset($v1[$v2]))?$v1[$v2]:null;
				$app->set($key , $value);
			}else{
				$app->set($key , $v1);
			}
		}else{

			return $app->get($key);
		}
	}
	
	class App extends DotNotation{
		private static $instance;
		public $storage = array();
		
			
		public static function getInstance(){
			if(self::$instance == null)
				self::$instance = new App();
			return self::$instance;
		}
		
		public static function forget($key){
			$instance = self::getInstance();
			$instance->remove($key);
		}

	}