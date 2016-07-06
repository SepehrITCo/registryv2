<?php 
	define("SUCCESS","success");
	define("ERROR","error");
	define("NOTIFY","notify");
	define("WARNING","warning");

	class Message{
		public static function set($message,$type){
			switch($type){
				case "success":
					self::success($message);
				break;
				case "notify":
					self::notify($message);
				break;
				case "error":
					self::error($message);
				break;
				case "warning":
					self::warning($message);
				break;
				default:
					self::notify($message);
				break;
			}
		}
		
		public static function notify($message){
			self::set_session($message,"notify");
		}
		
		public static function error($message){
			self::set_session($message,"error");
		}	
		
		public static function success($message){

			self::set_session($message,"success");
		}

		public static function warning($message){
			self::set_session($message,"warning");
		}
		
		private static function set_session($message,$type){
			if(trim($message) == "") return;
			$session = Session::getInstance();
			$array = $session->get($type);
			if(!is_array($array)) $array = array();
			$array[] = $message;
			$session->set($type,$array);
		}
		
		public static function get($type = "notify"){
			$session = Session::getInstance();
			$array= $session->get($type);
			if(is_array($array)){
				$html = "<ul>";
				foreach($array as $item){
					$html .= "<li>".$item."</li>";
				}
				$html .= "</ul>";
				$session->set($type,null);
				return $html;
			}
			
			return false;
		}
	}

	class Notification{

		public static function set($title,$message,$icon = false,$color = "text-yellow",$url = false,$user = false){
			if(!$user)
				$user = Auth::getUser();
			if(!$icon)
				$icon = "";
			if(!$url)
				$url = "";
			return
				DB::table("notification")->create([
					"users_id"=>$user->id,
					"title"=>$title,
					"message"=>$message,
					"icon"=>$icon,
					"color"=>$color,
					"url"=>$url
				]);
		}

		public static function get($user = false,$unseen = true){
			if(!$user)
				$user = Auth::getUser();
			$seen = ($unseen)?[0]:[0,1];
			return
				DB::table("notification")->find("all",["conditions"=>["users_id=? AND seen=(?)",$user->id,$seen]]);
		}

		public static function seen($id){
			

			if(is_array($id) && count($id) > 0){

				$user = Auth::getUser();
				$result = DB::table("notification")->find("all",["conditions"=>["users_id=? AND id IN (?)",$user->id,$id],"order"=>"id desc","limit"=>6]);
				if($result){
					foreach($result as $item){
						$item->seen = 1;
						$item->seen_date = date("Y-m-d H:i:s");
						$item->save();
					}
				}
			}



		}

	}
	