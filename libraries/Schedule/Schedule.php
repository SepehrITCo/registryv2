<?php 
	
	define("ONE_TIME",1);
	define("EVERY_TIME",2);
	
	class Schedule extends ORM{
		
		public static $forks = array();
		public static $done = true;
		
		public static function create($component,$controller,$method,$params,$run_on,$type = ONE_TIME,$interval = 0){
			withModel();
			$schedule = new ScheduleModel();
			$schedule->component = $component;
			$schedule->controller = $controller;
			$schedule->method = $method;
			$schedule->params = serialize($params);
			$schedule->run_on = date("Y-m-d H:i:s", $run_on );
			$schedule->type = $type;
			$schedule->interval = $interval;
			$id = $schedule->save();
			$schedule->token = md5( $component.$controller.$method.$id );
			$schedule->save();
		}
		

		public static function tick(){
			withModel();
			IW::Lib("Crypt");
			$items = ScheduleModel::find("all",["conditions"=>[ "run_on <= ?",new \DateTime()]]);
			$url = array();
			foreach($items as $item){
				$url[] = config("IW.ROOT")."/cron.php?fork=".Crypt::encode($item->id.":".$item->token);
			}
			self::callForks($url);
			echo json_encode(["status"=>true,"date"=>time()]);
			
			
		}
		
		public static function fork(){
			IW::Lib("Crypt");
			withModel();
			$hash = Crypt::decode($_GET["fork"]);
			list($id,$token) = explode(":",$hash);
			$item = ScheduleModel::find("last",["conditions"=>[ "id=? AND token=?",$id,$token]]);
			if($item){
				
				
				
				$params = unserialize($item->params);
				if($params == null){ $params = array(); }
				$controller = $item->controller;
				$method = $item->method;
				$component = $item->component;
				
				
				if($item->type == ONE_TIME){
					$item->delete();
				}else{
					$item->run_on = date("Y-m-d H:i:s", strtotime($item->run_on) + (int)$item->interval );
					$item->created_on = date("Y-m-d H:i:s");
					$item->save();
				}
				
				action($controller.".".$method,$component,$params);
				
				echo json_encode(["status"=>true,"time"=>time()]);
			}else{
				echo json_encode(["status"=>false,"time"=>time()]);
			}
			
			
		}
		
		private static function callback($data,$info){
			self::$forks[] = $data;
			
		}
		
		public static function callForks($urls) {
			self::$done = false;
			$handle = curl_multi_init();
			foreach ($urls as $url) {
				$ch = curl_init($url);
				curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_USERAGENT=>"INNOWARE"
				
				]);
				curl_multi_add_handle($handle, $ch);
			}

			do {
				$mrc = curl_multi_exec($handle, $active);

				if ($state = curl_multi_info_read($handle)) {

					$info = curl_getinfo($state['handle']);

					self::callback(curl_multi_getcontent($state['handle']), $info);
					curl_multi_remove_handle($handle, $state['handle']);
				}

				usleep(10000); // stop wasting CPU cycles and rest for a couple ms

			} while ($mrc == CURLM_CALL_MULTI_PERFORM || $active);
			
			curl_multi_close($handle);
			self::$done = true;
		}

	}