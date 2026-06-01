<?php
namespace Axiom\Modele;

class PaiementModel {
    private \PDO $pdo;

    private array $deliveryLabels = [
        'standard' => 'Standard (3 a 5 jours)',
        'express'  => 'Express (24h a 48h)',
        'pickup'   => 'Retrait en magasin',
    ];

    private array $deliveryPrices = [
        'standard' => 7.90,
        'express'  => 14.90,
        'pickup'   => 0.00,
    ];

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getOrderSummary(array $cartSession, ?string $deliveryMode): array {
        $deliveryLabel  = $this->deliveryLabels[$deliveryMode] ?? 'Non selectionne';
        $shippingAmount = $this->deliveryPrices[$deliveryMode] ?? 0.00;

        $cart = [];
        foreach ($cartSession as $productId => $quantity) {
            $cleanProductId = filter_var($productId, FILTER_VALIDATE_INT);
            $cleanQuantity  = filter_var($quantity, FILTER_VALIDATE_INT);
            if ($cleanProductId && $cleanQuantity && $cleanQuantity > 0) {
                $cart[$cleanProductId] = $cleanQuantity;
            }
        }

        $cartItems = [];
        $subtotal  = 0.0;

        if ($cart !== []) {
            $ids          = array_keys($cart);
            $placeholders = implode(',', array_fill(0, count($ids), '?'));

            $stmt = $this->pdo->prepare("
                SELECT id, nom, prix
                FROM produits
                WHERE id IN ($placeholders)
            ");
            $stmt->execute($ids);
            $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($produits as $produit) {
                $productId = (int) $produit['id'];
                $quantity  = $cart[$productId] ?? 0;
                if ($quantity < 1) continue;

                $unitPrice = (float) $produit['prix'];
                $lineTotal = $unitPrice * $quantity;
                $subtotal += $lineTotal;

                $cartItems[] = [
                    'nom'        => $produit['nom'],
                    'quantity'   => $quantity,
                    'line_total' => $lineTotal,
                ];
            }
        }

        return [
            'deliveryMode'   => $deliveryMode,
            'deliveryLabel'  => $deliveryLabel,
            'shippingAmount' => $shippingAmount,
            'cartItems'      => $cartItems,
            'subtotal'       => $subtotal,
            'grandTotal'     => $subtotal + $shippingAmount,
        ];
    }
}
