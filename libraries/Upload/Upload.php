<?php 
	IW::Lib("Image");
	class Upload{
		public static function uploadImage($name,$destination,$crop = false,$thumb = false,$size = 9){
			$file = $_FILES[$name];
			$result = array("success"=>false);
			if ($file['error'] !== UPLOAD_ERR_OK) {
				$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD.".$file['error']);
			}else{
				if(!self::isImage($name)){
					$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD_ERROR_FILE_TYPE");
				}elseif(!self::isFileSize($name,$size)){
					$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD_ERROR_FILE_SIZE" , $size );
				}else{
					
					if(is_array($crop)){
						$image = new Image($file["tmp_name"]);
						$dest = $crop["dest"];
						$width = (int)@$crop["width"];
						$height = (int)@$crop["height"];
						$image->thumbnail($width, $height);
						$image->save($dest);
						$result["crop_url"] = str_replace(PATH_BASE,IW_ROOT,$dest)."?".time();
					}
					if(is_array($thumb)){
						$image = new Image($file["tmp_name"]);
						$dest = $thumb["dest"];
						$width = (int)@$thumb["width"];
						$height = (int)@$thumb["height"];
						if($width == 0)$width = 200;
						if($height == 0)$height = 200;
						$image->thumbnail($width, $height);
						$image->save($dest);
						$result["thumb_url"] = str_replace(PATH_BASE,IW_ROOT,$dest)."?".time();
					}
					if($destination){
						move_uploaded_file($file["tmp_name"],$destination);
						$result["url"] = str_replace(PATH_BASE,IW_ROOT,$destination)."?".time();
					}
					$result["success"] = true;
				}
			}
			return json_encode($result);
		}

		public static function isImage($name){
			$info = getimagesize($_FILES[$name]['tmp_name']);
			if ($info === FALSE) 
				return false;
			
			if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) 
				return false;
			
			return true;
		}
		
		public static function isFileType($name,$allow){
			if($allow === false || $allow === true) return true;
			$ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
			return in_array($ext,$allow);
		}
		
		public static function isFileSize($name,$size){
			$size *= 1048576;
			if($_FILES[$name]['size'] > $size) return false;
			return true;
		}
		
		public static function uploadFile($name,$destionation_dir,$file_name = false,$ext = false,$allow = array("zip","pdf","doc","docx","ppt","pptx","xls","xlsx","csv"),$size = 1){
			
			$file = $_FILES[$name];
			$result = array("success"=>false);
			if ($file['error'] !== UPLOAD_ERR_OK) {
				$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD.".$file['error']);
			}else{
				if(!self::isFileType($name,$allow)){
					$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD_ERROR_FILE_TYPE");
				}elseif(!self::isFileSize($name,$size)){
					$result["error"] = T("FORM.UPLOAD_ERROR").T("FORM.UPLOAD_ERROR_FILE_SIZE" , $size );
				}else{
					
					$destination = trim($destionation_dir,DS);
					if($file_name != false){
						$destination .= DS.$file_name;
					}else{
						
						$destination .= DS.$file["name"];
					}
					
					if($ext != false){
						$destination .= ".".trim($ext,".");
					}elseif($file_name != false){
						$destination .= ".".pathinfo($file['name'], PATHINFO_EXTENSION);
					}
					$success = move_uploaded_file($file['tmp_name'],$destination);
					$result["success"] = $success;
					$result["destination"] = $destination;
					$result["url"] = str_replace(PATH_BASE,IW_ROOT,$destination);
					$result["file"] = basename($destination);
				}
			}
			return json_encode($result);
		}
		
	}