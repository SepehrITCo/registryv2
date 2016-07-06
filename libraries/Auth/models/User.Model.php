<?php
	class Users extends ActiveRecord\Model {
		static $table_name = 'users';
		static $has_many = array(
			array("role")
		);
	}

	class Role extends ActiveRecord\Model{
		static $table_name = 'role_user';
		static $belongs_to = array(
			array('users')
		);
	}

	class Roles extends ActiveRecord\Model{
		static $table_name = 'roles';
	}

	class LoginHistory extends ActiveRecord\Model{
		static $table_name = 'login_history';
	}