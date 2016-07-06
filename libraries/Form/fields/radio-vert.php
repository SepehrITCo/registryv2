<div class="form-group">
	<label class="col-sm-<?php echo $element->label_size; ?>" for="<?php echo $element->attribute("id"); ?>"><?php echo $element->label; ?></label>
	<div class="col-sm-<?php echo $element->input_size; ?>">
	<?php foreach($element->options as $key=>$value): ?>
	<label>
		<input type="radio" value="<?php echo $key; ?>"  <?php echo extract_attribute($element->attribute);  ?> <?php if(in_array($key,$element->selected) || in_array($value,$element->selected)) echo "checked"; ?> />
		<?php echo $value; ?>
	</label>
	<?php endforeach; ?>
	</div>
</div>