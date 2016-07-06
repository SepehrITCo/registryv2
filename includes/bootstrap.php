<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
	class Bootstrap{
		public $template;
		public static function Run(){
			$instance = new Bootstrap();
			
			$instance->template();
			$instance->modules();

			$component = $instance->component();


			echo $instance->template->render();
			
		}

		private function template(){
			app("TEMPLATE.DIR",PATH_BASE.DS."templates".DS.config("IW.TEMPLATE"));
			

			IW::Lib("Template");
			$this->template = Template::getInstance();

			return $this->template;
		}

		private function modules(){
			IW::Lib("Modules");

			$blocks = getJSON(PATH_BASE.DS."config".DS."modules.json");
			if(count($blocks) > 0)
			foreach($blocks as $key=>$block){
				foreach($block as $module) {
					if ($module->state == 1) {
						$module_instance = Modules::getModule($module->module, $module->params);
						$view = $module_instance->getView();
						if($view){
							$this->template->addBlock($key,$view);

						}

					}
				}
			}
		}

		private function component(){
			Plugins::onComponent();
			$router = Router::getInstance();

			Plugins::onBeforeRoute();

			
			if(Auth::getUser()){
			
				$router->map( 'GET', 'error', function() {
					
					$error = require_ob( PATH_BASE.DS."static".DS."error".php );
					$this->template->addBlock("component",$error);
					
				});
			}else{
				$router->map( 'GET', 'error', function() {
					$this->template->custom_page(PATH_BASE.DS."static".DS."404".php);
				
				});	
			}
			
			//Registering routes
			IW::Lib("File");
			$components = File::scanDir(PATH_BASE.DS."components");
			foreach($components as $component){
				$path = PATH_BASE.DS."components".DS.$component. DS ;

				if(file_exists($path . "router" . php))
					require  $path . "router" . php;

			}

			
			$this->template->addBlock("component",$router->data);
		

			if( !$router->routed ) {
				Fail(404);
			}


		}
	}