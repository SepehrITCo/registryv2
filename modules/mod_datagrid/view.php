<?php 
	$columns = $this->get("columns");
	$data = $this->get("data");
	$class = "";
	if($this->get("class")){
		$class = $this->get("class");
	}
	
	$t = Template::getInstance();
	$t->js("datatable.bootstrap.js");
	$t->css("datatable.css");
?>
<div class="box-body table-responsive no-padding">
	  <table class="table <?php echo $class; ?>">
		<thead>
		<tr>
		  <?php
			$sort = (Router::param("sort:") == "asc")?"desc":"asc";
			$query = Router::param("q:");
			$uri = trim(Router::getInstance()->onlyURL(),"/");
			foreach($columns as $key=>$column){
			
				$sorting = "";
				if(@$column["sort"] == true){
					$sorting = "class='sorting'";
				}
				if(!is_null($this->get("sort_col")) &&  $key == $this->get("sort_col")){
					if($this->get("sort") == "desc"){
						$sorting = "class='sorting_desc'";
					}else{
						$sorting = "class='sorting_asc'";
					}
				}
				if(@$column["sort"] == true){
					$sorting .= " onclick='window.location=\"".
					route($uri,array(
					"q:"=>$query,
					"col:"=>$key,
					"sort:"=>$sort
					))
					."\"'";
				}
				echo "<th $sorting width=\"".@$column["width"]."\">".$column["title"]."</th>";
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

<?php if($this->get("pagination")): ?>
	<div class="box-footer clearfix">
	 <?php echo $this->get("pagination"); ?>
	</div>
<?php endif; ?>