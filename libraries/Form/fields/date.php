<div class="form-group">
	<label for="<?php echo $element->attribute("id"); ?>" class="col-sm-2 control-label"><?php echo $element->label; ?></label>
	<div class="col-sm-<?php echo $element->input_size; ?>">
		<input type="email" <?php echo extract_attribute($element->attribute);  ?> />
	</div>
</div>