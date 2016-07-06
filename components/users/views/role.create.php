<?php 
	IW::Lib("Form");

?>
<div class="col-md-12">
	<?php echo Form::create("role")->action(route("roles/create"))->method("POST"); ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php P("USERS.CREATE_NEW_ROLE"); ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
		<?php



			echo Form::_("text",T("USERS.ROLE_NAME"),"name")->pre( icon("terminal")  )->required();
			echo Form::_("text",T("USERS.ROLE_DESCRIPTION"),"description")->pre(icon("question-circle"))->required();
			echo Form::_("text",T("USERS.ROLE_SLUG"),"slug")->pre( icon("code") )->required();


		?>
	
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?php 
			echo Form::_("submit",T("TEMPLATE.SUBMIT"))->addClass("margin");
			echo Form::_("button",T("TEMPLATE.BACK"))->onclick("window.location='".route("roles")."'")->addClass("margin");
		  ?>
		 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
<?php echo Form::close(); ?>
</div>
