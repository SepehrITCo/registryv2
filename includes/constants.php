<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
	
define("VERSION","1.0.0.0");
define("RELEASE_DATE","1395-01-03");


$config = Configuration::getInstance();

if($config->get("IW.ROOT_AUTO_DETECT")){
	define("IW_ROOT",IW::root());
}
else{
	define("IW_ROOT",$config->get("IW.ROOT"));
	IW::root($config->get("IW.ROOT"));
}


define("Files",PATH_BASE.DS."files");

define("CSS",IW_ROOT.DS."media".DS."css".DS);
define("JS",IW_ROOT.DS."media".DS."js".DS);



