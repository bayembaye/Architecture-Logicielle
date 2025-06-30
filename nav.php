<html>
        <?php include 'header.php'; 
        $pdo = new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'baye', 'Passser@123');
        $sql = "SELECT id, libelle FROM categorie ORDER BY libelle";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <body>
        <nav>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Senegal News</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="articles.php">Articles</a>
        </li>
        <?php foreach ($cats as $cat): ?>
        <li class="nav-item">
          <a class="nav-link" href="articles.php?cat=<?php echo $cat['id']; ?>">
            <?php echo htmlspecialchars($cat['libelle']); ?>
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>
        </nav>
    </body>
</html>