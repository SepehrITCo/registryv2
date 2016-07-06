<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
	class Plugin_app{

		
		public function onInit(){
			app("REQUEST.METHOD", $_SERVER, "REQUEST_METHOD");

			$chunks = explode( config("IW.BASE_PATH"), $_SERVER["REQUEST_URI"] );
			for($i = 0; $i < count($chunks); $i++)
				if($chunks[$i] == ""){
					unset($chunks[$i]);
				}
			
			app("REQUEST.URI", trim(implode("/",$chunks),"/") );
			
			app("REQUEST.IP", getIP() );
			app("REQUEST.RAW", true);
			app("PAGE.TITLE",config("IW.GLOBAL_NAME"));
			app("PAGE.H1",config("IW.GLOBAL_NAME"));
			
		
		}
		
		public function onComponent(){
			$seen = json_decode(Cookie::getInstance()->getRaw("seen"));
			if(!is_null($seen)){
				Notification::seen($seen);
			}
		}
	} 