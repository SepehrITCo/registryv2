<?php 
	class DashboardController{
		
		public function test(){
			IW::lib("Auth");
			Auth::loginOrFail("shirazitcompany@yahoo.com","123");
			$user = Auth::getUser();
			$user->logout();

			return "";
		}
		
		public function menu($menu,$menu_object){
			$menu_object->badge("new","blue");
		}
	}