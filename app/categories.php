<?php
include "./includes/config.php";
?>
<!doctype html>
<html ⚡>
<?php
/* Head */
include "./includes/head.php";
?>
<title>Webjump | Backend Test | Categories</title>
</head>

<?php
/* Header */
include "./includes/header.php";
?>
  
<body>
  <?php
  // SELECIONA TODAS AS CATEGORIAS
  $categorias = $categories->selectAll(); 
  ?>
  <!-- Main Content -->
  <main class="content">
    <div class="header-list-page">
      <h1 class="title">Categories</h1>
      <a href="addCategory.php" class="btn-action">Add new Category</a>
    </div>
    <table class="data-grid">
      <tr class="data-row">
        <th class="data-grid-th">
          <span class="data-grid-cell-content">Name</span>
        </th>
        <th class="data-grid-th">
          <span class="data-grid-cell-content">Code</span>
        </th>
        <th class="data-grid-th">
          <span class="data-grid-cell-content">Actions</span>
        </th>
      </tr>
      <?php
      foreach ($categorias as $categoria) :
      ?>
        <tr class="data-row" id='conteudo-<?= $categoria->id ?>'>
          <td class="data-grid-td">
            <span class="data-grid-cell-content"><?= $categoria->category_name ?></span>
          </td>

          <td class="data-grid-td">
            <span class="data-grid-cell-content"><?= $categoria->category_code ?></span>
          </td>

          <td class="data-grid-td">
            <div class="actions">
              <a href='addCategory.php?id=<?= $categoria->id ?>'>
                <div class="action edit"><span>Edit</span></div>
              </a>
              <a href='javascript:' onclick="deleteCategoria('<?= $categoria->id ?>')">
                <div class="action delete"><span>Delete</span></div>
              </a>
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
  function deleteCategoria(id) {
    //envia requisição ajax para deletar sem recarregar a página
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./actions/deleteCategory.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);

    //Deleta linha da tabela
    var elemento = document.getElementById('conteudo-' + id);
    elemento = elemento.remove();
  }
</script>
<!-- Footer -->
<?php include "./includes/footer.php"; ?>
<!-- Footer -->

</html>