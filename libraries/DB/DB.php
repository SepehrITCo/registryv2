<?php 
	
	IW::Lib("ActiveRecord");
	class DB{
		public static $instances = array();
		private $table;



		public static function table($table){
			$table = str_replace(array("-"," ","."),"_",$table);
			$class = "_".hash("crc32b",$table);
			if(!ctype_alnum($table)) return null;
			if(!isset(self::$instances[$table])){
				if(!file_exists(__DIR__.DS."models".DS.$table.php) || config("IW.DEVELOPER"))
					file_put_contents(   __DIR__.DS."models".DS.$table.php  , '<?php class '.$class.' extends ActiveRecord\Model{ static  $table_name = "'.$table.'";} ?>');
				withModel();
				self::$instances[$table] = new DB($class);
			}
			return self::$instances[$table] ;
		}
		
		public function __construct($table){
			$this->table = $table;
		}
		
		public function find(){
			return call_user_func_array(array($this->table,"find"),func_get_args());
		}
		public function first(){
			return call_user_func_array(array($this->table,"first"),func_get_args());
		}
		public function last(){
			return call_user_func_array(array($this->table,"last"),func_get_args());
		}		
		public function all(){
			return call_user_func_array(array($this->table,"all"),func_get_args());
		}

		public function create(){
			return call_user_func_array(array($this->table,"create"),func_get_args());
		}

		public function count(){
			return call_user_func_array(array($this->table,"count"),func_get_args());
		}

		public function model(){
			return call_user_func_array(array($this->table,"table"),func_get_args());
		}

		public static function Query($query){
			$adapter = ActiveRecord\ConnectionManager::get_connection();
			$connection = $adapter->connection;
			return $connection->query($query);
		}
	}