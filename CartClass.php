<?php 

class Cart{
    public $items = [];
  
    public function addItem(Product $item){
      array_push($this->items, $item);
    }

    public function getItems(){
      return $this->items;
    }
  
  }

?>