<?php
include "./includes/config.php";
?>
<!doctype html>
<html ⚡>
<?php
/* Head */
include "./includes/head.php";
?>
<title>Webjump | Backend Test | Add Category</title>
</head>

<?php
/* Header */
include "./includes/header.php";
?>
<!-- Header -->

<body>
  <?php 
    //EDIÇÃO
    if(isset($_GET['id'])):
      $codigo_produto = $_GET['id'];
      if($codigo_produto > 0 )
      {
        $dados  = json_decode($categories->select($codigo_produto));
        $nome   = $dados[0]->category_name;
        $codigo = $dados[0]->category_code;
      }
    endif;
  ?>
  <!-- Main Content -->
  <main class="content">
    <h1 class="title new-item">New Category</h1>

    <form  method='POST'>
      <div class="input-field">
        <label for="category-name" class="label">Category Name</label>
        <input type="text" id="category-name" class="input-text" name='nome' value='<?= (isset($nome)) ? $nome : '' ?>' />

      </div>
      <div class="input-field">
        <label for="category-code" class="label">Category Code</label>
        <input type="text" id="category-code" class="input-text" name='codigo' value='<?= (isset($codigo)) ? $codigo : '' ?>' />

      </div>
      <div class="actions-form">
        <a href="categories.php" class="action back">Back</a>
        <a href='javascript:' class="btn-submit btn-action" onclick='submitForm()'>Save</a>
      </div>
    </form>
  </main>
  <!-- Main Content -->
</body>
<script>
  function submitForm() {
    var nome = document.getElementById("category-name").value;
    var codigo = document.getElementById("category-code").value;
    var id = <?= (isset($_GET['id'])) ? $codigo_produto  : '0'; ?>;

    if(nome.length > 0 || codigo.length > 0){
      //envia requisição ajax para deletar sem recarregar a página
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "./actions/addCategory.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("nome=" + nome +"&codigo="+codigo+"&edit="+id);
  
      window.location="./categories.php";
    }
    else{
      alert("Campos obrigatórios não preenchidos, revise seu formulário =)");
    }
  }
</script>
<!-- Footer -->
<?php include "./includes/footer.php"; ?>
<!-- Footer -->

</html>