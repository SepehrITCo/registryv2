<div class="form-group">
	<label for="<?php echo $element->attribute("id"); ?>" class="col-sm-<?php echo $element->label_size; ?> control-label"><?php echo $element->label; ?></label>
	<div class="col-sm-<?php echo $element->input_size; ?> input-group">
		<?php echo $element->pre; ?>
		<input type="text" <?php echo extract_attribute($element->attribute);  ?> />
		<?php echo $element->post; ?>
	</div>
</div>