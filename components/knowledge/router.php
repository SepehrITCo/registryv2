<?php 

	$route = Router::getInstance();

	
	$route->map("GET","/knowledge",function(){
		$user = Auth::getUserOrFail();
		$user->hasPermOrFail("knowledge.view");
		return view( "search" );
	});
	
