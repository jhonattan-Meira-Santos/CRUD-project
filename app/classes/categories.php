<?php

use FFI\Exception;

class categories
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
        $sql = "SELECT * FROM categories";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Seleciona categorias especificas
    */
    public function select($codigo)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "id" => $codigo,
            ]);
            $stmt->execute();

            //Dados  
            $dados = $stmt->fetchAll(PDO::FETCH_CLASS);

            return json_encode($dados);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*
    / Seleciona produtos e suas Categorias contidas no produto
    / @int codigo
    */
    public function selectCategoryProduct($codigo)
    {
        $sql = "SELECT * FROM category_product as cp,categories as c WHERE cp.product_id = :product_id and c.id = cp.category_id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "product_id" => $codigo,
            ]);
            $stmt->execute();

            //Dados  
            $dados = $stmt->fetchAll(PDO::FETCH_CLASS);

            return json_encode($dados);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*
    / Seleciona produtos e suas Categorias contidas no produto
    / @int codigo
    */
    public function selectCategory($codigo)
    {
        $sql = "SELECT category_id FROM category_product as cp WHERE cp.product_id = :product_id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "product_id" => $codigo,
            ]);
            $stmt->execute();

            //Dados  
            $dados = $stmt->fetchAll(PDO::FETCH_CLASS);

            return json_encode($dados);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Atualiza categoria no banco de dados
    / @string nome
    / @string codigo 
    */
    public function edit($nome, $codigo, $edit)
    {
        $sql = "UPDATE categories SET category_name = :nome, category_code = :codigo WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "codigo" => $codigo,
                "id"=>$edit
            ]);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*
    / Cria nova categoria no banco de dados
    / @string nome
    / @string codigo 
    */
    public function create($nome, $codigo)
    {
        $sql = "INSERT INTO categories SET category_name = :nome, category_code = :codigo";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "codigo" => $codigo
            ]);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*
    / Deleta categoria do banco de dados
    / @integer id
    */
    public function deleteCategoria($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";

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
