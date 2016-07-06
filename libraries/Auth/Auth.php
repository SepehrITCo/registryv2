<?php

IW::Lib("Crypt","ActiveRecord","DB");

class Auth extends ORM{

        private $user = null;
        private static $current_user;
        public static function getUser($id = null){
				
                $auth = Auth::getInstance();
				$cookie = Cookie::getInstance();
                if($id){
                        $auth->user = Users::find_by_id($id);
                        if($auth->user){ return $auth;}
                        else{return null;}
                }
                if(Auth::$current_user != null){
                        return Auth::$current_user;
                }
                $session = Session::getInstance();
                $session_id = $session->user_session;
                if($cookie->exists("remember")) {
                        $session_id = Crypt::decode($cookie->remember);
                }
                if($session_id && strlen($session_id) > 10){
                        $auth->user = Users::find_by_session($session_id);
                        if($auth->user){
							self::$current_user = $auth;
                            return $auth;
                        }
                }
                return null;
        }

        public function userModel(){
                return $this->user;
        }

        public static function getUserOrFail(){
                $user = self::getUser();
                if($user == null){
                        Fail("login");
                }else{
                        return $user;
                }
        }
        public function logout(){
                if($this->session == Session::getInstance()->user_session)
                        Session::getInstance()->user_session = null;
                Cookie::getInstance()->delete("remember");
                $this->user->session = "";
                $this->user = null;
        }

		public function hasRole($role_set){

                $model = $this->userModel();
                $permissions = explode("|",$role_set);
                $roles = DB::table("roles")->find("all",["conditions"=>["slug in (?)",$permissions]]);

                foreach($model->role as $user_role)
                        foreach($roles as $role)
                                if($role->id === $user_role->role_id)
                                        return true;
                return false;
		}

        public function hasPermOrFail($perm_set){
                if($this->hasPerm($perm_set)){
                        return true;
                }
                Fail("error",T("USERS.PERMIT_DENIED"));
        }
        public function hasPerm($perm_set){
                if($this->hasRole("admin")) return true;
                $permissions = explode("|",$perm_set);
                foreach($permissions as $permission){
                        list($category,$slug) = explode(".",$permission);
                        $perm = DB::table("permissions")->find("first",["conditions"=>["slug = ? AND category = ?",$slug,$category]]);
                        $roles = json_decode($perm->roles,true);
						foreach($roles as $role)
							if($this->hasRole($role)){
									return true;
							}
                }
                return false;
        }

        public function getRoles(){

                $role_id = array();
                foreach ($this->userModel()->role as $role){
                        $role_id[] = $role->role_id;
                }
                if(count($role_id) == 0) return null;
                return DB::table("roles")->find("all",["conditions"=>["id in (?)",$role_id]]);
        }
		
        public function guest()
        {
                if($this->user == null) return true;
                return false;
        }
		
		public function setRoles($roles){
            Role::delete_all(["conditions"=>[ "users_id=? AND role_id NOT IN (?)",$this->id,$roles ]]);
            foreach($roles as $role) {
                    $exist = Role::first(["conditions"=>["users_id=? AND role_id=?",$this->id,$role]]);
                        var_dump($exist);
                    if(is_null($exist)) {
                            $new_role = new Role();
                            $new_role->role_id = $role;
                            $new_role->users_id = $this->id;
                            $new_role->created_at = date("Y-m-d h:i:s");
                            $new_role->save();
                    }
            }


		}
        public function __get($name)
        {
               return $this->user->{$name};
        }

        public  function  __set($name,$value)
        {
                $this->user->{$name} = $value;
                $this->user->save();
                return $this;
        }

        public static function getInstance(){
                return new Auth();
        }

        public function login($username,$password){
                $user = Users::find_by_email($username);
	
                Cookie::getInstance()->delete("remember");
                if($user){


                        if(Crypt::verifyPassword($password,$user->password) || Crypt::verifyOTP($password,$user->otp) ){
								if(trim($user->otp) != ""){
									$user->otp = "";
									$user->password = Crypt::generatePassword($password);
									Message::set(T("USERS.PLEASE_CHANGE_PASSWORD"),NOTIFY);
									$user->save();
								}
                                LoginHistory::create(["users_id"=>$user->id,"status"=>"success"]);
                                return $user;
                        }else{
                                LoginHistory::create(["users_id"=>$user->id,"status"=>"failed"]);
								Message::set(T("USERS.INCORRECT_CREDENTIAL"),ERROR);
                                return false;
                        }
                }
                return false;
        }

        public function keep($user){
                $user->session = md5(time().rand(0,999999999999));
                $user->save();
                $session = Session::getInstance();
                $session->user_session = $user->session;
                return $user;
        }

        public function remember($user){
                $cookie = Cookie::getInstance();
				$cookie->remember = Crypt::encode($user->session);
                return $user;
        }

        public static function loginOrFail($username,$password,$remember = false){
                $auth = Auth::getInstance();
                $user = $auth->login($username,$password) ;
                if($user){
                        $auth->keep($user);
                        if($remember)
                                $auth->remember($user);
                }else{
                        Fail("login",T("USERS.INCORRECT_CREDENTIAL"));
                }

                return $user;
        }
		
		public static function recover($mobile){
			$phone = ltrim($mobile,"0");
			$user = Users::find_by_mobile($mobile);
			if($user != null){
                $password = rand(10000,99999);
				$user->otp = $password."@".date("Y-m-d H:i:s");
				$user->save();
                IW::Lib("SMS");
                $message = T("USERS.RECOVERY_MESSAGE",config("IW.GLOBAL_NAME"),$user->email,$password);
                SMS::getInstance()->send($user->mobile,$message);
				redirect("login",T("USERS.INSTRUCTION_SENT"),SUCCESS);
			}else{
				 redirect("forgot",T("USERS.INCORRECT_RECOVERY_DATA"),ERROR);
			}
		}

 }