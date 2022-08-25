<?php
/*
/ Chama a classe que adiciona as categorias no banco de dados
*/
require "../../config.php";
require "../classes/categories.php";

$categorie = new categories();

$id = $_POST['id'];

$categorie->deleteCategoria($id);
echo 'request confirmed!';
?>