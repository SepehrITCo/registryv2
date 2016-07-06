<?php

class Downloader{

	public function remove($id){
		withModel();
		$user = Auth::getUser();
		$result = ["status"=>false];
		if($user == null)
			return $result;
		$download = Download::find("first",["conditions"=>["id=? AND uid=?",$id,$user->id]]);
	
		if( $download != null ){
			unlink($download->path);
			$download->delete();
			$result["status"] = true;
		}
		return $result;
		
	}
	
	public function start($id){
		withModel();

		$download = Download::find("first",["conditions"=>["id=?",$id]]);

		if(!$download){
			die("INVALID REQUEST");
		}

		$this->serve($download->path,$download->name);
		
		exit;
	}
	
	public function settle($id){
		withModel();
		$download = Download::find("first",["conditions"=>["id=?",$id]]);
		$download->settle = 1;
		$download->save();
	}
	
	public function create($path,$filename,$hash){
		withModel();
		$type = File::getFileType($filename,$path);
		$download = new Download();
		$download->uid = Auth::getUser()->id;
		$download->name = $filename;
		$download->path = $path;
		$download->hash = $hash;
		$download->size = filesize($path);
		$download->ext = $type->ext;
		$download->mime = $type->mime;
		$download->save();
		return $download;
	}
	
	public function find($id){
		withModel();
		$download = Download::find("first",["conditions"=>["id=?",$id]]);
		$result["size"] = Text::formatBytes($download->size);
		$visualizer = File::visualizer($download->path,$download->ext);
		$result["icon"] = $visualizer["icon"];
		$result["thumb"]= $visualizer["thumb"];
		IW::Lib("Text");
		$result["name"] = $download->name;
		$result["ext"] = $download->ext;
		$result["id"] = $download->id;
		return (object)$result;
	}
	
	function serve($fileLocation, $fileName , $maxSpeed = 10240, $doStream = false) {
            if (connection_status() != 0)
                return(false);
        //    in some old versions this can be pereferable to get extention
        //    $extension = strtolower(end(explode('.', $fileName)));
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);

            header("Cache-Control: public");
            header("Content-Transfer-Encoding: binary\n");
            header('Content-Type: application/octet-stream');

            $contentDisposition = 'attachment';

            if ($doStream == true) {
                /* extensions to stream */
                $array_listen = array('mp3', 'm3u', 'm4a', 'mid', 'ogg', 'ra', 'ram', 'wm',
                    'wav', 'wma', 'aac', '3gp', 'avi', 'mov', 'mp4', 'mpeg', 'mpg', 'swf', 'wmv', 'divx', 'asf');
                if (in_array($extension, $array_listen)) {
                    $contentDisposition = 'inline';
                }
            }

            if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
                $fileName = preg_replace('/\./', '%2e', $fileName, substr_count($fileName, '.') - 1);
                header("Content-Disposition: $contentDisposition;
                    filename=\"$fileName\"");
            } else {

                header("Content-Disposition: $contentDisposition;
                    filename=\"$fileName\"");
            }

            header("Accept-Ranges: bytes");
            $range = 0;
            $size = filesize($fileLocation);

            if (isset($_SERVER['HTTP_RANGE'])) {
                list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
                str_replace($range, "-", $range);
                $size2 = $size - 1;
                $new_length = $size - $range;
                header("HTTP/1.1 206 Partial Content");
                header("Content-Length: $new_length");
                header("Content-Range: bytes $range$size2/$size");
            } else {
                $size2 = $size - 1;
                header("Content-Range: bytes 0-$size2/$size");
                header("Content-Length: " . $size);
            }

            if ($size == 0) {
                die('Zero byte file! Aborting download');
            }
			if (version_compare(PHP_VERSION, '5.3.0', '<')) {
				$mqr=get_magic_quotes_runtime();
				set_magic_quotes_runtime(0);
			}
            $fp = fopen("$fileLocation", "rb");

            fseek($fp, $range);
	
            while (!feof($fp) and ( connection_status() == 0)) {
                set_time_limit(0);
                print(fread($fp, 1024 * $maxSpeed));
                flush();
                ob_flush();
                sleep(1);
            }
            fclose($fp);

            return((connection_status() == 0) and ! connection_aborted());
        }
}

