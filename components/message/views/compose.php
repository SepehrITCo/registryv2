<?php 
	$t = Template::getInstance();
	$t->css("bootstrap3-wysihtml5.min.css");
	$t->js("bootstrap3-wysihtml5.all.min.js");
	$t->js("form.extend.js");
	app("PAGE.H1",T("MESSAGE.COMPOSE"));
	IW::Lib("Form");
	echo Form::create("message.compose")->action(route("message/compose"))->method("POST"); 
	withModel();
	$user = Auth::getUserOrFail();
	$load = false;
	if(isset($forward) || isset($reply)){
		$message  = Messages::find("first", ["conditions"=> ["(`from`=? OR receipt=?) AND id=?",$user->id,$user->id,$id] ] );
		$from = Users::find("first", ["conditions"=> ["id=?",$message->from] ] );
		$receipt = Users::find("first", ["conditions"=> ["id=?",$message->receipt] ] );
		$date = Date::forge($message->sent_on);
		$load = true;
	}
?>
<script language="javascript">

   


	var draft = false;
	jQuery(document).ready(function ($){
		$("#compose-textarea").wysihtml5();
		attachEvt($);
	})
	
	function attachEvt($){
		$("#attachment").change(function () {

			$.ajaxFileUpload({
				url:'<?php echo route("message/attachment"); ?>',
				secureuri:false,
				fileElementId:'attachment',
				dataType: 'json',
				success: function(data,status){

					if(data.status){
						if(data.thumb.startsWith("icon:")){
							thumb = "<span class=\"mailbox-attachment-icon\"><i class=\"fa fa-"+data.thumb.substr(5,30)+"\"></i></span>"
						}else{
							thumb = "<span class=\"mailbox-attachment-icon has-img\"><img src=\""+data.thumb+"\" alt=\""+data.name+"\"></span>"
						}
						item = "<li aria-id="+data.id+">"+
						 thumb+
						  "<div class=\"mailbox-attachment-info\">"+
							"<a href=\"<?php echo route("core/attachment/"); ?>"+data.id+"\"  class=\"mailbox-attachment-name\"><i class=\"fa fa-"+data.icon+"\"></i> "+data.name+"</a>"+
								"<span class=\"mailbox-attachment-size\">"+
								  data.size+
								  "<a href=\"<?php echo route("core/attachment/"); ?>"+data.id+"\" class=\"btn btn-default btn-xs pull-right\"><i class=\"fa fa-cloud-download\"></i></a>"+
								   "<a href=\"javascript:removeAttachment("+data.id+")\" class=\"btn btn-default btn-xs pull-right\"><i class=\"fa fa-trash\"></i></a>"+
								"</span>"+
						  "</div>"+
						  "<input type=\"hidden\" name=\"form[attachment][]\" value=\""+data.id+"\" />"+
						"</li>";
						$(".mailbox-attachments").append(item)
					}else{
						App.alert("<?php P("MESSAGE.FAILED_TO_ATTACH"); ?>");
					}
					
				},
				error: function(data,status,e){
					//print error
					App.alert("<?php P("MESSAGE.FAILED_TO_ATTACH"); ?>"+"<BR/>"+e);
				}
			});
			$(this).val("")
			attachEvt($)
		})
	}
	
	function removeAttachment(id){
		App.confirm("<?php P("MESSAGE.ARE_U_SURE_REMOVE_ATTACHMENT"); ?>",function(){
			
			jQuery.ajax({
				url:"<?php echo route("core/attachment/"); ?>"+id,
				type: "POST",
				data:{ "id":id },
				dataType: 'json',
				success:function(data,status,xhr){
					if(data.status){
						jQuery("li[aria-id="+id+"]").remove()
					}else{
						App.alert("<?php P("MESSAGE.FAILED_TO_REMOVE_ATTACH"); ?>");
					}
				},
				error:function(data,status,e){
					App.alert("<?php P("MESSAGE.FAILED_TO_REMOVE_ATTACH"); ?>"+"<BR/>"+e);
				}
			})
		})
		
	}
</script>
 <div class="row">
		<?php if(isset($forward)): ?>
			<input type="hidden" name="form[forward]" value="true" />
		<?php endif; ?>
		<?php if(isset($reply)): ?>
			<input type="hidden" name="form[reply]" value="true" />
		<?php endif; ?>
        <div class="col-md-3">
          <a href="<?php echo route("message/inbox"); ?>" class="btn btn-primary btn-block margin-bottom"><?php P("MESSAGE.BACK_TO_INBOX"); ?></a>

			<?php require "left.php"; ?>

        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php P("MESSAGE.COMPOESE_MESSAGE"); ?></h3>
            </div>
            <div class="box-body">
              <div class="form-group">
			  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
				<select class="form-control select2" name="form[to][]" multiple="multiple" data-placeholder="<?php P("MESSAGE.TO"); ?>" >
                  <?php
					$users = Users::find("all",["conditions"=>"id != ".Auth::getUser()->id]);
					foreach($users as $item){
						$selected = ($load && $item->id == $message->from)?"selected":"";
						echo "<option value='".$item->id."' ".$selected.">".$item->name."</option>";
					}
				  ?>
                </select>
                
              </div>
			  </div>
              <div class="form-group">
			  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
				<select class="form-control select2" name="form[bcc][]" multiple="multiple" data-placeholder="<?php P("MESSAGE.BCC"); ?>" >
                  <?php
					
					foreach($users as $item)
						echo "<option value='".$item->id."'>".$item->name."</option>";
				  ?>
                </select>
                
              </div>
			  </div>
              <div class="form-group">
			  <div class="input-group">
				<div class="input-group-addon">
                    <i class="fa fa-commenting"></i>
                  </div>
                <input name="form[subject]" type="text" class="form-control" placeholder="<?php P("MESSAGE.SUBJECT"); ?>" value="<?php if(isset($forward)) echo "FW:".$message->subject;  if(isset($reply)) echo "RE:".$message->subject; ?>">
			  </div>
              </div>
              <div class="form-group">
                    <textarea name="form[body]" id="compose-textarea" class="form-control" style="height: 300px"><?php 
					
					if(isset($forward)) echo "<br/><br/><hr/><u><b>".T("MESSAGE.FROWARDED_FROM")." ".$from->name." ".T("MESSAGE.ON")." ".$date->format("%d %b %Y %I:%M %p")." </b></u><br/>".$message->body; 
					if(isset($reply)) echo "<br/><br/><hr/><u><b>".T("MESSAGE.REPLY_TO")." ".$message->subject." ".$from->name." ".T("MESSAGE.ON")." ".$date->format("%d %b %Y %I:%M %p")." </b></u><br/>".$message->body; 
					
					?></textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> <?php P("MESSAGE.ATTACHMENT"); ?>
                  <input type="file" id="attachment" name="attachment">
                </div>
                <p class="help-block"><?php P("MESSAGE.MAX_FILE_SIZE"); ?> 5MB</p>
              </div>
				<?php if($load) require "attachment.php"; else echo "<ul class=\"mailbox-attachments clearfix\"></u>"; ?>
		
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i>  <?php P("MESSAGE.DRAFT"); ?></button>
                <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o"></i>  <?php P("MESSAGE.SEND"); ?></button>
              </div>
              <button type="reset" class="btn btn-default" onclick="window.location='<?php echo route("message/inbox"); ?>'"><i class="fa fa-times"></i>  <?php P("MESSAGE.DISCARD"); ?></button>
            </div>
          </div>
        </div>
      </div>
<?php Form::close(); ?>

