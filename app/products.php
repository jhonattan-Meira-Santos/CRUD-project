<?php
include "./includes/config.php";
?>
<!doctype html>
<html ⚡>
<?php 
/* Head */
include "./includes/head.php";
?>
<title>Webjump | Backend Test | Products</title>
</head>

<?php
/* Header */
include "./includes/header.php";
?>

<body>
    <?php
    $produtos = $products->selectAll();
    ?>
    <!-- Main Content -->
    <main class="content">
        <div class="header-list-page">
            <h1 class="title">Products</h1>
            <a href="addProduct.php" class="btn-action">Add new Product</a>
        </div>
        <table class="data-grid">
            <tr class="data-row">
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Name</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">SKU</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Price</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Quantity</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Categories</span>
                </th>

                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Actions</span>
                </th>
            </tr>
            <?php foreach ($produtos as $produto) : ?>
                <!-- Seleciona as Categorias -->
                <?php
                    $categorias = json_decode($categories->selectCategoryProduct($produto->id));
                ?>
                <tr class="data-row" id='conteudo-<?= $produto->id?>'>
                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $produto->name ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $produto->sku ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content">R$ <?= $produto->price ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $produto->quantity ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content">
                            <?php 
                            foreach($categorias as $categoria):
                                echo $categoria->category_name."<br>";
                            endforeach;
                            ?>
                        </span>
                    </td>

                    <td class="data-grid-td">
                        <div class="actions">
                            <a href='./addProduct.php?id=<?= $produto->id?>'><div class="action edit"><span>Edit</span></div></a>
                            <a href='javascript:' onclick='deleteProdutos(<?= $produto->id?>)'><div class="action delete" ><span>Delete</span></div></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <!-- Main Content -->
</body>
<!-- Scripts -->
<script>
    function deleteProdutos(id) {
        //envia requisição ajax para deletar sem recarregar a página
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "./actions/deleteProduct.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id);

        //Deleta linha da tabela
        var elemento = document.getElementById('conteudo-'+id);
        elemento = elemento.remove();
    }
</script>
<!-- Footer -->
<?php include "./includes/footer.php"; ?>
<!-- Footer -->

</html>