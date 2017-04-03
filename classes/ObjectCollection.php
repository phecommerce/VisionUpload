<?php
class ObjectCollection{

		private $line_items_array;

		private $lineCounter;

		public function __construct() {
			$this->line_items_array = array();
			$this->lineCounter=0;
		}

		public function addLineItem($line_item) {
			$this->lineCounter++;
			$this->line_items_array[] = $line_item;
		}

		public function getLineCount() 	{
		   return $this->lineCounter;
		}

		public function getLineItem($i) {
		    return $this->line_item;
		}

		public function delLineItem($line_item){
        //Check to see if $line_item exists
	    if(($key = array_search($line_item, $this->line_items_array )) !== false) {
		//remove portion of the array
		array_splice($this->line_items_array, $key, 1);
		$this->lineCounter--;
         }
	    }
	    

}
