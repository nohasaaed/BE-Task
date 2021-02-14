<?php
require_once('ProductClass.php');
require_once('CartClass.php');
require_once('BillClass.php');

$user = 'root';
$password = '';
$database = 'task';
$database = new mysqli('localhost',$user,$password,$database) or die ("unable to connent");

//set product into cart
if(isset($_POST["add_to_cart"]))
{
    $id = $_GET["id"];
    $sql = "INSERT INTO cart (product_id,id) VALUES ($id, NULL)";

    if ($database->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


//display products
$sql = "SELECT * FROM Products";
if($result = mysqli_query($database, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            ?>
                   <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
	                 <h4 class="text-info"><?php echo $row["name"]; ?></h4>
		         <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
		         <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
		    </form>
                <?php
        }
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($database);
}

// Close connection
mysqli_close($database);






//Add available products
$t_shirt = new Product();
$pants   = new Product();
$jacket  = new Product();
$shoes   = new Product();
$t_shirt->set_name('T-shirt');
$t_shirt->set_price(10.99);

$pants->set_name('Pants');
$pants->set_price(14.99);

$jacket->set_name('Jacket');
$jacket->set_price(19.99);

$shoes->set_name('Shoes');
$shoes->set_price(24.99);

//Create shopping cart
 $cart = new Cart();
 $cart->addItem($t_shirt);
 $cart->addItem($t_shirt);
 $cart->addItem($shoes);
 $cart->addItem($jacket);

//Produce bill
$bill = new Bill();

//select bill type
$bill->setStrategy(new Bill_USD());
$bill->display_bill($cart);
?>









