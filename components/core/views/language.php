<?php 
	$dir = PATH_BASE.DS."language".DS.$language;
	$config = getJSON($dir.DS."config.json");
	IW::Lib("Form");
	app("PAGE.H1",T("CORE.TRANSLATION.TRANSLATIONS"));
?>

<div class="row">
        <div class="col-md-3">
          <a href="javascript:App.popup('<?php P("CORE.TRANSLATION.NEW_FILE"); ?>',jQuery('.NEW_TRANSLATION').html(),createTranslation)" class="btn btn-primary btn-block margin-bottom"><?php P("CORE.TRANSLATION.NEW_FILE"); ?></a>
		  <?php if($translation): ?>
		  <a href="javascript:App.popup('<?php P("CORE.TRANSLATION.NEW_ITEM"); ?>',jQuery('.NEW_TRANSLATION_ITEM').html(),createTranslationItem)" class="btn btn-success btn-block margin-bottom"><?php P("CORE.TRANSLATION.NEW_ITEM"); ?></a>
		  <?php endif; ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php P("CORE.TRANSLATION.TRANSLATIONS"); ?></h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
				<?php 
					$translations = File::searchDir($dir,"*.translate.json");
					foreach($translations as $item):
					$trans_file = basename($item,".translate.json");
					$active = ($trans_file === $translation)?"active":"";
					
				?>
				<li class="<?php echo $active; ?>">
					<a href="<?php echo route("core/languages/".$language."/".$trans_file); ?>"><?php echo ucfirst($trans_file); ?></a>
				</li>
				<?php endforeach; ?>

			   </ul>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-warning">
		  <?php if($translation === false): ?>
				<div class="box-header with-border">
				  <h3 class="box-title">  <img src="<?php echo IW_ROOT."/media/images/languages/".substr($language,3,5).".png"; ?>" width=25 height=25 /> <?php echo $config->title; ?></h3>

				</div>
				<?php 
					$custom_date = (file_exists(PATH_BASE.DS."language".DS.$language.DS."Date.class".php))?T("TEMPLATE.YES"):T("TEMPLATE.NO");
					$map = getJSON(PATH_BASE.DS."language".DS.$language.DS."map.json");
				?>
				<div class="box-body">
					<table>
						<tr><td><b><?php P("CORE.TRANSLATION.TITLE"); ?>:</b></td><td><?php echo $config->title; ?></td></tr>
						<tr><td><b><?php P("CORE.TRANSLATION.CODE"); ?>:</b></td><td><?php echo $config->code; ?></td></tr>
						<tr><td><b><?php P("CORE.TRANSLATION.CUSTOM_DATE"); ?>:</b></td><td><span class="label label-success"><?php echo $custom_date; ?></span></td></tr>
						<tr><td><b><?php P("CORE.TRANSLATION.DIRECTION"); ?>:</b></td><td><?php echo ($config->isRTL == true)?"RTL":"LTR"; ?></td></tr>
						<tr><td><b><?php P("CORE.TRANSLATION.MAP"); ?>:</b></td><td><?php foreach($map as $item) echo "<span class='label label-primary'>".$item."</span> "; ?></td></tr>
					</table>
					
				</div>
			<?php else: ?>
				<?php echo Form::create("translate")->action(route("core/languages/".$language."/".$translation))->method("POST"); ?>
				<div class="box-header with-border">
				  <h3 class="box-title">  <img src="<?php echo IW_ROOT."/media/images/languages/".substr($language,3,5).".png"; ?>" width=25 height=25 /> <?php echo $config->title; ?> - <?php echo ucfirst($translation); ?></h3>
					<div class="pull-right box-tools">
					<button type="button" class="btn btn-danger btn-sm" onclick="App.confirm('<?php P("CORE.TRANSLATION.ARE_U_SURE_REMOVE_TRANS_FILE"); ?>',removeTransFile)">
					  <i class="fa fa-times"></i></button>
					</div>
				</div>
				
				<div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->


			
				
				<?php 
					$translation_array = getJSON(PATH_BASE.DS."language".DS.$language.DS.$translation.".translate.json");
					$collapsed = "collapsed";
					$in = "in";
					foreach($translation_array as $head=>$inner):
				
				?>
					
					  <div class="box-header with-border">
						<h4 class="box-title">
						  <a data-toggle="collapse" href="#collapse-<?php echo $head; ?>" class="<?php echo $collapsed; ?>" aria-expanded="false">
							<?php echo $head; ?>
						  </a>

						</h4>
							<div class="pull-right box-tools">
							<button type="button" class="btn btn-danger btn-xs" onclick="removeTransItem('<?php echo $head; ?>')">
							  <i class="fa fa-times"></i></button>
							</div>
					  </div>
					  <div id="collapse-<?php echo $head; ?>" class="panel-collapse collapse <?php echo $in; ?>" aria-expanded="false">
						<div class="box-body">
						<ul class="language-fields">
						  <?php
							recursive_print($inner,$head);
						  ?>
						 </ul>
						</div>
					  </div>
					
				<?php 
				$collapsed = "";
				$in = "";
				endforeach; ?>
				</div>
			<div class="box-footer">
			  <?php 
				echo Form::_("submit",T("TEMPLATE.SUBMIT"))->addClass("margin");
				if($language != "en-GB")
					echo Form::_("button",T("CORE.TRANSLATION.COPY_FROM_EN"))->addClass("btn-success");
				echo Form::close();
			  ?>
			 
			</div>
			<?php endif; ?>


		</div>
	</div>
