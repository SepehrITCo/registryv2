<?php
	$router = Router::getInstance();
	
	$router->group("users",function($router){
	
		$router->map("GET","profile",function(){
			$user = Auth::getUserOrFail();
			return view("profile",["user"=>$user]);
		});	
		
		$router->map("POST","profile",function(){
			$user = Auth::getUserOrFail();
			return action("UserController.editProfile",false,["user"=>$user,"redirect"=>"users/profile"]);
		});	

		$router->map("GET","create",function(){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.create");
			return view("create");
		});	
		
		$router->map("GET","~q:[s:query]/~s:[i:size]/~p:[i:page]/~col:[s:col]/~sort:[s:sort]",function($query,$size,$page,$col,$sort){
			return action("UserController.viewUsers",false,[$size,$page,$query,$col,$sort]);
		});

		
		$router->map("GET","view/[i:id]",function($id){
			
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.edit");
			return view("user",["id"=>$id]);
		});
		
		$router->map("POST","create",function(){

			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.create");
		
			return action("UserController.createUser");
		});
		
		$router->map("POST","view/[i:id]",function($id){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.edit");
			$user = Auth::getUser($id);
			return action("UserController.editProfile",false,["user"=>$user,"redirect"=>"users/view/".$id]);
		});
		
		$router->map("GET","remove/[i:id]",function($id){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.edit");
			return action("UserController.deleteUser",false,compact("id"));
		});	
		$router->map("POST","find",function(){
			IW::Lib("Form");
			Form::checkToken();
			$search = Input::post("search","");
			if($search != ""){
				redirect("users/q:".$search);
			}else{
				redirect("users");
			}
		});
		$router->map("POST","profile.image",function(){
			$user = Auth::getUserOrFail();
			echo action("UserController.profileImage",false,["user"=>$user]);
			die;
		});

		$router->map("POST","profile.image/[i:id]",function($id){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.edit");
			$user = Auth::getUser($id);
			echo action("UserController.profileImage",false,["user"=>$user]);
			die;
		});
		
	});
	
	$router->group("roles",function($router){
		$router->map("GET","/create",function(){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.role");
			return view("role.create");
		});	
		
		$router->map("POST","create",function(){
			return action("UserController.createRole");
		});
		
		$router->map("GET","/",function(){
			return view("roles");
		});

		$router->map("GET","view/[i:id]",function($id){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("role.edit");
			return view("role",["id"=>$id]);
		});
		$router->map("POST","view",function(){
			return action("UserController.editRole");
		});
		$router->map("GET","remove/[i:id]",function($id){
			$me = Auth::getUserOrFail();
			$me->hasPermOrFail("user.role");
			return action("UserController.deleteRole",false,compact("id"));
		});
	});
	


	$router->map("POST","login",function(){
		return action("UserController.login");
	});

	$router->map("GET","login",function(){
		$user = Auth::getUser();
		if($user != null)
			redirect( "dashboard" );
		$template = Template::getInstance();
		$template->custom_page(app("TEMPLATE.DIR").DS."login.php");
		return "";
	});
	
	$router->map("GET","logout",function(){
		
		Auth::getUser()->logout();
		redirect("login",T("USERS.YOU_HAVE_LOGOUT"));
		return "";
	});

	$router->map("GET","forgot",function(){
		$user = Auth::getUser();

		if($user != null)
			redirect( "dashboard" );
		$template = Template::getInstance();
		$template->custom_page(app("TEMPLATE.DIR").DS."forgot.php");
		return "";
	});


	$router->map("GET","/bing",function(){
		app("VIEW.RAW",true);
		echo action("UserController.bing");
	});
