<?php 
	class Input{
		public static function get($key,$default = ""){
			if(isset($_GET[$key])){
				return $_GET[$key];
			}else{
				return $default;
			}
		}
		
		public static function post($key,$default = ""){

			if(isset($_POST["form"][$key])){
				return $_POST["form"][$key];
			}else{
				return $default;
			}
		}
		
		public static function req($key,$default = ""){
			if(isset($_REQUEST["form"][$key])){
				return $_REQUEST["form"][$key];
			}else{
				return $default;
			}
		}
		
		public static function bind($model = false){
			if($model){
				$out = array();
				foreach($_REQUEST["form"] as $key=>$value){
					if(isset($model->{$key})){
						$out[$key] = $value;
					}
				}
				return $out;
			}else{
				return $_REQUEST["form"];
			}
		}

		public static function set($key,$value){
			$_REQUEST["form"][$key] = $value;
			$_POST["form"][$key] = $value;
		}

		public static function unbind($key){
			unset($_REQUEST["form"][$key],$_POST["form"][$key]);
		}
	}