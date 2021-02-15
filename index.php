<?php 
require_once('ProductClass.php');
require_once('CartClass.php');
require_once('bill.php');


$product = new Products();
$item = new Cart();

 if(isset($_POST["add_to_cart"]))  
 {  
    $item_array = array(  
        'item_id'          =>     $_GET["id"],  
        'item_name'        =>     $_POST["hidden_name"],  
        'item_price'       =>     $_POST["hidden_price"],  
        'item_quantity'    =>     $_POST["quantity"], 
        'items_total'      =>     $_POST["quantity"] * $_POST["hidden_price"]  
   ); 
    $item->addItem($item_array);
 }  
 ?> 
  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>BE Task</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container">  
                <?php  
                $array = $product->get_products();  
                foreach($array as $item => $row) {
                ?>  
                <div class="col-md-3"> 
                     <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>"> 
                        <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                        <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>  
                        <input type="text" name="quantity" class="form-control" value="1" />  
                        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                     </form>  
                </div> 
   
                <?php  
                }   
                ?>  
                <form  method="post">
                    <select name="currency">
                       <option value="EG" selected>EG</option>
                       <option value="USD">USD</option>
                    </select>
                    <input type="submit" name="submit" value="Checkout">
                </form>

            <?php
                  if(isset($_POST['submit'])){
                    if(!empty($_POST['currency'])) {
                       $selected = $_POST['currency'];
                    }

                $item = new Cart();
                $bill = new bill();

                if($selected == "EG"){
                   $bill->setStrategy(new Bill_EG());
                }else{
                $bill->setStrategy(new Bill_USD());
                }

                echo "<h3>Bill Details</h3>";
                $bill->display_bill();
                }
            ?> 

      </body>  
 </html>