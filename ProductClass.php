<?php 
class Products{
  public $products = [];
  
  public function get_products(){
      $connect = mysqli_connect("localhost", "root", "", "task"); 
      $query = "SELECT * FROM products ORDER BY id ASC";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
            array_push($this->products,$row);
           }
      }
      return $this->products;
  }

}
?>
