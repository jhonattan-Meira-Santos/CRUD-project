<?php 
//Configurações de banco e classes
require "../config.php";
require "./classes/products.php";
require "./classes/categories.php";

$products = new products();
$categories = new categories();

?>