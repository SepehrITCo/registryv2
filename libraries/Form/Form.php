<?php 
	IW::Lib("Crypt");
	class Form{
		public static $model;
		private $isElement = false;
		private $element;
		private $element_path;
		public $attribute = array();
		public $label = "";
		public $pre = "";
		public $post = "";
		public $options;
		public $selected = array();
		public $name;
		public $label_size = "2";
		public $input_size = "10";

		public static function createToken($age = 600){
			$token = Crypt::createToken($age,app("REQUEST.IP"));
			return self::hidden("__TOKEN__",$token);
			
		}
		
		public static function create($name){
			$form = self::_("form","",$name);
			$form->attribute["class"] = "";
			return $form;
		}

		public static function close(){
			return "</form>";
		}
		
		public static function checkToken(){
			$token = Input::post("__TOKEN__");
			unset($_POST["__TOKEN__"]);
			
			if(!Crypt::validateToken($token,app("REQUEST.IP")))
				Fail("error",T("FORM.INCORRECT_TOKEN"));
		}
		
		public static function hidden($name,$value){
			return "<input type=\"hidden\" name=\"form[$name]\" value=\"$value\" />";
		}

		public function addClass($input){
			if(!isset($this->attribute["class"]))
				$this->attribute["class"] = "";
			$this->attribute["class"] .= " ".$input;
			return $this;
		}

		public function attribute($key,$value = false){
			if($value){
				$this->attribute[$key] = $value;
				return $this;
			}else{
				if(isset( $this->attribute[$key] )) {
					return $this->attribute[$key];
				}
				return "";
			}
		}

		public function name($name){
			$this->name = $name;

			$this->attribute("name","form[".$name."]");

			$this->attribute("id",$name."-id");
			return $this;
		}

		public function label($label){
			$this->label = $label;
			if(empty($this->attribute("placeholder")))
				$this->attribute("placeholder",$label);
			return $this;
		}

		public function setSize($label,$input){
			$this->label_size = $label;
			$this->input_size = $input;
			return $this;
		}

	

		public function maxlength($maxlength){
			return $this->attribute("max-length",$maxlength);
		}

		public function minlength($minlength){
			return $this->attribute("min-length",$minlength);
		}

		public function multiple(){
			$this->attribute("multiple",true);
			$this->name($this->name);
			return $this;
		}

		public function size($size){
			return $this->attribute("size",$size);
		}

		public function min($min){
			return $this->attribute("min",$min);
		}

		public function max($max){
			return $this->attribute("max",$max);
		}

		public function between($min,$max){
			 return $this->attribute("min",$min)->attribute("max",$max);
		}

		public function value($value){
			if($value) {
				return $this->attribute("value", $value);
			}else{
				return $this;
			}
		}

		public function mask($mask){
			return $this->attribute("mask",$mask);
		}

		public function length($length){
			return $this->attribute("max-length",$length);
		}

		public function required(){
			return $this->attribute("required",true);
		}

		public function active($dependency){
			return $this->attribute("active-depend",$dependency);
		}

		public function visible($dependency){
			return $this->attribute("visible-depend",$dependency);
		}


		public function placeholder($label){
			return $this->attribute("placeholder",$label);
		}

		public function confirm($element_name){
			return $this->attribute("confirm",$element_name);
		}
		public function pre($text){
			$this->pre = '<span class="input-group-addon">'.$text.'</span>';
			return $this;
		}

		public function post($text){
			$this->post = '<span class="input-group-addon">'.$text.'</span>';
			return $this;
		}

		public function large(){
			$this->addClass("input-lg");
			return $this;
		}

		public function small(){
			$this->addClass("input-sm");
			return $this;
		}

		public function disable(){
			$this->attribute("disabled",true);
			return $this;
		}

		public function readonly(){
			$this->attribute("readonly",true);
			return $this;
		}
		public function onclick($onclick){
			$this->attribute("onclick",$onclick);
			return $this;
		}
		public function options($options){
			$this->options = array();
			foreach($options as $key=>$value){
				$this->options[$key] = $value;
			}
			return $this;
		}
	
		public function select($select){
			if(is_array($select)){
				$this->selected = array_merge($this->selected,$select);
			}else {
				$this->selected[] = $select;
			}
			return $this;
		}

		public function method($method){
			return $this->attribute("method",strtolower($method));
		}

		public function action($action){
			return $this->attribute("action",$action);
		}


		function __call($name, $args)
		{
			if($this->isElement){

			}else {
				$path = __DIR__ . DS . "fields" . DS . $name . php;
				if (file_exists($path)) {
					$obj = new Form(true);
					$obj->element_path = $path;
					$obj->element = $name;
					return $obj;
				}
			}

			return null;
		}

		public static function _($element,$label = "",$name = ""){
			$path = __DIR__ . DS . "fields" . DS . $element . php;

			if (file_exists($path)) {
				$obj = new Form(true);
				$obj->element_path = $path;
				$obj->element = $element;
				$obj->label($label);
				$obj->name($name);

				return $obj;
			}

			return false;

		}
		function __construct($isElement = false)
		{
			$this->addClass("form-control");
		}

		public function __toString()
		{
			$this->attribute["class"] = trim($this->attribute["class"]);
			return require_ob_extract($this->element_path,["element"=>$this]);
		}

	
	}