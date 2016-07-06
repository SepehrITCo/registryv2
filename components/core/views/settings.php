<div class="row">
        <div class="col-md-3">


          <div class="box box-primary">
            <div class="box-header with-border box-primary">
              <h3 class="box-title"><?php P("CORE.SETTINGS"); ?></h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding " style="display: block;">
              <ul class="nav nav-pills nav-stacked">
				<?php 
					foreach($settings as $component):
					$component_trans = strtoupper($component);
					$active = ($current == $component)?" class='active'":"";
					$color = ($current == $component)?" text-blue":"";
				?>

					<li<?php echo $active; ?>><a href="<?php echo route("core/settings/component:".$component); ?>"><i class="fa fa-cog<?php echo $color; ?>"></i> <?php P($component_trans.".".$component_trans); ?></a></li>
				<?php endforeach; ?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        </div>

        <div class="col-md-9">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><?php P(strtoupper($current).".".strtoupper($current)); ?></h3>
				<?php echo Form::create("settings")->action(route("core/settings/component:".$current))->method("POST"); ?>
          
            </div>
       
            <div class="box-body">

				<?php require PATH_BASE.DS."components".DS.$current.DS."package".DS."settings".php; ?>
    
            </div>

            <div class="box-footer">
			<?php 
				echo Form::_("submit",T("TEMPLATE.SAVE"))->addClass("margin");
				echo Form::_("button",T("TEMPLATE.CANCEL"))->onclick("window.location='".route("dashboard")."'")->addClass("margin");
			?>
		 
            </div>
				<?php echo Form::close(); ?>
          </div>
 
        </div>
  
      </div>