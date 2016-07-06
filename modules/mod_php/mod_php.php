<?php 
	class Module_php extends Modules{
		public function run(){
			$template = Template::getInstance();
			$template->addBlock("block1","<h1>hi</h1>");
		}
		
		public function render(){
			require PATH_BASE.DS.$this->get("PATH");
		}
	}