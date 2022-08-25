<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
  <div class="close-menu">
    <a on="tap:sidebar.toggle">
      <img src="./assets/images/bt-close.png" alt="Close Menu" width="24" height="24" />
    </a>
  </div>
  <a href="dashboard.php"><img src="./assets/images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
  <div>
    <ul>
      <li><a href="./categories.php" class="link-menu">Categorias</a></li>
      <li><a href="./products.php" class="link-menu">Produtos</a></li>
    </ul>
  </div>
</amp-sidebar>
<header>
  <div class="go-menu">
    <a on="tap:sidebar.toggle">☰</a>
    <a href="dashboard.php" class="link-logo"><img src="./assets/images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
  </div>
  <div class="right-box">
    <a href="./products.php"><span class="go-title">Administration Panel</span></a>
  </div>
</header>