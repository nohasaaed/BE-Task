<?php
require_once('ProductClass.php');
require_once('CartClass.php');
require_once('BillClass.php');


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









