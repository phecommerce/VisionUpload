<?php

class Item {

private $id;
private $description;
private $image;
private $price;
private $Nprice;

public function __construct($id, $description, $price, $image) {
$this->id = $id;
$this->description = $description;
$this->price = $price;
$this->image = $image;
}


public function __toString()
    {
      return $this->id . $this->description . $this->price . $this->image;
    
    }
    
public function getId(){
echo $this->id;
}

public function getPrice(){
echo $this->price;
}

public function setDescription($description){
       $this->description = $description;
    }
    
public function getDescription(){
       echo $this->description;
    }
    
public function setImage($image){
       $this->image = $image;
    }
    
public function getImage(){
       echo $this->image;
    }
public function setNprice($Nprice){
       $this->price = $Nprice;
    }
    

}
