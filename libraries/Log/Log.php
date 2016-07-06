<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
class Log{
	private static $instance;
	public static function getInstance(){
		if(self::$instance == null)
			self::$instance = new Log;
		return self::$instance;
	}
	
	public static function Warn($message,$data = null,$pkg = "log"){
		$logger = self::getInstance();
		$logger->assertLog($message,$data,$pkg,"Warn");
	}
	
	public static function Critical($message,$data = null,$pkg = "log"){
		$logger = self::getInstance();
		$logger->assertLog($message,$data,$pkg,"Critical");
	}		
	
	public static function Emergency($message,$data = null,$pkg = "log"){
		$logger = self::getInstance();
		$logger->assertLog($message,$data,$pkg,"Emergency");
	}
	
	public static function Info($message,$data = null,$pkg = "log"){
		
		$logger = self::getInstance();
		$logger->assertLog($message,$data,$pkg,"Info");
	}
	
	public function assertLog($message,$data = null,$pkg = "log",$type = "Info"){
		$log_path = config("IW.LOG_PATH").DS.$pkg.".html";
		$file = $this->openFile($log_path);
		$date = date("Y-m-d H:i:s");
		$data = $this->encapsule($data);
		$append = "\r\n<div class='log'>\r\n";
		$append .= "\r\n\t<div class='date'>".$date."</div>";
		$append .= "\r\n\t<div class='type ".strtolower($type)."'>".$type."</div>";
		$append .= "\r\n\t<div class='text'>".$message."</div>";
		$append .= "\r\n\t<div class='data'><pre><code>".$data."</code></pre></div>";
		$append .= "</div>\r\n";
		file_put_contents($log_path,$append,FILE_APPEND);
	}
	
	private function openFile($path){

		if(!file_exists($path)) 
			file_put_contents($path,file_get_contents(__DIR__.DS."log.head"));
	}	

	private function encapsule($data){
		return print_r($data,true);
	}
}