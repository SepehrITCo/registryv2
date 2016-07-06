<?php 
	IW::Lib("Form","DB");
	$form = new Form();
	$user = Auth::getUser($id);
	if(!$user){
		Fail("error",T("USERS.USER_NOT_FOUND"));
	}
	Template::getInstance()->js("form.extend.js");
?>
<script language="javascript">
	jQuery(document).ready(function ($){
		$("#profile_upload_image").change(function () {
			$.ajaxFileUpload({
				url:'<?php echo route("users/profile.image/".$id); ?>',
				secureuri:false,
				fileElementId:'profile_upload_image',
				dataType: 'json',
				success: function(data,status){
						if(data.success == false){
							alert(data.error);
						}else{
							$("#profile-image").attr("src",data.thumb_url);
						}
				},
				error: function(data,status,e){
					//print error
					alert(e);
				}
			});
		})
	})
</script>
<div class="col-md-3">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<img id="profile-image" class="profile-user-img img-responsive img-circle" src="<?php
			if(file_exists(Files.DS."profile".DS.$user->id.".jpg")){
				echo IW_ROOT.DS."files".DS."profile".DS.$user->id.".jpg";
			}else{
				echo IW_ROOT.DS."files".DS."profile".DS."default.jpg";
			}
			?>">
			<input type="file" id="profile_upload_image" title="<?php P("USERS.EDIT_PROFILE_IMAGE"); ?>"  name="profile_upload_image" />
			<h3 class="profile-username text-center"><?php echo $user->name; ?></h3>
			<p class="text-muted text-center"><?php
				$roles = $user->getRoles();
				$print = "";
				if(count($roles) > 0)
				foreach($roles as $role){
					$print .= ",".$role->name;
				}
				echo trim($print,",");
			?></p>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php P("USERS.LAST_LOGINS"); ?></h3>
		</div>
		<div class="box-body box-profile">

			<ul class="list-group list-group-unbordered">
				<?php
					$logins = LoginHistory::find("all",["conditions"=>["users_id=?",$user->id],"order"=>"id desc","limit"=>7]);
					foreach($logins as $login){
						$class = ($login->status == "failed")?"danger":"success";
						$date = Date::forge($login->date);
						echo "
						<li class=\"list-group-item\">
							<span class=\"label label-$class\">".$login->status."</span> </span><span class=\"pull-right\" title='".$date->format("datetime")."'>".$date->ago()." </span>
						</li>
						";
					}
				?>

			</ul>
		</div>
	</div>
</div>
<div class="col-md-9">
	<?php echo Form::create("profile")->action(route("users/view/".$id))->method("POST"); ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php P("USERS.EDIT_USER_PROFILE"); ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
		<?php



			echo Form::_("text",T("USERS.NAME"),"name")->pre( icon("user")  )->value($user->name)->required();
			echo Form::_("email",T("USERS.EMAIL"),"email")->pre("@")->value($user->email)->required();
			echo Form::_("text",T("USERS.MOBILE"),"mobile")->pre( icon("phone-square") )->value($user->mobile)->required();

			echo Form::_("password",T("USERS.PASSWORD"),"password")->pre( icon("asterisk") )->confirm("password.confirm")->minlength(6);
			echo Form::_("password",T("USERS.PASSWORD_CONFIRM"),"password.confirm")->pre( icon("asterisk") )->active("[password.confirm].val().length > 5")->minlength(6);

			echo Form::_("radio-horiz",T("USERS.BLOCK_USER"),"block")->options([ "1"=>T("TEMPLATE.YES"),"0"=>T("TEMPLATE.NO") ])->select( $user->block );
			$langs = Language::getLangList();
			echo Form::_("select2",T("USERS.LANGUAGE"),"lang")->options($langs)->select($user->lang);

			$roles = array();
			foreach(DB::table("roles")->all() as $item){
				$roles[$item->id] = $item->name;
			}


			if(Auth::getUser()->hasPerm("user.role")) {
				$selected = array();
				$user_roles = $user->getRoles();
				if($user_roles)
				foreach ($user_roles as $role) {
					$selected[] = $role->id;
				}

				echo Form::_("select2", T("USERS.ROLES"), "roles")->options($roles)->select($selected)->multiple();
			}
		?>
	
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?php 
			echo Form::_("submit",T("TEMPLATE.SUBMIT"))->addClass("margin");
			echo Form::_("button",T("TEMPLATE.DELETE"))->addClass("btn-danger")->onclick("App.confirm('".T("USERS.ARE_U_SURE_REMOVE_USER")."',function(){ window.location='".route("users/remove/".$user->id)."'; });")->addClass("margin");
			echo Form::_("reset",T("TEMPLATE.RESET"))->addClass("margin");
		  ?>
		 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
<?php echo Form::close(); ?>
</div>
