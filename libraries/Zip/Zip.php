<?php 

	class Zip{
		
		public static function unzip($src,$dest){
			
			$zip = new ZipArchive;
			$res = $zip->open($src);
			if ($res === TRUE) {
			  $zip->extractTo($dest);
			  $zip->close();
			  return true;
			} else {
			  return false;
			}
			
		}
	}