<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php P("CORE.LANGUAGES"); ?></h3>
    </div>
    <div class="box-body">
		<?php 
			App("PAGE.H1",T("CORE.LANGUAGE_MANAGEMENT"));
			$columns = [
				"#"=>["width"=>"45px","title"=>"#"],
				"code"=>["width"=>"45px","title"=>T("CORE.TRANSLATION.CODE")],
				"name"=>["width"=>"30%","title"=>T("CORE.TRANSLATION.NAME")],
				"rtl"=>["width"=>"150px","title"=>T("CORE.TRANSLATION.DIRECTION")],
				"custom_date"=>["width"=>"150px","title"=>T("CORE.TRANSLATION.CUSTOM_DATE")],
				"active"=>["width"=>"150px","title"=>T("CORE.TRANSLATION.ACTIVE")],
			];
			
			$dir = PATH_BASE.DS."language";
			$languages = File::scanDir($dir);
			
			$array = array();
			$lang = Language::getInstance();
			$c = 0;
			foreach($languages as $item){
				$config = getJSON($dir.DS.$item.DS."config.json");
				
				$array[$c] = array();
				$array[$c]["#"] = $c+1;
				$array[$c]["name"] = "<a href='".route("core/languages/".$config->code)."'>".$config->title."</a>";
				$array[$c]["code"] = $config->code;
				$array[$c]["rtl"] = ($config->isRTL == true)?"RTL":"LTR";
				$array[$c]["custom_date"] = (file_exists($dir.DS.$item.DS."Date.class".php))?T("TEMPLATE.YES"):T("TEMPLATE.NO");
				$array[$c]["active"] = 	($lang->language == $config->code)?"<i class='fa fa-check text-green'></i>":"<i class='fa fa-times text-red'></i>";
			
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

	