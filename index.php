<?php 
/**
INNOWARE PROJECT 95
Project Started on 1395-01-03
**/	
	define("_IW",1);
	define("DS","/");
	define('PATH_BASE', dirname(__FILE__));
	define("php",".php");
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL | E_STRICT);
		
	require "includes".DS."base".php;
	
	IW::init();


	require "includes".DS."constants".php;
	require "includes".DS."bootstrap".php;
	
	Bootstrap::Run();
	
	IW::render();