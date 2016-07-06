<?php 
	defined("_IW") or die( "DIRECT ACCESS NOT ALLOWED" );
	
class Date_en_GB implements DateInterface
{
	protected $time;

	protected $formats = array(
		'datetime' => '%Y-%m-%d %H:%M:%S',
		'date'     => '%Y-%m-%d',
		'time'     => '%H:%M:%S',
	);

	public static function forge($str = null)
	{
		$class = __CLASS__;
		return new $class($str);
	}

	public function __construct($str = null)
	{
		if ($str === null){
			$this->time = time();
		}
		else
		{
			if (is_numeric($str)){
				$this->time = $str;
			}
			else
			{
				$time = strtotime($str);

				if (!$time){
					$this->time = false;
				}
				else{
					$this->time = $time;
				}
			}
		}
	}

	public function time()
	{
		return $this->time;
	}

	public function format($str)
	{
		// convert alias string
		if (in_array($str, array_keys($this->formats))){
			$str = $this->formats[$str];
		}

		
		// if valid unix timestamp...
		if ($this->time !== false){
			return strftime($str, $this->time);
		}
		else{
			return false;
		}
	}

	public function reforge($str)
	{
		if ($this->time !== false)
		{
			// amend the time
			$time = strtotime($str, $this->time);

			// if conversion fails...
			if (!$time){
				// set time as false
				$this->time = false;
			}
			else{
				// accept time value
				$this->time = $time;
			}
		}

		return $this;
	}

	public function ago($till = null)
	{
		if($till != null){
			$now = $till;
		}else{
			$now = time();
		}
		
		$time = $this->time();

		// catch error
		if (!$time) return false;

		// build period and length arrays
		$periods = array('Second', 'Minute', 'Hour', 'Day', 'Week', 'Month', 'Year', 'Age');
		$lengths = array(60, 60, 24, 7, 4.35, 12, 10);

		// get difference
		$difference = $now - $time;

		// set descriptor
		if ($difference < 0)
		{
			$difference = abs($difference); // absolute value
			$negative = true;
		}

		// do math
		for($j = 0; $difference >= $lengths[$j] and $j < count($lengths)-1; $j++){
			$difference /= $lengths[$j];
		}

		// round difference
		$difference = intval(round($difference));
		$s = ($difference > 1)? "s" : "";
		// return
		return number_format($difference).' '.$periods[$j].$s.' '.(' Ago');
	}

	public function until($till = null)
	{
		return $this->ago($till);
	}
	
	public function toMySQL(){
		return $this->format("%Y-%m-%d %H:%i:%s");
	}
}