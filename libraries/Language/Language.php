<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
/**
	@Language and all related functions
**/
class Language extends  DotNotation{
	public $language = "en-GB";
	protected $values = array();
	public static $instance;
	public static function getInstance($lang = "en-GB"){
		if(self::$instance == null)
			self::$instance = new Language($lang);
		return self::$instance;
	}

	public function __construct($lang = "en-GB")
	{
		$this->setLang($lang);
	}

	public function detectLanguage(){

	}
	
	public static function getLang(){
		$languages = self::getLangList();
		$map = array();
	
		foreach($languages  as $lang){
			$map[$lang] = getJSON(PATH_BASE.DS."language".DS.$lang.DS."map.json");
		}


		//Try User
		IW::Lib("Auth");
		$user = Auth::getUser();

		if($user && $user->lang != ""){
		
			$lang_code = self::searchMap($user->lang,$map);
			if($lang_code)
				return  $lang_code;
		}
		//Try cookie
		$cookie = Cookie::getInstance();
		if($cookie->exists("language")){
			$lang_code = self::searchMap($cookie->language,$map);
			if($lang_code)
				return  $lang_code;
		}

		//Try $_SERVER
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
		$lang_code = self::searchMap($lang,$map);
		if($lang_code)
			return  $lang_code;


		//ON Fail
		return config("IW.DEFAULT_LANG");

	}

	public static function searchMap($code,$map){
		$code = strtolower($code);

		foreach($map as $key=>$array){
			foreach($array as $item){
				if($code == strtolower($item)){
					return $key;
				}
			}
		}
		return false;
	}
	
	public function setLang($lang_code){
		$dir = PATH_BASE.DS."language".DS.$lang_code;
		if(file_exists($dir)){
			IW::Lib("Date");
			$translations = File::searchDir($dir,"*.translate.json");
			$this->values = array();
			foreach($translations as $translate){
				$json = file_get_contents($translate);
				$table = json_decode($json,true);
				if(is_array($table))
					$this->values = array_merge($table,$this->values);
			}
			
			$lang_class = str_replace("-","_",$lang_code);
			
			app("LANG.CLASS",$lang_class);
			app("LANG.CODE",$lang_code);
			$this->language = $lang_code;
			
			if(file_exists($dir.DS."config.json")){
				$json = file_get_contents($dir.DS."config.json");
				$data = json_decode($json,true);
				if(is_array($data)){
					
					$this->values["LANGUAGE"] = $data;
			
				}
			}
			
		}
	}

	public static function getLangList(){
		return File::scanDir(PATH_BASE.DS."language");
	}
	
	public function translate($text){
		return $this->get($text);
	}
	
	public function isRTL(){
		return $this->get("LANGUAGE.isRTL") ;
	}
}