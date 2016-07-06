<?php 
	class CoreController{
		
		public function viewSettings($component){
			
			//scan all components for settings
			$components_dir = PATH_BASE.DS."components";
			$components = File::scanDir($components_dir);
			$settings = array();
			
			foreach($components as $com){
					if( file_exists($components_dir.DS.$com.DS."package".DS."settings".php) )
						$settings[] = $com;
			}
			
			app("PAGE.H1",T("CORE.SETTINGS"));
			if(!$component || $component == "") $component = "core";
			if(!file_exists($components_dir.DS.$component.DS."package".DS."settings".php))
				Fail( T("ERROR.RESOURCE_NOT_FOUND") );
			IW::Lib("Form");
			return view("settings",["settings"=>$settings,"current"=>$component]);
		}
		
		public function saveSettings($component){
			IW::Lib("Form");
			$components_dir = PATH_BASE.DS."components";
			if(!file_exists($components_dir.DS.$component.DS."package".DS."settings".php))
				Fail( T("ERROR.RESOURCE_NOT_FOUND") );
			


			Form::checkToken();
			unset($_POST["form"]["__TOKEN__"]);
			$load = new Configuration($component);
			app("core.temporary",$load->get(""));
			foreach($_POST["form"] as $key=>$value){
				app("core.temporary.".$key,$value);
			}
			
			$json = json_encode(app("core.temporary") , JSON_PRETTY_PRINT);
			file_put_contents(PATH_BASE.DS."config".DS.$component.".json",$json);
			$component_trans = T(strtoupper($component).".".strtoupper($component));
			Message::set(T("CORE.SETTINGS_SAVED",$component_trans),SUCCESS);
			redirect("core/settings/component:".$component);
		}
		
		public function uninstall($filter,$package){

			if( !in_array($filter, ["libraries","components","plugins","modules"]) || !$package || $package == "" || strlen($package) < 3 ){
				Message::set("ERROR.UNABLE_PROCCESS_COMMAND");
				redirect("core/installer");
			}

			$path = PATH_BASE.DS.$filter.DS.$package;
			if( file_exists($path.DS."package".DS."script".php) ){
				$action = "uninstall";
				require $path.DS."package".DS."script".php;
			}
			if( file_exists($path.DS."settings".php) ){
				@unlink(PATH_BASE.DS."config".DS.$package.".json");
			}
			File::rmDir($path);
			Message::set( T("CORE.SUCCESS_REMOVE") ,SUCCESS);
			redirect("core/installer/filter:$filter");
		}
		
		public function install(){
			IW::Lib("Upload","Zip");
			
			$temp = "install_".md5($_FILES["input"]["name"]);
			File::rmDir(PATH_BASE.DS."tmp".DS.$temp);
			@mkdir(PATH_BASE.DS."tmp".DS.$temp);
			$src = PATH_BASE.DS."tmp".DS.$temp.DS."source";
			$json = Upload::uploadFile("input",PATH_BASE.DS."tmp".DS.$temp);
			$result = json_decode($json);
			if( $result->success ){
				IW::Lib("Zip");
				File::rmDir($src);
				@mkdir($src);
				Zip::unzip($result->destination,$src);
			}
			

			$package = getJSON($src.DS."package".DS."package.json");
			
			if(isset($package->path) && strlen($package->path) >= 3 && in_array( $package->type."s",["components","plugins","libraries","modules"] )){
				if( file_exists($src.DS."package".DS."install") ){
					File::copy($src.DS."package".DS."install",PATH_BASE);
					File::rmDir($src.DS."package".DS."install");
				}
				$dest = PATH_BASE.DS.$package->type."s".DS.$package->path;
				@mkdir($dest);
				File::copy($src,$dest);
				
				if( file_exists($src.DS."package".DS."script".php) ){
					$action = "install";
					require $dest.DS."package".DS."script".php;
				}
				Message::set(T("CORE.SUCCESS_INSTALL",$package->name),SUCCESS);
				File::rmDir(PATH_BASE.DS."tmp".DS.$temp);
				redirect("core/installer/filter:".$package->type."s/package:".$package->path);
			}else{
				File::rmDir(PATH_BASE.DS."tmp".DS.$temp);
				Message::set(T("CORE.FAILED_INSTALL"),ERROR);
				redirect("core/installer/new");
			}
			
		}
		
		public function saveLanguage($language,$translation){
			IW::Lib("Form");
			Form::checkToken();
			$form = $_POST["form"];
			unset($form[0],$form["__TOKEN__"]);
			foreach($form as $key=>$value){
				app("TRANSLATION.TEMP.".$key,
					str_replace(array('\r','\n'),"\r\n",$value)
				);
			}
			$data = app("TRANSLATION.TEMP");
			$data = json_encode($data,JSON_PRETTY_PRINT);
			file_put_contents(PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json",$data);
			Message::set(T("CORE.LANGUAGE_TRANSLATION_SAVED"),SUCCESS);
			redirect( "core/languages/".$language."/".$translation );
		}
		
		public function createTranslation($language,$translation){
			$translation = trim(strtolower($translation));
			$file = PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json";
			if(file_exists($file)){
				Message::set( T("CORE.TRANSLATION_EXITS"),WARNING );
				redirect("core/languages/".$language."/".$translation);
			}else{
				file_put_contents($file,"{}");
				Message::set( T("CORE.TRANSLATION_CREATED"),SUCCESS );
				redirect("core/languages/".$language."/".$translation);
			}
		}
		public function createTranslationItem($language,$translation){
			
			$file = PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json";
			$trans = getJSON($file,true);
			app("TRANSLATION.TEMP",$trans);
			app("TRANSLATION.TEMP.".strtoupper(trim($_POST["head"])),str_replace(array('\r','\n'),"\r\n",$_POST["value"]));
			$data = app("TRANSLATION.TEMP");
			$data = json_encode($data,JSON_PRETTY_PRINT);
			file_put_contents($file,$data);
			return json_encode( array("success"=>true,"head"=>$_POST["head"],"value"=>$_POST["value"]) );
		}
		
		public function removeTranslationFile($language,$translation){
			$file = PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json";
			unlink($file);		
			Message::set(T("CORE.TRANSLATION.SUCCESS_REMOVE"),SUCCESS);
			redirect("core/languages/".$language);
		}
		
		public function removeTranslationItem($language,$translation,$key){
			$file = PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json";
			$trans = getJSON($file,true);
			app("TEMP",$trans);
			App::forget("TEMP.".$key);

			$data = app("TEMP");

			$data = json_encode($data,JSON_PRETTY_PRINT);
			file_put_contents($file,$data);
			redirect("core/languages/".$language."/".$translation);		
		}	

		public function downloadAttachment($id){
			IW::Lib("Downloader");
			$downloader = new Downloader();
			$downloader->start($id);
		}
		
		public function removeAttachment($id){
			IW::Lib("Downloader");
			$downloader = new Downloader();
			$result = $downloader->remove($id);
			return json_encode($result);
		}
	}