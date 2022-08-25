<?php
/*
/ Chama a classe que adiciona os produtos no banco de dados
*/
require "../../config.php";
require "../classes/products.php";
$products = new products();

$nome        = $_POST['name'];
$sku         = $_POST['sku'];
$price       = $_POST['price'];
$quantity    = $_POST['quantity'];
$categories  = $_POST['categories'];
$description = $_POST['description'];
if($_POST['edit'] != 0){
    $id = $_POST['edit'];
    $products->edit($nome,$sku,$quantity,$categories,$description,$categories, $id);
}else{
    $products->create($nome,$sku,$price,$quantity,$description, $categories);
}
?>