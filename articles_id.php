<?php
include 'header.php';
include 'nav.php';
include_once 'connexion.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT titre, contenu, dateCreation AS date, categorie FROM article WHERE id = :id";
    $categorie = "SELECT libelle FROM categorie WHERE id = (SELECT categorie FROM article WHERE id = :id)";
    $pdo = new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'baye', 'Passser@123');
    $stmt = $pdo->prepare($sql);
    $cat = $pdo->prepare($categorie);
    $cat->execute(['id' => $id]);
    $catResult = $cat->fetch(PDO::FETCH_ASSOC);
    if ($catResult) {
        $categorie = $catResult['libelle'];
    } else {
        $categorie = 'Inconnue';
    }
    $stmt->execute(['id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        echo '<div class="container mt-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">' . htmlspecialchars($article['titre']) . '</h2>';
        echo '<p class="text-muted">Catégorie : ' . htmlspecialchars($categorie) . ' | Publié le ' . htmlspecialchars($article['date']) . '</p>';
        echo '<p class="card-text">' . nl2br(htmlspecialchars($article['contenu'])) . '</p>';
        echo '<a href="index.php" class="btn btn-secondary mt-3">Retour à la liste</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning mt-4">Article non trouvé.</div>';
    }
} else {
    echo '<div class="alert alert-danger mt-4">Identifiant d\'article invalide.</div>';
}
 ?>