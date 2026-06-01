<?php
$produit = null;
if ($id) {
    $stmt = $pdo->prepare("
        SELECT id, nom, description, image_url, prix, categorie_id, stock
        FROM produits
        WHERE id = :id
        LIMIT 1
    ");
    $stmt->execute(['id' => $id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$produit) {
    http_response_code(404);
}

$nom = $produit['nom'] ?? "Produit introuvable";
$description = $produit['description'] ?? "Ce produit n'existe pas.";
$prix = $produit['prix'] ?? null;
$imageUrl = $produit['image_url'] ?? null;

$imageFile = $imageUrl ?: "logo_axiom.png";
$imageSrc = BASE_URL . "public/" . htmlspecialchars($imageFile);

$title = $nom ?: "Produit";
