<ul class="mailbox-attachments clearfix">
<?php 
	IW::Lib("Downloader");
	$attachment = @json_decode($message->attachment);
	$downloader = new Downloader();
	if(count($attachment) > 0 && !isset($reply))
		foreach($attachment as $item):
		$download = $downloader->find($item);
		if(Text::startsWith($download->thumb,"icon:")){
			$thumb = "<span class=\"mailbox-attachment-icon\"><i class=\"fa fa-".substr($download->thumb,5,30)."\"></i></span>";
		}else{
			$thumb = "<span class=\"mailbox-attachment-icon has-img\"><img src=\"".$download->thumb."\" alt=\"".$download->name."\"></span>";
		}
?>
<li>
	<?php echo $thumb; ?>

  <div class="mailbox-attachment-info">
	<a href="<?php echo route("core/attachment/".$download->id); ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $download->name; ?></a>
		<span class="mailbox-attachment-size">
		  <?php echo $download->size; ?>
		  <a href="<?php echo route("core/attachment/".$download->id); ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
		</span>
  </div>
  <input type="hidden" name="form[attachment][]" value="<?php echo $download->id; ?>" />
</li>
<?php endforeach; ?>
</ul>