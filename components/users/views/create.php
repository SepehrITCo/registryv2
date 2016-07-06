<?php 
	IW::Lib("Form","DB");
	Template::getInstance()->js("form.extend.js");
?>
<div class="col-md-12">
	<?php echo Form::create("profile")->action(route("users/create"))->method("POST"); ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php P("USERS.CREATE_USER_PROFILE"); ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
		<?php



			echo Form::_("text",T("USERS.NAME"),"name")->pre( icon("user")  )->required();
			echo Form::_("email",T("USERS.EMAIL"),"email")->pre("@")->required();
			echo Form::_("text",T("USERS.MOBILE"),"mobile")->pre( icon("phone-square") )->required();

			echo Form::_("password",T("USERS.PASSWORD"),"password")->pre( icon("asterisk") )->confirm("password.confirm")->minlength(6)->required();
			echo Form::_("password",T("USERS.PASSWORD_CONFIRM"),"password.confirm")->pre( icon("asterisk") )->active("[password.confirm].val().length > 5")->minlength(6)->required();

			echo Form::_("radio-horiz",T("USERS.BLOCK_USER"),"block")->options([ "1"=>"Yes","0"=>"No" ]);
			$langs = Language::getLangList();
			echo Form::_("select2",T("USERS.LANGUAGE"),"lang")->options($langs);

			$roles = array();
			foreach(DB::table("roles")->all() as $item){
				$roles[$item->id] = $item->name;
			}


			if(Auth::getUser()->hasPerm("user.role")) {
				echo Form::_("select2", "Roles", "roles")->options($roles)->multiple();
			}
		?>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?php 
			echo Form::_("submit",T("TEMPLATE.SUBMIT"))->addClass("margin");
			echo Form::_("reset",T("TEMPLATE.RESET"))->addClass("margin");
		  ?>
		 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
<?php echo Form::close(); ?>
</div>
