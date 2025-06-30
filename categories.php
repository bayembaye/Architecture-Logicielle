<?php
function getCategories() {
    $pdo = new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'baye', 'Passser@123');
    $sql = "SELECT id, nom FROM categorie ORDER BY nom";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>