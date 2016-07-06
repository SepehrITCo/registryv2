<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );

class File{
	public static function scanDir($dir){
		if(trim($dir) == "" || !is_dir($dir)) return [];
		$result = scandir($dir);
		unset($result[0]);
		unset($result[1]);
		return $result;
	}

	public static function searchDir($dir,$criteria = null){
		if($criteria != null){
			return glob($dir.DS.$criteria);
		}else {
			return glob($dir.DS."*");
		}

	}

	public static function olderThan($file,$age){
		return (time()-filemtime($file)) > $age;
	}
	
	public static function rmDir($dir) { 
	   if (is_dir($dir)) { 
		 $objects = scandir($dir); 
		 foreach ($objects as $object) { 
		   if ($object != "." && $object != "..") { 
			 if (is_dir($dir."/".$object))
			   self::rmDir($dir."/".$object);
			 else
			   unlink($dir."/".$object); 
		   } 
		 }
		 rmdir($dir); 
	   } 
	 }
	 
	public static function copy($src,$dst) { 
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					self::copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	} 
	

    public static function getFileType($filename,$path = false) {

        $mime_types = [

            'txt' => ["mime"=>'text/plain'],
            'htm' => ["mime"=>'text/html'],
            'html' => ["mime"=>'text/html'],
            'php' => ["mime"=>'text/html'],
            'css' => ["mime"=>'text/css'],
            'js' => ["mime"=>'application/javascript'],
            'json' => ["mime"=>'application/json'],
            'xml' => ["mime"=>'application/xml'],
            'swf' => ["mime"=>'application/x-shockwave-flash'],
            'flv' => ["mime"=>'video/x-flv'],

            // images
            'png' => ["mime"=>'image/png'],
            'jpe' => ["mime"=>'image/jpeg'],
            'jpeg' => ["mime"=>'image/jpeg'],
            'jpg' => ["mime"=>'image/jpeg'],
            'gif' => ["mime"=>'image/gif'],
            'bmp' => ["mime"=>'image/bmp'],
            'ico' => ["mime"=>'image/vnd.microsoft.icon'],
            'tiff' => ["mime"=>'image/tiff'],
            'tif' => ["mime"=>'image/tiff'],
            'svg' => ["mime"=>'image/svg+xml'],
            'svgz' => ["mime"=>'image/svg+xml'],

            // archives
            'zip' => ["mime"=>'application/zip'],
            'rar' => ["mime"=>'application/x-rar-compressed'],
            'exe' => ["mime"=>'application/x-msdownload'],
            'msi' => ["mime"=>'application/x-msdownload'],
            'cab' => ["mime"=>'application/vnd.ms-cab-compressed'],

            // audio/video
            'mp3' => ["mime"=>'audio/mpeg'],
            'qt' => ["mime"=>'video/quicktime'],
            'mov' => ["mime"=>'video/quicktime'],

            // adobe
            'pdf' => ["mime"=>'application/pdf'],
            'psd' => ["mime"=>'image/vnd.adobe.photoshop'],
            'ai' => ["mime"=>'application/postscript'],
            'eps' => ["mime"=>'application/postscript'],
            'ps' => ["mime"=>'application/postscript'],

            // ms office
            'doc' => ["mime"=>'application/msword'],
            'rtf' => ["mime"=>'application/rtf'],
            'xls' => ["mime"=>'application/vnd.ms-excel'],
            'ppt' => ["mime"=>'application/vnd.ms-powerpoint'],

            // open office
            'odt' => ["mime"=>'application/vnd.oasis.opendocument.text'],
            'ods' => ["mime"=>'application/vnd.oasis.opendocument.spreadsheet'],
        ];

		$chunks = explode('.',$filename);
		$ext = array_pop($chunks);
		$ext = strtolower($ext);

        if (array_key_exists($ext, $mime_types)) {
            $result = $mime_types[$ext];
			$result["ext"] = $ext;
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
			if(!$path)
				$mimetype = finfo_file($finfo, $filename);
			else
				$mimetype = finfo_file($finfo, $path);
            finfo_close($finfo);
			$result = [];
            $result["mime"] = $mimetype;
			$result["ext"] = $ext;
        }
        else {
			$result = [];
            $result["mime"] = 'application/octet-stream';
			$result["ext"] = $ext;
        }
		return (object)$result;
    }
	
	public static function visualizer($file , $ext ,$params = ["width"=>250,"height"=>166]){
		//thumb , icon
		if( in_array($ext,["jpg","jpeg","png","gif","tif","jpe","tiff"]) ){
			IW::Lib("Image");
			$icon = "camera";
			$dest = PATH_BASE.DS."files".DS."thumb".DS.basename($file).".vis.".$ext;
			if(!file_exists($dest)){
				$image = new Image($file);
				$width = ((int)$params["width"] == 0)?250:$params["width"];
				$height = ((int)$params["height"] == 0)?140:$params["height"];
				$image->thumbnail($width, $height);
				$image->save($dest);
			}
			$thumb = str_replace(PATH_BASE,IW_ROOT,$dest)."?".time();
		}else{
			$icon = "paperclip";
			$thumb = "icon:file-o";
			switch($ext){
				case in_array($ext,["doc","docx","rtf"]): 
					$thumb = "icon:file-word-o";
				break;
				case "pdf": 
					$thumb = "icon:file-pdf-o";
				break;
				case in_array($ext,["zip","rar","7z","tar","gz","iso"]): 
					$thumb = "icon:file-archive-o";
				break;	
				case in_array($ext,["mp3","wav","wma","ogg","mid","midi"]): 
					$thumb = "icon:file-audio-o";
				break;
				case in_array($ext,["mp3","xls","xlsx","ods","xlt"]): 
					$thumb = "icon:file-excel-o";
				break;		
				case in_array($ext,["ppt","pot","pps","pptx","pptm","ppsx","sldx"]): 
					$thumb = "icon:file-powerpoint-o";
				break;	
				case in_array($ext,["mov","mkv","mp4","wmv","avi","vob","webm","flv","swf"]): 
					$thumb = "icon:file-video-o";
				break;		
				case in_array($ext,["php","html","htm","asp","aspx","c","py","tpl","css","js","json","xml","txt","jar","pyx","matlab"]): 
					$thumb = "icon:file-code-o";
				break;					
			}
			
			
		}
		return ["icon"=>$icon,"thumb"=>$thumb];
		
	}
}