<?php
/*
/ Chama a classe que adiciona as categorias no banco de dados
*/
require "../../config.php";
require "../classes/categories.php";
$categories = new categories();
$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
if($_POST['edit'] != 0){
    $id = $_POST['edit'];
    $categories->edit($nome,$codigo, $id);
}else{
    $categories->create($nome,$codigo);

}


?>