<?php

class UserController
{
    public function login()
    {
        if(Input::post("recover") != ""){
            Auth::recover( Input::post("recover") );
        }else {
            app("VIEW.RAW", true);
            IW::Lib("Form", "Auth");
            Form::checkToken();
            $remember = (bool)Input::post("remember", false);

            $user = Auth::loginOrFail(Input::post("username"), Input::post("password"), $remember);
            redirect("dashboard");
        }
    }

    public function viewUsers($size, $page, $query, $col, $sort)
    {
        $user = Auth::getUserOrFail();
        $user->hasPermOrFail("user.view");

        IW::Lib("Pagination");

        $columns = [
            "#" => ["title" => "#", "width" => "30px"],
            "id" => ["title" => T("USERS.ID"), "width" => "60px", "filter" => "=*", "sort" => true],
            "name" => ["title" => T("USERS.NAME"), "width" => "20%", "filter" => "LIKE CONCAT('%',*,'%')", "sort" => true],
            "email" => ["title" => T("USERS.EMAIL"), "width" => "20%", "filter" => "LIKE CONCAT('%',*,'%')", "sort" => true],
            "block" => ["title" => T("USERS.BLOCK"), "width" => "70px", "sort" => true],
            "roles" => ["title" => T("USERS.ROLES"),]
        ];
        $pagination = new Pagination("Users", $columns, $query, $size, $page, $col, $sort);
        $pagination_html = $pagination->render();
        return view("users", ["users" => $pagination->getData(), "pagination" => $pagination_html, "columns" => $columns, "query" => $query, "sort_col" => $col, "sort" => $sort]);
    }

    public function bing()
    {
        IW::Lib("Bing");
        return Bing::getImage(PATH_BASE . DS . "media".DS."images");
    }

    public function editProfile($user, $redirect = false)
    {
        IW::Lib("Form", "Auth");
        Form::checkToken();
        $user = Auth::getUser($user->id);

        $password = Input::post("password");
        if ($password != "") {
            Input::set("password", Crypt::generatePassword($password));
            Notification::set(T("USERS.YOUR_PASSWORD_CHANGED"), "", "unlock-alt", "text-red", false, $user);
        } else {
            Input::unbind("password");
        }
        Input::unbind("password.confirm");
		Input::set("mobile",ltrim(Input::post("mobile"),"0"));
        $model = $user->userModel();
        $input = Input::bind($model);
        $model->update_attributes($input);

        $user->setRoles(Input::post("roles"));
        if (isset($redirect)) {
            redirect($redirect, T("USERS.PROFILE_EDITED"), SUCCESS);
        }
        redirect("users/profile", T("USERS.PROFILE_EDITED"), SUCCESS);
    }

    public function createUser()
    {
        IW::Lib("Form", "Auth");
        Form::checkToken();

        $password = Input::post("password");
        Input::set("password", Crypt::generatePassword($password));
        Input::unbind("password.confirm");
        $model = Auth::getUser()->userModel();
        $input = Input::bind($model);
        $new = Users::create($input);
        $user = Auth::getUser($new->id);
        $user->setRoles(Input::post("roles"));
        redirect("users/view/" . $new->id);
    }

    public function profileImage($user)
    {

        app("VIEW.RAW", true);
        IW::Lib("Upload");
        return Upload::uploadImage("profile_upload_image", false, false, ["dest" => Files . DS . "profile" . DS . $user->id . ".jpg", "width" => 160, "height" => 160]);
    }

    public function createRole()
    {
        $user = Auth::getUserOrFail();
        $user->hasPermOrFail("user.role");
        IW::Lib("Form", "Auth");
        Form::checkToken();
        $model = Roles::first();
        $input = Input::bind($model);
        $role = Roles::create($input);
        redirect("roles/view/" . $role->id);
    }

    public function editRole()
    {
        $user = Auth::getUserOrFail();
        $user->hasPermOrFail("user.role");
        IW::Lib("Form", "Auth");
        Form::checkToken();
        $role = Roles::find_by_slug(Input::post("slug"));
        $role->update_attributes(["name" => Input::post("name"), "description" => Input::post("description")]);

        $permissions = DB::table("permissions")->all();
        foreach ($permissions as $permission) {
            $roles = json_decode($permission->roles, true);
            if (is_null($roles)) $roles = array();

            if (isset($_POST["form"]["perms"][$permission->id]) && !in_array($role->slug, $roles)) {

                $roles[] = $role->slug;

            }

            if (in_array($role->slug, $roles) && !isset($_POST["form"]["perms"][$permission->id])) {
                if (($key = array_search($role->slug, $roles)) !== false) {
                    unset($roles[$key]);
                }
            }


            $permission->roles = json_encode($roles);
            $permission->save();
        }
        redirect("roles/view/" . $role->id, T("USERS.ROLE_HASBEEN_EDITED"), SUCCESS);
    }

    public function deleteRole($id)
    {
        $role = Roles::find_by_id($id);
        $permissions = DB::table("permissions")->all();
        foreach ($permissions as $permission) {
            $roles = json_decode($permission->roles, true);
            if (in_array($role->slug, $roles)) {
                if (($key = array_search($role->slug, $roles)) !== false) {
                    unset($roles[$key]);
                }
            }
            $permission->roles = json_encode($roles);
            $permission->save();
        }

        Role::table()->delete(["role_id" => $role->id]);
        $role->delete();
        redirect("roles", T("USERS.ROLE_DELETED"), SUCCESS);
    }

    public function deleteUser($id)
    {
        $user = Users::find_by_id($id);
        Role::table()->delete(["users_id" => $user->id]);
        $user->delete();
        redirect("users", T("USERS.USER_DELETED"), SUCCESS);
    }
}