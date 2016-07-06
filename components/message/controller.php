<?php 
	class MessageController extends ORM{
		
		public function inbox($html = true){
			withModel();
			$uid = Auth::getUserOrFail()->id;
			$count = Messages::find_by_sql('SELECT count(`id`) AS `count` FROM `messages` WHERE `read` = 0 && receipt='.$uid)[0]->count;
			if($html){
				if($count > 0)
					return "<span class=\"label label-primary pull-right\">$count ".T("MESSAGE.NEW_MESSAGE")."</span>";
				else 
					return "";
			}else{
				return $count;
			}
		}
		public function menuUnread($menu,$object){
			$inbox = $this->inbox(false);
			if($inbox > 0)
			$object->badge($inbox." ".T("MESSAGE.NEW_MESSAGE"),"blue");

		}
		public function compose(){
			IW::Lib("Form","Input","Downloader");
			Form::checkToken();
			$subject = Input::post("subject");
			$to = Input::post("to");
			$bcc = Input::post("bcc");
			$body = Input::post("body");
			$from = Auth::getUser()->id;
			$attachment = Input::post("attachment");
			if(count($attachment) > 0){
				$downloader = new Downloader();
				foreach($attachment as $item){
					$downloader->settle($item);
				}
			}
			
			$attachment = json_encode($attachment) ;
			$origin = 0;
			$forward = (Input::post("forward"))?1:0;
			$reply = (Input::post("reply"))?1:0;	

			foreach($to as $item){
				$id = $this->sendMessage( $subject,$body,$from,$item, ["origin"=>$origin,"attachment"=>$attachment,"forwarded"=>$forward,"replied"=>$reply] );
				if($origin == 0) $origin = $id;
			}
			foreach($bcc as $item){
				$this->sendMessage( $subject,$body,$from,$item, ["transcript"=>1,"origin"=>$origin,"attachment"=>$attachment,"forwarded"=>$forward,"replied"=>$reply ]);
			}
			Message::set(T("MESSAGE.MESSAGE_SENT_SUCCESSFULLY"),SUCCESS);
			redirect("message/inbox");
		}
		
		//Params: transcript,origin,read,forwarded,replied,draft,sent_on,read_on,trash
		public function sendMessage($subject,$body,$from,$receipt,$params = array()){
			$params["subject"] = $subject;
			$params["body"] = $body;
			$params["from"] = $from;
			$params["receipt"] = $receipt;
			$message = new Messages($params);
			return $message->save();
		}
		
		public function getMessage($id){
			$user = Auth::getUser();
			$message = Messages::find("first", ["conditions"=> ["id=? AND (`from`=? OR receipt=?)",$id,$user->id,$user->id] ] );
			if(!$message) Fail(404);
			$from = Users::find("first", ["conditions"=> ["id=?",$message->from] ] );
			$receipt = Users::find("first", ["conditions"=> ["id=?",$message->receipt] ] );
			if($message->read != 1 && $message->receipt == $user->id){
				$message->read = 1;
				$message->read_on = date("Y-m-d H:i:s");
				$message->save();
			}
			$date = Date::forge($message->sent_on);
			return view( "message",["message"=>$message,"from"=>$from,"receipt"=>$receipt,"date"=>$date] );
		}
		
		public function attachment(){
			$result = ["status"=>false];
			IW::Lib("Upload","Downloader");
			$file_name = md5( time()."upload" ).rand(0,10000);
			$dir = PATH_BASE.DS."cache".DS."upload";
			$data = Upload::uploadFile("attachment",$dir,$file_name,".download",false, 15);
			$data = json_decode($data);
		
			$result["status"] = $data->success;
			$result["error"] = @$data->error;
			if($result["status"]){
				$downloader = new Downloader();
				$object = $downloader->create($dir.DS.$file_name.".download",$_FILES["attachment"]["name"],$file_name);
				IW::Lib("Text");
				$result["name"] = $object->name;
				$result["ext"] = $object->ext;
				$result["id"] = $object->id;
				$result["size"] = Text::formatBytes($object->size);
				$visualizer = File::visualizer($dir.DS.$file_name.".download",$object->ext);
				$result["icon"] = $visualizer["icon"];
				$result["thumb"] = $visualizer["thumb"];
			}

			
			return json_encode($result);
		}
		
		public function trashMessage($id,$redirect = false){
			if(!$redirect) $redirect = "message/inbox";
			$user = Auth::getUserOrFail();
			$messages = Messages::find("all",["conditions"=>["id IN (?) AND receipt=?",$id,$user->id  ]]);

			foreach($messages as $message){
				if($message->trash == 1){
					$message->trash = 0;
				}else{
					$message->trash = 1;
				}
				$message->save();
			}
				
			redirect($redirect);
		}
		
		
	}