</div>
<div class="hidden">
	<div class="NEW_TRANSLATION">
		<b><?php P("CORE.TRANSLATION.FILE_NAME"); ?>:</b><input type="text" name="file" value="" />
		
	</div>
	<div class="NEW_TRANSLATION_ITEM">
		<table>
		<tr style="height:45px"><td><b><?php P("CORE.TRANSLATION.ITEM_HEAD"); ?>:</b></td><td><input name="head" type="text" value="" /></td></tr>
		<tr style="height:45px"><td><b><?php P("CORE.TRANSLATION.ITEM_VALUE"); ?>:</b></td><td><input name="value" type="text" value="" /></td></tr>
		</table>
	</div>	
	
</div>
<script language="javascript">
	var y;
	createTranslation = function(result,item){
		_file_name = item.find("input[name=file]").val()
		window.location = '<?php echo route("core/languages/".$language."/create/"); ?>'+_file_name
	}
	
	createTranslationItem = function(result,item){
		head = item.find("input[name=head]").val()
		value = item.find("input[name=value]").val()
		jQuery.ajax({url: "<?php echo route("core/languages/".$language."/".$translation."/create"); ?>",
		dataType: 'json',
		type: 'POST',
		data:{"head":head,"value":value},
		success: function(result){
			
			if(!result.success){
				App.alert('<?php P("CORE.TRANSLATION.CREATE_FAILED"); ?>')
			}else{
				window.location.reload();
			}
		},
		error: function(){
			App.alert('<?php P("CORE.TRANSLATION.CREATE_FAILED"); ?>')
		}
		});
	}
	
	removeTransFile = function(){
		window.location = '<?php echo route("core/languages/".$language."/".$translation."/remove"); ?>'
	}
	removeTransItem = function(key){
		App.confirm('<?php P("CORE.TRANSLATION.ARE_U_SURE_REMOVE_TRANS_ITEM"); ?>',function(){
			window.location = '<?php echo route("core/languages/".$language."/".$translation."/remove/"); ?>'+key
		})
	}
		
</script>
<?php 
	function recursive_print($data,$prefix){
		foreach($data as $head=>$item){
			if( is_string($item) ){
				echo "<li>"
				.Form::_("text",$prefix.".".$head ,$prefix.".".$head)->value( preg_replace('/[\r\n]+/', '\n', $item) )->setSize(4,6)->post(
					"<button type='button' class='btn btn-danger btn-xs' onclick=\"removeTransItem('".$prefix.".".$head."')\"><i class='fa fa-times'></i></button>").
				"</li>";
			}else{
				echo "<ul>";
				echo recursive_print($item,$prefix.".".$head);
				echo "</ul>";
			}
		}
		
	}

?>