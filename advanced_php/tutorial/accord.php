<?php
	class Accord
	{
		private $vin_number;
		private $odometer;
		public $color;
		
		public function __construct()
		{
			$this->odometer = 0;
		}
		
		public function drive()
		{
			echo "<br />driving <br />";
			$this->update_odometer(1);
		}
		
		public function stop()
		{
			echo "stopping <br />";
		}
		
		private function update_odometer($num)
		{
			$this->odometer = $this->odometer + $num;
			echo "updating odometer. Currently odometer is now " . $this->odometer;
		}
	}
	
	$michaelAccord = new Accord();
	$michaelAccord->drive();
	$michaelAccord->drive();
	$michaelAccord->drive();
	var_dump($michaelAccord);
	//$michaelAccord->updated_odometer(-400);
?>