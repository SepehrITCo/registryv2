<?php 
if($element->attribute("multiple") === true) {
	$element->attribute("name","form[".$element->name."][]");
}
?>
<div class="form-group">
<?php $element->addClass("select2"); ?>
<label for="<?php echo $element->attribute("id"); ?>" class="col-sm-<?php echo $element->label_size; ?>"><?php echo $element->label; ?></label>
<div class="col-sm-<?php echo $element->input_size; ?>">
<?php echo $element->pre; ?>
<select <?php echo extract_attribute($element->attribute); ?> >
	<?php 
		
		foreach($element->options as $key=>$value){
			$selected = (in_array($key,$element->selected) || in_array($value,$element->selected))?"selected":""; 
			echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
	?>
</select>
<?php echo $element->post; ?>
</div>
</div>