<?php

function conectar(){
    $dbname="webjump"; // Indique o nome do banco de dados que será aberto
 
    $usuario="root"; // Indique o nome do usuário que tem acesso
     
    $password=""; // Indique a senha do usuário
    
    $hostname="localhost:3306";
    
    try {
       $pdo = new pdo("mysql:host=$hostname;dbname=$dbname;",$usuario,$password);
       $pdo->exec("SET CHARACTER SET utf8");
    } catch(\Throwable $e) {
        return $e;
        die;
    }
    return $pdo;
}

