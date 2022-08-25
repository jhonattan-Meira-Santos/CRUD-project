<?php
include "./includes/config.php";
?>
<!doctype html>
<html ⚡>
<?php 
/* Head */
include "./includes/head.php";
?>
<title>Webjump | Backend Test | Add Product</title>
</head>

<?php
/* Header */
include "./includes/header.php";
?>
<!-- Main Content -->

<body>
  <?php
  //EDIÇÃO
  if(isset($_GET['id'])){
    $codigo_produto = $_GET['id'];
    if($codigo_produto > 0 )
    {
      $dados      = json_decode($products->select($codigo_produto));
      $nome       = $dados[0]->name;
      $sku        = $dados[0]->sku;
      $preco      = $dados[0]->price;
      $quantidade = $dados[0]->quantity;
      $categorias_selecionada  = json_decode($categories->selectCategory($codigo_produto));
      $descricao  = $dados[0]->description;
    }
  }
  /* Busca Todas as Categorias Contidas no Banco */
  $categorias = $categories->selectAll();
  ?>

  <main class="content">
    <h1 class="title new-item">New Product</h1>

    <form method='POST'>
      <div class="input-field">
        <label for="sku" class="label">Product SKU</label>
        <input type="text" id="sku" class="input-text" name='sku' value='<?= (isset($sku)) ? $sku : '' ?>'/>
      </div>
      <div class="input-field">
        <label for="name" class="label">Product Name</label>
        <input type="text" id="name" class="input-text" name='name' value='<?= (isset($nome)) ? $nome : '' ?>'/>
      </div>
      <div class="input-field">
        <label for="price" class="label">Price</label>
        <input type="text" id="price" class="input-text" name='price' value='<?= (isset($preco)) ? $preco : '' ?>'/>
      </div>
      <div class="input-field">
        <label for="quantity" class="label">Quantity</label>
        <input type="text" id="quantity" class="input-text" name='quantity' value='<?= (isset($quantidade)) ? $quantidade : '' ?>'/>
      </div>
      <div class="input-field">
        <label for="category" class="label">Categories</label>
        <select multiple id="category" class="input-text" name='categories[]' >
          <?php foreach($categorias as $categoria): ?>
            <option <?= (isset($categorias_selecionada) && array_search($categoria->id,$categorias_selecionada)) ? "selected" : '' ?> value='<?= $categoria->id ?>'><?= $categoria->category_name ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="input-field">
        <label for="description" class="label">Description</label>
        <textarea id="description" class="input-text" name='description'><?= (isset($descricao)) ? $descricao : '' ?></textarea>
      </div>
      <div class="actions-form">
        <a href="products.php" class="action back">Back</a>
        <a href='javascript:' class="btn-submit btn-action" onclick='submitForm()'>Save Product</a>
      </div>

    </form>
  </main>
</body>
<!-- Main Content -->
<!-- Script -->
<script>
  function submitForm() {
    var arr = [];
    var nome       = document.getElementById("name").value;
    var sku        = document.getElementById("sku").value;
    var preco      = document.getElementById("price").value;
    var quantidade = document.getElementById("quantity").value;

    //CATEGORIAS
    var options  =  document.querySelectorAll("#category option:checked");
    const categorias = Array.from(options).map(el => el.value);
      
    var descricao  = document.getElementById("description").value;
    var id = <?= (isset($_GET['id'])) ? $codigo_produto  : '0'; ?>;

    if(nome.length > 0 || codigo.length > 0 || sku.length > 0 || preco.length > 0 || quantidade.length > 0 || descricao.length > 0){
      //envia requisição ajax para deletar sem recarregar a página
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "./actions/addProduct.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("name=" + nome +"&sku="+sku+"&price="+preco+"&quantity="+quantidade+"&categories[]="+categorias+"&description="+descricao+"&edit="+id);
  
      window.location="./products.php";
    }
    else{
      alert("Campos obrigatórios não preenchidos, revise seu formulário =)");
    }
  }
</script>

  <!-- Footer -->
  <?php include "./includes/footer.php"; ?>
 <!-- Footer -->
</body>

</html>