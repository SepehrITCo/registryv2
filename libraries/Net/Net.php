<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
class Net{
	
	public static function request($url,$post = array()){
		$post_params = array();
		foreach ($post as $key => &$val) {
		  if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);
	 
		$ch = curl_init();  
	 
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, count($post_string));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);    
	 
		$result = curl_exec($ch);
	 
		curl_close($ch);
		return $result;
	}
	
	public static function silentRequest($url,$post = array()){
		$post_params = array();
		foreach ($post as $key => &$val) {
		  if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);

		$parts=parse_url($url);

		$fp = fsockopen($parts['host'], 
			isset($parts['port'])?$parts['port']:80, 
			$errno, $errstr, 30);


		$out = "POST ".$parts['path']." HTTP/1.1\r\n";
		$out.= "Host: ".$parts['host']."\r\n";
		$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out.= "Content-Length: ".strlen($post_string)."\r\n";
		$out.= "Connection: Close\r\n\r\n";
		if (isset($post_string)) $out.= $post_string;

		fwrite($fp, $out);
		fclose($fp);
	}
	
	public static function jsonRequest($url,$post = array(),$assoc = true){
		return json_decode( self::request($url,$post) , $assoc );
	}
	
	public static function jsonSecureRequest($url,$post = array(),$assoc = true){
		IW::Lib("Crypt");
		$post["__UNIQUE__"] = Crypt::createToken(60);
		$return = self::request($url,$post) ;
		$result = json_decode($return , $assoc );
		
		if(!empty($result["__UNIQUE__"]) && $result["__UNIQUE__"] ==  $post["__UNIQUE__"] ){
			unset($result["__UNIQUE__"]);
			return $result;
		}
	}
	
}