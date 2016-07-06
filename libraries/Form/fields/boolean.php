<div class="form-group">
	<label class="col-sm-<?php echo $element->label_size; ?>" for="<?php echo $element->attribute("id"); ?>"><?php echo $element->label; ?></label>
	<div class="col-sm-<?php echo $element->input_size; ?>">
		<label>
			<input type="radio" value=true <?php echo extract_attribute($element->attribute); if(@$element->selected[0] === true) echo "checked"; ?> />
			<?php P("TEMPLATE.YES"); ?>
		</label>
		<label>
			<input type="radio" value=false  <?php echo extract_attribute($element->attribute); if(@$element->selected[0] === false)  echo "checked"; ?> />
			<?php P("TEMPLATE.NO"); ?>
		</label>
	</div>
</div>