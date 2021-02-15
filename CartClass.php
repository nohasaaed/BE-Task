<?php 

class Cart{
    public $items = [];
  
    public function addItem(array $values){
      $total = 0; 
      $id = $values["item_id"]; 
      $name = $values["item_name"];
      $price = $values["item_price"];
      $quantity = $values["item_quantity"];
      $total = $total + ($values["item_quantity"] * $values["item_price"]);  

      $connect = mysqli_connect("localhost", "root", "", "task"); 
      $sql = "INSERT INTO cart (id,product_id,item_name, unit_price,quantity,items_total)
      VALUES (Null, '$id', '$name' , $price , $quantity , $total )";
      
      if ($connect->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
      } 
    }

    public function getItems(){
      $connect = mysqli_connect("localhost", "root", "", "task"); 
      $query = "SELECT * FROM cart ORDER BY id ASC";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
            array_push($this->items,$row);
           }
      }
      return $this->items;
  }
  
  }

?>