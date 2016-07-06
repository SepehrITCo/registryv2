<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php P("USERS.MANAGEMENT"); ?></h3>
		<div class="box-tools">
		<?php 
		IW::Lib("Form");
		echo Form::create("search_users")->method("POST")->action(route("users/find")); ?>
			<div class="input-group input-group-sm" style="width: 150px;">

			  <input type="text" name="form[search]" value="<?php if($query) echo $query;  ?>" class="form-control pull-right" placeholder="<?php P("TEMPLATE.SEARCH_PLACE_HOLDER"); ?>">

			  <div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			  </div>
			</div>
		<?php echo Form::close(); ?>
        </div>
    </div>
    <div class="box-body">

       <?php



            $user_array = array();
			$c = 0;
            $role_map = array();
            $role_table = Roles::all();
            foreach($role_table as $item){
                $role_map[$item->id] = $item->name;

            }
            foreach($users as $item){
				$user_array[$c] = $item->to_array();
				$user_array[$c]["#"] = $c+1;
				$user_array[$c]["name"] =  "<a href='".route("users/view/".$item->id)."'>".$item->name."</a>";
				$user_array[$c]["block"] = ($item->block == 0)?"<span class=\"label label-success\">".T("USERS.ACTIVE")."</span>":"<span class=\"label label-danger\">".T("USERS.BLOCKED")."</span>";
				
				$roles = Role::find("all",["conditions"=>["users_id=?",$item->id]]);
                $roles_text = "";
                foreach($roles as $role){
                    $roles_text .= ",".$role_map[$role->role_id];
                }
                $roles_text = trim($roles_text,",");
                if(count($roles) < 4){
                    $user_array[$c]["roles"] = "<span class='label label-primary'>".str_replace(',','</span>  <span class="label label-primary">' , $roles_text)."</span>";
                }else{
                    $user_array[$c]["roles"] = "<span class='label label-primary' title='".str_replace(',',"\n" , $roles_text)."'>".count($roles)." ".T("USERS.ROLES")."</span>";
                }

				
				$c++;
            }

			$module = Modules::getModule("mod_datagrid",[
                "data"=>$user_array,
                "pagination"=>$pagination,
                "columns"=>$columns,
				"class"=>"table-hover table-striped",
				"sort_col"=>$sort_col,
				"sort"=>$sort
            ]);
            echo $module->getView();
			
		?>

    </div>
	
			

		
</div>