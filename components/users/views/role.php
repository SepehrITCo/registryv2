<?php
    IW::Lib("Form");

    $role = Roles::find_by_id($id);
    if(!$role){
        Fail("error",app("TEMPLATE.INVALID_REQUEST"));
    }
?>
<div class="col-md-12">
    <?php echo Form::create("role")->action(route("roles/view"))->method("POST"); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php P("USERS.EDIT_ROLE"); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <?php



            echo Form::_("text",T("USERS.ROLE_NAME"),"name")->pre( icon("terminal")  )->value($role->name)->required();
            echo Form::_("text",T("USERS.ROLE_DESCRIPTION"),"description")->pre(icon("question-circle"))->value($role->description)->required();
            echo Form::_("text",T("USERS.ROLE_SLUG"),"slug")->pre( icon("code") )->readonly()->value($role->slug)->required();


            ?>
        </div>
        </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php P("USERS.PERMISSIONS"); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">


            <?php
                $perms = DB::table("permissions")->all(["order"=>"category asc"]);
                $perm_list = array();
                $category = "";
                $close = false;
                foreach($perms as $perm){
                    if($perm->category != $category){
                        if($close) echo "</div><hr/>";
                        echo "<div class='row'>";
                        $close = true;
                        $category = $perm->category;
                        echo "<div class='col-md-2'><label class='col-sm-2 control-label'>".ucwords($category)."</label></div>";
                    }
                    $roles = json_decode($perm->roles,true);
                    if(is_null($roles)) $roles = array();
                    $checked = (in_array($role->slug,$roles))?"checked":"";
                    echo "<div class='col-md-2' title='".$perm->description."'><input type='checkbox' name='form[perms][".$perm->id."]' $checked /> &nbsp;".$perm->name."</div>";
                }
                if($close) echo "</div>";

            ?>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <?php
            echo Form::_("submit",T("TEMPLATE.SAVE"))->addClass("margin");
            echo Form::_("button",T("TEMPLATE.DELETE"))->addClass("btn-danger")->onclick("App.confirm('".T("USERS.ARE_U_SURE_REMOVE_ROLE")."',function(){ window.location='".route("roles/remove/".$role->id)."'; });")->addClass("margin");
            echo Form::_("button",T("TEMPLATE.BACK"))->onclick("window.location='".route("roles")."'")->addClass("margin");
            ?>

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <?php echo Form::close(); ?>
</div>
