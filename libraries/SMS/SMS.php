<?php 
	
	class SMS{
		private static $instance;
        private $params,$driver;
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new SMS();
			}
			return self::$instance;
		}
		
		public function __construct(){
			$driver = config("SMS.DRIVER");
			$connection_string = config("SMS.CONNECTION_STRING");
            $array = explode(";",$connection_string);
            $this->params = array();
            foreach($array as $item){
                $chunks = explode(":",$item);
                if(count($chunks) == 2)
                    $this->params[$chunks[0]] = $chunks[1];
            }

			if(file_exists(__DIR__.DS."driver".DS.$driver.php)) {
                require __DIR__.DS."driver".DS.$driver.php;
                $this->driver = $driver;
            }
		}

        public function send($to,$message){
                if($this->driver == null){
                    Message::set(T("ERROR.MESSAGE_DRIVER_NOT_PERSISTENT"),ERROR);
                    return;
                }
                if(is_string($to))
                    $to = explode(",",$to);

                foreach($to as $item){
                    try {
                        $failed = !call_user_func_array(array($this->driver, "send"), ["to" => $item, "message" => $message, "params" => $this->params]);
                    }catch (Exception $ex){
                        $failed = true;
                    }
                    if($failed){
                        Message::set(T("ERROR.MESSAGE_CANT_SENT"),ERROR);
                        return;
                    }
                }

        }
		
		
	}
	
