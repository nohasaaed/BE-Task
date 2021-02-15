<?php 
require_once('CartClass.php');
require_once('offers.php');

class Bill
{   
    private $strategy;

    public function setStrategy(Bill_Type $strategy)
    {
        $this->strategy = $strategy;
    }

    public function display_bill(): void
    { 
        $this->strategy->produce_bill();
        
    }
}


interface Bill_Type
{   
    public function produce_bill(): void;
}


class Bill_USD implements Bill_Type
{

    public $subtotal = 0;
    public $taxes = 0;
    public $alldiscount = 0;
    public $total = 0;


    public function check_discounts(){
        $discount = 0;
        $discount_desc ="";

        //get Cart items
        $obj = new Cart();    
        $data = $obj->getItems();

        //get offers
        $offer = new Offer();
        $offers = $offer->getOffers();

        //check if product that user selected on offer or not
        foreach($data as $keys => $values){
            $discount = 0;
            $discount_desc ="";
            
            foreach($offers as $offer){
              if($values['product_id'] == $offer['product_id']){
                if($offer['dependant_product'] == Null){
                $discount += $values['items_total'] * $offer['discount_value']/100;
                $discount_desc = $offer['description'];
                
                }else{
                    foreach($data as $keys => $values){
                        if($values['product_id'] ==  $offer['dependant_product']){
                            if($values['quantity'] == $offer['dependant_amount']){
                             $discount += $values['items_total'] * $offer['discount_value']/100;
                             $discount_desc = $offer['description'];
                            } 
                        }
                    }
                }
              }
              
              //add all avail discounts in one variable
              $this->alldiscount = $this->alldiscount + $discount;
           }

            if($discount > 0){
                echo "<br>";
                echo $discount_desc ."= $-" . $discount;
            }
       }  
    }

    

    public function subtotal(){
        $obj = new Cart();    
        $data = $obj->getItems();
        $total = 0;
        foreach($data as $keys => $values)  
        {
            $total = $total + $values['items_total'];
        }
        echo "Subtotal = $".$total;
        $this->subtotal = $total;
    }

    public function taxes(){
        echo "<br>";
        echo "Taxes = $".$this->subtotal * 14/100;
        $this->taxes = $this->subtotal * 14/100;
    }

    public function total(){
        $this->total = $this->subtotal + $this->taxes - $this->alldiscount;
        echo "<br>";
        echo "Total = $".$this->total;
    }

    public function produce_bill():void{
      $this->subtotal();
      $this->taxes();
      $this->check_discounts();
      $this->total();
    }
 
}

class Bill_EG implements Bill_Type
{
    public $subtotal = 0;
    public $taxes = 0;
    public $total = 0;
    public $alldiscount = 0;

    public function check_discounts(){
        $discount = 0;
        $discount_desc ="";

        //get Cart items
        $obj = new Cart();    
        $data = $obj->getItems();
        
        //get offers
        $offer = new Offer();
        $offers = $offer->getOffers();

        //check if product that user selected on offer or not
        foreach($data as $keys => $values){
            $discount = 0;
            $discount_desc ="";
            foreach($offers as $offer){   
              if($values['product_id'] == $offer['product_id']){
                if($offer['dependant_product'] == Null){
                $discount += $values['items_total'] * $offer['discount_value']/100;
                $discount_desc = $offer['description'];

                }else{
                    foreach($data as $keys => $values){
                        if($values['product_id'] ==  $offer['dependant_product']){
                            if($values['quantity'] == $offer['dependant_amount']){
                             $discount += $values['items_total'] * $offer['discount_value']/100;
                             $discount_desc = $offer['description'];
                            }
                        }
                    }
                }
              }
            //add all avail discounts in one variable
            $this->alldiscount = $this->alldiscount + $discount;
            }

            if($discount > 0){
                echo "<br>";
                echo $discount_desc ."= -" . $discount*15.7 ." EG";
            }
  
       }  
    }


    public function subtotal(){
        $obj = new Cart();    
        $data = $obj->getItems();
        $total = 0;
        foreach($data as $keys => $values)  
        {
            $total = $total + $values['items_total'];
        }
        echo "Subtotal = ".$total*15.7 ." EG";
        $this->subtotal = $total;
    }

    public function taxes(){
        echo "<br>";
        echo "Taxes = ". $this->subtotal * 0.14*15.7 ." EG";
        $this->taxes = $this->subtotal * 14/100;
    }

    public function total(){
        $this->total = $this->subtotal + $this->taxes - $this->alldiscount;

        $this->total = $this->subtotal + $this->taxes;
        echo "<br>";
        echo "Total = ".$this->total *15.7 ." EG";
    }

    public function produce_bill():void{
      $this->subtotal();
      $this->taxes();
      $this->check_discounts();
      $this->total();
    }

}

?>




