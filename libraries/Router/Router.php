<?php 

	
	class Router{
		var $uri;
		var $parts;
		var $method;
		var $group = 0;
		public $routed = false;
		var $selected = "";
		var $group_selected = "";
		public $data = "";
		private static $instance = null;
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new Router();
			}
			return self::$instance;
		}
		
		public function __construct(){

			$this->uri = app("REQUEST.URI");
			$this->parts = explode("/",$this->uri);
			$this->method = strtolower(app("REQUEST.METHOD"));
		}
		
		
		public function group($match,$function){
			$this->group = 0;
			$matched = true;
			$orig_match = $match;
			$match = explode("/",$match);

				for($i = 0; $i < count($match); $i++){
					
					if(isset($this->parts[$i]) && $match[$i] == $this->parts[$i]){
						$this->group = $i;
					}else{
						$matched = false;
						break;
					}
				}
			
			if($matched){
				$this->group++;
				$this->group_selected = $orig_match."/";
				$function($this);
			}
			$this->group = 0;
		}
		
				
		public function map($method,$match,$function){
		
			if($this->routed) return;
		
			$matches = explode("/",trim($match,"/"));
			$matched = true;
			$force = false;
			$extract = array();
			$late_match_count = 0;
			$EOR = false; //end of rules
			$orig_match = $match;
			$this->selected = $this->group_selected;
			$late_match = array();
			if( $this->matchMethod($method) ){	
					
				$j = $this->group;
			
				if($match == "/" && @$this->parts[$j] == ""){
							
					$matched = true;
					$force = true;
					$this->selected = "/";
				}elseif($match == "/" && count($this->parts)-$j > 1){
					$matched = false;
					
				}elseif($match != "/" && $match[0] != "~" && @$this->parts[$j] == ""){
					
					$matched = false;
						
				}else{
				
					for($i = 0; $i < count($matches); $i++){
						$match = $matches[$i];
					
						if($match == ""){
							$matched = false;
							break;
						}
			
						//check for match type
						if($match[0] == "[" && substr($match,-1) == "]" || $match[0] == ":"){
						
							if($EOR){
								$matched = false;
								break;
							}
								
							if(!isset($this->parts[$j])){
								$matched = false;
							}else{
								$chunks = explode(":",substr($match,1,-1));
								$var = $chunks[1];
								$value =  $this->parts[$j];
							
								$this->selected .= $value."/";
								switch ($chunks[0]){
									case "i": //integer
										if(is_numeric($value)){
											$extract[$var] = $value;
										}else{
											$matched = false;
										}
									break;
									case "a": //alphanumeric
										if(ctype_alnum($value)){
											$extract[$var] = $value;
										}else{
											$matched = false;
										}
									break;
									default:
										$extract[$var] = $value;
									break;
								}
							
							}
							$j++;
							
						//Late match	
						}elseif($match[0] == "~"){
							$late_match_count++;
							$parameters = array();
							preg_match("/^~(.+)\[(.+):(.+)\]/", $match, $parameters);
							
							$value = $this->extract_late_parameter($parameters[1],$parameters[2],$j);
							$extract[$parameters[3]] = $value;
							$late_match[] = $parameters[1];
							$EOR = true;
							$force = true;
							
						}else{
							if($EOR){
								$matched = false;
								break;
							}
								
							if($match == ""){
								
							}else{
							
								if($match != "*"){
									
									if($match != @$this->parts[$j]){
										$matched = false;
										
										break;
									}
								
									$this->selected .= $this->parts[$j]."/";
								}
								
									$j++;
							}
						}
					}
				}
				
			
					if(count($late_match) > 0)
					for($i = $j+1; $i < count($this->parts); $i++){
						$in_array = false;
						foreach($late_match as $match){
						
							if( strrpos($this->parts[$i], $match, -strlen($this->parts[$i])) !== false){
								$in_array = true;
							}
						
						}

						if(!$in_array){
							$matched = false;
						}
				}
				if($matched && ($force || $j == count($this->parts))){
			
					$this->routed = true;
					Plugins::onRoute();
					ob_start();
					$buffer = call_user_func_array($function,$extract);
					$buffer .= ob_get_contents();
					@ob_end_clean();
					if(app("VIEW.RAW")){
						echo $buffer;
						die;
					}
					$this->data = $buffer;
				}
				
			}
		}
		
		public function matchMethod($method){
			$methods = explode("|",strtolower($method));
			return in_array($this->method,$methods);
		}
		

		public function extract_late_parameter($match,$type,$index = 0){
			$pos = false;
			
			for($i = $index; $i < count($this->parts); $i++){
				$pos = strrpos($this->parts[$i], $match, -strlen($this->parts[$i]));
				if($pos !== false){
					$value =  substr($this->parts[$i],strlen($match));
					switch($type){
						case "i":
							$value = (int)$value;
						break;
						case "a":
							if(!ctype_alnum($value))
								return null;
						break;
					}
					return $value;
				}
			}
			return false;
		}
		
		public function onlyURL(){

			return $this->selected;
		}
		
		public static function param($match,$type = "s"){
			$router = self::getInstance();
			return $router->extract_late_parameter($match,$type);
		}
	}