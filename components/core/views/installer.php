<div class="row">
        <div class="col-md-3">
          <a href="<?php echo route("core/installer/new"); ?>" class="btn btn-primary btn-block margin-bottom"><?php P("CORE.INSTALL_NEW_ITEM"); ?></a>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php P("CORE.EXTENSIONS"); ?></h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  
			<?php 

				$types = ["components"=>[],"modules"=>[],"plugins"=>[],"libraries"=>[]];
				foreach($types as $type=>$items):
			?>
                <li <?php if($filter == $type) ?>>
				<a href="<?php echo route("core/installer/filter:".$type); ?>"><i class="fa fa-inbox"></i> 
				  <?php P("CORE.".strtoupper($type)); ?>
                  <span class="label label-primary pull-right">
				  <?php
						$items = File::scanDir(PATH_BASE.DS.$type);
						echo count($items);
						$types[$type] = $items;
				  ?>
				  </span></a>
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
            <div class="box-header with-border">
              <h3 class="box-title"><?php P("CORE.".strtoupper($filter)); ?></h3>
            </div>
            
            <div class="box-body">
				<?php 
				if(isset($install)):
					IW::Lib("Form");
					echo Form::create("installer")->action(route("core/installer"))->method("POST");
					echo Form::_("file",T("CORE.FILE_INPUT"),"input");
				?>
					
					
					
				<?php
			
				else:
					if(!$package):
						foreach($types[$filter] as $item):
							$data_path = PATH_BASE.DS.$filter.DS.$item.DS."package".DS."package.json";
							if(file_exists($data_path)){
								$data = getJSON($data_path,true);
							}else{
								$data = [
									"name"=>ucwords($item),
									"description"=>"",
									"version"=>"Unknown",
									"author"=>"Unknown"
								];
							}
					?>
						<div class="col-md-3 installer-item box box-primary">
							<div class="box-header with-border">
							
									<strong>
									<a href="<?php echo route("core/installer/filter:".$filter."/package:".$item); ?>">
									<?php 
										echo ucwords($data["name"]); 
									?>
									</a>
									</strong>
									
									
								
							</div>
							
							<div class="description"><b><?php P("CORE.DESCRIPTION"); ?>:</b><?php echo $data["description"];  ?></div>
							<div class="version"><b><?php P("CORE.VERSION"); ?>:</b><span class="label label-warning"><?php echo @$data["version"]; ?></span></div>
							<div class="author"><b><?php P("CORE.AUTHOR"); ?>:</b><a target="_blank" href="<?php echo @$data["url"]; ?>"><?php echo @$data["author"]; ?></a></div>
							
						</div>
					
					<?php
						endforeach;
					else: 
						$data_path = PATH_BASE.DS.$filter.DS.$package.DS."package".DS;
						if(file_exists($data_path."package.json")){
							$data = getJSON($data_path."package.json",true);
						}else{
							$data = [
								"name"=>ucwords($package),
								"description"=>"",
								"version"=>"Unknown",
								"author"=>"Unknown"
							];
						}
					?>
						<h4>
							<?php 
								echo ucwords($data["name"]); 
							?>		
						</h4>
						<div class="installer-package row">
							<div class="col-md-8"> 
								<?php 
									if(isset($data["icon"]) && isset($data["icon"]["image"])) echo "<img class='icon' src='".route("").$data["icon"]["image"]."' />";
								?>
								<div class="description"><b><?php P("CORE.DESCRIPTION"); ?>:</b><?php echo $data["description"];  ?></div>
								<div class="version"><b><?php P("CORE.VERSION"); ?>:</b><span class="label label-warning"><?php echo @$data["version"]; ?></span></div>
								<div class="author"><b><?php P("CORE.AUTHOR"); ?>:<a target="_blank" href="<?php echo @$data["url"]; ?>"><?php echo @$data["author"]; ?></a></b></div>
							
								<br/><br/>
								<?php 
									if(file_exists($data_path."script".php)){
										$action = "credits";
										require $data_path."script".php;
									}
								?>
							</div>
							<div class="col-md-4">
								<a href="<?php echo route("core/updater/filter:$filter/package:$package"); ?>" class="btn btn-primary btn-block margin-bottom"><?php P("CORE.CHECK_FOR_UPDATE"); ?></a>
								<a href="javascript:App.confirm('<?php P("CORE.ARE_U_SURE_DELETE_EXT"); ?>',function(){ window.location='<?php echo route("core/uninstall/filter:$filter/package:$package"); ?>'; });" class="btn btn-danger btn-block margin-bottom"><?php P("CORE.UNINSTALL"); ?></a>
								<?php if(file_exists($data_path."settings".php)): ?>
									<a href="<?php echo route("core/settings/component:$package"); ?>" class="btn btn-success btn-block margin-bottom"><?php P("CORE.SETTINGS"); ?></a>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php if(isset($install)): ?>
				<div class="box-footer">
					<?php
							echo Form::_("submit",T("CORE.FILE_INPUT_SUBMIT"),"submit");
							echo Form::close();
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>		
			