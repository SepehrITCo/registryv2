<?php 
	$columns = $this->get("columns");
	$data = $this->get("data");
	$class = "";
	$t = Template::getInstance();
	$t->js("datatable.min.js");
	$t->js("datatable.bootstrap.js");
	$t->css("datatable.css");
	if($this->get("class")){
		$class = $this->get("class");
	}
	$lang = Language::getInstance();
	$this->set("attribute.language.url",route("/language/".$lang->language."/datatable.json"));

?>
<script language="javascript">
	jQuery(document).ready(function($){
	 $('.datatable').DataTable(<?php echo json_encode($this->get("attribute")); ?>);
  });
</script>
<div class="box-body ">
	  <table class="table datatable table-responsive no-padding datatable <?php echo $class; ?>">
		<thead>
		<tr>
		  <?php
			foreach($columns as $column){
				echo "<th width=\"".@$column["width"]."\">".$column["title"]."</th>";
			}
		  ?>
		</tr>
		</thead>
		<tbody>
		<?php
			foreach($data as $row){
				echo "<tr>";
				foreach($columns as $column=>$attribute){
					echo "<td>".$row[$column]."</td>";
				}
				echo "</tr>";
			}
		?>

	  </tbody>
	  </table>
</div>

