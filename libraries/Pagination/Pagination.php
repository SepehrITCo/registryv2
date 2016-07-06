<?php 

	class Pagination{
		public $size = 20;
		public $page = 1;
		public $total = 0;
		public $col = false;
		public $sort = false;
		private $cookie;
		private $hash;
		private $model;
		private $filter = false;
		private $condition = array();
		

		public function __construct($model,$columns,$filter = false,$size = false,$page = false,$col = false,$sort = false){
			$this->model = $model;
			$this->columns = $columns;
			$this->filter = $filter;
			
			$this->col = $col;
			$this->sort = $sort;

			if(!$filter) {
				$this->total = call_user_func(array($model, 'count'));
			}else{
				$this->condition = $this->condition($columns);
				$this->total = call_user_func(array($model, 'count'),["conditions"=>$this->condition]);
			}
			$this->cookie = Cookie::getInstance();
			$uri = app("REQUEST.URI");
			$this->hash = md5($uri);
			if(	$page && $size){
				$this->page = $page;
				$this->size = $size;
				$this->cookie->set($this->hash, ["size"=>$this->size,"page"=>$this->page], 3600 );
			}else {

				if ($this->cookie->exists($this->hash)) {
					$data = $this->cookie->get($this->hash);
					$this->size = $data["size"];
					$this->page = $data["page"];
				}

			}
			
		}

		public function getData(){
		
			if($this->col && $this->sort){
				$order = $this->col." ".$this->sort;
			}else{
				$order = "";
			}
			return call_user_func(array($this->model, 'find'),
				"all",
				["limit"=>$this->size,"offset"=>$this->getOffset(),"conditions"=>$this->condition,"order"=>$order]
			);

		}
		public function condition(){
			$this->condition = array("");
			foreach($this->columns as $key=>$column){
				if(isset($column["filter"]) ){
					$this->condition[0] .= " OR `".$key."` ".str_replace("*","?" ,$column["filter"] );
					$this->condition[] = $this->filter;
				}
			}
			$this->condition[0] = substr($this->condition[0],4 );
			return $this->condition;
		}
		public function getOffset(){
			return (((int)$this->page)-1)*((int)$this->size);
		}
		
		public function render($class = "pagination pagination-sm no-margin pull-right"){
			$uri = Router::getInstance()->onlyURL();
		

			$total_pages = ceil($this->total/$this->size);
			$counter = $this->page;
			$limiter = 3;
			$html = "<ul class='$class'>";
			if($this->page > 1)
			$html .= "<li><a href=\"".
			route($uri,array(
				"p:"=>1,
				"size:"=>$this->size,
				"q:"=>$this->filter,
				"col:"=>$this->col,
				"sort:"=>$this->sort
				))
			."\">«</a></li>";
			while($counter > 1 && $limiter > 0){
				$limiter--;
				$counter--;
				$html .= "<li><a href=\"".
				route($uri,array(
				"p:"=>$counter,
				"size:"=>$this->size,
				"q:"=>$this->filter,
				"col:"=>$this->col,
				"sort:"=>$this->sort
				))
				."\">".$counter."</a></li>";
			}
			
			$counter = $this->page;
			$limiter = 3;
			$html .= "<li class='active'><a href=\"".
			route($uri,array(
				"p:"=>$this->page,
				"size:"=>$this->size,
				"q:"=>$this->filter,
				"col:"=>$this->col,
				"sort:"=>$this->sort
			))
			."\">".$this->page."</a></li>";
			while($counter < $total_pages && $limiter > 0){
				$limiter--;
				$counter++;
				$html .= "<li><a href=\"".
				route($uri,array(
				"p:"=>$counter,
				"size:"=>$this->size,
				"q:"=>$this->filter,
				"col:"=>$this->col,
				"sort:"=>$this->sort
				))
				."</a></li>";
			}		
			if($this->page < $total_pages)
			$html .= "<li><a href=\"".route($uri."p/".$this->size."/".($total_pages))."\">»</a></li>";
			$html .= "</ul>";
			$options = "";
			$sizes = array("10","20","40","80","100");
			for ($i = 0; $i < count($sizes); $i++){
				$size = $sizes[$i];
				$checked = ($size."" == $this->size."")?"selected='selected'":"";
				$options .= "<option $checked>".($size)."</option>";
			}

			$html .= "<span>".T("TEMPLATE.RESULT_PER_PAGE")."</span><select id='result_per_page' onchange=\"window.location='".route($uri,array(
			"p:"=>$this->page,
			"size:"=>$this->size,
			"q:"=>$this->filter,
			"col:"=>$this->col,
			"sort:"=>$this->sort,
			))."/s:'+this.value\">".$options."</select>  &nbsp;&nbsp;";
			$html .= "<span>".T("TEMPLATE.PAGE")." ".$this->page." ".T("TEMPLATE.OF")." ".$total_pages."</span>  ";

			return $html;
		}


		
	}