<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php P("USERS.ROLES"); ?></h3>
    </div>
    <div class="box-body">
		<?php 
			$columns = [
				"#"=>["width"=>"45px","title"=>"#"],
				"id"=>["width"=>"45px","title"=>T("USERS.ID")],
				"name"=>["width"=>"200px","title"=>T("USERS.NAME")],
				"slug"=>["width"=>"150px","title"=>T("USERS.ROLE_SLUG")],
				"description"=>["width"=>"30%","title"=>T("USERS.ROLE_DESCRIPTION")]
			];
			$roles = Roles::all();
			
			$array = array();
			
			$c = 0;
			foreach($roles as $item){
				$array[$c] = $item->to_array();
				$array[$c]["#"] = $c+1;
				$array[$c]["name"] = "<a href='".route("roles/view/".$item->id)."'>".$item->name."</a>";
				$c++;
			}
			$module = Modules::getModule(
			"mod_datatable",
			[
				"columns"=>$columns,
				"data"=>$array
			]
			);
			echo $module->getView();
		?>
	</div>
</div>

	