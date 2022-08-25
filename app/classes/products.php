<?php

use FFI\Exception;

class products
{
    protected $pdo;

    /*
    / Função Construtor
    */
    public function __construct() 
    {
        $this->pdo = conectar();
    }
    /*
    / Seleciona todos os dados
    */
    public function selectAll()
    {
        $sql = "SELECT * FROM products";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Seleciona todos os dados
    */
    public function select($id)
    {
        $sql = "SELECT * FROM products WHERE id= :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id"=>$id]);

            return json_encode($stmt->fetchAll(PDO::FETCH_CLASS));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Cria novo Produto no banco de dados
    / @string nome
    / @string sku 
    / @float preco 
    / @string descricao 
    / @string categories 
    */
    public function create($nome, $sku, $preco, $quantidade, $descricao, $optionsCategories)
    {
        $sql = "INSERT INTO products SET name = :nome, sku = :sku, price = :preco, quantity = :quantidade, description = :descricao";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "sku" => $sku,
                "preco" => $preco,
                "quantidade" => $quantidade,
                "descricao" => $descricao
            ]);

            //Recebe o ultimo ID inserido na Tabela de Produtos
            $id_product = $this->pdo->lastInsertId();

            $stmt->fetchAll(PDO::FETCH_CLASS);

            $categories = explode(",", $optionsCategories[0]);
            //Insere cada Categoria escolhida
            foreach($categories as $category){
                $insert_categorias_sql = "INSERT INTO category_product SET product_id = :id_product, category_id = :id_category";
                try {
                    $statemt = $this->pdo->prepare($insert_categorias_sql);
                    $statemt->execute([
                        "id_product" => $id_product,
                        "id_category" => $category
                    ]);
                    $statemt->fetchAll(PDO::FETCH_CLASS);
                }catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*
    / Cria novo Produto no banco de dados
    / @string nome
    / @string sku 
    / @float preco 
    / @string descricao 
    / @string categories 
    / @integer edit 
    */
    public function edit($nome, $sku, $preco, $quantidade, $descricao, $optionsCategories, $edit)
    {
        $sql = "UPDATE products SET name = :nome, sku = :sku, price = :preco, quantity = :quantidade, description = :descricao WHERE id = :id_produto ";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "sku" => $sku,
                "preco" => $preco,
                "quantidade" => $quantidade,
                "id_produto" => $edit,   
                "descricao" => $descricao,
            ]);

            $stmt->fetchAll(PDO::FETCH_CLASS);

            $categories = explode(",", $optionsCategories[0]);
            
            //DELETA TODAS AS CATEGORIAS ANTIGAS
            $delete_categorias = "DELETE FROM category_product WHERE product_id = :id_product";
            $stat = $this->pdo->prepare($delete_categorias);
            $stat->execute([
                "id_product" => $edit,
            ]);
            $stat->fetchAll(PDO::FETCH_CLASS);
            foreach($categories as $category){

                //INSERE NOVAMENTE
                $insert_categorias_sql = "INSERT INTO category_product SET product_id = :id_product, category_id = :id_category";
                try {
                    $statemt = $this->pdo->prepare($insert_categorias_sql);
                    $statemt->execute([
                        "id_product" => $edit,
                        "id_category" => $category
                    ]);
                    $statemt->fetchAll(PDO::FETCH_CLASS);
                }catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Deleta categoria do banco de dados
    / @integer id
    */
    public function deleteProdutos($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "id" => $id,
            ]);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
