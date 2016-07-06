<?php 
	IW::Lib("Template");
	$t = Template::getInstance();
	$t->css("bootstrap.min.css");
	$t->css("font-awesome.min.css");
	$t->css("iCheck.square.blue.css");
	$t->css("select2.min.css");
	$t->css("AdminLTE.min.css");
	$t->css("skin.min.css");
	$t->css("apprise.css");
	$t->css("custom.css");
	$t->js("bootstrap.min.js");
	$t->js("icheck.min.js");
	$t->js("jquery.slimscroll.min.js");
	$t->js("fastclick.js");
	$t->js("jquery.cookie.js");
	$t->js("select2.full.min.js");
	$t->js("apprise.js");
	$t->js("app.min.js");
	

	
	IW::Lib("Auth");
	echo "<script language='javascript' src='".JS.DS."jquery-2.2.3.min.js"."'></script>";
	$user = Auth::getUser();
	
	$language = language::getInstance();
	if($language->isRTL()){
		$t->css("rtl.css");
		$t->css("yekan.css");
	}