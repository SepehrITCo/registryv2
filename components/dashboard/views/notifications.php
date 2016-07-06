<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php P("DASHBOARD.NOTIFICATIONS"); ?></h3>
    </div>
    <div class="box-body">
		<?php 
			$columns = [
				"#"=>["width"=>"45px","title"=>"#"],
				"title"=>["width"=>"250px","title"=>"Title"],
				"message"=>["width"=>"","title"=>"Description"],
				"date"=>["width"=>"150px","title"=>"Date"],
				"seen_date"=>["width"=>"150px","title"=>"Seen"]
			];
			$roles = DB::table("notification")->find("all",["conditions"=>["users_id=?",$user->id],"order"=>"id desc","limit"=>150]);
			
			$array = array();
			
			$c = 0;
			foreach($roles as $item){
				$array[$c] = $item->to_array();
				$array[$c]["#"] = $c+1;
				
				$array[$c]["date"] = Date::forge($item->date)->format("datetime");

				if($item->seen == 1){
					$date = Date::forge($item->seen_date);
					$array[$c]["seen_date"] = "<label class='label label-primary' title='".$date->format("datetime")."'>".$date->ago()."</label>";
				}else{
					$array[$c]["seen_date"] = "<label class='label label-danger'>".T("TEMPLATE.NEVER")."</label>";
				}
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

	