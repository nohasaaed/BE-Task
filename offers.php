<?php 

class Offer{
    public $offers = [];

    public function getOffers(){
      $connect = mysqli_connect("localhost", "root", "", "task"); 
      $query = "SELECT * FROM offers ORDER BY id ASC";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
            array_push($this->offers,$row);
           }
      }
      return $this->offers;
  }
  
  }

?>