<?php
 class Product {
    // Properties
    public $name;
    public $price;

  
    // Methods
    function set_name($name) {
      $this->name = $name;
    }
    function get_name() {
      return $this->name;
    }
    function set_price($price) {
      $this->price = $price;
    }
    function get_price() {
      return $this->price;
    }
  }
?>
