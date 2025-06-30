 <?php
    include 'header.php';
    include_once 'nav.php';
    include_once 'connexion.php';
    $articles = [];
    $categorie = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
    $pdo = new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'baye', 'Passser@123');
    if ($categorie) {
    $sql = "SELECT id, titre, contenu, dateCreation AS date, categorie FROM article WHERE categorie = :categorie ORDER BY dateCreation DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categorie' => $categorie]);
} else {
    $sql = "SELECT id, titre, contenu, dateCreation AS date, categorie FROM article ORDER BY dateCreation DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$articles) {
        echo '<div class="alert alert-info mt-4">Aucun article trouvé .</div>';
        return;
    }
    foreach ($articles as $article) {
        $extrait = mb_substr($article['contenu'], 0, 150) . (mb_strlen($article['contenu']) > 150 ? '...' : '');
        echo '<div class="row">';
        echo '<div class="col-md-8">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">' . htmlspecialchars($article['titre']) . '</h2>';
        // echo '<p class="card-text">' . htmlspecialchars($article['contenu']) . '</p>';
        echo '<p class="card-text">' . htmlspecialchars($extrait) . '</p>';
        echo '<a href="articles_id.php?id=' . $article['id'] . '" class="btn btn-success btn-sm">Lire la suite</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>