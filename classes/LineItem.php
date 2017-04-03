<?php
class LineItem{
		private $item;
		private $quantity;

		public function __construct($item, $price, $quantity) {
			$this-> item = $item;
			$this-> price = $price;
			$this-> quantity = $quantity;
		}

		public function __toString() {
			return $this -> item . $this -> price . $this -> quantity;
		}
	
		public function getQuantity(){
			return $this->quantity;
		}
	
		public function changeQuantity($value){
			$this->quantity += $value;
		}
	
		public function getItem(){
			return $this->item;
		}
		
		public function getPrice(){
        echo $this->price;
        }
}

