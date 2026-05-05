<?php
// Récupération des produits depuis la base de données
$stmt = $pdo->prepare("
    SELECT id, nom, description, image_url, prix, categorie_id, stock
    FROM produits
    ORDER BY categorie_id, id
");

$stmt->execute();

$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* 2. Group products by category */
$sections = [];
$byId     = [];

foreach ($produits as $produit) {
    $sections[$produit['categorie_id']][] = $produit;
    $byId[$produit['id']] = $produit;
}
