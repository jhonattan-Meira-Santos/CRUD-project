<?php
/*
/ Chama a classe que adiciona as categorias no banco de dados
*/
require "../../config.php";
require "../classes/products.php";

$produtos = new products();

$id = $_POST['id'];

$produtos->deleteProdutos($id);
echo 'request confirmed!';
?>