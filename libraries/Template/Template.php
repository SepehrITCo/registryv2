<?php 
	class Template{
		public $html = false;
		private $blocks;
		private static $instance;

		
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance =  new Template();
				self::$instance->html = false;
				$language = Language::getInstance();
				if(file_exists(PATH_BASE.DS."language".DS.$language->language.DS."translate.js"))
					self::$instance->js("translate.js",IW_ROOT."/language/".$language->language."/");
				else
					self::$instance->js("translate.js",IW_ROOT."/language/en-GB/");
			}
			return self::$instance;
		}

		public function custom_page($page){
			$this->html = require_ob($page);
		}

		public function addBlock($block,$html){
			$this->blocks[$block][] = $html;
		}
		
		public function setBlocks($blocks){
			
			$this->blocks = $blocks;
		}
		
		public function setBlock($block,$html){
			if(is_string($html)) $html = array($html); 
			$this->blocks[$block] = $html;
		}
		
		public function __set($name,$value){
			$this->addBlock($name,$value);
		}

		public function script($script, $path = JS){
			$this->js($script,$path);
		}
		public function js($script, $path = JS){
				$this->addBlock("script", "<script language=\"javascript\" src=\"".$path.$script."\"></script>");
		}

		public function css($css, $attributes = null, $path = CSS){
			$this->addBlock("css", "<link rel=\"stylesheet\" href=\"".$path.$css."\" ".extract_attribute($attributes)." />");
		}

		
		public function render(){
			if(!$this->html){
				$this->html = require_ob( app("TEMPLATE.DIR").DS."index".php );	
			}

			return preg_replace_callback('/<module.+name="(.*)".+\/>/',
			function($match){
				if(!empty($this->blocks[$match[1]])){
					$buffer = "";
					foreach($this->blocks[$match[1]] as $block)
						$buffer .= $block;
					return $buffer;
				}else{
					return "";
				}
				
						
			}
			, $this->html);

		}
	}