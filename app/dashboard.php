<!doctype html>
<html ⚡>

<head>
  <?php
  include "./includes/config.php";
  /* Head */
  include "./includes/head.php";
  ?>
  <title>Webjump | Backend Test | Dashboard</title>
</head>
<?php
/* Header */
include "./includes/header.php";
?>

<body>
  <?php 
  // SELECIONA TODAS AS CATEGORIAS
  $produtos = $products->selectAll();
  $quantidade = count($produtos);
  ?>
  <!-- Main Content -->
  <main class="content">
    <div class="header-list-page">
      <h1 class="title">Dashboard</h1>
    </div>
    <div class="infor">
      You have <?= $quantidade ?> products added on this store: <a href="addProduct.php" class="btn-action">Add new Product</a>
    </div>
    <ul class="product-list">
      <?php foreach($produtos as $produto): ?>
      <li>
        <div class="product-image">
          <img src="./assets/images/product/tenis-runner-bolt.png" layout="responsive" width="164" height="145" alt="Tênis Runner Bolt" />
        </div>
        <div class="product-info">
          <div class="product-name"><span><?= $produto->name ?></span></div>
          <div class="product-price"><span class="special-price">9 available</span> <span>R$<?= $produto->price ?></span></div>
        </div>
      </li>
      <?php endforeach; ?>
      
    </ul>
  </main>
  <!-- Main Content -->
</body>

<!-- Footer -->
<?php include "./includes/footer.php"; ?>
<!-- Footer -->

</html>