<?php
class Bill
{   
    private $strategy;

    public function setStrategy(Bill_Type $strategy)
    {
        $this->strategy = $strategy;
    }

    public function display_bill(Cart $data): void
    { 
        $this->strategy->produce_bill($data);
        
    }
}


interface Bill_Type
{   
    public function produce_bill(Cart $data): void;
}


class Bill_USD implements Bill_Type
{
  
   public $discounts = 0;
  
   public function check_discounts(Cart $data){
    $discount_shoes = 0;
    $counter = 0;
    $discount_jacket = 0;
    
    //check discount for shoes
    foreach($data->items as $key=>$value){
      if($value->name == 'Shoes'){
      $discount_shoes += $value->price * 10/100;
      }
    }
    if($discount_shoes > 0){
      echo "<br>";
      echo "10% off shoes: - " .$discount_shoes;
    }

    //check discount for Jacket
    foreach($data->items as $key=>$value){
      if($value->name == 'T-shirt'){
      $counter += 1;
      }
    }

    foreach($data->items as $key=>$value){
      if($counter > 1){
        if($value->name == 'Jacket'){
            $counter -= 2;
            $discount_jacket += $value->price * 50/100;
          }
        }
      }

      if($discount_jacket > 0){
        echo "<br>";
        echo "50% off jacket: - " .$discount_jacket;
      }
      
      $this->discounts = $discount_shoes + $discount_jacket;
   }
   

    public function produce_bill(Cart $data): void
    {
      print_r($data);
      $sum = 0;
      $taxes = 0;
      $total = 0;

      foreach($data->items as $key=>$value){
        if(isset($value->price))
           $sum += $value->price;
      }
      $taxes = $sum*14/100;
      echo "<br>";
      echo "Subtotal = $".$sum;
      echo "<br>";
      echo "Taxes = $".$taxes;
      $this->check_discounts($data);
      $total = $sum + $taxes - $this->discounts;
      echo "<br>";
      echo "Total = $".$total;
    }
}

class Bill_EG implements Bill_Type
{
  public $discounts = 0;
  
  public function check_discounts(Cart $data){
   $discount_shoes = 0;
   $counter = 0;
   $discount_jacket = 0;
   
   //check discount for shoes
   foreach($data->items as $key=>$value){
     if($value->name == 'Shoes'){
     $discount_shoes += $value->price * 10/100;
     }
   }
   if($discount_shoes > 0){
     echo "<br>";
     echo "10% off shoes: - " .$discount_shoes*15.75;
   }

   //check discount for Jacket
   foreach($data->items as $key=>$value){
     if($value->name == 'T-shirt'){
     $counter += 1;
     }
   }

   foreach($data->items as $key=>$value){
     if($counter > 1){
       if($value->name == 'Jacket'){
           $counter -= 2;
           $discount_jacket += $value->price * 50/100;
         }
       }
     }
     

     if($discount_jacket > 0){
       echo "<br>";
       echo "50% off jacket: - " .$discount_jacket*15.75;
     }
     
     $this->discounts = $discount_shoes + $discount_jacket;
  }
  

   public function produce_bill(Cart $data): void
   {
     print_r($data);
     $sum = 0;
     $taxes = 0;
     $total = 0;

     foreach($data->items as $key=>$value){
       if(isset($value->price))
          $sum += $value->price;
     }
     $sum = $sum*15.75;
     $taxes = $sum*14/100;
     echo "<br>";
     echo "Subtotal = ".$sum." EG";
     echo "<br>";
     echo "Taxes = ".$taxes." EG";
     $this->check_discounts($data);
     $total = $sum + $taxes - $this->discounts;
     echo "<br>";
     echo "Total = ".$total." EG";
   }

}
?>