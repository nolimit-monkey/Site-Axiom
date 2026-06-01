# Axiom — E-commerce de pièces BMW

Site e-commerce en PHP (architecture MVC) pour la vente de pièces détachées pour véhicules BMW.

---

## Prérequis

| Outil | Version minimale |
|-------|-----------------|
| PHP | 8.1+ |
| MySQL / MariaDB | 5.7+ / 10.3+ |
| Apache | 2.4+ avec `mod_rewrite` activé |
| XAMPP (recommandé) | 8.x |

> PHP 8.1 requis pour `str_starts_with()` utilisé dans l'autoloader.

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/nolimit-monkey/axiom.git
cd axiom
```

Placer le dossier dans `C:\xampp\htdocs\axiom` (ou l'équivalent de votre `htdocs`).

### 2. Base de données

1. Ouvrir **phpMyAdmin** (ou un client MySQL)
2. Créer une base nommée `axiom`
3. Importer le fichier SQL du projet (si disponible)

### 3. Configuration de la base de données

Éditer [config/database.php](config/database.php) :

```php
$host     = "localhost";
$dbname   = "axiom";
$username = "root";
$password = "votre_mot_de_passe";
```

> Ne jamais committer ce fichier avec des identifiants réels en production.

### 4. Apache — activer `mod_rewrite`

Le fichier [`.htaccess`](.htaccess) redirige toutes les requêtes vers `index.php`.  
S'assurer que `mod_rewrite` est activé dans `httpd.conf` :

```apache
LoadModule rewrite_module modules/mod_rewrite.so
```

Et que le VirtualHost autorise les overrides :

```apache
<Directory "C:/xampp/htdocs/axiom">
    AllowOverride All
</Directory>
```

### 5. Lancer le projet

Démarrer **Apache** et **MySQL** depuis le panneau XAMPP, puis ouvrir :

```
http://localhost/axiom/
```

---

## Structure du projet

```
axiom/
├── index.php               # Point d'entrée unique (routeur)
├── .htaccess               # Réécriture d'URL vers index.php
├── config/
│   ├── config.php          # Constantes globales (BASE_URL)
│   ├── database.php        # Connexion PDO
│   └── autoload.php        # Autoloader PSR-4 (namespaces Axiom\)
├── CONTROLEUR/
│   ├── Controleur.php      # Classe de base des contrôleurs
│   ├── AccueilControleur.php
│   ├── ProduitControleur.php
│   ├── PanierControleur.php
│   ├── InscriptionControleur.php
│   ├── FacturationControleur.php
│   ├── PaiementControleur.php
│   └── ConfirmationControleur.php
├── MODELE/
│   ├── ProduitModel.php
│   ├── PanierModel.php
│   ├── PaiementModel.php
│   └── ConfirmationModel.php
└── VUE/
    ├── accueil.php
    ├── produit.php (via ProduitControleur)
    ├── panier.php
    ├── inscription.php
    ├── facturation.php
    ├── paiement.php
    ├── confirmation.php
    ├── header.php
    └── 404.php
```

---

## Routes disponibles

| URL | Contrôleur | Description |
|-----|-----------|-------------|
| `/` | `AccueilControleur` | Page d'accueil |
| `/produit` | `ProduitControleur` | Catalogue de pièces |
| `/panier` | `PanierControleur` | Panier d'achat |
| `/inscription` | `InscriptionControleur` | Création de compte |
| `/facturation` | `FacturationControleur` | Adresse de facturation |
| `/paiement` | `PaiementControleur` | Paiement de la commande |
| `/confirmation` | `ConfirmationControleur` | Confirmation de commande |

Toute URL inconnue retourne une page 404.

---

## Architecture MVC

- **Modèle** : accès base de données via PDO, namespace `Axiom\Modele`
- **Vue** : fichiers PHP dans `VUE/`, inclus par les contrôleurs
- **Contrôleur** : logique métier, namespace `Axiom\Controleur`
- **Routeur** : `index.php` résout le chemin et instancie le bon contrôleur

L'autoloader (`config/autoload.php`) mappe automatiquement les namespaces sur les dossiers — aucune dépendance Composer requise.

---

## Sécurité

- Les mots de passe de base de données ne doivent pas être versionnés
- Ajouter `config/database.php` au `.gitignore` en environnement réel
- Valider et échapper toutes les entrées utilisateur côté serveur