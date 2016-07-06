<?php 

	$route = Router::getInstance();

	$route->group("core",function($router){
		
		$router->map("GET","attachment/[i:id]",function($id){
			app("VIEW.RAW",true);
			return action( "CoreController.downloadAttachment", "core" , ["id"=>$id] );
		});
		
		$router->map("POST","attachment/[i:id]",function($id){
			app("VIEW.RAW",true);
			return action( "CoreController.removeAttachment", "core" , ["id"=>$id] );
			
		});
		
		$router->map("GET","installer/new",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.installer");
			return view("installer",["filter"=>"INSTALLER","install"=>true]);
		});
		
		$router->map("POST","installer",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.installer");
			return action( "CoreController.install" );
		});
		
		$router->map("GET","settings/~component:[s:component]",function($component){
		
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.settings");
			return action( "CoreController.viewSettings" , "core" , ["component"=>$component] );
		});
			
		
		$router->map("POST","settings/~component:[s:component]",function($component){
		
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.settings");
			return action( "CoreController.saveSettings" , "core" , ["component"=>$component] );
		});

		$router->map("GET","info",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.info");
			app("PAGE.H1",T("CORE.SYSTEM_INFO"));
			return view("info");
		});
		
		$router->map("GET","installer/~filter:[s:type]/~package:[s:package]",function($type,$package){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.installer");
			app("PAGE.H1",T("CORE.SYSTEM_INSTALLER"));
			if(!$type) $type = "components";
			return view("installer",["filter"=>$type,"package"=>$package]);
		});
		
		$router->map("GET","uninstall/~filter:[s:type]/~package:[s:package]",function($type,$package){

			return action( "CoreController.uninstall" , "core" , ["filter"=>$type,"package"=>$package] );
		});
		

		
	});
	

	//>Language Group
	$route->group("core/languages",function($router){
		
		$router->map("GET","[s:language]/[s:translation]/remove/[s:key]",function($language,$translation,$key){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return action( "CoreController.removeTranslationItem" , "core" ,  ["language"=>$language,"translation"=>$translation,"key"=>$key] );
		});
		
		$router->map("GET","[s:language]/[s:translation]/remove",function($language,$translation){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return action( "CoreController.removeTranslationFile" , "core" ,  ["language"=>$language,"translation"=>$translation] );
		});
		
		$router->map("GET","/",function(){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return view( "languages" );
		});
		
		$router->map("GET","[s:language]",function($language){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return view( "language" , ["language"=>$language,"translation"=>false] );
		
		});	

		$router->map("GET","[s:language]/create/[s:translation]",function($language,$translation){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return action( "CoreController.createTranslation" ,"core", ["language"=>$language,"translation"=>$translation] );
		});
		
		$router->map("POST","[s:language]/[s:translation]/create",function($language,$translation){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			app("VIEW.RAW",true);
			return action( "CoreController.createTranslationItem" ,"core", ["language"=>$language,"translation"=>$translation] );
		});
		
		$router->map("GET","[s:language]/[s:translation]",function($language,$translation){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return view( "language" , ["language"=>$language,"translation"=>$translation] );
		});
		
		
		$router->map("POST","[s:language]/[s:translation]",function($language,$translation){
			$user = Auth::getUserOrFail();
			$user->hasPermOrFail("core.language");
			return action( "CoreController.saveLanguage" , "core" ,  ["language"=>$language,"translation"=>$translation] );
		});		
		
	});
	//Language Group<	
