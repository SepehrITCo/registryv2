<?php 

	$route = Router::getInstance();

	
	$route->map("GET","/dashboard",function(){
		$user = Auth::getUserOrFail();
		return view( "dashboard" , ["user"=>$user] );
	});
	
	$route->map("GET","/",function(){
		$user = Auth::getUserOrFail();
		return view( "dashboard" , ["user"=>$user] );
	});
	
	$route->map("GET","/notifications",function(){
		$user = Auth::getUserOrFail();
		return view( "notifications" , ["user"=>$user] );
	});