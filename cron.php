<?php 
	
	define("_IW",1);
	define("DS","/");
	define('PATH_BASE', dirname(__FILE__));
	define("php",".php");
	define("REST",true);
	
	require "includes".DS."base".php;
	IW::init();
	require "includes".DS."constants".php;
	
	IW::Lib("Schedule");
	
	if(isset($_GET["fork"]))
		echo Schedule::fork();
	else
		echo Schedule::tick();