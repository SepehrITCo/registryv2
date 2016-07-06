<?php 
	
	class Modules extends DotNotation{
		protected $values = array();
		protected $path;
		
		public function boot(){
			return true;
		}
		public function run(){
			return true;
		}
		public function __construct($params = ""){
			if(is_string($params))
				$this->values = json_decode($params);
			else
				$this->values = toArray($params);
			$this->boot();
		}
		
		public function getView(){
			if($this->checkCondition()){
				ob_start();

				$this->run();
				$this->render();
				$buffer = ob_get_contents();
				@ob_end_clean();
				return $buffer;
			}else{
				return false;
			}
		}
		
		
		public function checkCondition(){
			return true;
		}
		
		public function getJSON(){
			return json_encode($this->values);
		}
		
		public function render(){
			require $this->path.DS."view".php;
		}
		
		public function getForm(){
			require $this->path.DS."form".php;
		}
		
		public static function getModule($module,$params = ""){
			$class = substr($module,4);
			if(!class_exists("Module_$class")){
				$path = PATH_BASE.DS."modules".DS.$module.DS.$module.php;
				if(file_exists($path)){
					require $path;
				}else{
					return $path;
				}
			}
			$reflector = new ReflectionClass("Module_$class");
			

			$obj = $reflector->newInstanceArgs(array($params));
			$obj->path = dirname($reflector->getFileName());
			return $obj;
		}
	}