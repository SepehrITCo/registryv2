<?php 
	$element->attribute("class",
	str_replace("form-control","btn btn-primary",$element->attribute("class"))
	);
	
?>
<button type="submit" <?php echo extract_attribute($element->attribute);  ?>><?php echo $element->label; ?></button>