<?php 
	$element->attribute("class",
	str_replace("form-control","btn",$element->attribute("class"))
	);
	
?>
<button type="button" <?php echo extract_attribute($element->attribute);  ?>><?php echo $element->label; ?></button>