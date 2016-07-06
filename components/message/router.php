<?php 

	$route = Router::getInstance();

	$route->group("message",function($router){
		$router->map("GET","compose",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.compose");
			return view( "compose" );
		});	
		
		$router->map("POST","compose",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.compose");
			return action("MessageController.compose");
		});		
		
		
		$router->map("GET","view/[i:id]",function($id){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.view");
			return action( "MessageController.getMessage" , "message" , ["id"=>$id] );
		});	
		
		$router->map("GET","forward/[i:id]",function($id){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.view");
			return view( "compose" , ["id"=>$id,"forward"=>true]);
		});	

		$router->map("GET","reply/[i:id]",function($id){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.compose");
			return view( "compose" , ["id"=>$id,"reply"=>true]);
		});	
		
		$router->map("GET","trash/[i:id]",function($id){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.view");
			return action( "MessageController.trashMessage" , "message" , ["id"=>$id] );
		});	
		
		$router->map("POST","trash",function($id){
			IW::Lib("Input");
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.view");
			return action( "MessageController.trashMessage" , "message" , ["id"=>Input::post("id"),"redirect"=>Input::post("redirect")] );
		});	
		
		$router->map("GET","/[s:box]",function($box){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("message.view");
			if(!in_array($box,["inbox","sent","trash","drafts"])) {
				Fail(404);
			}
			return view( "messages" ,["box"=>$box]);
		});		
		
		$router->map("POST","attachment",function(){
			$user = Auth::getUserOrFail();

			$user->hasPermOrFail("message.compose");
			app("VIEW.RAW",true);
			return action( "MessageController.attachment" );

		});
		
	});
	

	
